@extends('layouts.bendahara')

@section('title', 'Edit Pengumuman')
@section('page_title', 'Edit Pengumuman')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Edit Pengumuman</h2>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Perbarui informasi pengumuman</p>
        </div>
        <a href="{{ route('pengumuman.index') }}" class="text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200 flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali
        </a>
    </div>

    <div class="glass-card rounded-2xl p-6 lg:p-8">
        <form action="{{ route('pengumuman.update', $pengumuman->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Judul -->
            <div class="mb-6">
                <label for="title" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                    Judul Pengumuman <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       name="title"
                       id="title"
                       value="{{ old('title', $pengumuman->title) }}"
                       required
                       class="w-full px-4 py-3 rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                       placeholder="Contoh: Pembayaran Kas Bulan Januari">
                @error('title')
                    <p class="text-red-500 text-xs mt-2 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Isi Pengumuman -->
            <div class="mb-6">
                <label for="content" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                    Isi Pengumuman <span class="text-red-500">*</span>
                </label>
                <textarea name="content"
                          id="content"
                          rows="6"
                          required
                          class="w-full px-4 py-3 rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all resize-none"
                          placeholder="Tulis isi pengumuman di sini...">{{ old('content', $pengumuman->content) }}</textarea>
                @error('content')
                    <p class="text-red-500 text-xs mt-2 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Tanggal Deadline (Opsional) -->
            <div class="mb-8">
                <label for="deadline_date" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                    Tanggal Deadline
                    <span class="text-slate-400 font-normal">(Opsional - untuk pengumuman yang ada batas waktu)</span>
                </label>
                <input type="date"
                       name="deadline_date"
                       id="deadline_date"
                       value="{{ old('deadline_date', $pengumuman->deadline_date) }}"
                       class="w-full px-4 py-3 rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                @error('deadline_date')
                    <p class="text-red-500 text-xs mt-2 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex gap-3">
                <button type="submit" class="flex-1 btn-primary py-3 rounded-xl font-bold text-white flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                    </svg>
                    Update Pengumuman
                </button>
                <a href="{{ route('pengumuman.index') }}" class="px-6 py-3 rounded-xl border border-slate-300 dark:border-slate-600 text-slate-600 dark:text-slate-400 font-semibold hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
