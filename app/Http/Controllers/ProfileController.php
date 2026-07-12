<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    /**
     * Tampilkan halaman pengaturan
     */
    public function index()
    {
        return view('dashboard.settings');
    }

    /**
     * Update Profil
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'name' => 'required|string|max:255',
        ];

        if ($user->role === 'bendahara') {
            $rules['email'] = 'required|email|unique:users,email,' . $user->id;
        } else {
            $rules['nis'] = 'required|string|unique:users,nis,' . $user->id;
        }

        $request->validate($rules, [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'nis.required' => 'NIS wajib diisi.',
            'nis.unique' => 'NIS sudah digunakan.',
        ]);

        $data = ['name' => $request->name];

        if ($user->role === 'bendahara') {
            $data['email'] = $request->email;
        } else {
            $data['nis'] = $request->nis;
        }

        DB::table('users')->where('id', $user->id)->update($data);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Ganti Password
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
        ], [
            'current_password.required' => 'Password lama wajib diisi.',
            'new_password.required' => 'Password baru wajib diisi.',
            'new_password.min' => 'Password baru minimal 6 karakter.',
            'new_password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama salah.']);
        }

        DB::table('users')->where('id', $user->id)->update([
            'password' => Hash::make($request->new_password),
            'updated_at' => now(),
        ]);

        return back()->with('success_password', 'Password berhasil diganti!');
    }
}
