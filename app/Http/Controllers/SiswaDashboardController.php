<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;

class SiswaDashboardController extends Controller
{
    public function index()
    {
        $id = auth()->user()->id;

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

        // Tentukan tahun ajaran mulai
        if ($bulanSekarang >= 7) {
            $tahunAjaranMulai = $tahunSekarang;
        } else {
            $tahunAjaranMulai = $tahunSekarang - 1;
        }

        // Hitung jumlah bulan dari Juli sampai bulan sekarang
        if ($bulanSekarang >= 7) {
            $jumlahBulan = $bulanSekarang - 7 + 1;
        } else {
            $jumlahBulan = (12 - 7 + 1) + $bulanSekarang;
        }

        // ============================================
        // HITUNG TOTAL PEMBAYARAN
        // ============================================
        $total = DB::table('payments')->where('student_id', $id)->sum('amount');

        // Hitung target berdasarkan bulan
        $target = $jumlahBulan * $biayaPerBulan;
        $tunggakan = max(0, $target - $total);

        // Riwayat 5 transaksi terakhir
        $riwayat = DB::table('payments')
            ->where('student_id', $id)
            ->orderByDesc('payment_date')
            ->limit(5)
            ->get();

        // 3 Pengumuman terbaru
        $pengumuman = DB::table('announcements')
            ->orderByDesc('created_at')
            ->limit(3)
            ->get();

        // ============================================
        // REKAP BULAN INI
        // ============================================
        $namaBulan = Carbon::now()->locale('id')->isoFormat('MMMM YYYY');

        // Format period untuk bulan ini (YYYY-MM)
        $period = sprintf('%04d-%02d', $tahunSekarang, $bulanSekarang);

        // Ambil semua pembayaran bulan ini (berdasarkan period)
        $pembayaranBulanIni = DB::table('payments')
            ->join('users', 'payments.student_id', '=', 'users.id')
            ->where('payments.period', $period) // PAKAI PERIOD
            ->select(
                'users.id as student_id',
                'users.name',
                'users.nis',
                'payments.amount',
                'payments.payment_date'
            )
            ->orderByDesc('payments.payment_date')
            ->get();

        // Statistik bulan ini
        $totalSiswaBayar = $pembayaranBulanIni->pluck('student_id')->unique()->count();
        $totalNominalBulanIni = $pembayaranBulanIni->sum('amount');

        // Cek apakah user sudah bayar bulan ini
        $sudahBayarBulanIni = $pembayaranBulanIni->contains(function($p) use ($id) {
            return $p->student_id == $id;
        });

        // 5 siswa terakhir yang bayar (preview)
        $previewSiswaBayar = $pembayaranBulanIni->unique('student_id')->take(5)->values();

        // ============================================
        //       SISWA YANG BELUM BAYAR BULAN INI
        // ============================================
        $totalSiswa = User::where('role', 'siswa')->count();
        $idSudahBayar = $pembayaranBulanIni->pluck('student_id')->unique()->toArray();

        $siswaBelumBayar = User::where('role', 'siswa')
            ->whereNotIn('id', $idSudahBayar)
            ->orderBy('name')
            ->get();

        $totalSiswaBelumBayar = $siswaBelumBayar->count();

        return view('siswa.dashboard', compact(
            'total',
            'tunggakan',
            'target',
            'jumlahBulan',
            'biayaPerBulan',
            'riwayat',
            'pengumuman',
            'namaBulan',
            'totalSiswaBayar',
            'totalNominalBulanIni',
            'sudahBayarBulanIni',
            'previewSiswaBayar',
            'totalSiswa',
            'siswaBelumBayar',
            'totalSiswaBelumBayar'
        ));
    }
}
