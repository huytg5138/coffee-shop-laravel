@extends('layouts.app')

@section('content')
<div class="container mt-2">
    <h2 class="mb-4">📊 Thống kê quán Cà phê</h2>
    
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card bg-primary text-white shadow border-0">
                <div class="card-body py-4">
                    <h6 class="text-uppercase opacity-75">Doanh thu hôm nay</h6>
                    <h2 class="fw-bold">{{ number_format($todayRevenue) }}đ</h2>
                    <p class="mb-0">Tổng số đơn: <strong>{{ $todayOrders }}</strong></p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card bg-success text-white shadow border-0">
                <div class="card-body py-4">
                    <h6 class="text-uppercase opacity-75">Doanh thu tháng {{ date('m') }}</h6>
                    <h2 class="fw-bold">{{ number_format($monthRevenue) }}đ</h2>
                    <p class="mb-0">Hôm nay: {{ date('d/m/Y') }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow border-0 h-100">
                <div class="card-body d-flex flex-column justify-content-center gap-2">
                    <a href="{{ route('pos.index') }}" class="btn btn-dark">🛒 Trang Bán hàng</a>
                    <a href="{{ route('orders.index') }}" class="btn btn-outline-dark">📜 Lịch sử hóa đơn</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection