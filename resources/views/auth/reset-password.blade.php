@extends('auth')
@section('auth')
<div id="wrapper">
    <form action="{{ route('password.store') }}" method="POST" id="form-login">
        @csrf
        <h1 class="form-heading">ĐẶT LẠI MẬT KHẨU</h1>
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
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
        <div class="form-group">
            <i class="fa-solid fa-key"></i>
            <input type="password" name="password_confirmation" class="form-input" id="password" placeholder="Mật khẩu nhập lại">
            <div id="eyes">
                <i class="fa-solid fa-eye-slash"></i>

            </div>
        </div>
        @error('password_confirmation')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        <input type="submit" class="form-submit" name="send-login" value="Đặt lại">
    </form>
</div>
@endsection