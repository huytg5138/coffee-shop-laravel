@extends('layouts.app')

@section('content')
<div class="container mt-2">
    <h2 class="text-center mb-4">☕ Quản lý Menu Đồ Uống</h2>

    <div class="row mb-3 align-items-center">
        <div class="col-md-4">
            <a href="{{ route('products.create') }}" class="btn btn-primary shadow-sm">+ Thêm món mới</a>
        </div>
        <div class="col-md-8">
            <form action="{{ route('products.index') }}" method="GET" class="d-flex gap-2">
                <input type="text" name="search" class="form-control shadow-sm" 
                       placeholder="Nhập tên món cần tìm..." value="{{ $search ?? '' }}">
                <button type="submit" class="btn btn-dark shadow-sm">Tìm kiếm</button>
                @if(request('search'))
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary shadow-sm">Xóa lọc</a>
                @endif
            </form>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow border-0">
        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0 text-muted">Danh sách món nước</h5>
            <span class="badge bg-info text-dark">Tổng số: {{ $products->count() }} món</span>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th class="ps-3">STT</th>
                        <th>Tên đồ uống</th>
                        <th>Giá tiền (VNĐ)</th>
                        <th>Trạng thái</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $item)
                        <tr class="align-middle">
                            <td class="ps-3">{{ $loop->iteration }}</td>
                            <td class="fw-bold">{{ $item->name }}</td>
                            <td class="text-danger fw-bold">{{ number_format($item->price) }} đ</td>
                            <td>
                                @if($item->is_active)
                                    <span class="badge bg-success">Đang bán</span>
                                @else
                                    <span class="badge bg-secondary">Ngừng bán</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('products.edit', $item->id) }}" class="btn btn-sm btn-warning shadow-sm">Sửa</a>
                                <form action="{{ route('products.destroy', $item->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Bạn có chắc muốn xóa món này không?')">
                                    @csrf
                                    @method('DELETE') 
                                    <button type="submit" class="btn btn-sm btn-danger shadow-sm">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">Không tìm thấy món nào phù hợp với từ khóa "{{ request('search') }}"</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection