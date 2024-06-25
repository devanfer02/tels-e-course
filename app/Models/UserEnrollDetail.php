<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserEnrollDetail extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['nama_mapel'] ?? false, function($query, $namaMapel) {
            return $query->whereHas('course', function($query) use($namaMapel) {
                return $query->where('course_name', 'like' , '%' . $namaMapel . '%');
            });
        })->when($filters['nama_pengguna'] ?? false, function($query, $namaPengguna) {
            return $query->whereHas('user', function($query) use($namaPengguna) {
                return $query->where('fullname', 'like' , '%' . $namaPengguna . '%');
            });
        })->when($filters['tanggal'] ?? false, function($query, $tanggal) {
            return $query->whereDate('created_at', '=', $tanggal);
        });
    }

    public function course(): BelongsTo {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
