@extends('layout.LoginRegisterLayout')

@section('title', 'Register')

@section('content')
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="container" style="max-width: 400px;">
        <h1 class="text-center mb-4">Đăng Ký</h1>
        <form action="{{ route('register.submit') }}" method="POST">
            @csrf

            <div class="mb-3">
                <input type="text" name="fullname" value="{{ old('fullname') }}" placeholder="Họ tên" class="form-control @error('fullname') is-invalid @enderror">
                @error('fullname')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" class="form-control @error('email') is-invalid @enderror">
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <input type="text" name="phone_number" value="{{ old('phone_number') }}" placeholder="Số điện thoại (tuỳ chọn)" class="form-control @error('phone_number') is-invalid @enderror">
                @error('phone_number')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <input type="text" name="address" value="{{ old('address') }}" placeholder="Địa chỉ (tuỳ chọn)" class="form-control @error('address') is-invalid @enderror">
                @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <input type="password" name="password" placeholder="Mật khẩu" class="form-control @error('password') is-invalid @enderror">
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <input type="password" name="password_confirmation" placeholder="Xác nhận mật khẩu" class="form-control">
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-success">Đăng ký</button>
            </div>

            <div class="text-center mt-3">
                <a href="{{ route('login.form') }}">Đăng nhập</a>
            </div>
        </form>
    </div>
</div>
@endsection
