<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewMovie extends Model
{
    use HasFactory;
    // Khai báo bảng tương ứng cho model ViewMovie
    protected $table = 'viewmovies';

    // Khai báo trường tương ứng cho model ViewMovie
    protected $primaryKey = 'id';
}