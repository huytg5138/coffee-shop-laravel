<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    // Cho phép lưu mã đơn, mã món, số lượng và giá tại thời điểm bán
    protected $fillable = ['order_id', 'product_id', 'quantity', 'unit_price'];

    // Khai báo quan hệ: Chi tiết này thuộc về một món sản phẩm nào đó
    public function product() {
        return $this->belongsTo(Product::class)->withTrashed();
    }
}
