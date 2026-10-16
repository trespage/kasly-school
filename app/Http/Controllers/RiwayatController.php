<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RiwayatController extends Controller
{
    /**
     * Riwayat Pembayaran Siswa
     */
    public function index(Request $request)
    {
        $id = auth()->user()->id;

        // Get search parameter
        $search = $request->get('search', '');

        // Query riwayat pembayaran
        $query = DB::table('payments')
            ->where('student_id', $id)
            ->orderByDesc('payment_date');

        // Apply search if exists
        if ($search) {
            $query->where('description', 'LIKE', "%{$search}%");
        }

        $riwayat = $query->paginate(10);

        // Hitung total
        $total = DB::table('payments')
            ->where('student_id', $id)
            ->sum('amount');

        return view('siswa.riwayat', compact('riwayat', 'total', 'search'));
    }

    /**
     * Riwayat Pengeluaran Kas
     */
    public function pengeluaran(Request $request)
    {
        // Get search parameter
        $search = $request->get('search', '');

        // Query pengeluaran
        $query = DB::table('expenses')
            ->orderByDesc('expense_date');

        // Apply search if exists
        if ($search) {
            $query->where('category', 'LIKE', "%{$search}%")
                  ->orWhere('notes', 'LIKE', "%{$search}%");
        }

        $riwayatPengeluaran = $query->paginate(10);

        // Total pengeluaran
        $totalPengeluaran = DB::table('expenses')->sum('amount');

        // Statistik per kategori
        $kategoriStats = DB::table('expenses')
            ->select('category', DB::raw('SUM(amount) as total'), DB::raw('COUNT(*) as count'))
            ->groupBy('category')
            ->get();

        return view('siswa.riwayat-pengeluaran', compact(
            'riwayatPengeluaran',
            'totalPengeluaran',
            'kategoriStats',
            'search'
        ));
    }
}
