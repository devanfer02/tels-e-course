<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Option extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $guarded = [];
    public function dragNDrops(): HasOne {
        return $this->hasOne(DragNDrop::class, 'option_id', 'id');
    }

    public function pilgandas(): HasOne {
        return $this->hasOne(Pilganda::class, 'option_id', 'id');
    }
}
