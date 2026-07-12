<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = DB::table('payments')
            ->join('users', 'payments.student_id', '=', 'users.id')
            ->select('payments.*', 'users.name as student_name', 'users.nis');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('users.name', 'like', "%{$search}%")
                  ->orWhere('users.nis', 'like', "%{$search}%")
                  ->orWhere('payments.description', 'like', "%{$search}%");
            });
        }

        $pembayaran = $query->orderByDesc('payments.payment_date')
            ->paginate(10)
            ->withQueryString();

        return view('dashboard.pembayaran.index', compact('pembayaran', 'search'));
    }

    public function create()
    {
        $siswa = User::where('role', 'siswa')->orderBy('name')->get();

        return view('dashboard.pembayaran.create', compact('siswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:1',
            'payment_date' => 'required|date',
            'description' => 'required|string|max:255',
        ]);

        // ✅ PARSE BULAN KAS DARI DESCRIPTION
        // Contoh: "Kas Bulan Agustus" → "2026-08"
        $bulanMap = [
            'Januari' => '01', 'Februari' => '02', 'Maret' => '03',
            'April' => '04', 'Mei' => '05', 'Juni' => '06',
            'Juli' => '07', 'Agustus' => '08', 'September' => '09',
            'Oktober' => '10', 'November' => '11', 'Desember' => '12'
        ];

        // Ambil nama bulan dari description (hapus "Kas Bulan ")
        $bulanName = str_replace('Kas Bulan ', '', $request->description);
        $bulanNumber = $bulanMap[$bulanName] ?? date('m');

        // Tentukan tahun berdasarkan bulan kas
        // Tahun ajaran: Juli (7) - Juni (6)
        $tahunSekarang = date('Y');
        $bulanSekarang = (int) date('m');

        if ($bulanNumber >= 7) {
            // Bulan Juli-Desember → tahun ajaran dimulai tahun ini
            $tahunKas = $tahunSekarang;
        } else {
            // Bulan Januari-Juni → tahun ajaran dimulai tahun lalu
            $tahunKas = $tahunSekarang;
        }

        // Format period: YYYY-MM
        $period = $tahunKas . '-' . $bulanNumber;

        DB::table('payments')->insert([
            'student_id' => $request->student_id,
            'amount' => $request->amount,
            'payment_date' => $request->payment_date,
            'description' => $request->description,
            'period' => $period, // ✅ PERIOD = BULAN KAS (bukan tanggal bayar)
            'created_by' => auth()->id(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('pembayaran.index')
            ->with('success', 'Pembayaran berhasil dicatat.');
    }

    public function edit($id)
    {
        $pembayaran = DB::table('payments')->where('id', $id)->first();
        $siswa = User::where('role', 'siswa')->orderBy('name')->get();

        return view('dashboard.pembayaran.edit', compact('pembayaran', 'siswa'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'student_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:1',
            'payment_date' => 'required|date',
            'description' => 'required|string|max:255',
        ]);

        // ✅ PARSE BULAN KAS DARI DESCRIPTION
        $bulanMap = [
            'Januari' => '01', 'Februari' => '02', 'Maret' => '03',
            'April' => '04', 'Mei' => '05', 'Juni' => '06',
            'Juli' => '07', 'Agustus' => '08', 'September' => '09',
            'Oktober' => '10', 'November' => '11', 'Desember' => '12'
        ];

        $bulanName = str_replace('Kas Bulan ', '', $request->description);
        $bulanNumber = $bulanMap[$bulanName] ?? date('m');
        $tahunKas = date('Y');
        $period = $tahunKas . '-' . $bulanNumber;

        DB::table('payments')->where('id', $id)->update([
            'student_id' => $request->student_id,
            'amount' => $request->amount,
            'payment_date' => $request->payment_date,
            'description' => $request->description,
            'period' => $period, // ✅ UPDATE PERIOD
            'updated_at' => now(),
        ]);

        return redirect()->route('pembayaran.index')
            ->with('success', 'Pembayaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        DB::table('payments')->where('id', $id)->delete();

        return redirect()->route('pembayaran.index')
            ->with('success', 'Pembayaran berhasil dihapus.');
    }
}
