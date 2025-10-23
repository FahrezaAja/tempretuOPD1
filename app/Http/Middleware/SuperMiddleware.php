<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Cek login dan role admin
         if (in_array(Auth::user()->role, ['super'])) {
            return $next($request);
         }

        // Redirect ke admin login jika belum login atau bukan admin
        return redirect()->route('admin.login')->with('error', 'Hanya admin yang boleh masuk.');
    }
}
