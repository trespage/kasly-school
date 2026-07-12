<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SiswaMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Cek apakah role = siswa
        if (Auth::user()->role !== 'siswa') {
            // Jika bukan siswa, redirect sesuai role
            if (Auth::user()->role === 'bendahara') {
                return redirect()->route('dashboard.bendahara');
            }

            return redirect()->route('login')->withErrors([
                'email' => 'Anda tidak memiliki akses sebagai siswa.',
            ]);
        }

        return $next($request);
    }
}
