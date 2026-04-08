<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa món uống</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-warning">
                        <h4 class="mb-0 text-dark">Chỉnh sửa món uống</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('products.update', $product->id) }}" method="POST">
                            @csrf
                            @method('PUT') <div class="mb-3">
                                <label class="form-label">Tên đồ uống</label>
                                <input type="text" name="name" value="{{ $product->name }}" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Giá tiền (VNĐ)</label>
                                <input type="number" name="price" value="{{ $product->price }}" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Trạng thái</label>
                                <select name="is_active" class="form-select">
                                    <option value="1" {{ $product->is_active ? 'selected' : '' }}>Đang bán</option>
                                    <option value="0" {{ !$product->is_active ? 'selected' : '' }}>Ngừng bán</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-warning w-100">Cập nhật thay đổi</button>
                        </form>
                    </div>
                </div>
                <a href="{{ route('products.index') }}" class="btn btn-link mt-3">Quay lại danh sách</a>
            </div>
        </div>
    </div>
</body>
</html>