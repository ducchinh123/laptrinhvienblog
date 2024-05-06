@extends('admin.index')
@section('content')
    <div class="pl-3 pr-3">
        <div id="content__topic--1">
            <h5 class="">QUẢN LÝ VIDEO</h5>
        </div>
        <div class="table-responsive mt-3">
            <table class="table table-striped">

                <thead>
                    <caption>
                        <td>
                            @if (Auth::user()->is_admin == 1 || auth()->user()->can('add video'))
                                <a href="{{ route('devC-video-add') }}" style="text-decoration: none" class="atable">Thêm
                                    mới</a> |
                            @endif
                            
                            @if (Auth::user()->is_admin == 1 || auth()->user()->can('delete video'))
                                <a href="{{ route('devc-video-trash') }}" style="text-decoration: none">Thùng rác
                                    ({{ $countDeleted }})
                                </a>
                            @endif
                        </td>
                    </caption>
                    <tr>
                        <td>ID</td>
                        <td>Tiêu đề</td>
                        <td>Video</td>
                        <td>Danh mục</td>
                        <td>Chức năng</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($videos as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td class="this-title">{{ $item->title }}</td>
                            <td class="">
                                <iframe class="w-100 h-100 show_video"
                                    src="https://www.youtube-nocookie.com/embed/{{ $item->link_youtube }}"
                                    title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen></iframe>
                            </td>
                            <td>{{ $item->name }}</td>
                            <td>
                                @if (Auth::user()->is_admin == 1 || auth()->user()->can('edit video'))
                                    <a href="{{ route('devC-video-update', ['id' => $item->id]) }}"
                                        class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                                @endif
                                @if (Auth::user()->is_admin == 1 || auth()->user()->can('delete video'))
                                    <button onclick="handleDelete({{ $item->id }})" class="btn btn-danger"><i
                                            class="bi bi-trash"></i></button>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                </tbody>

            </table>
        </div>
        {!! $videos->links() !!}
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
                                `${server}devC/wp-admin/video-delete/${id}`);

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
