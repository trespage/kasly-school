<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\ActivityLogger;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $pengumuman = DB::table('announcements')
            ->leftJoin('users', 'announcements.created_by', '=', 'users.id')
            ->select('announcements.*', 'users.name as created_by_name')
            ->when($search, function ($query, $search) {
                return $query->where('announcements.title', 'like', "%{$search}%")
                             ->orWhere('announcements.content', 'like', "%{$search}%");
            })
            ->orderBy('announcements.created_at', 'desc')
            ->paginate(10);

        return view('dashboard.pengumuman.index', compact('pengumuman', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.pengumuman.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'deadline_date' => 'nullable|date',
        ], [
            'title.required' => 'Judul wajib diisi.',
            'content.required' => 'Isi pengumuman wajib diisi.',
            'deadline_date.date' => 'Format tanggal tidak valid.',
        ]);

        $id = DB::table('announcements')->insertGetId([
            'created_by' => auth()->user()->id,
            'title' => $request->title,
            'content' => $request->content,
            'deadline_date' => $request->deadline_date,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        ActivityLogger::log('create', 'Membuat pengumuman: ' . $request->title, 'announcements', $id);

        return redirect()->route('pengumuman.index')
            ->with('success', 'Pengumuman berhasil dibuat!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pengumuman = DB::table('announcements')->where('id', $id)->first();

        if (!$pengumuman) {
            return redirect()->route('pengumuman.index')->with('error', 'Pengumuman tidak ditemukan.');
        }

        return view('dashboard.pengumuman.edit', compact('pengumuman'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'deadline_date' => 'nullable|date',
        ]);

        DB::table('announcements')->where('id', $id)->update([
            'title' => $request->title,
            'content' => $request->content,
            'deadline_date' => $request->deadline_date,
            'updated_at' => now(),
        ]);

        ActivityLogger::log('update', 'Mengupdate pengumuman: ' . $request->title, 'announcements', $id);

        return redirect()->route('pengumuman.index')
            ->with('success', 'Pengumuman berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pengumuman = DB::table('announcements')->where('id', $id)->first();

        ActivityLogger::log('delete', 'Menghapus pengumuman: ' . ($pengumuman->title ?? ''), 'announcements', $id);

        DB::table('announcements')->where('id', $id)->delete();

        return redirect()->route('pengumuman.index')
            ->with('success', 'Pengumuman berhasil dihapus!');
    }
}
