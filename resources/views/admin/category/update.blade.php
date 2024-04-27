@extends('admin.index')
@section('content')
    <div class="pl-3 pr-3">
        <div id="content__topic--1">
            <h5 class="">CẬP NHẬT DANH MỤC</h5>
        </div>
        <form action="" class="mt-3">
            <div class="row">
                <div class="col-md-6">


                    <div class="mb-3">
                        <label for="title" class="form-label">Tên danh mục</label>
                        <input type="text" id="title" class="form-control" placeholder="Tên danh mục">
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Ngày tạo</label>
                        <input type="date" class="form-control" name="" id="">
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Mô tả</label>
                        <textarea name="" class="form-control" id="" cols="30" rows="10"></textarea>
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
