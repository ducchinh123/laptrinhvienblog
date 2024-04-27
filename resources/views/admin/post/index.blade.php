@extends('admin.index')
@section('content')
    <div class="pl-3 pr-3">
        <div id="content__topic--1">
            <h5 class="">QUẢN LÝ BÀI VIẾT</h5>
        </div>
        <div class="table-responsive mt-3">
            <table class="table table-striped">
                
                <thead>
                    <caption><td><a href="{{ route('devC-post-add') }}" class="btn btn-success">Thêm mới</a></td></caption>
                    <tr>
                        <td>ID</td>
                        <td>Tên bài viết</td>
                        <td>Mô tả ngắn</td>
                        <td>Ngày xuất bản</td>
                        <td>Chức năng</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td class="this-title">Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum porro enim quia nostrum, numquam, esse, asperiores exercitationem sint aliquid quaerat corporis! Vero officiis reprehenderit quae in reiciendis accusamus! Voluptatem, sit.</td>
                        <td class="this-desc">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Vel, fugiat possimus animi quaerat ullam vitae maiores nulla officia ut accusamus? Rem, soluta animi blanditiis dignissimos, assumenda autem temporibus modi error maiores ipsum expedita sint accusantium similique sit, atque sapiente perferendis enim tempore possimus harum? Quibusdam neque, tempora aspernatur quidem, necessitatibus quod voluptatum magni expedita esse eaque nobis, laudantium nemo architecto sapiente iure. Molestias!</td>
                        <td>26/04/2024</td>
                        <td><a href="{{ route('devC-post-update') }}" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a> <button class="btn btn-danger"><i class="bi bi-trash"></i></button></td>
                    </tr>
                </tbody>
                
            </table>
        </div>
    </div>
@endsection

@section('cut-string')
<script type="text/javascript">
    var listTitle = document.querySelectorAll(".this-title");
    var listDesc = document.querySelectorAll(".this-desc");
    listTitle.forEach(element => {
        if(element.innerHTML.trim().length > 38) {
            var newTtitle = element.innerHTML.trim().slice(0, 38) + "...";
            element.innerHTML = newTtitle;
        }
    });

    listDesc.forEach(element => {
        if(element.innerHTML.trim().length > 60) {
            var newDesc = element.innerHTML.trim().slice(0, 60) + "...";
            element.innerHTML = newDesc;
        }
    })
</script>    
@endsection
