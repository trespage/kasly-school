@extends('layouts.bendahara')

@section('title', 'Catat Pembayaran')
@section('page_title', 'Catat Pembayaran')

@section('content')
<div class="max-w-3xl mx-auto">

    <!-- Header -->
    <div class="mb-6">
        <a href="{{ route('pembayaran.index') }}" class="inline-flex items-center gap-2 text-sm text-slate-600 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 mb-3 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali
        </a>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Catat Pembayaran</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Input pemasukan kas dari siswa</p>
    </div>

    <!-- Form Card -->
    <div class="glass-card rounded-2xl p-6 border border-white/20 dark:border-white/10 shadow-xl">
        <form action="{{ route('pembayaran.store') }}" method="POST">
            @csrf

            <!-- Nama Siswa -->
            <div class="mb-5">
                <label for="student_id" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                    Nama Siswa <span class="text-rose-500">*</span>
                </label>
                <select name="student_id" id="student_id" required
                        class="w-full px-4 py-3 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:text-white @error('student_id') border-rose-500 @enderror">
                    <option value="">-- Pilih Siswa --</option>
                    @foreach($siswa as $s)
                        <option value="{{ $s->id }}" {{ old('student_id') == $s->id ? 'selected' : '' }}>
                            {{ $s->name }} ({{ $s->nis }})
                        </option>
                    @endforeach
                </select>
                @error('student_id')
                    <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nominal -->
            <div class="mb-5">
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                    Nominal (Rp) <span class="text-rose-500">*</span>
                </label>

                <!-- Quick Select Buttons -->
                <div class="grid grid-cols-3 gap-3 mb-3">
                    <button type="button" onclick="setNominal(10000)"
                            class="nominal-btn px-4 py-3 border-2 border-slate-200 dark:border-slate-700 rounded-xl text-sm font-semibold hover:border-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/20 dark:hover:border-blue-500 transition-all text-slate-700 dark:text-slate-300">
                        Rp 10.000
                    </button>
                    <button type="button" onclick="setNominal(20000)"
                            class="nominal-btn px-4 py-3 border-2 border-slate-200 dark:border-slate-700 rounded-xl text-sm font-semibold hover:border-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/20 dark:hover:border-blue-500 transition-all text-slate-700 dark:text-slate-300">
                        Rp 20.000
                    </button>
                    <button type="button" onclick="setNominal(50000)"
                            class="nominal-btn px-4 py-3 border-2 border-slate-200 dark:border-slate-700 rounded-xl text-sm font-semibold hover:border-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/20 dark:hover:border-blue-500 transition-all text-slate-700 dark:text-slate-300">
                        Rp 50.000
                    </button>
                </div>

                <!-- Custom Input -->
                <input type="number" name="amount" id="amount" value="{{ old('amount') }}"
                       placeholder="Atau masukkan nominal lain..."
                       required min="0"
                       class="w-full px-4 py-3 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:text-white @error('amount') border-rose-500 @enderror">
                @error('amount')
                    <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Keterangan/Bulan (URUT DARI JULI) -->
            <div class="mb-5">
                <label for="description" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                    Bulan/Keterangan <span class="text-rose-500">*</span>
                </label>
                <select name="description" id="description" required
                        class="w-full px-4 py-3 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:text-white @error('description') border-rose-500 @enderror">
                    <option value="">-- Pilih Bulan --</option>
                    <option value="Kas Bulan Juli" {{ old('description') == 'Kas Bulan Juli' ? 'selected' : '' }}>Juli</option>
                    <option value="Kas Bulan Agustus" {{ old('description') == 'Kas Bulan Agustus' ? 'selected' : '' }}>Agustus</option>
                    <option value="Kas Bulan September" {{ old('description') == 'Kas Bulan September' ? 'selected' : '' }}>September</option>
                    <option value="Kas Bulan Oktober" {{ old('description') == 'Kas Bulan Oktober' ? 'selected' : '' }}>Oktober</option>
                    <option value="Kas Bulan November" {{ old('description') == 'Kas Bulan November' ? 'selected' : '' }}>November</option>
                    <option value="Kas Bulan Desember" {{ old('description') == 'Kas Bulan Desember' ? 'selected' : '' }}>Desember</option>
                    <option value="Kas Bulan Januari" {{ old('description') == 'Kas Bulan Januari' ? 'selected' : '' }}>Januari</option>
                    <option value="Kas Bulan Februari" {{ old('description') == 'Kas Bulan Februari' ? 'selected' : '' }}>Februari</option>
                    <option value="Kas Bulan Maret" {{ old('description') == 'Kas Bulan Maret' ? 'selected' : '' }}>Maret</option>
                    <option value="Kas Bulan April" {{ old('description') == 'Kas Bulan April' ? 'selected' : '' }}>April</option>
                    <option value="Kas Bulan Mei" {{ old('description') == 'Kas Bulan Mei' ? 'selected' : '' }}>Mei</option>
                    <option value="Kas Bulan Juni" {{ old('description') == 'Kas Bulan Juni' ? 'selected' : '' }}>Juni</option>
                </select>
                @error('description')
                    <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tanggal Pembayaran -->
            <div class="mb-6">
                <label for="payment_date" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                    Tanggal Pembayaran <span class="text-rose-500">*</span>
                </label>
                <input type="date" name="payment_date" id="payment_date" value="{{ old('payment_date', date('Y-m-d')) }}"
                       required
                       class="w-full px-4 py-3 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:text-white @error('payment_date') border-rose-500 @enderror">
                @error('payment_date')
                    <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex gap-3 pt-4 border-t border-slate-200 dark:border-slate-700">
                <button type="submit" class="flex-1 px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white text-sm font-semibold rounded-xl shadow-lg shadow-blue-500/30 transition-all">
                    <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Simpan Pembayaran
                </button>
                <a href="{{ route('pembayaran.index') }}" class="px-6 py-3 bg-slate-200 dark:bg-slate-700 hover:bg-slate-300 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-300 text-sm font-semibold rounded-xl transition-all">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
function setNominal(amount) {
    document.getElementById('amount').value = amount;

    // Visual feedback
    document.querySelectorAll('.nominal-btn').forEach(btn => {
        btn.classList.remove('border-blue-500', 'bg-blue-50', 'dark:bg-blue-900/20');
        btn.classList.add('border-slate-200', 'dark:border-slate-700');
    });

    event.target.classList.remove('border-slate-200', 'dark:border-slate-700');
    event.target.classList.add('border-blue-500', 'bg-blue-50', 'dark:bg-blue-900/20');
}

// Auto-select current month
document.addEventListener('DOMContentLoaded', function() {
    const bulanMap = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                      'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    const currentMonth = bulanMap[new Date().getMonth()];
    const descriptionSelect = document.getElementById('description');

    if (!descriptionSelect.value) {
        for (let option of descriptionSelect.options) {
            if (option.value.includes(currentMonth)) {
                option.selected = true;
                break;
            }
        }
    }
});
</script>
@endsection
