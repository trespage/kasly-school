<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class MustChangePasswordMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek jika user sudah login dan flag must_change_password masih true
        if (Auth::check() && Auth::user()->must_change_password) {

            // Izinkan akses ke route logout dan route ganti password
            // Jangan redirect ke route-route ini untuk menghindari loop
            $currentRoute = $request->route()->getName();
            $allowedRoutes = ['logout', 'password.change', 'password.update', 'dashboard.bendahara', 'dashboard.siswa'];

            if (in_array($currentRoute, $allowedRoutes)) {
                return $next($request);
            }

            // Untuk route lain, redirect ke halaman ganti password (nanti kita buat)
            // Untuk sementara, kita redirect ke dashboard saja dengan pesan
            return redirect()->route('dashboard.bendahara')
                ->with('error', 'Anda wajib mengganti password terlebih dahulu!');
        }

        return $next($request);
    }
}
