<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'student_id',
        'created_by',
        'period',
        'amount',
        'payment_date',
        'notes',
    ];

    // Relasi: Pembayaran ini milik siswa siapa?
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    // Relasi: Pembayaran ini diinput oleh bendahara siapa?
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
