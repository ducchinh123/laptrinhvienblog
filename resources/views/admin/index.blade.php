<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Sinh Viên It là một blog của một cậu sinh viên theo ngành it (mảng lập trình website), qua blog này
    cậu sinh viên muốn viết ra đây những lời tâm sự, sự trải nghiệm, niềm vui nỗi buồn mà cá nhân cậu ấy cảm nhận được. Không mong blog
    được nhiều đọc giả vào đọc chỉ mong rằng những bài viết được đọc giả quan tâm và đóng góp ý kiến, sự chia sẻ ngược lại một cách tích cực nhất. Đó là một hạnh phúc lớn lao của cậu ấy.">
    <meta name="keywords" content="Blog giải trí, blog tâm sự, blog chia sẻ kiến thức, công nghệ thông tin">
    <meta name="author" content="Đặng Đức Chính - Sinh viên ngành web">
    <meta name="language" content="vietnamese">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/DevC.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
    <style>
        /* Màn hình điện thoại */

        @media only screen and (min-width: 320px) and (max-width: 998px) {
            #header .header__item--1 .very-top .header__item--1__left {
                display: none;
            }

            #sidebar-left .list-menu-manager-admin ul {
                display: none;
            }

            #header .header__item--2__center,
            .header__item--2__right {
                display: none;
            }

            #header .header__item--2 .very-top-2 {
                display: flex;
                text-align: center;
                align-items: center;
            }

            #header .header__item--2 .very-top-2 #bar-menu {
                display: block;
                float: right;
            }

            #header .header__item--2 .very-top-2 #bar-menu:hover {
                cursor: pointer;
            }

            #header .header__item--3 {
                display: block;
            }

            #wp-content #sidebar-left {
                background: none;
            }

            #wp-content #sidebar-left #by-categories {
                display: none;
            }
        }

        @media only screen and (min-width: 998px) and (max-width: 1300px) {
            #header .header__item--2 .header__item--2__center #menu-customize {
                display: block;
            }

            #wp-content #sidebar-left {
                background: none;
            }

            #wp-content #sidebar-left #by-categories {
                display: none;
            }

            #header .header__item--2 .very-top-2 .header__item--2__center ul {
                display: flex;
            }
        }

        @media only screen and (max-width: 567px) {
            .list_video_in_blog {
                overflow: auto;
            }
        }

        @media only screen and (max-width: 576px) {
            #sidebar-right {
                display: none;
            }
        }

        @media only screen and (min-width: 576px) {
            #sidebar-right {
                display: block;
            }
        }

        @media only screen and (max-width: 997px) {
            #wrapper {
                overflow: hidden;
            }
        }

        @media only screen and (max-width: 1350px) {
            #my-content .list-post-with-feature ul {
                display: flex;
                flex-direction: column;
            }

            #my-content .list-post-with-feature ul li {
                max-width: 100%;
                padding-left: 0;
            }
        }

        @media only screen and (min-width: 576px) and (max-width: 726px) {
            #my-content .list-post-with-feature .post-with-feature-item .post-with-feature-item__title__time .post-with-feature-item__title__time--time {
                display: none;
            }
        }
    </style>
    <script src="{{ asset('assets/plugins/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap5/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-icons/font/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css">
    <title>SinhvienitBlog.online</title>
</head>

<body>
    <div id="wrapper">
        <div id="header" ref="header">
            <div class="header__item--2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 very-top-2">
                            <div class="header__item--2__left"><a href="{{ route('devC-admin') }}">DevC Blog |
                                    @if (Auth::user())
                                        {{ Auth::user()->name }}
                                    @endif
                                </a>
                            </div>
                            <div class="header__item--2__center">
                                <ul>
                                    <li style="display: none">
                                        <audio id="myAudio" ref="myAudio" controls type="audio/mp3"
                                            src=""></audio>
                                    </li>

                                    <li id="menu-customize">
                                        <a href="">Danh mục</a>
                                        <div>
                                            <ul class="menu-level-item" style="z-index: 1000">
                                                <li>
                                                    <i class="bi bi-arrow-return-right"></i><a href="">Chia sẻ cá
                                                        nhân</a>
                                                </li>
                                                <li>
                                                    <i class="bi bi-arrow-return-right"></i>
                                                    <a href="">Tâm sự cuộc sống</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="header__item--2__right">
                                <form action="">
                                    <input type="text" name="" placeholder="Tìm kiếm bài viết..."
                                        id="" />
                                    <button type="submit" class="ml-1">Tìm kiếm</button>

                                    @if (Auth::user())
                                        <a href="{{ route('logout') }}" class="btn"><i class="fa-solid fa-power-off"
                                                style="font-size: 20px; color: white;"></i></a>
                                    @endif
                                </form>

                            </div>

                            <div id="bar-menu"><i class="fa-solid fa-bars"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="header__item--3">
                <div id="list-menu">
                    <div class="btn-close"><i class="fa-solid fa-xmark"></i></div>
                    <ul>
                        <li class="boot">Danh sách menu</li>
                        <li style="display: none">
                            <audio id="myAudio" ref="myAudio" controls type="audio/mp3" src=""></audio>
                        </li>
                        <li><a href="">Dashboard</a></li>
                        <li><a href="{{ route('devC-post-index') }}">Quản lý bài viết</a></li>
                        <li><a href="{{ route('devC-cate-index') }}">Quản lý danh mục</a></li>
                        <li><a href="{{ route('devC-video-index') }}">Quản lý video</a></li>
                        <li><a href="{{ route('devc-comment-index') }}">Quản lý bình luận</a></li>
                        <li id="sm-level-2" style="padding-bottom: 30px;">
                            Cài đặt <i class="bi bi-caret-down-fill"></i>
                            <ul>
                                @if (Auth::user()->is_admin == 1)
                                    <li><a href="{{ route('devC-overview') }}">Tổng quan</a></li>
                                @endif
                                <li><a href="{{ route('devC-user') }}">Tài khoản</a></li>

                                @if (Auth::user())
                                    <li><a href="{{ route('logout') }}">Đăng xuất</a></li>
                                @endif
                            </ul>
                        </li>
                        <li class="inputSearchMini" class="mt-3">
                            <form action="">
                                <input type="text" name="" placeholder="Nhập từ khóa" id="" />
                                <button>Tìm kiếm</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="middle-line"></div>

        <div id="wp-content">
            <div id="sidebar-left">
                <div class="list-menu-manager-admin">
                    <ul>
                        <li><i class="bi bi-speedometer"></i> <a href="{{ route('devC-admin') }}">Dashboard</a></li>
                        <li><i class="bi bi-book-half"></i> <a href="{{ route('devC-post-index') }}">Quản lý bài
                                viết</a></li>
                        <li>
                            <i class="bi bi-card-checklist"></i> <a href="{{ route('devC-cate-index') }}">Quản lý
                                danh
                                mục</a>
                        </li>
                        <li><i class="bi bi-camera-video"></i> <a href="{{ route('devC-video-index') }}">Quản lý
                                video</a></li>

                        <li><i class="fa-regular fa-comment"></i></i> <a
                                href="{{ route('devc-comment-index') }}">Quản lý
                                bình luận</a></li>

                        <li class="setting-menu">
                            <i class="bi bi-gear-wide-connected"></i> <button>Cài đặt website</button>
                            <span><i class="bi bi-caret-down-fill"></i></span>
                            <!-- <i class="bi bi-caret-up-fill"></i> -->
                            <ul class="setting-submenu unactive">
                                @if (Auth::user()->is_admin == 1)
                                    <li><i class="bi bi-palette"></i> <a href="{{ route('devC-overview') }}">Tổng
                                            quan</a></li>
                                @endif
                                <li><i class="bi bi-person-check"></i> <a href="{{ route('devC-user') }}">Tài
                                        khoản</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>

            <div id="content">

                @if (request()->route()->getName() == 'devC-admin')
                    <div class="container">
                        <div id="content__topic--1">
                            <h5 class="">Tổng quan</h5>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <div class="card" style="width: 18rem; background-color: #F8444F;">
                                    <div class="card-body">
                                        <h5 class="card-title text-white">Tổng số bài viết</h5>
                                        <p class="card-text">
                                        <h1 class="text-center">{{ $post_total }}</h1>
                                        </p>
                                        <a href="{{ route('devC-post-index') }}" class="btn btn-light">Đi đến</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card" style="width: 18rem; background-color: #C0EA6A;">
                                    <div class="card-body">
                                        <h5 class="card-title text-white">Tổng số video</h5>
                                        <p class="card-text">
                                        <h1 class="text-center">{{ $video_total }}</h1>
                                        </p>
                                        <a href="{{ route('devC-video-index') }}" class="btn btn-light">Đi đến</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card" style="width: 18rem; background-color: #FFCC59;">
                                    <div class="card-body">
                                        <h5 class="card-title text-white">Tổng số danh mục</h5>
                                        <p class="card-text">
                                        <h1 class="text-center">{{ $category_total }}</h1>
                                        </p>
                                        <a href="{{ route('devC-cate-index') }}" class="btn btn-light">Đi đến</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 d-md-none">
                                <div class="card" style="width: 18rem; background-color: #F8476B;">
                                    <div class="card-body">
                                        <h5 class="card-title text-white">Tổng số người dùng</h5>
                                        <p class="card-text">
                                        <h1 class="text-center">{{ $user_total }}</h1>
                                        </p>
                                        <a href="{{ route('devC-user') }}" class="btn btn-light">Đi đến</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-5 col-12 d-none d-md-block">
                                <div class="card" style="width: 18rem; background-color: #F8476B; float: right; ">
                                    <div class="card-body">
                                        <h5 class="card-title text-white">Tổng số người dùng</h5>
                                        <p class="card-text">
                                        <h1 class="text-center">{{ $user_total }}</h1>
                                        </p>
                                        <a href="{{ route('devC-user') }}" class="btn btn-light">Đi đến</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1 d-none d-md-block"></div>
                            <div class="col-md-6 col-12">
                                <div class="card" style="width: 18rem; background-color: #E9E6DD; float: left;">
                                    <div class="card-body">
                                        <h5 class="card-title text-white">Tổng số bình luận</h5>
                                        <p class="card-text">
                                        <h1 class="text-center">{{ $comment_total }}</h1>
                                        </p>
                                        <a href="{{ route('devc-comment-index') }}" class="btn btn-light">Đi đến</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div id="content__topic--1">
                            <h5 class="">Cụ thể báo cáo</h5>
                        </div>

                        <div class="table-responsive mt-3">
                            <table class="table table-striped">

                                <thead>
                                    <caption>
                                        <td>Top bài viết có lượt xem cao nhất
                                            <!--- pvt - post view tallest !-->
                                            <select name="" id="pvt">
                                                <option value="tw-pvt">Tuần này</option>
                                                <option value="tm-pvt">Tháng này</option>
                                                <option value="ty-pvt">Năm này</option>
                                            </select>
                                        </td>
                                    </caption>

                                    <tr>
                                        <td>ID</td>
                                        <td>Tên bài viết</td>
                                        <td>Ngày xuất bản</td>
                                        <td>Lượt xem</td>
                                        <td>Ghé xem</td>
                                    </tr>
                                </thead>
                                <tbody id="vtop_post">
                                    @foreach ($vtop_post as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $item->date_submitted }}</td>
                                            <td>{{ $item->view_post }}</td>
                                            <td><a
                                                    href="{{ env('APP_SERVER') }}chi-tiet/{{ $item->slug . '_' . $item->id . '.html' }}">Đi
                                                    đến</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>

                        <div class="table-responsive mt-3">
                            <table class="table table-striped">

                                <thead>
                                    <caption>
                                        <td>Top bài viết có lượt quan tâm nhiều nhất
                                            <select name="" id="ctop_post">
                                                <option value="tw-ctp">Tuần này</option>
                                                <option value="tm-ctp">Tháng này</option>
                                                <option value="ty-ctp">Năm này</option>
                                            </select>
                                        </td>
                                    </caption>
                                    <tr>
                                        <td>ID</td>
                                        <td>Tên bài viết</td>
                                        <td>Ngày xuất bản</td>
                                        <td>Lượt quan tâm</td>
                                        <td>Ghé xem</td>
                                    </tr>
                                </thead>
                                <tbody id="comenttop_post">
                                    @foreach ($ctop_post as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $item->date_submitted }}</td>
                                            <td>{{ $item->comment_count }}</td>
                                            <td><a
                                                    href="{{ env('APP_SERVER') }}chi-tiet/{{ $item->slug . '_' . $item->id . '.html' }}">Đi
                                                    đến</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>

                        <div class="table-responsive mt-3">
                            <table class="table table-striped">

                                <thead>
                                    <caption>
                                        <td>Chủ đề đang được độc giả quan tâm

                                            <select name="" id="catetop_post">
                                                <option value="tw-catp">Tuần này</option>
                                                <option value="tm-catp">Tháng này</option>
                                                <option value="ty-catp">Năm này</option>
                                            </select>
                                        </td>
                                    </caption>
                                    <tr>
                                        <td>ID</td>
                                        <td>Tên chủ đề</td>
                                        <td>Tổng số bình luận và lượt xem</td>
                                        <td>Ngày xuất bản</td>
                                    </tr>
                                </thead>
                                <tbody id="catop_post">
                                    @foreach ($catetop_post as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->comment_count }} bình luận & {{ $item->total_views }} lượt
                                                xem</td>
                                            <td>{{ $item->created_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                    <div style="display: none;" id="aebncv"><?php echo env('APP_SERVER'); ?></div>
                    <script>
                        var pvt = document.getElementById('pvt');
                        const server = document.querySelector('#aebncv').innerHTML.trim();
                        pvt.addEventListener("change", (e) => {
                            var selectedValue = pvt.value;
                            var htmls = '';
                            if (selectedValue != "") {

                                axios.get(`${server}devC/wp-admin/post-view-tallest/${selectedValue}`)
                                    .then(function(response) {
                                        var responseData = response.data;
                                        console.log(responseData);
                                        // // Lưu ý: đổi tên biến để tránh ghi đè biến response ban đầu
                                        var bodyTable = document.getElementById('vtop_post');
                                        responseData.data.forEach(element => {
                                            // mỗi element là 1 post   
                                            htmls +=
                                                `<tr>
                                            <td>${element.id}</td>
                                            <td>${element.title}</td>
                                            <td>${element.date_submitted}</td>
                                            <td>${element.view_post}</td>
                                            <td>
                                                <a href="${server}chi-tiet/${element.slug}_${element.id}.html">Đi
                                                    đến</a>
                                                    </td>
                                        </tr>
                                            `
                                        });


                                        bodyTable.innerHTML = htmls;
                                    })
                                    .catch(function(error) {
                                        console.error('Error fetching data:', error);
                                    });

                            }
                        })

                        var ctop_post = document.getElementById('ctop_post');

                        ctop_post.addEventListener("change", (e) => {
                            var selectedValue = ctop_post.value;
                            var htmls = '';
                            if (selectedValue != "") {

                                axios.get(`${server}devC/wp-admin/post-comment-top/${selectedValue}`)
                                    .then(function(response) {
                                        var responseData = response.data;
                                        // console.log(responseData);
                                        // // Lưu ý: đổi tên biến để tránh ghi đè biến response ban đầu
                                        var bodyTable = document.getElementById('comenttop_post');
                                        responseData.data.forEach(element => {
                                            // mỗi element là 1 post   
                                            htmls +=
                                                `<tr>
                                            <td>${element.id}</td>
                                            <td>${element.title}</td>
                                            <td>${element.date_submitted}</td>
                                            <td>${element.comment_count}</td>
                                            <td>
                                                <a href="${server}chi-tiet/${element.slug}_${element.id}.html">Đi
                                                    đến</a>
                                                    </td>
                                        </tr>
                                            `
                                        });


                                        bodyTable.innerHTML = htmls;
                                    })
                                    .catch(function(error) {
                                        console.error('Error fetching data:', error);
                                    });

                            }
                        })

                        var catetop_post = document.getElementById('catetop_post');

                        catetop_post.addEventListener("change", (e) => {
                            var selectedValue = catetop_post.value;
                            var htmls = '';
                            if (selectedValue != "") {

                                axios.get(`${server}devC/wp-admin/post-category-top/${selectedValue}`)
                                    .then(function(response) {
                                        var responseData = response.data;
                                        console.log(responseData);
                                        // // Lưu ý: đổi tên biến để tránh ghi đè biến response ban đầu
                                        var bodyTable = document.getElementById('catop_post');
                                        responseData.data.forEach(element => {
                                            // mỗi element là 1 post   
                                            htmls +=
                                                `<tr>
                                            <td>${element.id}</td>
                                            <td>${element.name}</td>
                                            <td>${element.comment_count} bình luận & ${element.total_views }</td>
                                            <td>${element.created_at}</td>
                                        </tr>
                                            `
                                        });


                                        bodyTable.innerHTML = htmls;
                                    })
                                    .catch(function(error) {
                                        console.error('Error fetching data:', error);
                                    });

                            }
                        })
                    </script>

            </div>
            @endif
            @yield('content')
            @yield('cut-string')
            @yield('select2')
            @stack('js-video')
            @stack('js-admin')
        </div>
    </div>
    <div class="middle-line"></div>
    <div id="footer">
        <p class="text-center">Hãy là một người quản lý website thông minh nhất</p>
    </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
@stack('select2')
<script src="{{ asset('assets/js/admin.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="{{ asset('assets/bootstrap5/js/bootstrap.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.8/axios.min.js"></script>

</html>
