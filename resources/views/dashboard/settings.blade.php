@extends(auth()->user()->role === 'bendahara' ? 'layouts.bendahara' : 'layouts.siswa')

@section('title', 'Pengaturan Akun')
@section('page_title', 'Pengaturan')
@section('page_subtitle', 'Kelola informasi profil dan keamanan akun')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Success Messages -->
    @if (session('success'))
        <div class="p-4 rounded-xl bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 flex items-start gap-3">
            <svg class="w-5 h-5 text-green-600 dark:text-green-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <p class="text-sm text-green-700 dark:text-green-300">{{ session('success') }}</p>
        </div>
    @endif

    @if (session('success_password'))
        <div class="p-4 rounded-xl bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 flex items-start gap-3">
            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <p class="text-sm text-blue-700 dark:text-blue-300">{{ session('success_password') }}</p>
        </div>
    @endif

    <!-- Form Update Profil -->
    <div class="glass-card rounded-2xl p-6 lg:p-8">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/30">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
            <div>
                <h2 class="text-xl font-bold text-slate-900 dark:text-white">Informasi Profil</h2>
                <p class="text-sm text-slate-500 dark:text-slate-400">Perbarui data diri akun Anda</p>
            </div>
        </div>

        <form action="{{ route('settings.updateProfile') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="name" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Nama Lengkap</label>
                <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name) }}" required
                       class="w-full px-4 py-3 rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                @error('name') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
            </div>

            @if(Auth::user()->role === 'bendahara')
                <div class="mb-6">
                    <label for="email" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}" required
                           class="w-full px-4 py-3 rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                    @error('email') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                </div>
            @else
                <div class="mb-6">
                    <label for="nis" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">NIS (Nomor Induk Siswa)</label>
                    <input type="text" name="nis" id="nis" value="{{ old('nis', Auth::user()->nis) }}" required
                           class="w-full px-4 py-3 rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                    @error('nis') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                </div>
            @endif

            <button type="submit" class="btn-primary px-6 py-3 rounded-xl font-bold text-white flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Simpan Perubahan
            </button>
        </form>
    </div>

    <!-- Form Ganti Password -->
    <div class="glass-card rounded-2xl p-6 lg:p-8">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg shadow-purple-500/30">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
            </div>
            <div>
                <h2 class="text-xl font-bold text-slate-900 dark:text-white">Keamanan Akun</h2>
                <p class="text-sm text-slate-500 dark:text-slate-400">Ganti password untuk keamanan akun Anda</p>
            </div>
        </div>

        <form action="{{ route('settings.updatePassword') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="current_password" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Password Lama</label>
                <input type="password" name="current_password" id="current_password" required
                       class="w-full px-4 py-3 rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                @error('current_password') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label for="new_password" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Password Baru</label>
                <input type="password" name="new_password" id="new_password" required
                       class="w-full px-4 py-3 rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                @error('new_password') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
            </div>

            <div class="mb-8">
                <label for="new_password_confirmation" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Konfirmasi Password Baru</label>
                <input type="password" name="new_password_confirmation" id="new_password_confirmation" required
                       class="w-full px-4 py-3 rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
            </div>

            <button type="submit" class="btn-primary px-6 py-3 rounded-xl font-bold text-white flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
                Ganti Password
            </button>
        </form>
    </div>
</div>
@endsection
