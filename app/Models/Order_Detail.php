<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_Detail extends Model
{
    use HasFactory;

    protected $table = 'orderdetail';
    public $timestamps = false;
    protected $primaryKey = 'SoHDB';

    protected $fillable = [
        'MaDT',
        'Mau',
        'SoLuong',
        'DonGiaBan',
    ];
}
