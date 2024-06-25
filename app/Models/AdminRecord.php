<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdminRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'log'
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['nama_admin'] ?? false, function($query, $namaAdmin) {
            return $query->whereHas('admin', function($query) use($namaAdmin) {
                return $query->where('fullname', 'like', '%' . $namaAdmin . '%');
            });
        })->when($filters['aksi'] ?? false, function($query, $aksi) {
            return $query->where('log', 'like', '%' . $aksi . '%');
        })->when($filters['tanggal'] ?? false, function($query, $tanggal) {
            return $query->whereDate('created_at', '=',$tanggal);
        });
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id', 'id')
        ->whereHas('role', function($query) {
            $query->where('role_name', '=', 'admin');
        });
    }
}
