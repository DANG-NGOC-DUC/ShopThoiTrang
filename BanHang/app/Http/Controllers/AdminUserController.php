<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    // Hiển thị danh sách user kèm tìm kiếm
    public function index(Request $request)
    {
        $query = User::with('role');

        if ($request->has('keyword') && !empty($request->keyword)) {
            $query->where('email', 'like', '%' . $request->keyword . '%');
        }

        $users = $query->get();

        // Lấy danh sách roles để select trong modal edit
        $roles = Role::all();

        return view('admin.user', compact('users', 'roles'));
    }

    // Xử lý cập nhật user
    public function update(Request $request, $id)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => "required|email|max:255|unique:users,email,$id",
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::findOrFail($id);

        // Cập nhật dữ liệu user
        $user->fullname = $request->fullname;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;
        $user->role_id = $request->role_id;

        $user->save();

        return redirect()->route('admin.user')->with('success', 'Cập nhật người dùng thành công!');
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Xóa các đơn hàng liên quan của user này trước
        $user->orders()->delete();

        // Sau đó xóa user
        $user->delete();

        return redirect()->route('admin.user')->with('success', 'Xóa người dùng thành công!');
    }
}
