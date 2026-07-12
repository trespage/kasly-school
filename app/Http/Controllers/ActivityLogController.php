<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua data tanpa join - lebih simple
        $aktivitas = DB::table('activity_logs')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('dashboard.aktivitas.index', compact('aktivitas'));
    }
}
