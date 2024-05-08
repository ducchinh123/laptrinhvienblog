@extends('admin.index')
@section('content')
    <div class="pl-3 pr-3">
        <div id="content__topic--1">
            <h5 class="">CẬP NHẬT BÀI VIẾT</h5>
        </div>
        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('devC-post-update-start', ['id' => $post->id]) }}" method="POST" class="mt-3"
            enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">

                    <div class="row" style="padding: 30px 0;">
                        <div class="col-md-12">
                            <div class="image-upload" style="position: relative;">
                                <img class="w-100" style="height: 250px;" id="preview-image" src="<?php if ($post->overview_photo != '') {
                                    echo $post->overview_photo;
                                } else {
                                    echo 'https://static.vecteezy.com/system/resources/thumbnails/004/141/669/small/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg';
                                } ?>"
                                    alt="" />
                                <label for="image-upload"><i class="bi bi-cloud-arrow-up"
                                        style="position: absolute;
                                            font-size: 65px;
                                            top: 77px;
                                            left: 44%;"></i></label>
                                <img src="" id="preview-image" alt="">
                                <input type="file" id="image-upload" accept="image/*" name="overview_photo"
                                    style="display: none;" id="">
                            </div>
                            @error('overview_photo')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="title" class="form-label">Danh mục</label>
                            <select class="js-example-disabled-results form-control" name="category_id">
                                @foreach ($categories as $cate)
                                    <option value="{{ $cate->id }}" @if ($cate->id == $post->category_id) selected @endif>
                                        {{ $cate->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('category_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="title" class="form-label">Tên bài viết</label>
                        <input type="text" id="title" name="title" class="form-control" placeholder="Tên bài viết"
                            value="{{ $post->title }}">
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Tóm tắt bài viết</label>
                        <textarea name="desc_short" class="form-control" id="" cols="30" rows="10">{!! strip_tags($post->desc_short) !!}</textarea>
                        @error('desc_short')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="title" class="form-label">Ngày xuất bản</label>
                                <input type="date" class="form-control" name="date_submitted" id=""
                                    value="{{ $post->date_submitted }}">
                                @error('date_submitted')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="title" class="form-label">Tác giả</label>
                                <input type="text" class="form-control" name="author" id="" readonly
                                    value="{{ Auth::user()->name }}">
                                <input type="text" class="form-control" name="author_id" id="" hidden
                                    value="{{ Auth::user()->id }}">
                                @error('author')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="desc" class="form-label">Nội dung bài viết</label>
                        <textarea name="desc_detail" id="ckeditor" class="ckeditor" cols="30" rows="10">{{ $post->desc_detail }}</textarea>
                        @error('desc_detail')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
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
