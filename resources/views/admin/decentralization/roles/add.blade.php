@extends('admin.index')
@section('content')
    <div class="pl-3 pr-3">
        <div id="content__topic--1">
            <h5 class="">THÊM MỚI VAI TRÒ </h5>
        </div>
        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger mt-3">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('role-add-start') }}" method="POST" class="mt-3">
            @csrf
            <div class="row">
                <div class="col-md-6">


                    <div class="mb-3">
                        <label for="title" class="form-label">Tên vai trò</label>
                        <input type="text" id="title" name="name" class="form-control" placeholder="Tên vai trò">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Vai trò này có quyền gì?</label>
                        <div class="row">
                            @foreach ($permissions as $permission)
                                <div class="col-md-4"><input class="form-check-input" type="checkbox" name="permissions[]"
                                        value="{{ $permission->id }}" id="{{ $permission->id }}">
                                    <label class="form-check-label" for="{{ $permission->id }}">
                                        @if ($permission->name == 'add category')
                                            Thêm danh mục
                                        @endif
                                        @if ($permission->name == 'edit category')
                                            Sửa danh mục
                                        @endif
                                        @if ($permission->name == 'delete category')
                                            Xóa danh mục
                                        @endif
                                        @if ($permission->name == 'add post')
                                            Thêm bài viết
                                        @endif
                                        @if ($permission->name == 'edit post')
                                            Sửa bài viết
                                        @endif
                                        @if ($permission->name == 'delete post')
                                            Xóa bài viết
                                        @endif
                                        @if ($permission->name == 'add video')
                                            Thêm video
                                        @endif
                                        @if ($permission->name == 'edit video')
                                            Sửa video
                                        @endif
                                        @if ($permission->name == 'delete video')
                                            Xóa video
                                        @endif

                                        @if ($permission->name == 'delete comment')
                                            Xóa bình luận
                                        @endif
                                    </label>
                                </div>
                            @endforeach
                            @error('permissions')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <input type="text" id="title" name="guard_name" class="form-control" value="web" hidden>
                    <div class="mb-3">
                        <label for="title" class="form-label">Mô tả</label>
                        <textarea name="desc_role" class="form-control" id="" cols="30" rows="10"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-12 text-right">
                            <div class="mt-3">
                                <input type="submit" class="btn btn-success" value="Thêm mới">
                            </div>
                        </div>
                    </div>



                </div>
                <div class="col-md-6"></div>
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
