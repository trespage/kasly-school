<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Hapus email default dari Breeze (kita buat ulang dengan nullable)
            $table->string('email')->nullable()->change();

            // Tambah kolom NIS (unique, untuk login siswa)
            $table->string('nis')->unique()->after('id');

            // Tambah kolom role
            $table->enum('role', ['bendahara', 'siswa'])->default('siswa')->after('name');

            // Tambah kolom must_change_password
            $table->boolean('must_change_password')->default(true)->after('password');

            // Tambah soft delete
            $table->softDeletes()->after('password');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nis', 'role', 'must_change_password', 'deleted_at']);
            $table->string('email')->nullable(false)->change();
        });
    }
};
