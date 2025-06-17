<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class AdminCategoryController extends Controller
{
    // Hiển thị danh sách categories, có hỗ trợ tìm kiếm
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $categories = Category::when($keyword, function ($query, $keyword) {
            return $query->where('name', 'LIKE', "%{$keyword}%");
        })->orderBy('id', 'desc')->paginate(10);

        return view('admin.category', compact('categories'));
    }

    // Thêm mới category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:categories,name',
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.category')->with('success', 'Thêm danh mục thành công!');
    }

    // Cập nhật category
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => "required|string|max:100|unique:categories,name,{$id}",
        ]);

        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.category')->with('success', 'Cập nhật danh mục thành công!');
    }

    // Xóa category
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // Kiểm tra có sản phẩm liên quan không
        if ($category->products()->count() > 0) {
            return redirect()->route('admin.category')
                             ->with('error', 'Không thể xóa danh mục vì còn sản phẩm liên quan.');
        }

        $category->delete();

        return redirect()->route('admin.category')->with('success', 'Xóa danh mục thành công!');
    }
}
