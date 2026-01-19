<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperMiddleware
{
    public function handle(Request $request, Closure $next)
    {

        if (!Auth::check()) {
            return redirect()->route('admin.login')
                ->withErrors(['login' => 'Silakan login terlebih dahulu.']);
        }


        if (Auth::user()->role === 'super') {
            return $next($request);
        }


        Auth::logout();

        return redirect()->route('admin.login')
            ->withErrors(['role' => 'Akses ditolak. Khusus Super Admin!']);
    }
}
