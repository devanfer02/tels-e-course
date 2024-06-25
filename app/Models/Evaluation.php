<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Evaluation extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $guarded = [];

    public function subcourse(): BelongsTo {
        return $this->belongsTo(SubCourse::class, 'subcourse_id', 'id');
    }

    public function questions(): HasMany {
        return $this->hasMany(Question::class, 'evaluation_id', 'id');
    }

    public function evaluationCategory(): BelongsTo {
        return $this->belongsTo(EvaluationCategory::class, 'category_id', 'id');
    }

    public function scopeFilter($query, array $filters) {
        $query->when($filters['kategori'] ?? false, function($query, $category) {
            return $query->whereHas('evaluationCategory', function($query) use($category) {
                return $query->where('category_name', 'like', '%' . $category . '%');
            });
        })->when($filters['judul_materi'] ?? false, function($query, $subcourseName) {
            return $query->whereHas('subcourse', function($query) use($subcourseName) {
                return $query->where('subcourse_name', 'like', '%' . $subcourseName . '%');
            });
        })->when($filters['judul_mapel'] ?? false, function($query, $courseName) {
            return $query->whereHas('subcourse', function($query) use($courseName) {
                return $query->whereHas('course', function($query) use($courseName) {
                    return $query->where('course_name', 'like', '%' . $courseName . '%');
                });
            });
        });
    }
}
