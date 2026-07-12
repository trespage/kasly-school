<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = [
        'action',
        'description',
        'user_name',
        'user_role',
        'type',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public static function log($action, $description, $type = 'info')
    {
        $user = auth()->user();
        return static::create([
            'action' => $action,
            'description' => $description,
            'user_name' => $user?->name,
            'user_role' => $user?->role,
            'type' => $type,
        ]);
    }
}
