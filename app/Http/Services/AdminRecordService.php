<?php

namespace App\Http\Services;

use Amp;
use App\Models\AdminRecord;

class AdminRecordService
{
    public static function getRecords(array $filters = [])
    {
        return AdminRecord::with('admin')->latest()->filter($filters)->paginate(10);
    }

    public static function recordLog($message)
    {
        $data = [
            'admin_id' => auth('web')->user()->id,
            'log' => $message,
        ];

        AdminRecord::create($data);

    }
}
