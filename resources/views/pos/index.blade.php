@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pos.css'])
   
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="mb-4">
                <input type="text" id="pos-search" class="form-control form-control-lg shadow-sm border-0" 
                       placeholder="🔍 Tìm nhanh món nước">
            </div>

            <div class="row" id="product-list">
                @foreach($products as $product)
                <div class="col-md-3 mb-4 product-item" data-name="{{ strtolower($product->name) }}">
                    <div class="card h-100 shadow-sm menu-item border-0" 
                         onclick="addToCart({{ $product->id }}, '{{ $product->name }}', {{ $product->price }})">
                        
                        <div class="img-sp-wrap">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top img-sp" alt="{{ $product->name }}">
                            @else
                                <img src="https://via.placeholder.com/600x400?text=Coffee" class="card-img-top img-sp" alt="No image">
                            @endif
                        </div>

                        <div class="card-body text-center p-2">
                            <h6 class="card-title fw-bold mb-1 text-truncate">{{ $product->name }}</h6>
                            <p class="text-danger fw-bold mb-0">{{ number_format($product->price) }}đ</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow border-0">
                <div class="card-header bg-dark text-white py-3">
                    <h5 class="mb-0 fw-bold">🛒 ĐƠN HÀNG</h5>
                </div>
                <div class="card-body">
                    <div class="cart-scroll">
                        <table class="table table-sm align-middle">
                            <tbody id="cart-body">
                                </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0 fw-bold">TỔNG CỘNG:</h5>
                        <h4 class="text-danger fw-bold mb-0" id="total-amount">0đ</h4>
                    </div>
                    <button class="btn btn-success btn-lg w-100 py-3 fw-bold shadow" onclick="checkout()">
                        THANH TOÁN (XUẤT BILL)
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    @vite(['resources/js/pos.js'])
@endpush