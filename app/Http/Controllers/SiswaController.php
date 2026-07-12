<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Helpers\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $siswa = User::where('role', 'siswa')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                            ->orWhere('nis', 'like', "%{$search}%");
            })
            ->orderBy('name')
            ->paginate(10);

        return view('dashboard.siswa.index', compact('siswa', 'search'));
    }

    public function create()
    {
        return view('dashboard.siswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nis' => 'required|string|unique:users,nis',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'nis' => $request->nis,
            'password' => Hash::make($request->password),
            'temp_password' => $request->password, // ✅ UBAH DARI plain_password
            'role' => 'siswa',
        ]);

        ActivityLogger::log(
            'create',
            'Menambah siswa baru: ' . $user->name,
            'users',
            $user->id
        );

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil ditambahkan!');
    }

    public function edit(User $siswa)
    {
        return view('dashboard.siswa.edit', compact('siswa'));
    }

    public function update(Request $request, User $siswa)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nis' => 'required|string|unique:users,nis,' . $siswa->id,
            'password' => 'nullable|min:6',
        ]);

        $data = [
            'name' => $request->name,
            'nis' => $request->nis,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
            $data['temp_password'] = $request->password; // ✅ UBAH DARI plain_password
        }

        $siswa->update($data);

        ActivityLogger::log(
            'update',
            'Mengupdate data siswa: ' . $siswa->name,
            'users',
            $siswa->id
        );

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diupdate!');
    }

    public function destroy(User $siswa)
    {
        $nama = $siswa->name;

        ActivityLogger::log(
            'delete',
            'Menghapus siswa: ' . $nama,
            'users',
            $siswa->id
        );

        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil dihapus!');
    }
}
