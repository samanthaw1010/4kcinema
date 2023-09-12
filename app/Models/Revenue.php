<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revenue extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected $table = 'revenues'; // Tên bảng trong cơ sở dữ liệu
    protected $primaryKey = "id";
    protected $fillable = ['payment_method', 'purchase_total', 'purchase_date'];
}