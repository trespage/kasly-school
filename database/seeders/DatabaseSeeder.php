<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Payment;
use App\Models\Expense;
use App\Models\Announcement;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. BUAT AKUN ADMIN (BENDAHARA)
        $admin = User::create([
            'nis' => 'ADMIN001',
            'email' => 'admin@kasly.com',
            'name' => 'Anggia (Admin)',
            'role' => 'bendahara',
            'password' => Hash::make('admin123'),
            'must_change_password' => false,
        ]);

        // 2. BUAT 36 AKUN SISWA
        // Salah satunya adalah akun pribadi bendahara (sebagai siswa)
        $students = [];
        for ($i = 1; $i <= 36; $i++) {
            $nis = str_pad($i, 8, '0', STR_PAD_LEFT); // 00000001 - 00000036

            // Misal siswa ke-5 adalah bendahara (sesuaikan index jika mau)
            $isBendaharaStudent = ($i === 5);

            $students[] = User::create([
                'nis' => $nis,
                'name' => $isBendaharaStudent ? 'Anggia (Siswa)' : "Siswa {$i}",
                'role' => 'siswa',
                'password' => Hash::make($nis), // Password awal = NIS
                'must_change_password' => true,
            ]);
        }

        // 3. GENERATE PEMBAYARAN (30 LUNAS, 6 BELUM)
        // Akun siswa bendahara (index 4) sengaja dibuat LUNAS
        foreach ($students as $index => $student) {
            if ($index < 30) {
                Payment::create([
                    'student_id' => $student->id,
                    'created_by' => $admin->id, // Yang input tetap akun admin
                    'period' => '2026-06',
                    'amount' => 20000,
                    'payment_date' => now()->subDays(rand(1, 20))->format('Y-m-d'),
                    'notes' => 'Kas bulan Juni',
                ]);
            }
        }

        // 4. GENERATE PENGELUARAN (dibuat oleh akun admin)
        Expense::create([
            'created_by' => $admin->id,
            'category' => 'kebersihan',
            'amount' => 35000,
            'expense_date' => now()->subDays(10)->format('Y-m-d'),
            'notes' => 'Beli sabun, pengharum ruangan, dan lap.',
        ]);

        Expense::create([
            'created_by' => $admin->id,
            'category' => 'atk',
            'amount' => 25000,
            'expense_date' => now()->subDays(5)->format('Y-m-d'),
            'notes' => 'Beli spidol dan penghapus papan.',
        ]);

        // 5. GENERATE PENGUMUMAN
        Announcement::create([
            'created_by' => $admin->id,
            'title' => 'Deadline Kas Juni',
            'content' => 'Mohon kepada 6 siswa yang belum membayar untuk segera melunasi paling lambat 25 Juni 2026.',
            'deadline_date' => '2026-06-25',
        ]);
    }
}
