@extends('auth')
@section('auth')
    <div id="wrapper">
        <form action="{{ route('password.email') }}" method="POST" id="form-login">
            @csrf
            <h1 class="form-heading">Quên mật khẩu</h1>
            <div class="form-group">
                <i class="fa-solid fa-user"></i>
                <input type="email" name="email" class="form-input" id="username" placeholder="Địa chỉ email"
                    value="">
            </div>
            @error('email')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            @if (session('status'))
                @if (session('status') == 'Chúng tôi đã gửi email liên kết đặt lại mật khẩu của bạn.')
                    <p class="text-success">{{ session('status') }}</p>
                @endif
                @if (session('status') == 'Email không chính xác')
                    <p class="text-danger">{{ session('status') }}</p>
                @endif
            @endif
            <input type="submit" class="form-submit" name="send-login" value="Xác nhận">
        </form>
    </div>
@endsection
