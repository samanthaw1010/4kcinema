<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public $timestamps = false;
    use HasFactory;

    public function movie()
    {
        return $this->hasMany(Movie::class)->orderBy('id', 'DESC'); //hoặc là sắp xếp ở đây luôn, hoặc có thể sắp xếp ngay lúc dùng foreach duyệt qua mảng lấy phim hiển thị ra website.
    }
}