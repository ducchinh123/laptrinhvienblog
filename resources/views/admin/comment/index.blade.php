@extends('admin.index')
@section('content')
    <div class="pl-3 pr-3">
        <div id="content__topic--1">
            <h5 class="">QUẢN LÝ BÌNH LUẬN</h5>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <form action="{{ route('devc-comment-search') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" placeholder="Tìm kiếm theo nội dung" class="form-control" name="body">

                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="table-responsive mt-3">
            <table class="table table-striped">
                <thead>

                    <tr>
                        <td>ID</td>
                        <td>Tác giả</td>
                        <td>Email</td>
                        <td>Nội dung</td>
                        <td>Bài viết</td>
                        <td>Ngày viết</td>
                        <td>Chức năng</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($comments_list as $comment)
                        <tr>
                            <td>{{ $comment->id }}</td>
                            <td>{{ $comment->username }}</td>
                            <td>{{ $comment->email }}</td>
                            <td>{{ $comment->body }}</td>
                            <td>{{ $comment->title }}</td>
                            <td>{{ $comment->created_at }}</td>
                            <td>
                                <button onclick="handleDelete({{ $comment->id }})" class="btn btn-danger"><i
                                        class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach

                </tbody>

            </table>

        </div>

        {!! $comments_list->links() !!}

    </div>
    <div style="display: none;" id="aebncv"><?php echo env('APP_SERVER'); ?></div>
@endsection

@section('cut-string')
    <script type="text/javascript">
        var listTitle = document.querySelectorAll(".this-title");
        var listDesc = document.querySelectorAll(".this-desc");
        listTitle.forEach(element => {
            if (element.innerHTML.trim().length > 38) {
                var newTtitle = element.innerHTML.trim().slice(0, 38) + "...";
                element.innerHTML = newTtitle;
            }
        });

        listDesc.forEach(element => {
            if (element.innerHTML.trim().length > 60) {
                var newDesc = element.innerHTML.trim().slice(0, 60) + "...";
                element.innerHTML = newDesc;
            }
        })
    </script>
@endsection

@push('js-admin')
    <script>
        const handleDelete = async (id) => {
            if (id) {
                try {
                    Swal.fire({
                        title: "Bạn có chắc muốn xóa?",
                        text: "",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Vâng, tôi xóa!",
                        cancelButtonText: "Thoát",
                    }).then(async (result) => { // Thêm async ở đây
                        if (result.isConfirmed) {
                            const server = document.querySelector('#aebncv').innerHTML.trim();
                            const response = await axios.delete(
                                `${server}devC/wp-admin/comment-delete/${id}`);

                            if (response.status == 200) {
                                Swal.fire({
                                    position: "top-center",
                                    icon: "success",
                                    title: "Xóa bản ghi thành công!",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                location.reload();
                            }
                        }
                    });
                } catch (error) {
                    // Xử lý lỗi nếu cần
                }
            }
        }
    </script>
@endpush
