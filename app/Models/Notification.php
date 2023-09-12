<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Notification extends Model
{
    use HasFactory;
    protected $table = 'notifications';
    protected $fillable = [
        'package_id',
        'title',
        'image_notification',
        'content',
        'expired_at',
        'created_at',
        'updated_at'
    ];
    public function package(): HasMany
    {
        return $this->hasMany(Package::class);
    }
}