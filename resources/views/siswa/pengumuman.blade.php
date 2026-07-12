@extends('layouts.siswa')

@section('title', 'Pengumuman')
@section('page_title', 'Pengumuman')
@section('page_subtitle', 'Informasi dan berita terbaru dari bendahara')

@section('content')
<div class="max-w-4xl mx-auto space-y-5">

    <!-- Search Bar -->
    <div class="glass-card rounded-xl p-4 border border-white/20 dark:border-white/10">
        <form method="GET" action="{{ route('siswa.pengumuman') }}" class="flex gap-3">
            <div class="flex-1 relative">
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <input type="text" name="search" value="{{ $search ?? '' }}"
                       placeholder="Cari pengumuman berdasarkan judul atau isi..."
                       class="w-full pl-12 pr-4 py-3 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:text-white transition-all">
            </div>
            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white text-sm font-semibold rounded-xl shadow-lg shadow-blue-500/30 transition-all flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                Cari
            </button>
            @if($search)
                <a href="{{ route('siswa.pengumuman') }}" class="px-6 py-3 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 text-sm font-semibold rounded-xl transition-all flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Reset
                </a>
            @endif
        </form>
    </div>

    <!-- Daftar Pengumuman -->
    <div class="space-y-4">
        @forelse($pengumuman as $index => $p)
            <div class="glass-card rounded-xl border border-white/20 dark:border-white/10 overflow-hidden hover:shadow-lg transition-all duration-300">
                <div class="p-5">
                    <div class="flex items-start gap-4">
                        <!-- Icon -->
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg shadow-blue-500/30">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                            </svg>
                        </div>

                        <!-- Content -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between gap-3 mb-2">
                                <h4 class="text-base font-bold text-slate-900 dark:text-white">
                                    {{ $p->title }}
                                </h4>
                                @if($index === 0 && !$search)
                                    <span class="px-2.5 py-1 bg-gradient-to-r from-orange-500 to-amber-500 text-white text-xs font-bold rounded-lg whitespace-nowrap shadow-lg shadow-orange-500/30">
                                        BARU
                                    </span>
                                @endif
                            </div>

                            <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed mb-3">
                                {{ $p->content }}
                            </p>

                            <div class="flex items-center gap-4 text-xs text-slate-500 dark:text-slate-400 pt-3 border-t border-slate-200 dark:border-slate-700">
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span>{{ \Carbon\Carbon::parse($p->created_at)->format('d M Y') }}</span>
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>{{ \Carbon\Carbon::parse($p->created_at)->format('H:i') }} WIB</span>
                                </div>
                                @if($index === 0 && !$search)
                                    <div class="flex items-center gap-1.5 ml-auto">
                                        <div class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></div>
                                        <span class="font-semibold text-blue-600 dark:text-blue-400">Terbaru</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <!-- Empty State -->
            <div class="glass-card rounded-xl p-12 border border-white/20 dark:border-white/10 text-center">
                <div class="w-20 h-20 bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-800 dark:to-slate-700 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-1">
                    {{ $search ? 'Tidak Ada Hasil Pencarian' : 'Belum Ada Pengumuman' }}
                </h3>
                <p class="text-sm text-slate-500 dark:text-slate-400">
                    {{ $search ? 'Coba gunakan kata kunci lain' : 'Belum ada pengumuman dari bendahara saat ini.' }}
                </p>
            </div>
        @endforelse
    </div>

    @if($pengumuman->count() > 0)
        <!-- Pagination -->
        <div class="flex justify-center">
            {{ $pengumuman->links() }}
        </div>
    @endif
</div>
@endsection
