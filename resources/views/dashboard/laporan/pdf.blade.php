<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Keuangan Kasly - {{ $namaBulanText }} {{ $tahun }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #333; margin: 0; padding: 20px; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #2563EB; padding-bottom: 15px; }
        .header h1 { color: #2563EB; margin: 0; font-size: 22px; }
        .header p { margin: 5px 0 0 0; color: #666; font-size: 11px; }
        .title { text-align: center; margin-bottom: 20px; }
        .title h2 { margin: 0; font-size: 16px; color: #1e293b; }
        .stats { display: flex; justify-content: space-between; margin-bottom: 30px; }
        .stat-box { flex: 1; padding: 12px; margin: 0 5px; border: 1px solid #e2e8f0; border-radius: 8px; text-align: center; }
        .stat-box:first-child { margin-left: 0; }
        .stat-box:last-child { margin-right: 0; }
        .stat-label { font-size: 10px; color: #64748b; margin-bottom: 5px; }
        .stat-value { font-size: 14px; font-weight: bold; }
        .green { color: #16a34a; }
        .red { color: #dc2626; }
        .blue { color: #2563EB; }
        .purple { color: #9333ea; }
        .section { margin-bottom: 25px; }
        .section h3 { color: #1e293b; border-bottom: 1px solid #e2e8f0; padding-bottom: 5px; font-size: 14px; margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 10px; }
        th { background: #f1f5f9; padding: 8px; text-align: left; font-size: 11px; border-bottom: 2px solid #cbd5e1; }
        td { padding: 6px 8px; border-bottom: 1px solid #e2e8f0; font-size: 11px; }
        .text-right { text-align: right; }
        .footer { text-align: center; margin-top: 30px; font-size: 10px; color: #64748b; border-top: 1px solid #e2e8f0; padding-top: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>KASLY</h1>
        <p>Sistem Manajemen Kas Kelas</p>
    </div>

    <div class="title">
        <h2>LAPORAN KEUANGAN BULAN {{ strtoupper($namaBulanText) }} {{ $tahun }}</h2>
    </div>

    <div class="stats">
        <div class="stat-box">
            <div class="stat-label">Total Pemasukan</div>
            <div class="stat-value green">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</div>
        </div>
        <div class="stat-box">
            <div class="stat-label">Total Pengeluaran</div>
            <div class="stat-value red">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</div>
        </div>
        <div class="stat-box">
            <div class="stat-label">Saldo Bulan Ini</div>
            <div class="stat-value blue">Rp {{ number_format($saldoBulanIni, 0, ',', '.') }}</div>
        </div>
        <div class="stat-box">
            <div class="stat-label">Saldo Total</div>
            <div class="stat-value purple">Rp {{ number_format($saldoTotal, 0, ',', '.') }}</div>
        </div>
    </div>

    <div class="section">
        <h3> DETAIL PEMASUKAN</h3>
        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Siswa</th>
                    <th>Keterangan</th>
                    <th class="text-right">Nominal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pemasukan as $p)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($p->payment_date)->format('d M Y') }}</td>
                        <td>{{ $p->student_name }}</td>
                        <td>{{ $p->description }}</td>
                        <td class="text-right green">+ Rp {{ number_format($p->amount, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4" style="text-align:center; padding:15px;">Tidak ada pemasukan</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="section">
        <h3>📉 DETAIL PENGELUARAN</h3>
        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Kategori</th>
                    <th>Keterangan</th>
                    <th class="text-right">Nominal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengeluaran as $e)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($e->expense_date)->format('d M Y') }}</td>
                        <td>{{ ucfirst($e->category) }}</td>
                        <td>{{ $e->notes ?? '-' }}</td>
                        <td class="text-right red">- Rp {{ number_format($e->amount, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4" style="text-align:center; padding:15px;">Tidak ada pengeluaran</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="footer">
        <p>Dicetak pada {{ \Carbon\Carbon::now()->format('d F Y, H:i') }} WIB</p>
        <p>Laporan ini dibuat secara otomatis oleh Sistem Kasly</p>
    </div>
</body>
</html>
