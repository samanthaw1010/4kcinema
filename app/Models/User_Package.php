<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Package extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'user_package';

}