<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Doanh thu hôm nay
        $todayRevenue = Order::whereDate('created_at', Carbon::today())->sum('total_amount');

        // 2. Doanh thu tháng này
        $monthRevenue = Order::whereMonth('created_at', Carbon::now()->month)
                            ->whereYear('created_at', Carbon::now()->year)
                            ->sum('total_amount');

        // 3. Tổng số đơn hàng trong ngày
        $todayOrders = Order::whereDate('created_at', Carbon::today())->count();

        return view('dashboard', compact('todayRevenue', 'monthRevenue', 'todayOrders'));
    }
}
