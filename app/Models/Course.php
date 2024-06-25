<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $guarded = [];

    public function major(): BelongsTo {
        return $this->belongsTo(Major::class, 'major_id', 'id');
    }

    public function grade(): BelongsTo {
        return $this->belongsTo(Grade::class, 'grade_id', 'id');
    }

    public function curriculum(): BelongsTo {
        return $this->belongsTo(Curriculum::class, 'curriculum_id', 'id');
    }

    public function subcourses(): HasMany {
        return $this->hasMany(SubCourse::class, 'course_id', 'id');
    }

    public function userEnrollDetails(): HasMany {
        return $this->hasMany(UserEnrollDetail::class, 'course_id', 'id');
    }

    public function scopeFilter($query, array $filters) {
        $query->when($filters['mapel'] ?? false, function($query, $mapel) {
            return $query->where('course_name', 'like', '%' . $mapel . '%');
        })->when($filters['kelas'] ?? false, function($query, $kelas) {
            return $query->whereHas('grade', function($query) use($kelas) {
                $query->where('grade_name' , '=', $kelas);
            });
        })->when($filters['jurusan'] ?? false, function($query, $jurusan) {
            return $query->whereHas('major', function($query) use($jurusan) {
                $query->where('major_name' , '=', $jurusan);
            });
        })->when($filters['kurikulum'] ?? false, function($query, $kurikulum) {
            return $query->whereHas('curriculum', function($query) use($kurikulum) {
                $query->where('curriculum_name' , '=', $kurikulum);
            });
        })->when($filters['user_id'] ?? false, function($query, $userId) {
            return $query->whereHas('userEnrolldetails', function($query) use($userId) {
                $query->where('user_id' , '=', $userId);
            });
        });
    }
}
