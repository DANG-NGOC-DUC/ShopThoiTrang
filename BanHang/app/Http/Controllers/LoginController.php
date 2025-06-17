<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    $request->validate([
        'login_type' => 'required|in:admin,user',
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $credentials = $request->only('email', 'password');

    $user = User::where('email', $credentials['email'])->first();

    if (!$user || !Hash::check($credentials['password'], $user->password)) {
        return back()->withErrors(['email' => 'Email hoặc mật khẩu không chính xác'])->withInput();
    }

    // Kiểm tra role dựa trên login_type
    if (
        ($request->login_type == 'admin' && $user->role->name != 'admin') ||
        ($request->login_type == 'user' && $user->role->name != 'user')
    ) {
        return back()->withErrors(['login_type' => 'Không đúng chế độ đăng nhập'])->withInput();
    }

    // Đăng nhập người dùng
    Auth::login($user);

   // Điều hướng tùy loại user
    if ($request->login_type == 'admin') {
        return redirect()->route('admin.dashboard');
    } else {
        return redirect()->route('user.home');
    }

}

    
}
