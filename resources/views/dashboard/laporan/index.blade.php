@extends('layouts.bendahara')

@section('title', 'Laporan Keuangan')
@section('page_title', 'Laporan Keuangan')
@section('page_subtitle', 'Ringkasan pemasukan & pengeluaran')

@section('content')
<div class="max-w-7xl mx-auto space-y-3 -mt-1">

    <!-- Header & Actions -->
    <div class="flex justify-end">
        <a href="{{ route('laporan.export', ['bulan' => $bulan]) }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white text-sm font-semibold rounded-xl shadow-lg shadow-blue-500/30 transition-all whitespace-nowrap">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            Export PDF
        </a>
    </div>

    <!-- Filter Bulan -->
    <div class="glass-card rounded-xl p-3 border border-white/20 dark:border-white/10">
        <form method="GET" action="{{ route('laporan.index') }}" class="flex flex-col sm:flex-row gap-3">
            <label class="text-sm font-semibold text-slate-700 dark:text-slate-300 flex items-center gap-2 whitespace-nowrap">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Periode Laporan:
            </label>
            <input type="month"
                   name="bulan"
                   value="{{ $bulan }}"
                   class="flex-1 px-4 py-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            <button type="submit" class="px-6 py-2 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white text-sm font-semibold rounded-xl shadow-lg shadow-blue-500/30 transition-all">
                Tampilkan
            </button>
        </form>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
        <!-- Pemasukan -->
        <div class="glass-card rounded-xl p-4 border border-white/20 dark:border-white/10">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-lg flex items-center justify-center shadow-lg shadow-emerald-500/30">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Total Pemasukan</p>
                    <p class="text-xl font-bold text-emerald-600 dark:text-emerald-400">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <!-- Pengeluaran -->
        <div class="glass-card rounded-xl p-4 border border-white/20 dark:border-white/10">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-rose-500 to-rose-600 rounded-lg flex items-center justify-center shadow-lg shadow-rose-500/30">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Total Pengeluaran</p>
                    <p class="text-xl font-bold text-rose-600 dark:text-rose-400">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <!-- Saldo Bulan Ini -->
        <div class="glass-card rounded-xl p-4 border border-white/20 dark:border-white/10">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center shadow-lg shadow-blue-500/30">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Saldo Bulan Ini</p>
                    <p class="text-xl font-bold {{ $saldoBulanIni >= 0 ? 'text-blue-600 dark:text-blue-400' : 'text-rose-600 dark:text-rose-400' }}">
                        Rp {{ number_format($saldoBulanIni, 0, ',', '.') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Saldo Total -->
        <div class="glass-card rounded-xl p-4 border border-white/20 dark:border-white/10">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center shadow-lg shadow-purple-500/30">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Saldo Total</p>
                    <p class="text-xl font-bold text-purple-600 dark:text-purple-400">Rp {{ number_format($saldoTotal, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Pemasukan -->
    <div class="glass-card rounded-xl border border-white/20 dark:border-white/10 overflow-hidden">
        <div class="p-4 border-b border-slate-200 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-800/50">
            <h3 class="text-base font-bold text-slate-900 dark:text-white flex items-center gap-2">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                </svg>
                Detail Pemasukan
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50/50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-700">
                    <tr>
                        <th class="px-6 py-3 font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-xs">Tanggal</th>
                        <th class="px-6 py-3 font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-xs">Siswa</th>
                        <th class="px-6 py-3 font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-xs">Keterangan</th>
                        <th class="px-6 py-3 font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-xs text-right">Nominal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                    @forelse($pemasukan as $p)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/50 transition-colors">
                            <td class="px-6 py-3 text-slate-700 dark:text-slate-300 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($p->payment_date)->format('d M Y') }}
                            </td>
                            <td class="px-6 py-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold text-xs shadow-lg shadow-blue-500/30">
                                        {{ substr($p->student_name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-semibold text-slate-900 dark:text-white text-sm">{{ $p->student_name }}</p>
                                        <p class="text-xs text-slate-500 dark:text-slate-400">NIS: {{ $p->nis }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-slate-700 dark:text-slate-300">{{ $p->description }}</td>
                            <td class="px-6 py-3 text-right">
                                <span class="font-bold text-emerald-600 dark:text-emerald-400">+ Rp {{ number_format($p->amount, 0, ',', '.') }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-slate-500 dark:text-slate-400">Tidak ada pemasukan di bulan ini.</td>
                        </tr>
                    @endforelse
                </tbody>
                @if($pemasukan->count() > 0)
                    <tfoot class="bg-emerald-50 dark:bg-emerald-900/20">
                        <tr>
                            <td colspan="3" class="px-6 py-3 font-bold text-slate-900 dark:text-white text-right">Total Pemasukan:</td>
                            <td class="px-6 py-3 text-right font-bold text-emerald-600 dark:text-emerald-400">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                @endif
            </table>
        </div>
    </div>

    <!-- Detail Pengeluaran -->
    <div class="glass-card rounded-xl border border-white/20 dark:border-white/10 overflow-hidden">
        <div class="p-4 border-b border-slate-200 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-800/50">
            <h3 class="text-base font-bold text-slate-900 dark:text-white flex items-center gap-2">
                <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"></path>
                </svg>
                Detail Pengeluaran
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50/50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-700">
                    <tr>
                        <th class="px-6 py-3 font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-xs">Tanggal</th>
                        <th class="px-6 py-3 font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-xs">Kategori</th>
                        <th class="px-6 py-3 font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-xs">Keterangan</th>
                        <th class="px-6 py-3 font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-xs text-right">Nominal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                    @forelse($pengeluaran as $e)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/50 transition-colors">
                            <td class="px-6 py-3 text-slate-700 dark:text-slate-300 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($e->expense_date)->format('d M Y') }}
                            </td>
                            <td class="px-6 py-3">
                                @php
                                    $kategoriLabel = [
                                        'atk' => 'ATK',
                                        'kebersihan' => 'Kebersihan',
                                        'konsumsi' => 'Konsumsi',
                                        'class_meeting' => 'Class Meeting',
                                        'lainnya' => 'Lainnya'
                                    ];
                                    $kategoriColor = [
                                        'atk' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400',
                                        'kebersihan' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400',
                                        'konsumsi' => 'bg-orange-100 text-orange-700 dark:bg-orange-900/30 dark:text-orange-400',
                                        'class_meeting' => 'bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400',
                                        'lainnya' => 'bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-400'
                                    ];
                                @endphp
                                <span class="px-3 py-1 rounded-lg text-xs font-bold {{ $kategoriColor[$e->category] ?? 'bg-slate-100 text-slate-700' }}">
                                    {{ $kategoriLabel[$e->category] ?? $e->category }}
                                </span>
                            </td>
                            <td class="px-6 py-3 text-slate-700 dark:text-slate-300">{{ $e->notes ?? '-' }}</td>
                            <td class="px-6 py-3 text-right">
                                <span class="font-bold text-rose-600 dark:text-rose-400">- Rp {{ number_format($e->amount, 0, ',', '.') }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-slate-500 dark:text-slate-400">Tidak ada pengeluaran di bulan ini.</td>
                        </tr>
                    @endforelse
                </tbody>
                @if($pengeluaran->count() > 0)
                    <tfoot class="bg-rose-50 dark:bg-rose-900/20">
                        <tr>
                            <td colspan="3" class="px-6 py-3 font-bold text-slate-900 dark:text-white text-right">Total Pengeluaran:</td>
                            <td class="px-6 py-3 text-right font-bold text-rose-600 dark:text-rose-400">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                @endif
            </table>
        </div>
    </div>
</div>
@endsection
