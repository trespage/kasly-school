<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class BendaharaMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Cek apakah role = bendahara
        if (Auth::user()->role !== 'bendahara') {
            // Jika bukan bendahara, redirect sesuai role
            if (Auth::user()->role === 'siswa') {
                return redirect()->route('dashboard.siswa');
            }

            return redirect()->route('login')->withErrors([
                'email' => 'Anda tidak memiliki akses sebagai bendahara.',
            ]);
        }

        return $next($request);
    }
}
