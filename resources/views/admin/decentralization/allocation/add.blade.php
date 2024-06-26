@extends('admin.index')
@section('content')
    <div class="pl-3 pr-3">
        <div id="content__topic--1">
            <h5 class="">PHÂN QUYỀN SỬ DỤNG</h5>
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
        <form action="{{ route('allocation-add-start') }}" method="POST" class="mt-3">
            @csrf
            <div class="row">
                <div class="col-md-7">


                    <div class="mb-3">
                        <label for="title" class="form-label">Người sử dụng?</label>
                        <select class="js-example-disabled-results form-control" name="model_id">
                            <option value="">Chọn người dùng</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->email }}</option>
                            @endforeach
                        </select>
                        @error('model_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <input type="text" id="title" name="model_type" class="form-control" value="App\Models\User"
                        hidden>
                    <div class="mb-3">
                        <label for="title" class="form-label">Những vai trò được cấp?</label>
                        <div class="row">
                            @foreach ($roles as $role)
                                @if ($role->name != 'Admin')
                                    <div class="col-md-4"><input class="form-check-input" type="checkbox" name="role_id[]"
                                            value="{{ $role->id }}" id="{{ $role->id }}">
                                        <label class="form-check-label"
                                            for="{{ $role->id }}">{{ $role->name }}</label>
                                    </div>
                                @endif
                            @endforeach
                            @error('role_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 text-right">
                            <div class="mt-3">
                                <input type="submit" class="btn btn-success" value="Thêm mới">
                            </div>
                        </div>
                    </div>



                </div>
                <div class="col-md-5"></div>
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
