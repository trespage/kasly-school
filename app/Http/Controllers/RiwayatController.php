<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RiwayatController extends Controller
{
    public function index(Request $request)
    {
        $id = auth()->user()->id;
        $search = $request->input('search');

        // Total pembayaran
        $total = DB::table('payments')->where('student_id', $id)->sum('amount');

        // Riwayat dengan pencarian
        $query = DB::table('payments')
            ->where('student_id', $id);

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('description', 'like', "%{$search}%")
                  ->orWhere('payment_date', 'like', "%{$search}%");
            });
        }

        $riwayat = $query->orderByDesc('payment_date')
            ->paginate(10)
            ->withQueryString();

        return view('siswa.riwayat', compact('total', 'riwayat', 'search'));
    }
}
