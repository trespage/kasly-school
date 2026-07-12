<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $loginType = $request->input('login_type', 'bendahara');

        if ($loginType === 'siswa') {
            // LOGIN SISWA: NIS + PASSWORD
            $request->validate([
                'nis' => 'required|string',
                'password_siswa' => 'required|string',
            ], [
                'nis.required' => 'NIS wajib diisi.',
                'password_siswa.required' => 'Password wajib diisi.',
            ]);

            $user = User::where('nis', $request->nis)
                        ->where('role', 'siswa')
                        ->first();

            if ($user && Hash::check($request->password_siswa, $user->password)) {
                Auth::login($user, $request->filled('remember'));
                $request->session()->regenerate();
                return redirect()->intended(route('dashboard.siswa'));
            }

            return back()->withErrors([
                'nis' => 'NIS atau password salah.',
            ])->onlyInput('nis');

        } else {
            // LOGIN BENDAHARA: EMAIL + PASSWORD
            $request->validate([
                'email' => 'required|email',
                'password_bendahara' => 'required|string',
            ], [
                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'password_bendahara.required' => 'Password wajib diisi.',
            ]);

            if (Auth::attempt([
                'email' => $request->email,
                'password' => $request->password_bendahara,
                'role' => 'bendahara',
            ], $request->filled('remember'))) {
                $request->session()->regenerate();
                return redirect()->intended(route('dashboard.bendahara'));
            }

            return back()->withErrors([
                'email' => 'Email atau password salah.',
            ])->onlyInput('email');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
