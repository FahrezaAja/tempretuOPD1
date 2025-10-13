<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Jika user login dan role admin
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request);
        }

        // Redirect ke login admin dengan session error
        return redirect()->route('admin.login')->with('error', 'Hanya admin yang boleh masuk.');
    }
}
