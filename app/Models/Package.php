<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $fillable = ['name', 'price', 'quality', 'chat', 'bookmark'];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}