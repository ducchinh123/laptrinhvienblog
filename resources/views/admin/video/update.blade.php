@extends('admin.index')
@section('content')
    <div class="pl-3 pr-3">
        <div id="content__topic--1">
            <h5 class="">THÊM MỚI VIDEO</h5>
        </div>
        <form action="" class="mt-3">
            <div class="row">
                <div class="col-md-6">

                    <div class="row" style="padding: 30px 0;">
                        <div class="col-md-12">
                            <div class="image-upload" style="position: relative;">
                                <img class="w-100" style="height: 250px;" id="preview-image"
                                    src="https://noithatcaco.vn/upanh/uploads/487no-video.jpg" alt="" />
                                <label for="image-upload"><i class="bi bi-cloud-arrow-up"
                                        style="position: absolute;
                                                font-size: 65px;
                                                top: 53px;
                                                left: 44%;"></i></label>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">

                            <div class="row">
                                <div class="col-md-9">
                                    <input type="text" id="image-upload"
                                        placeholder="Điền link video vào đây." class="form-control"
                                        name=""
                                        style="display: none;
                                padding: 5px 5px;"
                                        id="" value="">
                                </div>
                                <div class="col-md-3"><button type="button" class="btn btn-primary" id="review-video" style="display: none;">Xem thử</button></div>
                            </div>
                            
                        </div>

                    </div>

                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="title" class="form-label">Tiêu đề</label>
                        <input type="text" id="title" class="form-control" placeholder="Tên bài viết">
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Danh mục</label>
                        <select class="js-example-disabled-results form-control">
                            <option value="one">First</option>
                            <option value="one">First 1</option>
                            <option value="one">First 2</option>
                            <option value="one">First 3</option>
                            <option value="one">First 4</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label">Ảnh đại diện</label>
                        <input type="file" name="" class="form-control pb-5" id="">
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
        boxVideo.addEventListener('click', function() {
            var input = document.querySelector('#image-upload');
            if (input.classList.toggle('active')) {
                input.style.display = 'block';
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
                    
                })
            } else {
                btnReview.style.display = 'none';

            }
        })
    </script>
@endpush
