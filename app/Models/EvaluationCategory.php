<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EvaluationCategory extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $guarded = [];
    public function evaluations(): HasMany {
        return $this->hasMany(Evaluation::class, 'category_id', 'id');
    }

}
