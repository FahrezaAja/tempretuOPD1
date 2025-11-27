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
    /**
     * Menampilkan form login untuk admin & super admin.
     */
    public function showLoginForm()
    {
        return view('admin.login');
    }

    /**
     * Proses login awal: verifikasi username & password,
     * generate OTP jika valid.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // ✅ Cek role valid (admin atau super)
            if (!in_array($user->role, ['admin', 'super'])) {
                Auth::logout();
                return back()->withErrors(['username' => 'Akun ini bukan admin atau super admin.']);
            }

            // ⬇️ Bagian rate limit DIHAPUS

            // Generate OTP
            $otp = rand(100000, 999999);

            $user->otp_code = $otp;
            $user->otp_expires_at = Carbon::now()->addMinutes(5);

            $user->save();

            // Kirim email OTP
            try {
                Mail::to($user->gmail)->send(new OtpMail($otp));
            } catch (\Exception $e) {
                $user->otp_code = null;
                $user->otp_expires_at = null;
               
                $user->save();

                Auth::logout();
                return back()->withErrors(['username' => 'Gagal mengirim OTP ke email. Periksa konfigurasi mail.']);
            }

            Auth::logout();
            session(['otp_user_id' => $user->id]);

            return redirect()->route('admin.otp.form')->with('success', 'Kode OTP telah dikirim ke email Anda.');
        }

        return back()->withErrors(['username' => 'Username atau password salah.']);
    }


    /**
     * Form OTP
     */
    public function showOtpForm()
    {
        return view('admin.otp');
    }

    /**
     * Verifikasi OTP dan arahkan ke dashboard sesuai role.
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp_code' => ['required', 'digits:6'],
        ]);

        $userId = session('otp_user_id');
        if (!$userId) {
            return redirect()->route('admin.login')
                ->withErrors(['otp_code' => 'Session OTP tidak valid.']);
        }

        $user = User::find($userId);
        if (!$user) {
            return redirect()->route('admin.login')
                ->withErrors(['otp_code' => 'User tidak ditemukan.']);
        }

       
        if ($user->otp_code !== $request->otp_code) {
            return back()->withErrors(['otp_code' => 'Kode OTP salah.']);
        }

        if (Carbon::now()->greaterThan($user->otp_expires_at)) {
            return back()->withErrors(['otp_code' => 'Kode OTP sudah kedaluwarsa.']);
        }

        // ✅ OTP valid, reset field OTP
        $user->otp_code = null;
        $user->otp_expires_at = null;
        $user->otp_attempts = 0; 
        $user->save();

        Auth::login($user);
        session()->forget('otp_user_id');

        // 🔹 Arahkan ke dashboard sesuai role
        if ($user->role === 'super') {
            return redirect()->route('super.dashboard')
                ->with('success', 'Selamat datang Super Admin!');
        }

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard')
                ->with('success', 'Selamat datang Admin!');
        }

        Auth::logout();
        return redirect()->route('admin.login')
            ->withErrors(['msg' => 'Role tidak dikenali.']);
    }


    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Berhasil logout.');
    }
}
