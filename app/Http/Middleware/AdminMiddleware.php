<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Cek login dan role admin
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Redirect ke admin login jika belum login atau bukan admin
        return redirect()->route('admin.login')->with('error', 'Hanya admin yang boleh masuk.');
    }
}
