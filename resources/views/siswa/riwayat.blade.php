@extends('layouts.siswa')

@section('title', 'Riwayat Pembayaran')
@section('page_title', 'Riwayat Pembayaran')
@section('page_subtitle', 'Daftar semua pembayaran kas kamu')

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

    <!-- Stats Card -->
    <div class="glass-card rounded-xl p-6 border border-white/20 dark:border-white/10 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-blue-500/10 to-transparent rounded-bl-full"></div>
        <div class="flex items-center justify-between relative z-10">
            <div>
                <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Total Pembayaran Kamu</p>
                <p class="text-3xl font-bold text-emerald-600 dark:text-emerald-400 mt-1">Rp {{ number_format($total, 0, ',', '.') }}</p>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">Semua waktu</p>
            </div>
            <div class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-lg shadow-emerald-500/30">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Search dan Table -->
    <div class="glass-card rounded-xl border border-white/20 dark:border-white/10 overflow-hidden">
        <div class="p-5 border-b border-slate-200/50 dark:border-slate-700/50 flex items-center justify-between flex-wrap gap-3">
            <div>
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">Daftar Pembayaran</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Semua transaksi pembayaran kas</p>
            </div>

            <!-- Search Form -->
            <form method="GET" action="{{ route('riwayat.index') }}" class="flex gap-2">
                <div class="relative">
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari keterangan..." class="pl-9 pr-4 py-2 border border-slate-200 dark:border-slate-700 rounded-lg text-sm bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <svg class="w-5 h-5 absolute left-3 top-1/2 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <button type="submit" class="btn-primary px-4 py-2 rounded-lg text-sm font-semibold">Cari</button>
                @if(!empty($search))
                    <a href="{{ route('riwayat.index') }}" class="px-4 py-2 border border-slate-200 dark:border-slate-700 rounded-lg text-sm font-semibold text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">Reset</a>
                @endif
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50/50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-700">
                    <tr>
                        <th class="text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider px-6 py-4">Tanggal</th>
                        <th class="text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider px-6 py-4">Keterangan</th>
                        <th class="text-right text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider px-6 py-4">Nominal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                    @forelse($riwayat as $item)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="text-sm font-semibold text-slate-900 dark:text-white">{{ \Carbon\Carbon::parse($item->payment_date)->format('d M Y') }}</div>
                                <div class="text-xs text-slate-500 dark:text-slate-400">{{ \Carbon\Carbon::parse($item->payment_date)->diffForHumans() }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-slate-700 dark:text-slate-300">{{ $item->description }}</p>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <p class="text-sm font-bold text-emerald-600 dark:text-emerald-400">+ Rp {{ number_format($item->amount, 0, ',', '.') }}</p>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-16 h-16 bg-slate-100 dark:bg-slate-800 rounded-full flex items-center justify-center mb-4">
                                        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-sm text-slate-500 dark:text-slate-400">Belum ada riwayat pembayaran</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($riwayat->hasPages())
            <div class="p-4 border-t border-slate-200 dark:border-slate-700">
                {{ $riwayat->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
