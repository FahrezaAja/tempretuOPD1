<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Mail\OtpMail;

class OtpController extends Controller
{
    /**
     * Tampilkan halaman input OTP.
     */
    public function showForm()
    {
        if (!session('otp_user_id')) {
            return redirect()->route('admin.login')
                ->withErrors(['username' => 'Sesi login tidak ditemukan. Silakan login kembali.']);
        }

        return view('admin.otp');
    }

    /**
     * Verifikasi kode OTP dan arahkan ke dashboard sesuai role.
     * TANPA limit percobaan.
     */
    public function verify(Request $request)
    {
        $request->validate(['otp' => 'required|digits:6']);

        $userId = session('otp_user_id');
        if (!$userId) {
            return redirect()->route('admin.login')
                ->withErrors(['otp' => 'Sesi OTP tidak ditemukan. Silakan login ulang.']);
        }

        $user = User::find($userId);
        if (!$user) {
            session()->forget('otp_user_id');
            return redirect()->route('admin.login')
                ->withErrors(['otp' => 'User tidak ditemukan.']);
        }

        // ❌ Hapus/abaikan semua logika lock & attempts

        // Cek expired
        if (!$user->otp_expires_at || Carbon::now()->greaterThan($user->otp_expires_at)) {
            return back()->withErrors(['otp' => 'Kode OTP telah kedaluwarsa. Silakan kirim ulang.']);
        }

        // Cek kode OTP (tanpa nambah attempts / lock)
        if ($user->otp_code !== $request->otp) {
            return back()->withErrors(['otp' => 'Kode OTP salah.']);
        }

        // ✅ OTP valid – reset field OTP
        $user->otp_code         = null;
        $user->otp_expires_at   = null;
        $user->otp_attempts     = 0;      // boleh dibiarkan untuk reset saja
        $user->otp_last_sent_at = null;   // opsional
        $user->otp_resend_count = 0;      // opsional
        $user->save();

        Auth::login($user);
        session()->forget('otp_user_id');

        // 🔹 Arahkan sesuai role
        if ($user->role === 'super') {
            return redirect()->route('super.dashboard')
                ->with('success', 'Selamat datang, Super Admin!');
        }

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard')
                ->with('success', 'Selamat datang, Admin!');
        }

        Auth::logout();
        return redirect()->route('admin.login')
            ->withErrors(['otp' => 'Role tidak dikenali.']);
    }

    /**
     * Kirim ulang OTP (resend) TANPA limit waktu/jumlah.
     */
    public function resend(Request $request)
    {
        $user = User::where('id', session('otp_user_id'))->first();

        if (!$user) {
            return redirect()->route('admin.login')
                ->with('error', 'Sesi OTP tidak valid.');
        }

        // ❌ Hilangkan semua perhitungan diff, delay 10 detik, 30 detik, dan resend_count

        return $this->sendNewOtp($user);
    }

    /**
     * Fungsi kirim OTP baru (baik saat login maupun resend).
     * Sudah tanpa logika limit.
     */
    private function sendNewOtp(User $user)
    {
        $otp = rand(100000, 999999);

        $user->update([
            'otp_code'       => $otp,
            'otp_expires_at' => Carbon::now()->addMinutes(5),
            'otp_last_sent_at' => Carbon::now(),    // boleh tetap diisi, tapi tidak dipakai limit lagi
            'otp_resend_count' => 0,               // reset / tidak dipakai lagi
        ]);

        Mail::to($user->gmail)->send(new OtpMail($otp));

        return back()->with('success', 'Kode OTP baru telah dikirim ke email Anda.');
    }
}
