<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'movie_id',
        'rating',
        'user_id'
    ];
    protected $table = 'ratings';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}