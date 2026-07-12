<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function bendahara()
    {
        // ============================================
        // KONFIGURASI
        // ============================================
        $biayaPerBulan = 10000; // Rp 10.000 per bulan

        // ============================================
        // HITUNG BULAN TAHUN AJARAN (JULI - JUNI)
        // ============================================
        $sekarang = Carbon::now();
        $tahunSekarang = $sekarang->year;
        $bulanSekarang = $sekarang->month;

        if ($bulanSekarang >= 7) {
            $tahunAjaranMulai = $tahunSekarang;
        } else {
            $tahunAjaranMulai = $tahunSekarang - 1;
        }

        // Hitung jumlah bulan
        if ($bulanSekarang >= 7) {
            $jumlahBulan = $bulanSekarang - 7 + 1;
        } else {
            $jumlahBulan = (12 - 7 + 1) + $bulanSekarang;
        }

        // ============================================
        // STATISTIK UMUM
        // ============================================
        $totalSiswa = User::where('role', 'siswa')->count();
        $totalPembayaran = DB::table('payments')->sum('amount');
        $totalPengeluaran = DB::table('expenses')->sum('amount');
        $saldo = $totalPembayaran - $totalPengeluaran;
        $saldoKeseluruhan = $saldo;

        // ============================================
        // STATUS PEMBAYARAN SISWA
        // ============================================
        $siswaList = User::where('role', 'siswa')->get();
        $totalTunggakan = 0;
        $targetKeseluruhan = $totalSiswa * $jumlahBulan * $biayaPerBulan;
        $targetKas = $targetKeseluruhan;

        $siswaSudahBayarList = collect();
        $siswaBelumBayarList = collect();

        foreach ($siswaList as $siswa) {
            $targetSiswa = $jumlahBulan * $biayaPerBulan;
            $totalBayar = DB::table('payments')
                ->where('student_id', $siswa->id)
                ->sum('amount');
            $tunggakan = max(0, $targetSiswa - $totalBayar);
            $totalTunggakan += $tunggakan;

            if ($totalBayar > 0) {
                $siswaSudahBayarList->push($siswa);
            } else {
                $siswaBelumBayarList->push($siswa);
            }
        }

        $siswaSudahBayar = $siswaSudahBayarList->count();
        $siswaBelumBayarCount = $siswaBelumBayarList->count();

        // Hitung kurang kas
        $kurangKas = max(0, $targetKeseluruhan - $totalPembayaran);

        // Progress target
        $progressTarget = $targetKeseluruhan > 0 ? ($totalPembayaran / $targetKeseluruhan) * 100 : 0;
        $progressTarget = min(100, $progressTarget);

        // ============================================
        // PEMBARUAN TERAKHIR
        // ============================================
        $transaksiTerbaru = DB::table('payments')
            ->join('users', 'payments.student_id', '=', 'users.id')
            ->select('payments.*', 'users.name as student_name')
            ->orderByDesc('payments.payment_date')
            ->limit(5)
            ->get()
            ->map(function($item) {
                return [
                    'id' => $item->id,
                    'student_id' => $item->student_id,
                    'name' => $item->student_name,
                    'amount' => $item->amount,
                    'date' => $item->payment_date,
                    'description' => $item->description,
                    'type' => 'pemasukan',
                ];
            });

        $pembayaranTerbaru = $transaksiTerbaru;

        // ============================================
        // PENGUMUMAN TERBARU
        // ============================================
        $pengumumanTerbaru = DB::table('announcements')
            ->orderByDesc('created_at')
            ->limit(3)
            ->get();

        // ============================================
        // AKTIVITAS TERBARU - FIX: CARBON OBJECT
        // ============================================
        $aktivitasTerbaru = collect();

        // Ambil 5 pembayaran terakhir
        $pembayaranAktivitas = DB::table('payments')
            ->join('users', 'payments.student_id', '=', 'users.id')
            ->select('payments.*', 'users.name as student_name')
            ->orderByDesc('payments.created_at')
            ->limit(5)
            ->get();

        foreach ($pembayaranAktivitas as $p) {
            $aktivitasTerbaru->push((object)[
                'description' => $p->student_name . ' melakukan pembayaran sebesar Rp ' . number_format($p->amount, 0, ',', '.'),
                'created_at' => Carbon::parse($p->created_at), // ← FIX: Convert ke Carbon object
            ]);
        }

        $aktivitasTerbaru = $aktivitasTerbaru->sortByDesc('created_at')->values();

        // ============================================
        // REKAP BULAN INI
        // ============================================
        $namaBulan = Carbon::now()->locale('id')->isoFormat('MMMM YYYY');

        $pemasukanBulanIni = DB::table('payments')
            ->whereMonth('payment_date', $bulanSekarang)
            ->whereYear('payment_date', $tahunSekarang)
            ->sum('amount');

        $pengeluaranBulanIni = DB::table('expenses')
            ->whereMonth('expense_date', $bulanSekarang)
            ->whereYear('expense_date', $tahunSekarang)
            ->sum('amount');

        return view('dashboard.bendahara', compact(
            'totalSiswa',
            'totalPembayaran',
            'totalPengeluaran',
            'saldo',
            'saldoKeseluruhan',
            'totalTunggakan',
            'targetKeseluruhan',
            'targetKas',
            'kurangKas',
            'jumlahBulan',
            'biayaPerBulan',
            'transaksiTerbaru',
            'pembayaranTerbaru',
            'namaBulan',
            'pemasukanBulanIni',
            'pengeluaranBulanIni',
            'progressTarget',
            'siswaSudahBayar',
            'siswaSudahBayarList',
            'siswaBelumBayarCount',
            'siswaBelumBayarList',
            'pengumumanTerbaru',
            'aktivitasTerbaru'
        ));
    }
}
