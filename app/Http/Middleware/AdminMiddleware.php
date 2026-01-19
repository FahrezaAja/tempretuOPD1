<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
       
        if (!Auth::check()) {
            return redirect()->route('admin.login')
                ->withErrors(['login' => 'Silakan login terlebih dahulu.']);
        }

       
        if (Auth::user()->role === 'admin') {
            return $next($request);
        }

     
        Auth::logout();
        return redirect()->route('admin.login')
            ->withErrors(['role' => 'Akses ditolak. Hanya admin yang boleh masuk.']);
    }
}
