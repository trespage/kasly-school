<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('created_by')->constrained('users')->onDelete('restrict');
            $table->string('period'); // Format: YYYY-MM (contoh: 2026-06)
            $table->decimal('amount', 12, 2);
            $table->date('payment_date');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // UNIQUE constraint: 1 siswa hanya bisa bayar 1x per bulan
            $table->unique(['student_id', 'period']);

            // Index untuk performa
            $table->index('period');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
