<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;

//Trang không cần đăng nhập
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
// Vòng bảo vệ: Tất cả các trang bên trong đều yêu cầu phải Login
Route::middleware(['auth'])->group(function () {
    //Trang đăng xuất
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    //Đường dẫn của trang quản lí sản phẩm
    Route::resource('products', ProductController::class);
    //Đường dẫn của trang POS
    Route::get('/pos', [PosController::class, 'index'])->name('pos.index');
    //Đường dẫn xử lý thanh toán
    Route::post('/checkout', [PosController::class, 'checkout'])->name('pos.checkout');
    //Đường dẫn của trang quản lí đơn hàng
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    //Đường dẫn của trang dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

});