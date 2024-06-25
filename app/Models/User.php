<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $keyType = 'uuid';
    public $incrementing = false;
    protected $guarded = [];
    protected $table = "users";

    protected $hidden = [
        'password'
    ];

    public static function fetchByRole(string $role = "User") {
        return User::withWhereHas('role', function($query) use($role) {
            $query->where('role_name', '=', $role);
        });
    }

    public function role(): BelongsTo {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function userSubcourseDetails(): HasMany {
        return $this->hasMany(UserSubCourseDetail::class, 'user_id', 'id');
    }

    public function userEnrollDetails(): HasMany {
        return $this->hasMany(UserEnrollDetail::class, 'user_id', 'id');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

}
