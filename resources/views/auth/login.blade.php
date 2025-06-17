@extends('layout.LoginRegisterLayout')
@section('title', 'Login')
@section('content')
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="container" style="max-width: 400px;">
        <h1 class="text-center mb-4">Đăng Nhập</h1>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Chọn chế độ đăng nhập</label>
                <select name="login_type" class="form-select @error('login_type') is-invalid @enderror">
                    <option value="admin" {{ old('login_type') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ old('login_type') == 'user' ? 'selected' : '' }}>User</option>
                </select>
                @error('login_type')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <input type="text" name="email" value="{{ old('email') }}" placeholder="Email" class="form-control @error('email') is-invalid @enderror">
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <input type="password" name="password" placeholder="Mật khẩu" class="form-control @error('password') is-invalid @enderror">
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Đăng nhập</button>
            </div>

            <div class="text-center mt-3">
                <a href="{{ route('register') }}">Đăng ký</a>
            </div>
        </form>
    </div>
</div>
@endsection
