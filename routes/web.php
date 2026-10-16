<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SiswaDashboardController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RekapController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\SiswaPengumumanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Landing Page
Route::get('/', function () {
    return view('landing');
})->name('landing');

// Login Routes (hanya untuk guest)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

// Logout (untuk semua yang sudah login)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// ============================================
// DASHBOARD BENDAHARA (Protected)
// ============================================
Route::middleware(['auth', 'bendahara'])->group(function () {

    // Dashboard Utama
    Route::get('/dashboard/bendahara', [DashboardController::class, 'bendahara'])
        ->name('dashboard.bendahara');

    // CRUD Siswa
    Route::resource('siswa', SiswaController::class);

    // CRUD Pembayaran
    Route::resource('pembayaran', PembayaranController::class);

    // CRUD Pengeluaran
    Route::resource('pengeluaran', PengeluaranController::class);

    // CRUD Pengumuman
    Route::resource('pengumuman', PengumumanController::class);

    // Laporan Keuangan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/export', [LaporanController::class, 'export'])->name('laporan.export');

    // Rekap Bulanan
    Route::get('/rekap', [RekapController::class, 'index'])->name('rekap.index');

    // Activity Log
    Route::get('/aktivitas', [ActivityLogController::class, 'index'])->name('aktivitas.index');
});

// ============================================
// DASHBOARD SISWA (Protected)
// ============================================
Route::middleware(['auth', 'siswa'])->group(function () {
    // Dashboard Siswa
    Route::get('/dashboard/siswa', [SiswaDashboardController::class, 'index'])
        ->name('dashboard.siswa');

    // Riwayat Pembayaran
    Route::get('/riwayat', [RiwayatController::class, 'index'])
        ->name('riwayat.index');

    // ✅ RIWAYAT PENGELUARAN (BARU!)
    Route::get('/riwayat-pengeluaran', [RiwayatController::class, 'pengeluaran'])
        ->name('riwayat.pengeluaran');

    // Pengumuman (View Siswa) - PATH DIUBAH AGAR TIDAK BENTROK
    Route::get('/pengumuman-siswa', [SiswaPengumumanController::class, 'index'])
        ->name('siswa.pengumuman');
});

// ============================================
// PENGATURAN / SETTINGS (Untuk Bendahara & Siswa)
// ============================================
Route::middleware('auth')->group(function () {
    Route::get('/pengaturan', [ProfileController::class, 'index'])->name('settings.index');
    Route::put('/pengaturan/profil', [ProfileController::class, 'updateProfile'])->name('settings.updateProfile');
    Route::put('/pengaturan/password', [ProfileController::class, 'updatePassword'])->name('settings.updatePassword');
});
