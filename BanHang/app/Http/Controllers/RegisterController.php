<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:200',
            'password' => 'required|min:6|confirmed',
        ]);

        // Lấy role_id của role "user"
        $roleUser = Role::where('name', 'user')->first();

        if (!$roleUser) {
            return back()->withErrors(['role' => 'Role user không tồn tại.']);
        }

        // Tạo user mới
        $user = User::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'role_id' => $roleUser->id,
        ]);

        return redirect()->route('login')->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
    }
}

