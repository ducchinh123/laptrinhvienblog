@extends('admin.index')
@section('content')
    <div class="pl-3 pr-3">
        <div id="content__topic--1">
            <h5 class="">THÊM MỚI DANH MỤC</h5>
        </div>
        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('devC-cate-add-start') }}" method="POST" class="mt-3">
            @csrf
            <div class="row">
                <div class="col-md-6">


                    <div class="mb-3">
                        <label for="title" class="form-label">Tên danh mục</label>
                        <input type="text" id="title" name="name" class="form-control" placeholder="Tên danh mục">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Mô tả</label>
                        <textarea name="desc" class="form-control" id="" cols="30" rows="10"></textarea>
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
