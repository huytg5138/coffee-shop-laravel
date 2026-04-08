<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        // Lấy danh sách đơn hàng mới nhất lên đầu
        $orders = Order::orderBy('created_at', 'desc')->get();
        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        // Xem chi tiết một hóa đơn (gồm các món bên trong)
        // Chúng ta sẽ dùng tính năng 'with' để lấy luôn order_details
        $order->load('orderDetails.product');
        return view('orders.show', compact('order'));
    }
}
