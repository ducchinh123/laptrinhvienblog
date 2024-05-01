@extends('admin.index')
@section('content')
    <div class="pl-3 pr-3">
        <div id="content__topic--1">
            <h5 class="">CẬP NHẬT DANH MỤC</h5>
        </div>
        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger  mt-3">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('devC-cate-update-start', ['id' => $category->id]) }}" method="POST" class="mt-3">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="title" class="form-label">Tên danh mục</label>
                        <input type="text" id="title" name="name" class="form-control"
                            value="{{ $category->name }}" placeholder="Tên danh mục">

                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Mô tả</label>
                        <textarea class="form-control" name="desc" id="" cols="30" rows="10">{{ $category->desc }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-12 text-right">
                            <div class="mt-3">
                                <input type="submit" class="btn btn-success" value="Cập nhật">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-6"></div>
            </div>
        </form>
    </div>
@endsection
