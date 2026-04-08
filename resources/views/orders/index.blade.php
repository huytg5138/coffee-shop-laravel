@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-dark text-white">📜 Danh sách hóa đơn đã bán</div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Mã đơn</th>
                        <th>Ngày giờ</th>
                        <th>Tổng tiền</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $item)
                    <tr>
                        <td>#{{ $item->id }}</td>
                        <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                        <td class="text-danger fw-bold">{{ number_format($item->total_amount) }}đ</td>
                        <td><a href="{{ route('orders.show', $item->id) }}" class="btn btn-sm btn-info text-white">Chi tiết</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection