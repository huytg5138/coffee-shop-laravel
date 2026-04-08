<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderDetail;
class Order extends Model
{
    // Cho phép lưu mã nhân viên và tổng tiền
    protected $fillable = ['user_id', 'total_amount'];

    // Khai báo quan hệ: 1 đơn hàng có nhiều chi tiết món
    public function orderDetails() {
        return $this->hasMany(OrderDetail::class);
    }
}
