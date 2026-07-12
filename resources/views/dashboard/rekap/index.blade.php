@extends('layouts.bendahara')

@section('title', 'Rekap Bulanan')
@section('page_title', 'Rekap Bulanan')
@section('page_subtitle', 'Pantau tunggakan dan ringkasan per periode')

@section('content')
<div class="max-w-7xl mx-auto space-y-3 -mt-1">

    <!-- Header -->
    <div class="flex justify-end">
        <a href="{{ route('dashboard.bendahara') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-slate-200 dark:bg-slate-700 hover:bg-slate-300 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-300 text-sm font-semibold rounded-xl transition-all whitespace-nowrap">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali
        </a>
    </div>

    <!-- Filter -->
    <div class="glass-card rounded-xl p-3 border border-white/20 dark:border-white/10">
        <form method="GET" action="{{ route('rekap.index') }}" class="flex flex-col sm:flex-row gap-3">
            <select name="bulan" class="flex-1 px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @php
                    $namaBulanList = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
                    $defaultBulan = request('bulan') ?? 7; // Default Juli (7)
                @endphp
                @foreach($namaBulanList as $index => $nama)
                    <option value="{{ $index + 1 }}" {{ $defaultBulan == ($index + 1) ? 'selected' : '' }}>
                        {{ $nama }}
                    </option>
                @endforeach
            </select>
            <select name="tahun" class="flex-1 px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @php
                    $defaultTahun = request('tahun') ?? 2026; // Default 2026
                @endphp
                @for($y = 2024; $y <= 2030; $y++)
                    <option value="{{ $y }}" {{ $defaultTahun == $y ? 'selected' : '' }}>{{ $y }}</option>
                @endfor
            </select>
            <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white text-sm font-semibold rounded-xl shadow-lg shadow-blue-500/30 transition-all">
                Tampilkan
            </button>
        </form>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
        <div class="glass-card rounded-xl p-4 border border-white/20 dark:border-white/10">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center shadow-lg shadow-blue-500/30">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Total Siswa</p>
                    <p class="text-xl font-bold text-slate-900 dark:text-white">{{ $totalSiswa ?? 0 }}</p>
                </div>
            </div>
        </div>

        <div class="glass-card rounded-xl p-4 border border-white/20 dark:border-white/10">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-lg flex items-center justify-center shadow-lg shadow-emerald-500/30">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Sudah Bayar</p>
                    <p class="text-xl font-bold text-emerald-600 dark:text-emerald-400">{{ $sudahBayar ?? 0 }}</p>
                </div>
            </div>
        </div>

        <div class="glass-card rounded-xl p-4 border border-white/20 dark:border-white/10">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-rose-500 to-rose-600 rounded-lg flex items-center justify-center shadow-lg shadow-rose-500/30">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Belum Bayar</p>
                    <p class="text-xl font-bold text-rose-600 dark:text-rose-400">{{ $belumBayar ?? 0 }}</p>
                </div>
            </div>
        </div>

        <div class="glass-card rounded-xl p-4 border border-white/20 dark:border-white/10">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center shadow-lg shadow-purple-500/30">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Total Pemasukan</p>
                    <p class="text-xl font-bold text-purple-600 dark:text-purple-400">Rp {{ number_format($totalPemasukan ?? 0, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Daftar Siswa Belum Bayar -->
    <div class="glass-card rounded-xl border border-white/20 dark:border-white/10 overflow-hidden">
        <div class="p-4 border-b border-slate-200 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-800/50">
            <h3 class="text-base font-bold text-slate-900 dark:text-white flex items-center gap-2">
                <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Daftar Siswa Belum Bayar
                <span class="text-xs font-normal text-slate-500 dark:text-slate-400 ml-2">
                    {{ $namaBulan[$bulan] ?? '' }} {{ $tahun ?? '' }}
                </span>
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50/50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-700">
                    <tr>
                        <th class="px-6 py-3 font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-xs">No.</th>
                        <th class="px-6 py-3 font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-xs">Nama Siswa</th>
                        <th class="px-6 py-3 font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-xs">NIS</th>
                        <th class="px-6 py-3 font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-xs">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                    @forelse($siswaBelumBayar ?? [] as $index => $s)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/50 transition-colors">
                            <td class="px-6 py-3 text-slate-700 dark:text-slate-300">{{ $index + 1 }}</td>
                            <td class="px-6 py-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-gradient-to-br from-rose-500 to-rose-600 rounded-full flex items-center justify-center text-white font-bold text-xs shadow-lg shadow-rose-500/30">
                                        {{ substr($s->name ?? 'U', 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-semibold text-slate-900 dark:text-white text-sm">{{ $s->name ?? '-' }}</p>
                                        <p class="text-xs text-slate-500 dark:text-slate-400">Siswa</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-slate-700 dark:text-slate-300 font-mono text-xs">{{ $s->nis ?? '-' }}</td>
                            <td class="px-6 py-3">
                                <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-medium bg-rose-100 dark:bg-rose-900/30 text-rose-700 dark:text-rose-400">
                                    Belum Bayar
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-16 h-16 bg-emerald-100 dark:bg-emerald-900/30 rounded-full flex items-center justify-center mb-4">
                                        <svg class="w-8 h-8 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <p class="text-sm text-slate-500 dark:text-slate-400">Semua siswa sudah membayar! </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Daftar Siswa Sudah Bayar -->
    <div class="glass-card rounded-xl border border-white/20 dark:border-white/10 overflow-hidden">
        <div class="p-4 border-b border-slate-200 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-800/50">
            <h3 class="text-base font-bold text-slate-900 dark:text-white flex items-center gap-2">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Daftar Siswa Sudah Bayar
                <span class="text-xs font-normal text-slate-500 dark:text-slate-400 ml-2">
                    {{ $namaBulan[$bulan] ?? '' }} {{ $tahun ?? '' }}
                </span>
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50/50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-700">
                    <tr>
                        <th class="px-6 py-3 font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-xs">No.</th>
                        <th class="px-6 py-3 font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-xs">Nama Siswa</th>
                        <th class="px-6 py-3 font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-xs">NIS</th>
                        <th class="px-6 py-3 font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-xs">Tanggal Bayar</th>
                        <th class="px-6 py-3 font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-xs text-right">Nominal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                    @forelse($siswaSudahBayar ?? [] as $index => $s)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/50 transition-colors">
                            <td class="px-6 py-3 text-slate-700 dark:text-slate-300">{{ $index + 1 }}</td>
                            <td class="px-6 py-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-full flex items-center justify-center text-white font-bold text-xs shadow-lg shadow-emerald-500/30">
                                        {{ substr($s->name ?? 'U', 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-semibold text-slate-900 dark:text-white text-sm">{{ $s->name ?? '-' }}</p>
                                        <p class="text-xs text-slate-500 dark:text-slate-400">Siswa</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-slate-700 dark:text-slate-300 font-mono text-xs">{{ $s->nis ?? '-' }}</td>
                            <td class="px-6 py-3 text-slate-700 dark:text-slate-300 text-xs">
                                {{ $s->tanggal_bayar ?? '-' }}
                            </td>
                            <td class="px-6 py-3 text-right">
                                <span class="font-bold text-emerald-600 dark:text-emerald-400 text-sm">
                                    + Rp {{ number_format($s->nominal ?? 0, 0, ',', '.') }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-slate-500 dark:text-slate-400">
                                Belum ada siswa yang membayar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
