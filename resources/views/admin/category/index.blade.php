@extends('admin.index')
@section('content')
    <div class="pl-3 pr-3">
        <div id="content__topic--1">
            <h5 class="">QUẢN LÝ DANH MỤC</h5>
        </div>
        <div class="table-responsive mt-3">
            <table class="table table-striped">
                <thead>
                    <caption>
                        <td>
                            @if (Auth::user()->is_admin == 1 || auth()->user()->can('add category'))
                                <a href="{{ route('devC-cate-add') }}" style="text-decoration: none" class="atable">Thêm
                                    mới</a> |

                            @endif
                            
                            @if (Auth::user()->is_admin == 1 || auth()->user()->can('delete category'))
                                <a href="{{ route('devC-cate-trash') }}" style="text-decoration: none">Thùng rác
                                    ({{ $dataDeleted }})</a>
                            @endif
                        </td>
                    </caption>
                    <tr>
                        <td>ID</td>
                        <td>Tên danh mục</td>
                        <td>Mô tả danh mục</td>
                        <td>Ngày tạo</td>
                        <td>Chức năng</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td class="this-title">{{ $item->name }}</td>
                            <td class="this-desc">{{ $item->desc }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                @if (Auth::user()->is_admin == 1 || auth()->user()->can('edit category'))
                                    <a href="{{ route('devC-cate-update', ['id' => $item->id]) }}"
                                        class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                                @endif
                                @if (Auth::user()->is_admin == 1 || auth()->user()->can('delete category'))
                                    <button onclick="handleDelete({{ $item->id }})" class="btn btn-danger"><i
                                            class="bi bi-trash"></i></button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

        {!! $datas->links() !!}

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
                                `${server}devC/wp-admin/category-delete/${id}`);

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
