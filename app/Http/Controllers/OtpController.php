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
        // Pastikan ada session otp_user_id
        if (!session('otp_user_id')) {
            return redirect()->route('admin.login')->withErrors(['username' => 'Sesi login tidak ditemukan. Silakan login kembali.']);
        }

        return view('admin.otp');
    }

    /**
     * Verifikasi kode OTP.
     */
    public function verify(Request $request)
    {
        $request->validate(['otp' => 'required|digits:6']);

        $userId = session('otp_user_id');
        if (!$userId) {
            return redirect()->route('admin.login')->withErrors(['otp' => 'Sesi OTP tidak ditemukan. Silakan login ulang.']);
        }

        $user = User::find($userId);
        if (!$user) {
            session()->forget('otp_user_id');
            return redirect()->route('admin.login')->withErrors(['otp' => 'User tidak ditemukan.']);
        }

        // Cek lock/attempts: jika attempts >= 5 dan last sent kurang dari 30 detik -> tolak
        if ($user->otp_last_sent_at && $user->otp_attempts >= 5) {
            $diffLock = Carbon::now()->diffInSeconds($user->otp_last_sent_at);
            if ($diffLock < 30) {
                return back()->withErrors(['otp' => 'Terlalu banyak percobaan. Silakan tunggu ' . (30 - $diffLock) . ' detik.']);
            } else {
                // reset attempts bila lock time sudah lewat
                $user->otp_attempts = 0;
                $user->save();
            }
        }

        // Cek expired
        if (!$user->otp_expires_at || Carbon::now()->greaterThan($user->otp_expires_at)) {
            return back()->withErrors(['otp' => 'Kode OTP telah kedaluwarsa. Silakan kirim ulang.']);
        }

        // Cek kode OTP
        if ($user->otp_code !== $request->otp) {
            // salah -> bisa berikan batas percobaan verifikasi juga
            $user->otp_attempts = $user->otp_attempts + 1;
            $user->save();

            // jika attempts >= 5 setelah increment -> set locked (enforced via otp_last_sent_at logic)
            if ($user->otp_attempts >= 5) {
                $user->otp_last_sent_at = Carbon::now();
                $user->save();
                return back()->withErrors(['otp' => 'Terlalu banyak percobaan salah. Coba lagi dalam 30 detik.']);
            }

            return back()->withErrors(['otp' => 'Kode OTP salah atau telah kadaluarsa.']);
        }

        // Jika benar -> reset kolom OTP dan lakukan login penuh
        $user->otp_code = null;
        $user->otp_expires_at = null;
        $user->otp_attempts = 0;
        $user->otp_last_sent_at = null;
        $user->otp_resend_count = 0;
        $user->save();

        // Login user (set session)
        Auth::login($user);

        // hapus session otp_user_id
        session()->forget('otp_user_id');

        return redirect()->route('admin.dashboard')->with('success', 'Login berhasil.');
    }

    /**
     * Kirim ulang OTP (resend).
     * Terdapat cooldown 10 detik dan rate-limit 5 kali -> tunggu 30 detik jika kena.
     */
    public function resend(Request $request)
    {
        $user = User::where('id', session('otp_user_id'))->first();

        if (!$user) {
            return redirect()->route('admin.login')->with('error', 'Sesi OTP tidak valid.');
        }

        // Hitung selisih waktu sejak OTP terakhir dikirim (dalam detik)
        $diff = $user->otp_last_sent_at ? $user->otp_last_sent_at->diffInSeconds(Carbon::now()) : 999;

        // Batasi agar tidak bisa kirim ulang dalam 10 detik terakhir
        if ($diff < 10) {
            return back()->with('error', 'Tunggu ' . (10 - $diff) . ' detik sebelum kirim ulang.');
        }

        // Batasi agar tidak bisa kirim lebih dari 5 kali dalam 30 detik terakhir
        if ($user->otp_resend_count >= 5 && $diff < 30) {
            return back()->with('error', 'Anda telah mengirim ulang OTP terlalu sering. Silakan tunggu 30 detik.');
        }

        // Reset hitungan jika sudah lewat 30 detik
        if ($diff >= 30) {
            $user->otp_resend_count = 0;
        }

        return $this->sendNewOtp($user);
    }

    /**
     * Fungsi kirim OTP baru (baik saat login maupun resend).
     */
    private function sendNewOtp(User $user)
    {
        $otp = rand(100000, 999999);

        $user->update([
            'otp_code' => $otp,
            'otp_expires_at' => Carbon::now()->addMinutes(5),
            'otp_last_sent_at' => Carbon::now(),
            'otp_resend_count' => ($user->otp_resend_count ?? 0) + 1,
        ]);

        // Kirim email OTP
        Mail::to($user->gmail)->send(new OtpMail($otp));

        return back()->with('success', 'Kode OTP baru telah dikirim ke email Anda.');
    }
}
