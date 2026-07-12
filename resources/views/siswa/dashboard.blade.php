@extends('layouts.siswa')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')
@section('page_subtitle', 'Selamat datang kembali, ' . Auth::user()->name . ' 👋')

@section('content')
<div class="max-w-7xl mx-auto space-y-5">

    <!-- ============================================ -->
    <!-- STATUS PEMBAYARAN (2 Cards) -->
    <!-- ============================================ -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Total Pembayaran -->
        <div class="glass-card rounded-xl p-5 border border-white/20 dark:border-white/10 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-emerald-500/10 to-transparent rounded-bl-full"></div>
            <div class="flex items-center justify-between relative z-10">
                <div>
                    <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Total Pembayaran</p>
                    <p class="text-3xl font-bold text-emerald-600 dark:text-emerald-400 mt-1">Rp {{ number_format($total, 0, ',', '.') }}</p>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-2 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        {{ $jumlahBulan }} bulan × Rp {{ number_format($biayaPerBulan, 0, ',', '.') }}
                    </p>
                </div>
                <div class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-lg shadow-emerald-500/30">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Tunggakan -->
        <div class="glass-card rounded-xl p-5 border border-white/20 dark:border-white/10 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 {{ $tunggakan > 0 ? 'bg-gradient-to-br from-rose-500/10 to-transparent' : 'bg-gradient-to-br from-emerald-500/10 to-transparent' }} rounded-bl-full"></div>
            <div class="flex items-center justify-between relative z-10">
                <div>
                    <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Tunggakan</p>
                    <p class="text-3xl font-bold {{ $tunggakan > 0 ? 'text-rose-600 dark:text-rose-400' : 'text-emerald-600 dark:text-emerald-400' }} mt-1">
                        Rp {{ number_format($tunggakan, 0, ',', '.') }}
                    </p>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-2 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Target: Rp {{ number_format($target, 0, ',', '.') }}
                    </p>
                </div>
                <div class="w-14 h-14 {{ $tunggakan > 0 ? 'bg-gradient-to-br from-rose-500 to-rose-600 shadow-rose-500/30' : 'bg-gradient-to-br from-emerald-500 to-emerald-600 shadow-emerald-500/30' }} rounded-xl flex items-center justify-center shadow-lg">
                    @if($tunggakan > 0)
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    @else
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================ -->
    <!-- REKAP BULAN INI -->
    <!-- ============================================ -->
    <div class="glass-card rounded-xl p-6 border border-white/20 dark:border-white/10">
        <div class="flex items-center justify-between mb-5 flex-wrap gap-3">
            <div>
                <h3 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    Rekap Pembayaran {{ $namaBulan }}
                </h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Status pembayaran kas bulan ini</p>
            </div>
            <div class="px-4 py-2 {{ $sudahBayarBulanIni ? 'bg-gradient-to-r from-emerald-500 to-emerald-600 text-white' : 'bg-gradient-to-r from-rose-500 to-rose-600 text-white' }} rounded-lg text-sm font-bold shadow-lg">
                {{ $sudahBayarBulanIni ? '✓ Sudah Bayar' : '✗ Belum Bayar' }}
            </div>
        </div>

        <!-- Statistik 3 Kolom -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-5">
            <!-- Total Siswa -->
            <div class="bg-gradient-to-br from-slate-50 to-slate-100/50 dark:from-slate-900/20 dark:to-slate-800/10 rounded-xl p-5 border border-slate-200/50 dark:border-slate-700/30">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-slate-500 to-slate-600 rounded-lg flex items-center justify-center shadow-lg shadow-slate-500/30">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">Total Siswa</p>
                        <p class="text-2xl font-bold text-slate-700 dark:text-slate-300">{{ $totalSiswa }} <span class="text-sm font-normal text-slate-500">Siswa</span></p>
                    </div>
                </div>
            </div>

            <!-- Sudah Bayar -->
            <div class="bg-gradient-to-br from-blue-50 to-blue-100/50 dark:from-blue-900/20 dark:to-blue-800/10 rounded-xl p-5 border border-blue-200/50 dark:border-blue-700/30">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center shadow-lg shadow-blue-500/30">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">Sudah Bayar</p>
                        <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $totalSiswaBayar }} <span class="text-sm font-normal text-slate-500">Siswa</span></p>
                    </div>
                </div>
            </div>

            <!-- Belum Bayar -->
            <div class="bg-gradient-to-br from-rose-50 to-rose-100/50 dark:from-rose-900/20 dark:to-rose-800/10 rounded-xl p-5 border border-rose-200/50 dark:border-rose-700/30">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-rose-500 to-rose-600 rounded-lg flex items-center justify-center shadow-lg shadow-rose-500/30">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">Belum Bayar</p>
                        <p class="text-2xl font-bold text-rose-600 dark:text-rose-400">{{ $totalSiswaBelumBayar }} <span class="text-sm font-normal text-slate-500">Siswa</span></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Terkumpul -->
        <div class="bg-gradient-to-br from-emerald-50 to-emerald-100/50 dark:from-emerald-900/20 dark:to-emerald-800/10 rounded-xl p-5 border border-emerald-200/50 dark:border-emerald-700/30 mb-5">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-lg flex items-center justify-center shadow-lg shadow-emerald-500/30">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">Total Terkumpul Bulan Ini</p>
                    <p class="text-2xl font-bold text-emerald-600 dark:text-emerald-400">Rp {{ number_format($totalNominalBulanIni, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <!-- Preview Siswa yang Sudah Bayar -->
        @if($previewSiswaBayar->count() > 0)
            <div class="border-t border-slate-200 dark:border-slate-700 pt-5 mb-5">
                <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 mb-3 uppercase tracking-wider flex items-center gap-2">
                    <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Siswa yang Sudah Bayar:
                </p>
                <div class="flex flex-wrap gap-2">
                    @foreach($previewSiswaBayar as $siswa)
                        <div class="flex items-center gap-2 px-3 py-2 bg-white dark:bg-slate-800 rounded-lg border border-slate-200 dark:border-slate-700 {{ $siswa->student_id == auth()->id() ? 'ring-2 ring-blue-500 shadow-md shadow-blue-500/20' : 'hover:shadow-md transition-shadow' }}">
                            <div class="w-7 h-7 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white text-xs font-bold shadow-md">
                                {{ substr($siswa->name, 0, 1) }}
                            </div>
                            <span class="text-xs font-medium text-slate-700 dark:text-slate-300">
                                {{ $siswa->name }}
                                @if($siswa->student_id == auth()->id())
                                    <span class="ml-1 text-blue-600 dark:text-blue-400 font-bold">(Kamu)</span>
                                @endif
                            </span>
                        </div>
                    @endforeach
                    @if($totalSiswaBayar > 5)
                        <div class="flex items-center px-3 py-2 bg-gradient-to-r from-blue-50 to-blue-100 dark:from-blue-900/30 dark:to-blue-800/20 rounded-lg border border-blue-200 dark:border-blue-700">
                            <span class="text-xs font-bold text-blue-700 dark:text-blue-400">
                                +{{ $totalSiswaBayar - 5 }} siswa lainnya
                            </span>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        <!-- ✅ DAFTAR SISWA YANG BELUM BAYAR -->
        @if($siswaBelumBayar->count() > 0)
            <div class="border-t border-slate-200 dark:border-slate-700 pt-5">
                <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 mb-3 uppercase tracking-wider flex items-center gap-2">
                    <svg class="w-4 h-4 text-rose-600 dark:text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Siswa yang Belum Bayar:
                </p>
                <div class="flex flex-wrap gap-2">
                    @foreach($siswaBelumBayar as $siswa)
                        <div class="flex items-center gap-2 px-3 py-2 bg-white dark:bg-slate-800 rounded-lg border border-rose-200 dark:border-rose-700/50 {{ $siswa->id == auth()->id() ? 'ring-2 ring-rose-500 shadow-md shadow-rose-500/20' : 'hover:shadow-md transition-shadow' }}">
                            <div class="w-7 h-7 bg-gradient-to-br from-rose-500 to-rose-600 rounded-full flex items-center justify-center text-white text-xs font-bold shadow-md">
                                {{ substr($siswa->name, 0, 1) }}
                            </div>
                            <span class="text-xs font-medium text-slate-700 dark:text-slate-300">
                                {{ $siswa->name }}
                                @if($siswa->id == auth()->id())
                                    <span class="ml-1 text-rose-600 dark:text-rose-400 font-bold">(Kamu)</span>
                                @endif
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <!-- ============================================ -->
    <!-- RIWAYAT & PENGUMUMAN (2 Kolom) -->
    <!-- ============================================ -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
        <!-- Riwayat Pembayaran -->
        <div class="glass-card rounded-xl border border-white/20 dark:border-white/10 overflow-hidden">
            <div class="p-5 border-b border-slate-200/50 dark:border-slate-700/50 flex items-center justify-between">
                <div>
                    <h3 class="text-base font-bold text-slate-900 dark:text-white flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                        Riwayat Pembayaran
                    </h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">5 transaksi terakhir kamu</p>
                </div>
                <a href="{{ route('riwayat.index') }}" class="text-xs text-blue-600 dark:text-blue-400 hover:underline font-medium">
                    Lihat Semua →
                </a>
            </div>

            <div class="divide-y divide-slate-200 dark:divide-slate-700">
                @forelse($riwayat as $r)
                    <div class="p-4 hover:bg-slate-50/50 dark:hover:bg-slate-800/50 transition-colors flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-lg flex items-center justify-center shadow-md">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ $r->description }}</p>
                                <p class="text-xs text-slate-500 dark:text-slate-400">{{ \Carbon\Carbon::parse($r->payment_date)->format('d M Y') }}</p>
                            </div>
                        </div>
                        <p class="text-sm font-bold text-emerald-600 dark:text-emerald-400">+ Rp {{ number_format($r->amount, 0, ',', '.') }}</p>
                    </div>
                @empty
                    <div class="p-12 text-center">
                        <div class="w-16 h-16 bg-slate-100 dark:bg-slate-800 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <p class="text-sm text-slate-500 dark:text-slate-400">Belum ada riwayat pembayaran.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Pengumuman -->
        <div class="glass-card rounded-xl border border-white/20 dark:border-white/10 overflow-hidden">
            <div class="p-5 border-b border-slate-200/50 dark:border-slate-700/50 flex items-center justify-between">
                <div>
                    <h3 class="text-base font-bold text-slate-900 dark:text-white flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                        </svg>
                        Pengumuman Terbaru
                    </h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Informasi dari bendahara</p>
                </div>
                <a href="{{ route('siswa.pengumuman') }}" class="text-xs text-blue-600 dark:text-blue-400 hover:underline font-medium">
                    Lihat Semua →
                </a>
            </div>

            <div class="divide-y divide-slate-200 dark:divide-slate-700">
                @forelse($pengumuman as $p)
                    <div class="p-5 hover:bg-slate-50/50 dark:hover:bg-slate-800/50 transition-colors">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center shadow-md flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm font-bold text-slate-900 dark:text-white mb-1">{{ $p->title }}</h4>
                                <p class="text-xs text-slate-600 dark:text-slate-400 line-clamp-2 leading-relaxed">{{ $p->content }}</p>
                                <p class="text-xs text-slate-500 dark:text-slate-500 mt-2 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    {{ \Carbon\Carbon::parse($p->created_at)->format('d M Y') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-12 text-center">
                        <div class="w-16 h-16 bg-slate-100 dark:bg-slate-800 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                            </svg>
                        </div>
                        <p class="text-sm text-slate-500 dark:text-slate-400">Belum ada pengumuman.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
