@extends('layouts.bendahara')

@section('title', 'Edit Siswa')
@section('page_title', 'Edit Siswa')

@section('content')
<div class="max-w-3xl mx-auto">

    <!-- Header -->
    <div class="mb-6">
        <a href="{{ route('siswa.index') }}" class="inline-flex items-center gap-2 text-sm text-slate-600 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 mb-3 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Data Siswa
        </a>
        <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-blue-400 bg-clip-text text-transparent">Edit Siswa</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Ubah data siswa di bawah ini</p>
    </div>

    <!-- Form Card -->
    <div class="glass-card rounded-2xl p-6 border border-white/20 dark:border-white/10">
        <form action="{{ route('siswa.update', $siswa) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nama Lengkap -->
            <div class="mb-5">
                <label for="name" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                    Nama Lengkap <span class="text-rose-500">*</span>
                </label>
                <input type="text"
                       name="name"
                       id="name"
                       value="{{ old('name', $siswa->name) }}"
                       placeholder="Masukkan nama lengkap siswa"
                       required
                       class="w-full px-4 py-3 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:text-white @error('name') border-rose-500 @enderror">
                @error('name')
                    <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- NIS -->
            <div class="mb-5">
                <label for="nis" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                    NIS <span class="text-rose-500">*</span>
                </label>
                <input type="text"
                       name="nis"
                       id="nis"
                       value="{{ old('nis', $siswa->nis) }}"
                       placeholder="Masukkan NIS"
                       required
                       class="w-full px-4 py-3 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:text-white @error('nis') border-rose-500 @enderror">
                @error('nis')
                    <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-5">
                <label for="password" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                    Password <span class="text-xs text-slate-500">(Kosongkan jika tidak ingin mengubah)</span>
                </label>
                <input type="password"
                       name="password"
                       id="password"
                       placeholder="Minimal 6 karakter (kosongkan jika tidak diubah)"
                       minlength="6"
                       class="w-full px-4 py-3 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:text-white @error('password') border-rose-500 @enderror">
                <p class="mt-1.5 text-xs text-slate-500 dark:text-slate-400"> Password saat ini: <strong>{{ $siswa->temp_password }}</strong></p>
                @error('password')
                    <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex gap-3 pt-4">
                <button type="submit" class="flex-1 px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white text-sm font-semibold rounded-xl shadow-lg shadow-blue-500/30 transition-all">
                    <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Update Siswa
                </button>
                <a href="{{ route('siswa.index') }}" class="px-6 py-3 bg-slate-200 dark:bg-slate-700 hover:bg-slate-300 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-300 text-sm font-semibold rounded-xl transition-all">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
