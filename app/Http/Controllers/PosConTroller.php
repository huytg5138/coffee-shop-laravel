<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Http\Controllers\Controller;
class PosConTroller extends Controller
{
    public function index()
    {
        // Chỉ lấy những món đang ở trạng thái "Đang bán"
        $products = Product::where('is_active', true)
            ->orderBy('name', 'asc')
            ->get();
        return view('pos.index', compact('products'));
    }
    public function checkout(Request $request)
{
    // 1. Kiểm tra giỏ hàng có trống không
    if (empty($request->cart)) {
        return response()->json(['success' => false, 'message' => 'Giỏ hàng trống!'], 400);
    }

    // 2. Dùng Database Transaction để đảm bảo an toàn dữ liệu (lưu thành công cả 2 bảng hoặc không lưu gì cả)
    DB::beginTransaction();
    try {
        // Tạo đơn hàng mới (Bảng orders)
        $order = Order::create([
            'user_id' => 1, // Tạm thời để ID = 1 (sau này sẽ là ID của nhân viên đang đăng nhập)
            'total_amount' => $request->total_amount,
        ]);

        // Lưu chi tiết từng món (Bảng order_details)
        foreach ($request->cart as $item) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['price'],
            ]);
        }

        DB::commit(); // Xác nhận lưu mọi thứ vào DB
        return response()->json(['success' => true, 'message' => 'Thanh toán thành công!']);

    } catch (\Exception $e) {
        DB::rollBack(); // Nếu có lỗi, hủy bỏ toàn bộ để tránh rác dữ liệu
        return response()->json(['success' => false, 'message' => 'Lỗi: ' . $e->getMessage()], 500);
    }
}
}


