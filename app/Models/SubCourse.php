<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SubCourse extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $table = "subcourses";
    protected $fillable = [
        'id',
        'subcourse_name',
        'course_id',
        'order',
        'content'
    ];

    public function course(): BelongsTo {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function evaluation(): HasOne {
        return $this->hasOne(Evaluation::class, 'subcourse_id', 'id');
    }

    public function userSubcourseDetails(): HasMany {
        return $this->hasMany(UserSubCourseDetail::class, 'subcourse_id', 'id');
    }
}
