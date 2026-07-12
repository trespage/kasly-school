<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Buat user bendahara (tanpa truncate!)
        User::updateOrCreate(
            ['email' => 'bendahara@kasly.com'],
            [
                'name' => 'Admin Bendahara',
                'nis' => null,
                'password' => Hash::make('password123'),
                'role' => 'bendahara',
            ]
        );
    }
}
