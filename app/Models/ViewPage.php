<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewPage extends Model
{
    use HasFactory;
    // Khai báo bảng tương ứng cho model ViewPage
    protected $table = 'viewpages';
    protected $fillable = ['view_count'];

    // Khai báo trường tương ứng cho model ViewPage
    protected $primaryKey = 'id';
}