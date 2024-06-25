<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $guarded = [];
    public function options(): HasMany {
        return $this->hasMany(Option::class, 'question_id', 'id');
    }

    public function questionCategory(): BelongsTo {
        return $this->belongsTo(QuestionCategory::class, 'category_id', 'id');
    }

    public function evaluation(): BelongsTo {
        return $this->belongsTo(Evaluation::class, 'evaluation_id', 'id');
    }
}
