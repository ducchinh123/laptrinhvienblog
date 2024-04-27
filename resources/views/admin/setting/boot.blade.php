@extends('admin.index')
@section('content')
    <div class="pl-3 pr-3">
        <div id="content__topic--1">
            <h5 class="">TÀI KHOẢN CỦA TÔI</h5>
        </div>
        <form action="" class="mt-3">
            <div class="row">
                <div class="col-md-6">

                    <div class="row" style="padding: 30px 0;">
                        <div class="col-md-12">
                            <div class="image-upload" style="position: relative;">
                                <img class="w-100" style="height: 250px;" id="preview-image"
                                    src="https://static.vecteezy.com/system/resources/thumbnails/004/141/669/small/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg"
                                    alt="" />
                                <label for="image-upload"><i class="bi bi-cloud-arrow-up"
                                        style="position: absolute;
                                                font-size: 65px;
                                                top: 77px;
                                                left: 44%;"></i></label>
                                <input type="file" id="image-upload" name="" style="display: none;"
                                    id="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="title" class="form-label">Ngày cập nhật</label>
                                <input type="date" class="form-control" name="" id="">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="title" class="form-label">Tên đăng nhập</label>
                        <input type="text" id="title" class="form-control" placeholder="Tên đăng nhập">
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Họ và Tên</label>
                        <input type="text" id="title" class="form-control" placeholder="Họ và tên">
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label">Địa chỉ Email</label>
                        <input type="email" id="title" class="form-control" placeholder="Email của bạn">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label confirm-change">Thay đổi mật khẩu <i class="fa-solid fa-arrow-right-to-bracket"></i></label>
                        <div class="password" style="display: none;">
                            <div class="mb-3">
                                <label for="title" class="form-label">Mật khẩu cũ</label>
                                <input type="password" id="title" class="form-control" placeholder="Email của bạn">
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label">Mật khẩu mới</label>
                                <input type="password" id="title" class="form-control" placeholder="Email của bạn">
                            </div>
                        </div>
                    </div>
                   

                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6 text-right">
                    <input type="submit" class="btn btn-success" value="Cập nhật">
                </div>
            </div>
        </form>
    </div>
@endsection
@push('select2')
    <script>
        var $disabledResults = $(".js-example-disabled-results");
        $disabledResults.select2();
    </script>
@endpush

@push('js-admin')
    <script>
        var btnConfirmChangePass = document.querySelector('.confirm-change');
        btnConfirmChangePass.addEventListener("click", function() {
            var boxPass = document.querySelector('.password');

            if(boxPass.classList.toggle('active')) {
                boxPass.style.display = 'block';
            }else {
                boxPass.style.display = 'none';
            }
        })
    </script>
@endpush