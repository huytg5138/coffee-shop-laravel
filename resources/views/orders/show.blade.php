@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow border-0">
        <div class="card-body p-5">
            <h2 class="text-center mb-4">CHI TIẾT HÓA ĐƠN #{{ $order->id }}</h2>
            <p class="text-center text-muted mb-4" id="print-datetime"></p>
            <script>
                document.getElementById('print-datetime').textContent =
                    'Ngày in: ' + new Date().toLocaleDateString('vi-VN', {
                        day: '2-digit', month: '2-digit', year: 'numeric'
                    }) + ' — ' + new Date().toLocaleTimeString('vi-VN', {
                        hour: '2-digit', minute: '2-digit', second: '2-digit'
                    });
            </script>
            <table class="table">
                <thead>
                    <tr>
                        <th>Món uống</th>
                        <th>SL</th>
                        <th>Đơn giá</th>
                        <th class="text-end">Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderDetails as $detail)
                    <tr>
                        <td>{{ $detail->product?->name ?? 'Sản phẩm đã xóa' }}</td>
                        <td>{{ $detail->quantity }}</td>
                        <td>{{ number_format($detail->unit_price) }}đ</td>
                        <td class="text-end">{{ number_format($detail->quantity * $detail->unit_price) }}đ</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-end mt-4">
                <h3>Tổng cộng: <span class="text-danger">{{ number_format($order->total_amount) }}đ</span></h3>
            </div>
            <div class="d-print-none mt-4">
                <button onclick="window.print()" class="btn btn-primary">🖨️ In hóa đơn</button>
                <a href="{{ route('orders.index') }}" class="btn btn-secondary">Quay lại</a>
            </div>
        </div>
    </div>
</div>
@endsection