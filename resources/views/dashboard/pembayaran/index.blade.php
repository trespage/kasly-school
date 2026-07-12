@extends('layouts.bendahara')

@section('title', 'Pemasukan')
@section('page_title', 'Pemasukan')
@section('page_subtitle', 'Catat pemasukan kas dari siswa')

@section('content')
<div class="max-w-7xl mx-auto space-y-3 -mt-1">

    <!-- Header -->
    <div class="flex justify-end">
        <a href="{{ route('pembayaran.create') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white text-sm font-semibold rounded-xl shadow-lg shadow-blue-500/30 transition-all whitespace-nowrap">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Catat Pembayaran
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
        <div class="glass-card rounded-xl p-4 border border-white/20 dark:border-white/10">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-lg flex items-center justify-center shadow-lg shadow-emerald-500/30">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Total Pemasukan</p>
                    <p class="text-xl font-bold text-emerald-600 dark:text-emerald-400">
                        Rp {{ number_format(DB::table('payments')->sum('amount') ?? 0, 0, ',', '.') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="glass-card rounded-xl p-4 border border-white/20 dark:border-white/10">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center shadow-lg shadow-blue-500/30">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Jumlah Transaksi</p>
                    <p class="text-xl font-bold text-slate-900 dark:text-white">{{ $pembayaran->total() }}</p>
                </div>
            </div>
        </div>

        <div class="glass-card rounded-xl p-4 border border-white/20 dark:border-white/10">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center shadow-lg shadow-purple-500/30">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Bulan Ini</p>
                    <p class="text-xl font-bold text-purple-600 dark:text-purple-400">
                        Rp {{ number_format(DB::table('payments')->whereMonth('payment_date', now()->month)->sum('amount') ?? 0, 0, ',', '.') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Search -->
    <div class="glass-card rounded-xl p-3 border border-white/20 dark:border-white/10">
        <form method="GET" action="{{ route('pembayaran.index') }}" class="flex gap-3">
            <div class="flex-1 relative">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <input type="text" name="search" value="{{ $search ?? '' }}"
                       placeholder="Cari nama siswa atau keterangan..."
                       class="w-full pl-10 pr-4 py-2.5 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:text-white">
            </div>
            <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white text-sm font-semibold rounded-xl shadow-lg shadow-blue-500/30 transition-all">
                Cari
            </button>
        </form>
    </div>

    <!-- Table -->
    <div class="glass-card rounded-xl border border-white/20 dark:border-white/10 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50/50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-700">
                    <tr>
                        <th class="text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider px-6 py-4">Tanggal</th>
                        <th class="text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider px-6 py-4">Siswa</th>
                        <th class="text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider px-6 py-4">Keterangan</th>
                        <th class="text-right text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider px-6 py-4">Nominal</th>
                        <th class="text-right text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider px-6 py-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                    @forelse($pembayaran as $p)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/50 transition-colors">
                            <!-- Tanggal -->
                            <td class="px-6 py-4">
                                <span class="text-sm text-slate-700 dark:text-slate-300">
                                    {{ \Carbon\Carbon::parse($p->payment_date)->format('d M Y') }}
                                </span>
                            </td>

                            <!-- Siswa -->
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold shadow-lg shadow-blue-500/30">
                                        {{ substr($p->student_name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ $p->student_name }}</p>
                                        <p class="text-xs text-slate-500 dark:text-slate-400">NIS: {{ $p->nis }}</p>
                                    </div>
                                </div>
                            </td>

                            <!-- Keterangan -->
                            <td class="px-6 py-4">
                                <span class="text-sm text-slate-700 dark:text-slate-300">{{ $p->description }}</span>
                            </td>

                            <!-- Nominal -->
                            <td class="px-6 py-4 text-right">
                                <span class="text-sm font-semibold text-emerald-600 dark:text-emerald-400">
                                    + Rp {{ number_format($p->amount, 0, ',', '.') }}
                                </span>
                            </td>

                            <!-- Aksi -->
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2 whitespace-nowrap">
                                    <a href="{{ route('pembayaran.edit', $p->id) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 rounded-lg text-xs font-medium hover:bg-blue-200 dark:hover:bg-blue-900/50 transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        Edit
                                    </a>
                                    <!-- PERUBAHAN TOMBOL HAPUS DI SINI -->
                                    <button onclick="showDeleteModal('{{ route('pembayaran.destroy', $p->id) }}')"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-rose-100 dark:bg-rose-900/30 text-rose-700 dark:text-rose-400 rounded-lg text-xs font-medium hover:bg-rose-200 dark:hover:bg-rose-900/50 transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-16 h-16 bg-slate-100 dark:bg-slate-800 rounded-full flex items-center justify-center mb-4">
                                        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-sm text-slate-500 dark:text-slate-400">Belum ada data pembayaran</p>
                                    <a href="{{ route('pembayaran.create') }}" class="mt-3 text-sm text-blue-600 dark:text-blue-400 hover:underline font-medium">Catat pembayaran pertama</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($pembayaran->hasPages())
            <div class="p-4 border-t border-slate-200 dark:border-slate-700">
                {{ $pembayaran->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
