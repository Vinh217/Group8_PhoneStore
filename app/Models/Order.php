<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'Order';

    public $timestamps = false;
    protected $primaryKey = 'SoHDB';

    protected $fillable = [
        'NgayDatHang',
        'DiaChi',
        'SoDienThoai',
        'GhiChu',
        'TongTien',
        'TrangThai',
        'Email',
        'TenKH'
    ];
}
