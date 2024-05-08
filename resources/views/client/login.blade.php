@extends('auth')
@section('auth')
<div id="wrapper">
    <form action="{{ route('loginClient') }}" method="POST" id="form-login">
        @csrf
        <h1 class="form-heading">ĐĂNG NHẬP</h1>
        <div class="form-group">
            <i class="fa-solid fa-user"></i>
            <input type="email" name="email" class="form-input" id="username" placeholder="Địa chỉ email" value="">
        </div>
        @error('email')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        <div class="form-group">
            <i class="fa-solid fa-key"></i>
            <input type="password" name="password" class="form-input" id="password" placeholder="Mật khẩu">
            <div id="eyes">
                <i class="fa-solid fa-eye-slash"></i>

            </div>
        </div>
        @error('password')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        
        <div style=""><a href="{{ route('c-register') }}" style="text-decoration: none; color: white; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Bạn chưa có tài khoản?</a></div>
        <div style=""><a href="" style="text-decoration: none; color: white; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Bạn quên mật khẩu?</a></div>
        <input type="submit" class="form-submit" name="send-login" value="Đăng nhập">
    </form>
</div>
@endsection