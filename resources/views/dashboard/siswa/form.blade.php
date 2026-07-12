@extends('layouts.bendahara')

@section('title', $pageTitle)
@section('page_title', $pageTitle)

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
        <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-blue-400 bg-clip-text text-transparent">{{ $pageTitle }}</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Isi formulir di bawah untuk {{ isset($siswa) ? 'mengubah' : 'menambahkan' }} data siswa</p>
    </div>

    <!-- Form Card -->
    <div class="glass-card rounded-2xl p-6 border border-white/20 dark:border-white/10">
        <form action="{{ isset($siswa) ? route('siswa.update', $siswa) : route('siswa.store') }}" method="POST" class="space-y-5">
            @csrf
            @if(isset($siswa))
                @method('PUT')
            @endif

            <!-- NIS -->
            <div>
                <label for="nis" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                    NIS <span class="text-rose-500">*</span>
                </label>
                <input type="text" name="nis" id="nis"
                       value="{{ old('nis', $siswa->nis ?? '') }}"
                       placeholder="Masukkan NIS"
                       class="w-full px-4 py-3 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:text-white @error('nis') border-rose-500 @enderror">
                @error('nis')
                    <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nama Lengkap -->
            <div>
                <label for="name" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                    Nama Lengkap <span class="text-rose-500">*</span>
                </label>
                <input type="text" name="name" id="name"
                       value="{{ old('name', $siswa->name ?? '') }}"
                       placeholder="Masukkan nama lengkap"
                       class="w-full px-4 py-3 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:text-white @error('name') border-rose-500 @enderror">
                @error('name')
                    <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                    Email <span class="text-xs text-slate-500">(Opsional)</span>
                </label>
                <input type="email" name="email" id="email"
                       value="{{ old('email', $siswa->email ?? '') }}"
                       placeholder="siswa@email.com"
                       class="w-full px-4 py-3 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:text-white @error('email') border-rose-500 @enderror">
                @error('email')
                    <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Kelas -->
            <div>
                <label for="kelas" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                    Kelas <span class="text-xs text-slate-500">(Opsional)</span>
                </label>
                <input type="text" name="kelas" id="kelas"
                       value="{{ old('kelas', $siswa->kelas ?? '') }}"
                       placeholder="Contoh: XII IPA 1"
                       class="w-full px-4 py-3 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:text-white @error('kelas') border-rose-500 @enderror">
                @error('kelas')
                    <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password (hanya untuk create) -->
            @if(!isset($siswa))
                <div>
                    <label for="password" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                        Password <span class="text-rose-500">*</span>
                    </label>
                    <input type="password" name="password" id="password"
                           placeholder="Minimal 8 karakter"
                           class="w-full px-4 py-3 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:text-white @error('password') border-rose-500 @enderror">
                    @error('password')
                        <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
                    @enderror
                </div>
            @endif

            <!-- Status -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                    Status
                </label>
                <div class="flex gap-3">
                    <label class="flex-1 cursor-pointer">
                        <input type="radio" name="status" value="aktif"
                               {{ old('status', $siswa->status ?? 'aktif') === 'aktif' ? 'checked' : '' }}
                               class="peer sr-only">
                        <div class="border border-slate-200 dark:border-slate-700 rounded-xl p-3 text-center transition-all peer-checked:border-emerald-500 peer-checked:bg-emerald-50 dark:peer-checked:bg-emerald-900/20">
                            <div class="flex items-center justify-center gap-2">
                                <svg class="w-5 h-5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-sm font-medium text-slate-700 dark:text-slate-300 peer-checked:text-emerald-700 dark:peer-checked:text-emerald-400">Aktif</span>
                            </div>
                        </div>
                    </label>
                    <label class="flex-1 cursor-pointer">
                        <input type="radio" name="status" value="tidak_aktif"
                               {{ old('status', $siswa->status ?? 'aktif') === 'tidak_aktif' ? 'checked' : '' }}
                               class="peer sr-only">
                        <div class="border border-slate-200 dark:border-slate-700 rounded-xl p-3 text-center transition-all peer-checked:border-rose-500 peer-checked:bg-rose-50 dark:peer-checked:bg-rose-900/20">
                            <div class="flex items-center justify-center gap-2">
                                <svg class="w-5 h-5 text-rose-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.2
