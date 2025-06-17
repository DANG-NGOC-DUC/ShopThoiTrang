<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();
        // Lọc theo tên sản phẩm
        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where('title', 'like', '% ' . $keyword . ' %')
                ->orWhere('title', 'like', $keyword . ' %')
                ->orWhere('title', 'like', '% ' . $keyword)
                ->orWhere('title', 'like', $keyword);
        }

        // Lọc theo danh mục
        if ($request->has('category')) {
            $query->whereIn('category_id', $request->input('category', []));
        }

        // Lọc theo giá
        if ($request->has('price')) {
            $query->where(function ($q) use ($request) {
                foreach ($request->input('price') as $range) {
                    [$min, $max] = explode('-', $range);
                    $q->orWhereBetween('price', [(int) $min, (int) $max]);
                }
            });
        }

        $products   = $query->paginate(6)->withQueryString();
        $categories = Category::withCount('products')->get();

        return view('user.shop', compact('products', 'categories'));
    }

}
