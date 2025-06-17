<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class AdminOrderController extends Controller
{
    /**
     * Hiển thị danh sách đơn hàng với tìm kiếm
     */
    public function index(Request $request)
{
    $keyword = $request->input('keyword');

   $orders = Order::with(['user', 'orderDetails.product'])
        ->when($keyword, function ($query) use ($keyword) {
            $query->where('fullname', 'LIKE', "%$keyword%")
                  ->orWhere('email', 'LIKE', "%$keyword%")
                  ->orWhere('phone_number', 'LIKE', "%$keyword%")
                  ->orWhere('address', 'LIKE', "%$keyword%");
        })
        ->orderByDesc('created_at')
        ->get();

    return view('admin.order', compact('orders'));
}

public function update(Request $request, $id)
{
    $order = Order::findOrFail($id);

    $order->update([
        'fullname' => $request->input('fullname'),
        'email' => $request->input('email'),
        'phone_number' => $request->input('phone_number'),
        'address' => $request->input('address'),
        'note' => $request->input('note'),
        'total_money' => $request->input('total_money'),
        'status' => $request->input('status'),
    ]);

    return redirect()->route('admin.order')->with('success', 'Order updated successfully.');
}


public function destroy($id)
{
    $order = Order::findOrFail($id);
    $order->delete();

    return redirect()->route('admin.order')->with('success', 'Order deleted successfully!');
}

}
