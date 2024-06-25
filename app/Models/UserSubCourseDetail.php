<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserSubCourseDetail extends Model
{
    use HasFactory;

    protected $table = 'user_subcourse_details';

    public function user(): BelongsTo {
        return $this->belonsgTo(User::class, 'user_id', 'id');
    }

    public function subcourse(): BelongsTo {
        return $this->belongsTo(Evaluation::class, 'evaluation_id', 'id');
    }
}
