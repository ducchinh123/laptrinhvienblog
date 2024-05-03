@extends('admin.index')
@section('content')
    <div class="pl-3 pr-3">
        <div id="content__topic--1">
            <h5 class="">CẬP NHẬT VIDEO</h5>
        </div>
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('devC-video-update-start', ['id' => $video->id]) }}" method="POST" enctype="multipart/form-data" class="mt-3">
            @csrf
            <div class="row">
                <div class="col-md-6">

                    <div class="row" style="padding: 30px 0;">
                        <div class="col-md-12">
                            <div class="image-upload" style="position: relative;">

                                <iframe class="w-100 h-100" style="position: relative;"
                                    src="https://www.youtube-nocookie.com/embed/{{ $video->link_youtube }}"
                                    title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen></iframe>
                                <i class="bi bi-x-lg" title="Click để thay đổi video hiện tại"
                                    style="position: absolute;
                                    font-size: 30px;
                                    top: -5px;
                                    right: 3px;
                                    color: white;"
                                    id="btnRemove"></i>

                            </div>
                        </div>
                       
                        <div class="col-md-12 mt-3">

                            <div class="row">
                                <div class="col-md-9">
                                    <input type="text" id="image-upload" placeholder="Điền link video vào đây."
                                        class="form-control"
                                        style="display: none;
                                padding: 5px 5px;"
                                        id="" value="">
                                    <input type="text" name="link_youtube" style="display: none;" id="link_youtube">
                                </div>
                                <div class="col-md-3"><button type="button" class="btn btn-primary" id="review-video"
                                        style="display: none;">Xem thử</button></div>
                            </div>

                        </div>

                    </div>

                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="title" class="form-label">Tiêu đề</label>
                        <input type="text" id="title" name="title" class="form-control" value="{{ $video->title }}"
                            placeholder="Tên bài viết">
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Danh mục</label>
                        <select class="js-example-disabled-results form-control" name="category_id">
                            @foreach ($categories as $cate)
                                <option value="{{ $cate->id }}" @if ($cate->id == $video->category_id) selected @endif>
                                    {{ $cate->name }}</option>
                            @endforeach

                        </select>
                        @error('category_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label">Ảnh đại diện</label>
                        <input type="file" name="image_video" accept="image/*" class="form-control pb-5 mb-3"
                            id="">
                        <img src="{{ $video->image_video }}" style="width: 100%; height: 276px;" class="img-thumbnail"
                            alt="...">
                        
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6 text-right">
                    <input type="submit" class="btn btn-success" value="Thêm mới">
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
@push('js-video')
    <script>
        var boxVideo = document.querySelector('.image-upload');
        var inputLink = document.getElementById('link_youtube');
        boxVideo.addEventListener('click', function() {
            var input = document.querySelector('#image-upload');
            if (input.classList.toggle('active')) {
                input.style.display = 'block';
                input.addEventListener("input", () => {
                    var value = input.value.trim().slice(17);
                    inputLink.value = value;
                })
            } else {
                input.style.display = 'none';

            }


            var btnReview = document.querySelector("#review-video");
            if (btnReview.classList.toggle('active')) {
                btnReview.style.display = 'block';

                btnReview.addEventListener("click", () => {
                    var value = input.value.trim().slice(17);
                    var boxParent = document.querySelector('.image-upload');
                    boxParent.innerHTML = `<iframe
                        class="w-100 h-100"
                        src="https://www.youtube-nocookie.com/embed/${value}"
                        title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen
                      ></iframe>`
                    inputLink.value = value;

                })
            } else {
                btnReview.style.display = 'none';

            }
        })


        var btnChangeVideo = document.getElementById("btnRemove");
        btnChangeVideo.addEventListener("click", (e) => {
            var boxParent = document.querySelector('.image-upload');
            boxParent.innerHTML = `<img class="w-100" style="height: 250px;" id="preview-image"
                                    src="https://noithatcaco.vn/upanh/uploads/487no-video.jpg" alt="" />
                                <label for="image-upload"><i class="bi bi-cloud-arrow-up"
                                        style="position: absolute;
                                                font-size: 65px;
                                                top: 53px;
                                                left: 44%;"></i></label>`
            e.stopPropagation()
        })
    </script>
@endpush
