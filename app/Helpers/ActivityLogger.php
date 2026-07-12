<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class ActivityLogger
{
    /**
     * Log aktivitas user
     *
     * @param string $activityType (create, update, delete, login, logout)
     * @param string $description
     * @param string|null $tableName
     * @param int|null $recordId
     * @return void
     */
    public static function log($activityType, $description, $tableName = null, $recordId = null)
    {
        try {
            DB::table('activity_logs')->insert([
                'user_id' => auth()->id(),
                'activity_type' => $activityType,
                'description' => $description,
                'table_name' => $tableName,
                'record_id' => $recordId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } catch (\Exception $e) {
            // Jika gagal log, jangan sampai mengganggu proses utama
            \Log::error('Failed to log activity: ' . $e->getMessage());
        }
    }
}
