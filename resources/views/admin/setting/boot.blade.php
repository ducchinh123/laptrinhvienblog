@extends('admin.index')
@section('content')
    <div class="pl-3 pr-3">
        <div id="content__topic--1">
            <h5 class="">TÀI KHOẢN CỦA TÔI</h5>
        </div>

        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        @if (session('passwordError'))
            <div class="alert alert-danger mt-3">
                {{ session('passwordError') }}
            </div>
        @endif
        <form action="{{ route('devC-boot-update', ['id' => $filter_info->id]) }}" method="POST" class="mt-3"
            enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">

                    <div class="row" style="padding: 30px 0;">
                        <div class="col-md-12">
                            <div class="image-upload" style="position: relative;">
                                <img class="w-100" style="height: 250px;" id="preview-image"
                                    src="{{ $filter_info->avatar }}" alt="" />
                                <label for="image-upload"><i class="bi bi-cloud-arrow-up"
                                        style="position: absolute;
                                                font-size: 65px;
                                                top: 77px;
                                                left: 44%;"></i></label>
                                <img src="" id="preview-image" alt="">
                                <input type="file" id="image-upload" accept="image/*" name="avatar"
                                    style="display: none;" id="">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="title" class="form-label">Tên đăng nhập</label>
                        <input type="text" id="title" class="form-control" name="username"
                            value="{{ $filter_info->username }}" placeholder="Tên đăng nhập">
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Họ và Tên</label>
                        <input type="text" id="title" name="name" class="form-control"
                            value="{{ $filter_info->name }}" placeholder="Họ và tên">
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label">Địa chỉ Email</label>
                        <input type="email" id="title" class="form-control" name="email"
                            value="{{ $filter_info->email }}" placeholder="Email của bạn">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label confirm-change">Thay đổi mật khẩu <i
                                class="fa-solid fa-arrow-right-to-bracket"></i></label>
                        <div class="password" style="display: none;">
                            <div class="mb-3">
                                <label for="title" class="form-label">Mật khẩu cũ</label>
                                <input type="password" id="title" name="password" class="form-control"
                                    placeholder="Nhập mật khẩu cũ">
                                @if (session('passwordError'))
                                    <p class="text-danger">{{ session('passwordError') }}</p>
                                @endif
                                @if (session('pass'))
                                    <p class="text-danger">{{ session('pass') }}</p>
                                @endif

                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label">Mật khẩu mới</label>
                                <input type="password" id="title" name="password_new" class="form-control"
                                    placeholder="Nhập mật khẩu mới">
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

            if (boxPass.classList.toggle('active')) {
                boxPass.style.display = 'block';
            } else {
                boxPass.style.display = 'none';
            }
        })

        var chooseFile = document.querySelector('#image-upload');
        chooseFile.addEventListener('change', (event) => {
            const input = event.target
            if (input.files && input.files[0]) {
                const selectedFile = input.files[0]
                const reader = new FileReader()

                reader.onload = function(e) {
                    const previewImage = document.getElementById('preview-image')
                    previewImage.src = e.target.result
                }

                reader.readAsDataURL(selectedFile)


            }
        })
    </script>
@endpush
