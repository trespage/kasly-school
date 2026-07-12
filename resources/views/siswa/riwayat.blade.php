@extends('layouts.siswa')

@section('title', 'Riwayat Pembayaran')
@section('page_title', 'Riwayat Pembayaran')
@section('page_subtitle', 'Daftar semua pembayaran kas yang sudah kamu lakukan')

@section('content')
<div class="max-w-6xl mx-auto space-y-5">

    <!-- Total Pembayaran Card -->
    <div class="glass-card rounded-xl p-6 border border-white/20 dark:border-white/10 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-blue-500/10 to-transparent rounded-bl-full"></div>
        <div class="flex items-center justify-between relative z-10">
            <div>
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Total Pembayaran</p>
                <p class="text-4xl font-bold text-blue-600 dark:text-blue-400 mt-2">Rp {{ number_format($total, 0, ',', '.') }}</p>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-2 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ $riwayat->total() }} transaksi tercatat
                </p>
            </div>
            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center shadow-xl shadow-blue-500/30">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Search & Filter -->
    <div class="glass-card rounded-xl p-4 border border-white/20 dark:border-white/10">
        <form method="GET" action="{{ route('riwayat.index') }}" class="flex gap-3">
            <div class="flex-1 relative">
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <input type="text" name="search" value="{{ $search ?? '' }}"
                       placeholder="Cari berdasarkan keterangan atau tanggal..."
                       class="w-full pl-12 pr-4 py-3 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:text-white transition-all">
            </div>
            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white text-sm font-semibold rounded-xl shadow-lg shadow-blue-500/30 transition-all flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                Cari
            </button>
            @if($search)
                <a href="{{ route('riwayat.index') }}" class="px-6 py-3 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 text-sm font-semibold rounded-xl transition-all flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Reset
                </a>
            @endif
        </form>
    </div>

    <!-- Tabel Riwayat -->
    <div class="glass-card rounded-xl border border-white/20 dark:border-white/10 overflow-hidden">
        <div class="p-6 border-b border-slate-200/50 dark:border-slate-700/50">
            <h3 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Daftar Pembayaran
            </h3>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Semua riwayat pembayaran kas kamu</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-gradient-to-r from-blue-50 to-blue-100/50 dark:from-blue-900/30 dark:to-blue-800/20 border-b border-blue-200/50 dark:border-blue-700/30">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold text-blue-900 dark:text-blue-300 uppercase tracking-wider">No</th>
                        <th class="px-6 py-4 text-xs font-bold text-blue-900 dark:text-blue-300 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-4 text-xs font-bold text-blue-900 dark:text-blue-300 uppercase tracking-wider">Keterangan</th>
                        <th class="px-6 py-4 text-xs font-bold text-blue-900 dark:text-blue-300 uppercase tracking-wider text-right">Nominal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                    @forelse($riwayat as $index => $r)
                        <tr class="hover:bg-blue-50/50 dark:hover:bg-blue-900/10 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center text-white text-xs font-bold shadow-md group-hover:shadow-lg transition-shadow">
                                    {{ $riwayat->firstItem() + $index }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">
                                        {{ \Carbon\Carbon::parse($r->payment_date)->format('d M Y') }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-lg flex items-center justify-center shadow-md">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <span class="text-sm font-semibold text-slate-700 dark:text-slate-300">
                                        {{ $r->description }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="inline-flex items-center gap-1 px-3 py-1.5 bg-gradient-to-r from-emerald-50 to-emerald-100 dark:from-emerald-900/30 dark:to-emerald-800/20 rounded-lg border border-emerald-200/50 dark:border-emerald-700/30">
                                    <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-sm font-bold text-emerald-700 dark:text-emerald-400">
                                        Rp {{ number_format($r->amount, 0, ',', '.') }}
                                    </span>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-20 h-20 bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-800 dark:to-slate-700 rounded-full flex items-center justify-center mb-4">
                                        <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-base font-semibold text-slate-700 dark:text-slate-300 mb-1">
                                        {{ $search ? 'Tidak ada hasil pencarian' : 'Belum ada pembayaran' }}
                                    </p>
                                    <p class="text-sm text-slate-500 dark:text-slate-400">
                                        {{ $search ? 'Coba kata kunci lain' : 'Kamu belum melakukan pembayaran kas' }}
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($riwayat->count() > 0)
            <div class="p-4 border-t border-slate-200 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-800/50">
                <div class="flex items-center justify-between text-xs text-slate-500 dark:text-slate-400">
                    <span>Menampilkan {{ $riwayat->firstItem() ?? 0 }} - {{ $riwayat->lastItem() ?? 0 }} dari {{ $riwayat->total() }} transaksi</span>
                    <div class="flex gap-2">
                        @if($riwayat->onFirstPage())
                            <button disabled class="px-3 py-1 rounded-lg bg-slate-200 dark:bg-slate-700 text-slate-400 cursor-not-allowed">Previous</button>
                        @else
                            <a href="{{ $riwayat->previousPageUrl() }}" class="px-3 py-1 rounded-lg bg-white dark:bg-slate-800 text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 border border-slate-200 dark:border-slate-700">Previous</a>
                        @endif

                        @if($riwayat->hasMorePages())
                            <a href="{{ $riwayat->nextPageUrl() }}" class="px-3 py-1 rounded-lg bg-white dark:bg-slate-800 text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 border border-slate-200 dark:border-slate-700">Next</a>
                        @else
                            <button disabled class="px-3 py-1 rounded-lg bg-slate-200 dark:bg-slate-700 text-slate-400 cursor-not-allowed">Next</button>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
