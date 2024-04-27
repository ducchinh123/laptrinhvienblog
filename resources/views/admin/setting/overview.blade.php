@extends('admin.index')
@section('content')
    <div class="pl-3 pr-3">
        <div id="content__topic--1">
            <h5 class="">TỔNG QUAN</h5>
        </div>
        <form action="" class="mt-3">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                          Cho phép hiển thị banner
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                        <label class="form-check-label" for="flexCheckChecked">
                          Cho phép hiển thị "Mạng xã hội liên kết"
                        </label>
                      </div>

                      <div class="mb-3">
                        <label for="title" class="form-label">Logo</label>
                        <input type="text" id="title" class="form-control" placeholder="Nội dung Logo">
                    </div>
                </div>
                <div class="col-md-6"></div>
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
