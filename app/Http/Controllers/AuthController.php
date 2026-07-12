<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Tampilkan halaman login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Proses Login
    public function login(Request $request)
    {
        // Validasi input dasar
        $request->validate([
            'role' => 'required|in:bendahara,siswa',
            'identifier' => 'required', // Bisa Email (bendahara) atau Nama (siswa)
            'password' => 'required',   // Bisa Password (bendahara) atau NIS (siswa)
        ]);

        $user = null;

        // Logika pencarian user berdasarkan Role
        if ($request->role === 'bendahara') {
            // Bendahara login pakai Email
            $user = User::where('email', $request->identifier)
                        ->where('role', 'bendahara')
                        ->first();
        } else {
            // Siswa login pakai Nama
            $user = User::where('name', $request->identifier)
                        ->where('role', 'siswa')
                        ->first();
        }

        // Cek apakah user ditemukan dan password/NIS cocok
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);

            // Redirect berdasarkan role
            if ($user->role === 'bendahara') {
                return redirect()->route('dashboard.bendahara');
            } else {
                return redirect()->route('dashboard.siswa');
            }
        }

        // Jika gagal
        return back()->withErrors([
            'identifier' => 'Kredensial tidak valid. Cek kembali Nama/Email dan Password/NIS Anda.',
        ])->withInput();
    }

    // Proses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
