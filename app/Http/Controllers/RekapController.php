<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RekapController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->input('bulan', now()->month);
        $tahun = $request->input('tahun', now()->year);

        $namaBulan = ['','Januari','Februari','Maret','April','Mei','Juni',
                      'Juli','Agustus','September','Oktober','November','Desember'];

        // ✅ Format period: YYYY-MM (contoh: "2026-08")
        $period = sprintf('%04d-%02d', $tahun, $bulan);

        // Ambil semua siswa
        $semuaSiswa = User::where('role', 'siswa')->get();
        $totalSiswa = $semuaSiswa->count();

        // ✅ AMBIL PEMBAYARAN BERDASARKAN PERIOD (BULAN KAS)
        // BUKAN berdasarkan payment_date (tanggal bayar)
        $pembayaranBulanIni = DB::table('payments')
            ->where('period', $period) // ✅ PAKAI PERIOD, BUKAN payment_date
            ->get();

        $sudahBayar = $pembayaranBulanIni->unique('student_id')->count();
        $belumBayar = $totalSiswa - $sudahBayar;
        $totalPemasukan = $pembayaranBulanIni->sum('amount');

        // Siswa belum bayar
        $idSudahBayar = $pembayaranBulanIni->pluck('student_id')->unique()->toArray();
        $siswaBelumBayar = User::where('role', 'siswa')
            ->whereNotIn('id', $idSudahBayar)
            ->get();

        // Siswa sudah bayar
        $siswaSudahBayar = User::where('role', 'siswa')
            ->whereIn('id', $idSudahBayar)
            ->get()
            ->map(function($siswa) use ($pembayaranBulanIni) {
                $p = $pembayaranBulanIni->where('student_id', $siswa->id)->first();
                $siswa->tanggal_bayar = $p ? Carbon::parse($p->payment_date)->format('d M Y') : '-';
                $siswa->nominal = $p->amount ?? 0;
                return $siswa;
            });

        return view('dashboard.rekap.index', compact(
            'totalSiswa', 'sudahBayar', 'belumBayar', 'totalPemasukan',
            'siswaBelumBayar', 'siswaSudahBayar', 'namaBulan', 'bulan', 'tahun'
        ));
    }
}
