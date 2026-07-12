@extends('layouts.bendahara')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@push('styles')
<style>
    /* Override judul Dashboard jadi biru */
    h2.text-slate-900.dark\:text-white {
        color: #2563eb !important; /* Blue-600 */
    }

    /* Dark mode tetap biru terang */
    .dark h2.text-slate-900.dark\:text-white {
        color: #3b82f6 !important; /* Blue-500 */
    }
</style>
@endpush

@section('content')
<div class="max-w-7xl mx-auto space-y-4">

    <!-- 4 Stat Cards (Compact: 120-140px) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="glass-card rounded-xl p-4 border border-white/20 dark:border-white/10">
            <div class="flex items-center justify-between mb-2">
                <div class="w-9 h-9 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center shadow-lg shadow-blue-500/30">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wide">Total Siswa</p>
            <p class="text-2xl font-bold text-slate-900 dark:text-white mt-1">{{ $totalSiswa }}</p>
        </div>

        <div class="glass-card rounded-xl p-4 border border-white/20 dark:border-white/10">
            <div class="flex items-center justify-between mb-2">
                <div class="w-9 h-9 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-lg flex items-center justify-center shadow-lg shadow-emerald-500/30">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                    </svg>
                </div>
            </div>
            <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wide">Pemasukan</p>
            <p class="text-2xl font-bold text-emerald-600 dark:text-emerald-400 mt-1">Rp {{ number_format($pemasukanBulanIni, 0, ',', '.') }}</p>
        </div>

        <div class="glass-card rounded-xl p-4 border border-white/20 dark:border-white/10">
            <div class="flex items-center justify-between mb-2">
                <div class="w-9 h-9 bg-gradient-to-br from-rose-500 to-rose-600 rounded-lg flex items-center justify-center shadow-lg shadow-rose-500/30">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"></path>
                    </svg>
                </div>
            </div>
            <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wide">Pengeluaran</p>
            <p class="text-2xl font-bold text-rose-600 dark:text-rose-400 mt-1">Rp {{ number_format($pengeluaranBulanIni, 0, ',', '.') }}</p>
        </div>

        <div class="glass-card rounded-xl p-4 border border-white/20 dark:border-white/10">
            <div class="flex items-center justify-between mb-2">
                <div class="w-9 h-9 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center shadow-lg shadow-purple-500/30">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wide">Saldo Kas</p>
            <p class="text-2xl font-bold text-slate-900 dark:text-white mt-1">Rp {{ number_format($saldoKeseluruhan, 0, ',', '.') }}</p>
        </div>
    </div>

    <!-- Row 2: Target Kas + Transaksi Terbaru -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        <!-- Target Kas (1/3) -->
        <div class="glass-card rounded-xl p-5 border border-white/20 dark:border-white/10">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-9 h-9 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center shadow-lg shadow-blue-500/30">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-sm font-bold text-slate-900 dark:text-white">Target Kas</h3>
            </div>

            <!-- Progress Bar -->
            <div class="mb-4">
                <div class="flex justify-between text-xs text-slate-500 dark:text-slate-400 mb-1.5">
                    <span>Progress</span>
                    <span class="font-semibold">{{ $progressTarget }}%</span>
                </div>
                <div class="w-full bg-slate-200 dark:bg-slate-700 rounded-full h-2">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-2 rounded-full transition-all" style="width: {{ $progressTarget }}%"></div>
                </div>
            </div>

            <div class="space-y-2">
                <div class="flex justify-between items-center text-sm">
                    <span class="text-slate-600 dark:text-slate-400">Target</span>
                    <span class="font-semibold text-slate-900 dark:text-white">Rp {{ number_format($targetKas, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between items-center text-sm">
                    <span class="text-slate-600 dark:text-slate-400">Terkumpul</span>
                    <span class="font-semibold text-emerald-600 dark:text-emerald-400">Rp {{ number_format($pemasukanBulanIni, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between items-center text-sm">
                    <span class="text-slate-600 dark:text-slate-400">Kurang</span>
                    <span class="font-semibold text-rose-600 dark:text-rose-400">Rp {{ number_format($kurangKas, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Transaksi Terbaru (2/3) -->
        <div class="lg:col-span-2 glass-card rounded-xl border border-white/20 dark:border-white/10">
            <div class="p-5 border-b border-slate-200/50 dark:border-slate-700/50 flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900 dark:text-white">Transaksi Terbaru</h3>
                </div>
                <a href="{{ route('laporan.index') }}" class="text-xs text-blue-600 dark:text-blue-400 hover:underline font-medium">Lihat Semua →</a>
            </div>

            @if($transaksiTerbaru->count() > 0)
                <div class="divide-y divide-slate-200/50 dark:divide-slate-700/50">
                    @foreach($transaksiTerbaru as $t)
                        <div class="p-4 flex justify-between items-center hover:bg-slate-50/50 dark:hover:bg-slate-800/50 transition-colors">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center {{ $t['type'] === 'pemasukan' ? 'bg-emerald-100 dark:bg-emerald-900/30' : 'bg-rose-100 dark:bg-rose-900/30' }}">
                                    <svg class="w-4 h-4 {{ $t['type'] === 'pemasukan' ? 'text-emerald-600 dark:text-emerald-400' : 'text-rose-600 dark:text-rose-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        @if($t['type'] === 'pemasukan')
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                                        @else
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"></path>
                                        @endif
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-slate-900 dark:text-white">{{ $t['description'] }}</p>
                                    <p class="text-xs text-slate-500 dark:text-slate-400">{{ \Carbon\Carbon::parse($t['date'])->format('d M Y') }} • {{ $t['name'] }}</p>
                                </div>
                            </div>
                            <span class="text-sm font-bold {{ $t['type'] === 'pemasukan' ? 'text-emerald-600 dark:text-emerald-400' : 'text-rose-600 dark:text-rose-400' }}">
                                {{ $t['type'] === 'pemasukan' ? '+' : '-' }} Rp {{ number_format($t['amount'], 0, ',', '.') }}
                            </span>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-slate-400 text-center py-8">Belum ada transaksi</p>
            @endif
        </div>
    </div>

    <!-- Row 3: Status Pembayaran + Pengumuman -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <!-- Status Pembayaran -->
        <div class="glass-card rounded-xl p-5 border border-white/20 dark:border-white/10">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-lg flex items-center justify-center shadow-lg shadow-cyan-500/30">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900 dark:text-white">Status Pembayaran</h3>
                </div>
                <a href="{{ route('pembayaran.index') }}" class="text-xs text-blue-600 dark:text-blue-400 hover:underline font-medium">Lihat Detail →</a>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <!-- Sudah Bayar -->
                <div class="bg-emerald-50 dark:bg-emerald-900/20 rounded-lg p-3">
                    <p class="text-xs font-medium text-emerald-700 dark:text-emerald-400 mb-2">Sudah Bayar ({{ $siswaSudahBayar }})</p>
                    @if($siswaSudahBayarList->count() > 0)
                        <div class="space-y-1.5 max-h-32 overflow-y-auto">
                            @foreach($siswaSudahBayarList as $s)
                                <div class="flex items-center gap-2 text-xs">
                                    <svg class="w-3 h-3 text-emerald-600 dark:text-emerald-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="text-slate-700 dark:text-slate-300 truncate">{{ $s->name }}</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-xs text-slate-400">Belum ada</p>
                    @endif
                </div>

                <!-- Belum Bayar -->
                <div class="bg-rose-50 dark:bg-rose-900/20 rounded-lg p-3">
                    <p class="text-xs font-medium text-rose-700 dark:text-rose-400 mb-2">Belum Bayar ({{ $siswaBelumBayarCount }})</p>
                    @if($siswaBelumBayarList->count() > 0)
                        <div class="space-y-1.5 max-h-32 overflow-y-auto">
                            @foreach($siswaBelumBayarList as $s)
                                <div class="flex items-center gap-2 text-xs">
                                    <div class="w-1.5 h-1.5 rounded-full bg-rose-500 flex-shrink-0"></div>
                                    <span class="text-slate-700 dark:text-slate-300 truncate">{{ $s->name }}</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-xs text-emerald-600 dark:text-emerald-400 font-medium">Semua sudah bayar! ✓</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Pengumuman -->
        <div class="glass-card rounded-xl border border-white/20 dark:border-white/10">
            <div class="p-5 border-b border-slate-200/50 dark:border-slate-700/50 flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                        </svg>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900 dark:text-white">Pengumuman</h3>
                </div>
                <a href="{{ route('pengumuman.index') }}" class="text-xs text-blue-600 dark:text-blue-400 hover:underline font-medium">Lihat Semua →</a>
            </div>

            @if($pengumumanTerbaru->count() > 0)
                <div class="divide-y divide-slate-200/50 dark:divide-slate-700/50">
                    @foreach($pengumumanTerbaru as $p)
                        <div class="p-4 hover:bg-slate-50/50 dark:hover:bg-slate-800/50 transition-colors">
                            <h4 class="text-sm font-medium text-slate-900 dark:text-white mb-1">{{ $p->title }}</h4>
                            <p class="text-xs text-slate-600 dark:text-slate-400 mb-1.5">{{ Str::limit($p->content, 60) }}</p>
                            <p class="text-xs text-slate-400">{{ \Carbon\Carbon::parse($p->created_at)->format('d M Y') }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-slate-400 text-center py-8">Belum ada pengumuman</p>
            @endif
        </div>
    </div>

    <!-- Aktivitas Terbaru -->
    <div class="glass-card rounded-xl border border-white/20 dark:border-white/10">
        <div class="p-5 border-b border-slate-200/50 dark:border-slate-700/50 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-gradient-to-br from-amber-500 to-amber-600 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-sm font-bold text-slate-900 dark:text-white">Aktivitas Terbaru</h3>
            </div>
            <a href="{{ route('aktivitas.index') }}" class="text-xs text-blue-600 dark:text-blue-400 hover:underline font-medium">Lihat Semua →</a>
        </div>

        @if($aktivitasTerbaru->count() > 0)
            <div class="p-5">
                <div class="space-y-3">
                    @foreach($aktivitasTerbaru as $a)
                        <div class="flex gap-3">
                            <div class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-blue-500 mt-2"></div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm text-slate-700 dark:text-slate-300 leading-relaxed">{{ $a->description }}</p>
                                <p class="text-xs text-slate-400 mt-1">{{ $a->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <p class="text-sm text-slate-400 text-center py-8">Belum ada aktivitas</p>
        @endif
    </div>

    <!-- Quick Access Rekap -->
    <div class="glass-card rounded-xl p-5 border border-white/20 dark:border-white/10">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center shadow-lg shadow-blue-500/30">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-slate-900 dark:text-white">Rekap Bulanan</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Lihat ringkasan dan tunggakan per bulan</p>
                </div>
            </div>
            <a href="{{ route('rekap.index') }}" class="px-5 py-2.5 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white text-sm font-semibold rounded-lg shadow-lg shadow-blue-500/30 transition-all">
                Buka Rekap →
            </a>
        </div>
    </div>
</div>
@endsection
