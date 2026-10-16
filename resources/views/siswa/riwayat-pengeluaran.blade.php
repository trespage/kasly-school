@extends('layouts.siswa')

@section('title', 'Riwayat Pengeluaran')
@section('page_title', 'Riwayat Pengeluaran Kas')
@section('page_subtitle', 'Transparansi penggunaan kas kelas')

@section('content')
<div class="max-w-7xl mx-auto space-y-5">

    <!-- Back Button -->
    <div class="flex items-center gap-2 mb-4">
        <a href="{{ route('dashboard.siswa') }}" class="inline-flex items-center gap-2 text-sm text-slate-600 hover:text-blue-600 dark:text-slate-400 dark:hover:text-blue-400 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Dashboard
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="glass-card rounded-xl p-5 border border-white/20 dark:border-white/10 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-rose-500/10 to-transparent rounded-bl-full"></div>
            <div class="flex items-center justify-between relative z-10">
                <div>
                    <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Total Pengeluaran</p>
                    <p class="text-3xl font-bold text-rose-600 dark:text-rose-400 mt-1">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</p>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">Semua waktu</p>
                </div>
                <div class="w-14 h-14 bg-gradient-to-br from-rose-500 to-rose-600 rounded-xl flex items-center justify-center shadow-lg shadow-rose-500/30">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="glass-card rounded-xl p-5 border border-white/20 dark:border-white/10 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-purple-500/10 to-transparent rounded-bl-full"></div>
            <div class="flex items-center justify-between relative z-10">
                <div>
                    <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Total Transaksi</p>
                    <p class="text-3xl font-bold text-purple-600 dark:text-purple-400 mt-1">{{ $riwayatPengeluaran->total() }}</p>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">Transaksi pengeluaran</p>
                </div>
                <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg shadow-purple-500/30">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    @if(isset($kategoriStats) && $kategoriStats->count() > 0)
        <div class="glass-card rounded-xl p-6 border border-white/20 dark:border-white/10">
            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Pengeluaran per Kategori</h3>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                @foreach($kategoriStats as $kategori)
                    @php
                        $colors = ['ATK' => 'blue', 'Kebersihan' => 'green', 'Konsumsi' => 'yellow', 'Class Meeting' => 'purple', 'Lainnya' => 'gray'];
                        $color = $colors[$kategori->category] ?? 'gray';
                    @endphp
                    <div class="bg-gradient-to-br from-slate-50 to-slate-100/50 dark:from-slate-900/20 dark:to-slate-800/10 rounded-xl p-4 border border-slate-200/50 dark:border-slate-700/30">
                        <div class="flex items-center gap-2 mb-2">
                            <div class="w-8 h-8 bg-{{ $color }}-500 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                            </div>
                            <span class="text-xs font-semibold text-slate-700 dark:text-slate-300">{{ $kategori->category }}</span>
                        </div>
                        <p class="text-lg font-bold text-slate-900 dark:text-white">Rp {{ number_format($kategori->total, 0, ',', '.') }}</p>
                        <p class="text-xs text-slate-500 dark:text-slate-400">{{ $kategori->count }} transaksi</p>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <div class="glass-card rounded-xl border border-white/20 dark:border-white/10 overflow-hidden">
        <div class="p-5 border-b border-slate-200/50 dark:border-slate-700/50">
            <h3 class="text-lg font-bold text-slate-900 dark:text-white">Daftar Pengeluaran</h3>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Semua transaksi pengeluaran kas kelas</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50/50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-700">
                    <tr>
                        <th class="text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider px-6 py-4">Tanggal</th>
                        <th class="text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider px-6 py-4">Kategori</th>
                        <th class="text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider px-6 py-4">Keterangan</th>
                        <th class="text-right text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider px-6 py-4">Nominal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                    @forelse($riwayatPengeluaran as $expense)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="text-sm font-semibold text-slate-900 dark:text-white">{{ \Carbon\Carbon::parse($expense->expense_date)->format('d M Y') }}</div>
                                <div class="text-xs text-slate-500 dark:text-slate-400">{{ \Carbon\Carbon::parse($expense->expense_date)->diffForHumans() }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                    @if($expense->category == 'ATK') bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400
                                    @elseif($expense->category == 'Kebersihan') bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400
                                    @elseif($expense->category == 'Konsumsi') bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400
                                    @elseif($expense->category == 'Class Meeting') bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400
                                    @else bg-gray-100 text-gray-700 dark:bg-gray-900/30 dark:text-gray-400 @endif">
                                    {{ $expense->category }}
                                </span>
                            </td>
                            <td class="px-6 py-4"><p class="text-sm text-slate-700 dark:text-slate-300">{{ $expense->notes ?? '-' }}</p></td>
                            <td class="px-6 py-4 text-right"><p class="text-sm font-bold text-rose-600 dark:text-rose-400">- Rp {{ number_format($expense->amount, 0, ',', '.') }}</p></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-16 h-16 bg-slate-100 dark:bg-slate-800 rounded-full flex items-center justify-center mb-4">
                                        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                                    </div>
                                    <p class="text-sm text-slate-500 dark:text-slate-400">Belum ada pengeluaran</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($riwayatPengeluaran->hasPages())
            <div class="p-4 border-t border-slate-200 dark:border-slate-700"
                {{ $riwayatPengeluaran->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
