<?php

namespace App\Http\Services;

use App\Models\User;
use App\Models\Course;
use App\Models\Evaluation;
use App\Models\UserEnrollDetail;

class Service
{
    public function getAppData()
    {
        $userCount = User::fetchByRole()->count();
        $courseCount = Course::count();
        $evaluationCount = Evaluation::count();
        $enrollCount = UserEnrollDetail::count();
        $completedEnroll = UserEnrollDetail::where('progress', '=', '100')->count();
        $completionRate = 0;

        if($enrollCount)
            $completionRate = round($completedEnroll / $enrollCount, 2);

        $data = [
            [
                'detail' => 'Pengguna yang Terdaftar',
                'count' => $userCount,
                'datatype' => 'integer',
                'iconify' => 'mdi:users-group',
                'href' => route('pengguna')
            ],
            [
                'detail' => 'Mata Pelajaran Tersedia',
                'count' => $courseCount,
                'datatype' => 'integer',
                'iconify' => 'raphael:books',
                'href' => route('mata-pelajaran')
            ],
            [
                'detail' => 'Ujian yang Ada',
                'count' => $evaluationCount,
                'datatype' => 'integer',
                'iconify' => 'healthicons:i-exam-multiple-choice',
                'href' => route('ujian')
            ],
            [
                'detail' => 'Jumlah Enroll Pengguna',
                'count' => $enrollCount,
                'datatype' => 'integer',
                'iconify' => 'fluent:notebook-add-20-filled',
                'href' => route('enrolls')
            ],
            [
                'detail' => 'Pengguna Menyelesaikan Mata Pelajaran',
                'count' => $completedEnroll,
                'datatype' => 'integer',
                'iconify' => 'icon-park-solid:doc-success'
            ],
            [
                'detail' => 'Tingkat Penyelesaian',
                'count' => $completionRate,
                'datatype' => 'double',
                'iconify' => 'tabler:percentage-60'
            ]
        ];

        return $data;
    }
}
