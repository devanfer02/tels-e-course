<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pilganda extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $guarded = [];
    protected $hidden = [
        'correct'
    ];

    public function option(): BelongsTo {
        return $this->belongsTo(Option::class, 'option_id', 'id');
    }
}
