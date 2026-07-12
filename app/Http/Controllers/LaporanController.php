<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    /**
     * Tampilkan halaman laporan
     */
    public function index(Request $request)
    {
        // Default: bulan ini
        $bulan = $request->input('bulan', date('Y-m'));

        $tahun = substr($bulan, 0, 4);
        $bulanAngka = substr($bulan, 5, 2);

        // Hitung total pemasukan bulan ini
        $totalPemasukan = DB::table('payments')
            ->whereYear('payment_date', $tahun)
            ->whereMonth('payment_date', $bulanAngka)
            ->sum('amount');

        // Hitung total pengeluaran bulan ini
        $totalPengeluaran = DB::table('expenses')
            ->whereYear('expense_date', $tahun)
            ->whereMonth('expense_date', $bulanAngka)
            ->sum('amount');

        // Saldo bulan ini
        $saldoBulanIni = $totalPemasukan - $totalPengeluaran;

        // Saldo total (semua waktu)
        $saldoTotal = DB::table('payments')->sum('amount') - DB::table('expenses')->sum('amount');

        // Detail pemasukan
        $pemasukan = DB::table('payments')
            ->join('users', 'payments.student_id', '=', 'users.id')
            ->select('payments.*', 'users.name as student_name', 'users.nis')
            ->whereYear('payments.payment_date', $tahun)
            ->whereMonth('payments.payment_date', $bulanAngka)
            ->orderBy('payments.payment_date', 'desc')
            ->get();

        // Detail pengeluaran
        $pengeluaran = DB::table('expenses')
            ->join('users', 'expenses.created_by', '=', 'users.id')
            ->select('expenses.*', 'users.name as created_by_name')
            ->whereYear('expenses.expense_date', $tahun)
            ->whereMonth('expenses.expense_date', $bulanAngka)
            ->orderBy('expenses.expense_date', 'desc')
            ->get();

        // Nama bulan untuk judul
        $namaBulan = [
            '01' => 'Januari', '02' => 'Februari', '03' => 'Maret',
            '04' => 'April', '05' => 'Mei', '06' => 'Juni',
            '07' => 'Juli', '08' => 'Agustus', '09' => 'September',
            '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
        ];

        return view('dashboard.laporan.index', compact(
            'bulan',
            'namaBulan',
            'totalPemasukan',
            'totalPengeluaran',
            'saldoBulanIni',
            'saldoTotal',
            'pemasukan',
            'pengeluaran'
        ));
    }

    /**
     * Export laporan ke PDF
     */
    public function export(Request $request)
    {
        $bulan = $request->input('bulan', date('Y-m'));

        $tahun = substr($bulan, 0, 4);
        $bulanAngka = substr($bulan, 5, 2);

        // Hitung total
        $totalPemasukan = DB::table('payments')
            ->whereYear('payment_date', $tahun)
            ->whereMonth('payment_date', $bulanAngka)
            ->sum('amount');

        $totalPengeluaran = DB::table('expenses')
            ->whereYear('expense_date', $tahun)
            ->whereMonth('expense_date', $bulanAngka)
            ->sum('amount');

        $saldoBulanIni = $totalPemasukan - $totalPengeluaran;
        $saldoTotal = DB::table('payments')->sum('amount') - DB::table('expenses')->sum('amount');

        // Detail
        $pemasukan = DB::table('payments')
            ->join('users', 'payments.student_id', '=', 'users.id')
            ->select('payments.*', 'users.name as student_name', 'users.nis')
            ->whereYear('payments.payment_date', $tahun)
            ->whereMonth('payments.payment_date', $bulanAngka)
            ->orderBy('payments.payment_date', 'desc')
            ->get();

        $pengeluaran = DB::table('expenses')
            ->join('users', 'expenses.created_by', '=', 'users.id')
            ->select('expenses.*', 'users.name as created_by_name')
            ->whereYear('expenses.expense_date', $tahun)
            ->whereMonth('expenses.expense_date', $bulanAngka)
            ->orderBy('expenses.expense_date', 'desc')
            ->get();

        // Nama bulan
        $namaBulan = [
            '01' => 'Januari', '02' => 'Februari', '03' => 'Maret',
            '04' => 'April', '05' => 'Mei', '06' => 'Juni',
            '07' => 'Juli', '08' => 'Agustus', '09' => 'September',
            '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
        ];

        $namaBulanText = $namaBulan[$bulanAngka] ?? '';

        // Load view PDF
        $pdf = Pdf::loadView('dashboard.laporan.pdf', compact(
            'namaBulanText',
            'tahun',
            'totalPemasukan',
            'totalPengeluaran',
            'saldoBulanIni',
            'saldoTotal',
            'pemasukan',
            'pengeluaran'
        ));

        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('Laporan-Kasly-' . $namaBulanText . '-' . $tahun . '.pdf');
    }
}
