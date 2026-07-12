@extends('layouts.bendahara')

@section('title', 'Pengumuman')
@section('page_title', 'Pengumuman')
@section('page_subtitle', 'Kelola pengumuman untuk siswa')

@section('content')
<div class="max-w-7xl mx-auto space-y-3 -mt-1">

    <!-- Header -->
    <div class="flex justify-end">
        <a href="{{ route('pengumuman.create') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white text-sm font-semibold rounded-xl shadow-lg shadow-blue-500/30 transition-all whitespace-nowrap">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Buat Pengumuman
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
        <div class="glass-card rounded-xl p-4 border border-white/20 dark:border-white/10">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center shadow-lg shadow-blue-500/30">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Total Pengumuman</p>
                    <p class="text-xl font-bold text-slate-900 dark:text-white">{{ $pengumuman->total() ?? 0 }}</p>
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
                    <p class="text-xs text-slate-500 dark:text-slate-400">Pengumuman Bulan Ini</p>
                    <p class="text-xl font-bold text-emerald-600 dark:text-emerald-400">
                        {{ \DB::table('announcements')->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count() }}
                    </p>
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
                    <p class="text-xs text-slate-500 dark:text-slate-400">Hari Ini</p>
                    <p class="text-xl font-bold text-purple-600 dark:text-purple-400">
                        {{ \DB::table('announcements')->whereDate('created_at', now())->count() }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Search -->
    <div class="glass-card rounded-xl p-3 border border-white/20 dark:border-white/10">
        <form method="GET" action="{{ route('pengumuman.index') }}" class="flex gap-3">
            <div class="flex-1 relative">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <input type="text" name="search" value="{{ $search ?? '' }}"
                       placeholder="Cari judul atau isi pengumuman..."
                       class="w-full pl-10 pr-4 py-2.5 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:text-white">
            </div>
            <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white text-sm font-semibold rounded-xl shadow-lg shadow-blue-500/30 transition-all">
                Cari
            </button>
        </form>
    </div>

    <!-- Pengumuman Cards -->
    <div class="space-y-3">
        @forelse($pengumuman as $p)
            <div class="glass-card rounded-xl p-5 border border-white/20 dark:border-white/10 hover:shadow-lg transition-shadow">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">
                            {{ $p->title ?? '-' }}
                        </h3>
                        <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                            {{ $p->content ?? $p->isi ?? '-' }}
                        </p>
                        <div class="flex items-center gap-3 mt-3 text-xs text-slate-500 dark:text-slate-400">
                            <span class="inline-flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                {{ $p->user->name ?? 'Admin' }}
                            </span>
                            <span class="text-slate-300 dark:text-slate-600">•</span>
                            <span class="inline-flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                {{ \Carbon\Carbon::parse($p->created_at)->format('d M Y, H:i') }}
                            </span>
                        </div>
                    </div>

                    <!-- Aksi -->
                    <div class="flex items-center gap-2 flex-shrink-0">
                        <a href="{{ route('pengumuman.edit', $p->id) }}" class="inline-flex items-center justify-center w-9 h-9 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 rounded-lg hover:bg-blue-200 dark:hover:bg-blue-900/50 transition-colors" title="Edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </a>
                        <!-- PERUBAHAN TOMBOL HAPUS DI SINI -->
                        <button onclick="showDeleteModal('{{ route('pengumuman.destroy', $p->id) }}')"
                                class="inline-flex items-center justify-center w-9 h-9 bg-rose-100 dark:bg-rose-900/30 text-rose-700 dark:text-rose-400 rounded-lg hover:bg-rose-200 dark:hover:bg-rose-900/50 transition-colors"
                                title="Hapus">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="glass-card rounded-xl p-12 border border-white/20 dark:border-white/10 text-center">
                <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 bg-slate-100 dark:bg-slate-800 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                        </svg>
                    </div>
                    <p class="text-sm text-slate-500 dark:text-slate-400 mb-3">Belum ada pengumuman</p>
                    <a href="{{ route('pengumuman.create') }}" class="text-sm text-blue-600 dark:text-blue-400 hover:underline font-medium">Buat pengumuman pertama</a>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($pengumuman->hasPages())
        <div class="glass-card rounded-xl p-4 border border-white/20 dark:border-white/10">
            {{ $pengumuman->links() }}
        </div>
    @endif
</div>
@endsection
