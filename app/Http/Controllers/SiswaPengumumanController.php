<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiswaPengumumanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = DB::table('announcements');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $pengumuman = $query->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('siswa.pengumuman', compact('pengumuman', 'search'));
    }
}
