@extends('layouts.app')

@push('styles')
    @vite('resources/css/pos.css')

@endpush

@section('content')
    <div class="container mt-2">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow border-0">
                    <div class="card-header bg-primary text-white py-3">
                        <h4 class="mb-0">Thêm đồ uống mới</h4>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label fw-bold">Tên đồ uống</label>
                                <input type="text" name="name" class="form-control" required placeholder="Nhập tên món...">
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Hình ảnh sản phẩm</label>
                                <input type="file" name="image" class="form-control" accept="image/*">
                                
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Giá tiền (VNĐ)</label>
                                <input type="number" name="price" class="form-control" required placeholder="Ví dụ: 25000">
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Trạng thái</label>
                                <select name="is_active" class="form-select">
                                    <option value="1">Đang bán</option>
                                    <option value="0">Ngừng bán</option>
                                </select>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success btn-lg">Lưu vào Menu</button>
                                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Quay lại danh
                                    sách</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection