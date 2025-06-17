<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        // Lấy hoặc tạo giỏ hàng user hiện tại
        $cart = Cart::firstOrCreate(['user_id' => $userId]);

        // Load các item cùng product
        $cart->load('cartItems.product');

        $cartItems = $cart->cartItems;

        return view('user.cart', compact('cartItems'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'integer|min:1',
        ]);

        $userId = auth()->id();
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        $product = Product::findOrFail($productId);

        // Lấy hoặc tạo giỏ hàng user
        $cart = Cart::firstOrCreate(['user_id' => $userId]);

        // Tìm CartItem đã có trong giỏ hàng
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
        } else {
            $cartItem = new CartItem([
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $product->price,
            ]);
            $cart->cartItems()->save($cartItem);
        }

        $cartItem->save();

        return response()->json(['message' => 'Thêm vào giỏ hàng thành công!']);
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'quantity' => 'required|integer|min:1',
    ]);

    $cartItem = CartItem::findOrFail($id);
    $cartItem->quantity = $request->input('quantity');
    $cartItem->save();

    return redirect()->route('user.cart');
}
    public function ajaxUpdate(Request $request, $id)
{
    $request->validate([
        'quantity' => 'required|integer|min:1',
    ]);

    $cartItem = CartItem::findOrFail($id);

    // Kiểm tra xem item đó có thuộc giỏ của user đang đăng nhập không
    if ($cartItem->cart->user_id !== auth()->id()) {
        return response()->json(['message' => 'Unauthorized'], 403);
    }

    $cartItem->quantity = $request->quantity;
    $cartItem->save();

    // Tính lại tổng giỏ hàng
    $cartTotal = CartItem::where('cart_id', $cartItem->cart_id)->sum(\DB::raw('quantity * price'));

    return response()->json([
        'item_total' => $cartItem->quantity * $cartItem->price,
        'cart_total' => $cartTotal,
    ]);
}


    public function remove($id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->delete();

        return redirect()->route('user.cart')->with('success', 'Xóa sản phẩm khỏi giỏ hàng thành công.');
    }
}
