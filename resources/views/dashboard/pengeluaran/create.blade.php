@extends('layouts.bendahara')

@section('title', 'Catat Pengeluaran')
@section('page_title', 'Catat Pengeluaran')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Catat Pengeluaran Baru</h2>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Input pengeluaran kas kelas</p>
        </div>
        <a href="{{ route('pengeluaran.index') }}" class="text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200 flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali
        </a>
    </div>

    <div class="glass-card rounded-2xl p-6 lg:p-8">
        <form action="{{ route('pengeluaran.store') }}" method="POST">
            @csrf

            <!-- Kategori -->
            <div class="mb-6">
                <label for="category" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                    Kategori <span class="text-red-500">*</span>
                </label>
                <select name="category" id="category" required
                        class="w-full px-4 py-3 rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                    <option value="">-- Pilih Kategori --</option>
                    <option value="atk" {{ old('category') == 'atk' ? 'selected' : '' }}>ATK (Alat Tulis Kantor)</option>
                    <option value="kebersihan" {{ old('category') == 'kebersihan' ? 'selected' : '' }}>Kebersihan</option>
                    <option value="konsumsi" {{ old('category') == 'konsumsi' ? 'selected' : '' }}>Konsumsi</option>
                    <option value="class_meeting" {{ old('category') == 'class_meeting' ? 'selected' : '' }}>Class Meeting</option>
                    <option value="lainnya" {{ old('category') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
                @error('category') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
            </div>

            <!-- Nominal -->
            <div class="mb-6">
                <label for="amount" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                    Nominal (Rp) <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <span class="text-slate-500 font-semibold">Rp</span>
                    </div>
                    <input type="number" name="amount" id="amount" value="{{ old('amount') }}" required min="1"
                           class="w-full pl-12 pr-4 py-3 rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                           placeholder="0">
                </div>
                @error('amount') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
            </div>

            <!-- Tanggal -->
            <div class="mb-6">
                <label for="expense_date" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                    Tanggal Pengeluaran <span class="text-red-500">*</span>
                </label>
                <input type="date" name="expense_date" id="expense_date" value="{{ old('expense_date', date('Y-m-d')) }}" required
                       class="w-full px-4 py-3 rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                @error('expense_date') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
            </div>

            <!-- Keterangan -->
            <div class="mb-8">
                <label for="notes" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                    Keterangan
                    <span class="text-slate-400 font-normal">(Opsional)</span>
                </label>
                <textarea name="notes" id="notes" rows="3"
                          class="w-full px-4 py-3 rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                          placeholder="Contoh: Beli spidol dan kertas HVS">{{ old('notes') }}</textarea>
                @error('notes') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
            </div>

            <!-- Buttons -->
            <div class="flex gap-3">
                <button type="submit" class="flex-1 btn-primary py-3 rounded-xl font-bold text-white flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Simpan Pengeluaran
                </button>
                <a href="{{ route('pengeluaran.index') }}" class="px-6 py-3 rounded-xl border border-slate-300 dark:border-slate-600 text-slate-600 dark:text-slate-400 font-semibold hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
