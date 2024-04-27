@extends('auth')
@section('auth')
    <div id="wrapper">
        <form action="?mod=users&action=login" method="POST" id="form-login">
            <h1 class="form-heading">ĐĂNG KÝ</h1>
            <div class="form-group">
                <i class="fa-solid fa-user"></i>
                <input type="text" name="username" class="form-input" id="username" placeholder="Tên đăng nhập"
                    value="">
            </div>

            <div class="form-group">
                <i class="fa-solid fa-user-secret"></i>
                <input type="text" name="username" class="form-input" id="username" placeholder="Họ và tên"
                    value="">
            </div>


            <div class="form-group">
                <i class="fa-regular fa-envelope"></i>
                <input type="text" name="username" class="form-input" id="username" placeholder="Địa chỉ email"
                    value="">
            </div>
            <div class="form-group">
                <i class="fa-solid fa-key"></i>
                <input type="password" name="password" class="form-input" id="password" placeholder="Mật khẩu">
                <div id="eyes">
                    <i class="fa-solid fa-eye-slash"></i>

                </div>
            </div>
            <div style=""><a href="{{ route('c-login') }}"
                    style="text-decoration: none; color: white; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Bạn
                    đã có tài khoản?</a></div>
            <input type="submit" class="form-submit" name="send-login" value="Đăng nhập">
        </form>
    </div>
@endsection
