<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Mail\OtpMail;
use App\Models\User;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    /**
     * Proses login awal: cek username/password,
     * kalau benar dan role = admin -> generate & kirim OTP,
     * lalu redirect ke halaman OTP (belum di-authenticate penuh).
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // Coba akses dengan Auth::attempt untuk verifikasi kredensial
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Pastikan role admin
            if ($user->role !== 'admin') {
                Auth::logout();
                return back()->withErrors(['username' => 'Akun ini bukan admin.']);
            }

            // Cek apakah user kena rate-limit (>=5 send dalam waktu singkat)
            if ($user->otp_last_sent_at && $user->otp_attempts >= 5) {
                $diff = Carbon::now()->diffInSeconds($user->otp_last_sent_at);
                if ($diff < 30) {
                    Auth::logout();
                    return back()->withErrors(['username' => 'Terlalu banyak percobaan OTP. Coba lagi dalam 30 detik.']);
                } else {
                    // reset counter jika lebih dari 30 detik sudah lewat
                    $user->otp_attempts = 0;
                }
            }

            // Generate OTP 6-digit
            $otp = rand(100000, 999999);

            // Simpan OTP (plain 6 digit sesuai permintaan; kalau mau lebih aman, hash)
            $user->otp_code = $otp;
            $user->otp_expires_at = Carbon::now()->addMinutes(5); // kadaluarsa 5 menit
            $user->otp_attempts = $user->otp_attempts + 1;
            $user->otp_last_sent_at = Carbon::now();
            $user->save();

            // Kirim OTP ke email (gmail)
            try {
                Mail::to($user->gmail)->send(new OtpMail($otp));
            } catch (\Exception $e) {
                // jika gagal kirim email, rollback OTP fields (opsional)
                $user->otp_code = null;
                $user->otp_expires_at = null;
                $user->otp_attempts = max(0, $user->otp_attempts - 1);
                $user->otp_last_sent_at = null;
                $user->save();

                Auth::logout();
                return back()->withErrors(['username' => 'Gagal mengirim OTP ke email. Periksa konfigurasi mail.']);
            }

            // logout sementara (karena Auth::attempt sudah berhasil sebelumnya)
            Auth::logout();

            // simpan ID user di session untuk proses OTP
            session(['otp_user_id' => $user->id]);

            return redirect()->route('admin.otp.form')->with('success', 'Kode OTP telah dikirim ke email Anda.');
        }

        return back()->withErrors(['username' => 'Username atau password salah.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Berhasil logout.');
    }
}
