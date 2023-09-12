<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function bookmark(): HasMany
    {
        return $this->hasMany(Bookmark::class);
    }
    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }
    public function revenues()
    {
        return $this->hasMany(Revenue::class);
    }

    public function user_package()
    {
        return $this->belongsToMany(Package::class, 'user_package', 'user_id', 'package_id'); //trong dòng này: user_package là tên bảng trung gian, còn user_id và package_id là 2 khóa ngoại, nằm trong bảng user_package
    }
}