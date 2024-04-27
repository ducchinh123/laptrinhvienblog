@extends('admin.index')
@section('content')
    <div class="pl-3 pr-3">
        <div id="content__topic--1">
            <h5 class="">THÊM MỚI BÀI VIẾT</h5>
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
                        <div class="col-md-12">
                            <label for="title" class="form-label">Danh mục</label>
                            <select class="js-example-disabled-results form-control">
                                <option value="one">First</option>
                                <option value="one">First 1</option>
                                <option value="one">First 2</option>
                                <option value="one">First 3</option>
                                <option value="one">First 4</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="title" class="form-label">Tên bài viết</label>
                        <input type="text" id="title" class="form-control" placeholder="Tên bài viết">
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Tóm tắt bài viết</label>
                        <textarea name="" class="form-control" id="" cols="30" rows="10"></textarea>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="title" class="form-label">Ngày xuất bản</label>
                                <input type="date" class="form-control" name="" id="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="title" class="form-label">Tác giả</label>
                                <input type="text" class="form-control" name="" id="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="desc" class="form-label">Nội dung bài viết</label>
                        <textarea name="" id="ckeditor" class="ckeditor" cols="30" rows="10"></textarea>
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
