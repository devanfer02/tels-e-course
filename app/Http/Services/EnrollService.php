<?php

namespace App\Http\Services;

use App\Models\UserEnrollDetail;

class EnrollService
{
    public function getEnrolls(array $filters = [])
    {
        $enrolls = UserEnrollDetail::with(['course', 'user'])
        ->filter($filters)
        ->latest()
        ->paginate(10);

        return $enrolls;
    }
}
