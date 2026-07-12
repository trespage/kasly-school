@extends('layouts.bendahara')

@section('title', 'Aktivitas')
@section('page_title', 'Aktivitas')
@section('page_subtitle', 'Log semua aktivitas dalam sistem')

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

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-4 gap-3">
        <div class="glass-card rounded-xl p-4 border border-white/20 dark:border-white/10">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center shadow-lg shadow-blue-500/30">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Total Aktivitas</p>
                    <p class="text-xl font-bold text-slate-900 dark:text-white">{{ $aktivitas->total() ?? 0 }}</p>
                </div>
            </div>
        </div>

        <div class="glass-card rounded-xl p-4 border border-white/20 dark:border-white/10">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-lg flex items-center justify-center shadow-lg shadow-emerald-500/30">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Tambah</p>
                    <p class="text-xl font-bold text-emerald-600 dark:text-emerald-400">
                        {{ $aktivitas->where('activity_type', 'create')->count() ?? 0 }}
                    </p>
                </div>
            </div>
        </div>

        <div class="glass-card rounded-xl p-4 border border-white/20 dark:border-white/10">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center shadow-lg shadow-blue-500/30">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Edit</p>
                    <p class="text-xl font-bold text-blue-600 dark:text-blue-400">
                        {{ $aktivitas->where('activity_type', 'update')->count() ?? 0 }}
                    </p>
                </div>
            </div>
        </div>

        <div class="glass-card rounded-xl p-4 border border-white/20 dark:border-white/10">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-rose-500 to-rose-600 rounded-lg flex items-center justify-center shadow-lg shadow-rose-500/30">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Hapus</p>
                    <p class="text-xl font-bold text-rose-600 dark:text-rose-400">
                        {{ $aktivitas->where('activity_type', 'delete')->count() ?? 0 }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Activity Timeline -->
    <div class="glass-card rounded-xl border border-white/20 dark:border-white/10 overflow-hidden">
        <div class="p-4 border-b border-slate-200 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-800/50">
            <h3 class="text-base font-bold text-slate-900 dark:text-white flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Timeline Aktivitas
            </h3>
        </div>

        <div class="divide-y divide-slate-200 dark:divide-slate-700">
            @forelse($aktivitas as $log)
                <div class="p-4 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                    <div class="flex items-start gap-4">
                        <!-- Icon -->
                        <div class="flex-shrink-0">
                            @php
                                $iconColor = [
                                    'create' => 'bg-emerald-100 text-emerald-600 dark:bg-emerald-900/30 dark:text-emerald-400',
                                    'update' => 'bg-blue-100 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400',
                                    'delete' => 'bg-rose-100 text-rose-600 dark:bg-rose-900/30 dark:text-rose-400',
                                    'login' => 'bg-purple-100 text-purple-600 dark:bg-purple-900/30 dark:text-purple-400',
                                    'logout' => 'bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-400'
                                ];
                                $icons = [
                                    'create' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>',
                                    'update' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>',
                                    'delete' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>',
                                    'login' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>',
                                    'logout' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>'
                                ];
                                $type = $log->activity_type ?? 'create';
                            @endphp
                            <div class="w-10 h-10 rounded-lg flex items-center justify-center {{ $iconColor[$type] ?? $iconColor['create'] }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    {!! $icons[$type] ?? $icons['create'] !!}
                                </svg>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-slate-900 dark:text-white">
                                        {{ $log->description ?? 'Aktivitas tidak tersedia' }}
                                    </p>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                                        <span class="inline-flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                            {{ $log->user_name ?? $log->created_by ?? $log->actor ?? 'Sistem' }}
                                        </span>
                                        <span class="mx-1">•</span>
                                        <span class="inline-flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            {{ \Carbon\Carbon::parse($log->created_at)->format('d M Y, H:i') }}
                                        </span>
                                    </p>
                                </div>

                                <!-- Badge -->
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium {{ $iconColor[$type] ?? $iconColor['create'] }}">
                                    {{ ucfirst($type) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-12 text-center">
                    <div class="flex flex-col items-center justify-center">
                        <div class="w-20 h-20 bg-slate-100 dark:bg-slate-800 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="text-sm text-slate-500 dark:text-slate-400 mb-1">Belum ada aktivitas</p>
                        <p class="text-xs text-slate-400 dark:text-slate-500">Aktivitas akan muncul ketika ada perubahan data</p>
                    </div>
                </div>
            @endforelse
        </div>

        @if($aktivitas->hasPages())
            <div class="p-4 border-t border-slate-200 dark:border-slate-700">
                {{ $aktivitas->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
