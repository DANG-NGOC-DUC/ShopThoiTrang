<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class AdminProductController extends Controller
{
    // Hiển thị danh sách sản phẩm + tìm kiếm
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $products = Product::with('category')
            ->when($keyword, function ($query, $keyword) {
                return $query->where('title', 'like', '%' . $keyword . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        $categories = Category::all();

        return view('admin.product', compact('products', 'categories', 'keyword'));
    }

    // Lưu sản phẩm mới
    public function store(Request $request)
    {
        
        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'nullable|numeric',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string|max:1000',
        ]);

        $imagePath = null;
        if ($request->hasFile('thumbnail')) {
            $imagePath = $request->file('thumbnail')->store('products', 'public');
        }

        Product::create([
            'title' => $request->title,
            'price' => $request->price,
            'quantity' => $request->quantity ?? 0,
            'thumbnail' => $imagePath,
            'category_id' => $request->category_id,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.product')->with('success', 'Thêm sản phẩm thành công');
    }


    // Cập nhật sản phẩm
   public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);
    $data = [
        'title' => $request->input('title'),
        'price' => $request->input('price'),
        'quantity' => $request->input('quantity', 0), // Mặc định là 0 nếu không có giá trị
        'description' => $request->input('description'),
    ];

    if ($request->hasFile('thumbnail')) {
        $imagePath = $request->file('thumbnail')->store('products', 'public');
        $data['thumbnail'] = $imagePath;
    }

    $updated = $product->update($data);

    return redirect()->route('admin.product')->with('success', 'Cập nhật sản phẩm thành công.');
}



    // Xoá sản phẩm
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.product')->with('success', 'Xoá sản phẩm thành công.');
    }
}
