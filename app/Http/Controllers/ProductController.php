<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Lấy từ khóa từ ô nhập liệu có tên là 'search'
        $search = $request->input('search');

        // Nếu có từ khóa, lọc theo tên. Nếu không, lấy tất cả.
        $products = Product::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%");
        })->get();

        // Trả về view kèm theo danh sách sản phẩm và từ khóa để hiển thị lại trên ô nhập
        return view('products.index', compact('products', 'search'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create'); //Hiển thị form tạo mới sản phẩm
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'is_active' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Giới hạn 2MB
        ]);

        $data['is_active'] = (bool) $data['is_active'];

        if ($request->hasFile('image')) {
            // Lưu ảnh vào storage/app/public/products và lấy tên file
            $path = $request->file('image')->store('products', 'public');
            $data['image'] = $path;
        }

        Product::create($data);
        return redirect()->route('products.index')->with('success', 'Thêm món thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'is_active' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data['is_active'] = (bool) $data['is_active'];

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $data['image'] = $path;
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Cập nhật món thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Đã xóa món khỏi menu !');
    }
}
