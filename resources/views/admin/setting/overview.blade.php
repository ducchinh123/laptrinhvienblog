@extends('admin.index')
@section('content')
    <div class="pl-3 pr-3">
        <div id="content__topic--1">
            <h5 class="">TỔNG QUAN</h5>
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
        <form action="{{ route('devC-change-system') }}" method="POST" class="mt-3">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="choose_banner" value="1"
                            @if ($setting->choose_banner == 1) @checked(true) @endif id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Cho phép hiển thị banner
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="choose_social"
                            @if ($setting->choose_social == 1) @checked(true) @endif value="1"
                            id="flexCheckChecked">
                        <label class="form-check-label" for="flexCheckChecked">
                            Cho phép hiển thị "Mạng xã hội liên kết"
                        </label>
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label">Logo</label>
                        <input type="text" id="title" name="text_logo" value="{{ $setting->text_logo }}"
                            class="form-control" placeholder="Nội dung Logo">
                    </div>
                </div>
                <div class="col-md-6"></div>
            </div>
            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6 text-right">
                    <input type="submit" class="btn btn-success" name="changeSystem" value="Cập nhật">
                </div>
            </div>
        </form>
    </div>
@endsection
