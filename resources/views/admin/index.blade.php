<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <meta name="description"
        content="Sinh Viên It là một blog của một cậu sinh viên theo ngành it (mảng lập trình website), qua blog này
    cậu sinh viên muốn viết ra đây những lời tâm sự, sự trải nghiệm, niềm vui nỗi buồn mà cá nhân cậu ấy cảm nhận được. Không mong blog
    được nhiều đọc giả vào đọc chỉ mong rằng những bài viết được đọc giả quan tâm và đóng góp ý kiến, sự chia sẻ ngược lại một cách tích cực nhất. Đó là một hạnh phúc lớn lao của ấy ấy.">
    <meta name="keywords" content="Blog giải trí, blog tâm sự, blog chia sẻ kiến thức, công nghệ thông tin">
    <meta name="author" content="Đặng Đức Chính - Sinh viên ngành web">
    <meta name="language" content="vietnamese">
    <link rel="icon" type="image/png" href="./src/assets/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
    <title>SinhvienitBlog.online</title>
</head>

<body>
    <div id="wrapper">
        <div id="header" ref="header">
            <div class="header__item--2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 very-top-2">
                            <div class="header__item--2__left"><a href="{{ route('devC-admin') }}">Vua Công Nghệ</a>
                            </div>
                            <div class="header__item--2__center">
                                <ul>
                                    <li style="display: none">
                                        <audio id="myAudio" ref="myAudio" controls type="audio/mp3"
                                            src="../../assets/hoacolau.mp3"></audio>
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
                            <audio id="myAudio" ref="myAudio" controls type="audio/mp3"
                                src="../../assets/hoacolau.mp3"></audio>
                        </li>
                        <li><a href="">Dashboard</a></li>
                        <li><a href="{{ route('devC-post-index') }}">Quản lý bài viết</a></li>
                        <li><a href="{{ route('devC-cate-index') }}">Quản lý danh mục</a></li>
                        <li><a href="{{ route('devC-video-index') }}">Quản lý video</a></li>
                        <li id="sm-level-2">
                            Cài đặt <i class="bi bi-caret-down-fill"></i>
                            <ul>
                                <li><a href="{{ route('devC-overview') }}">Tổng quan</a></li>
                                <li><a href="{{ route('devC-user') }}">Tài khoản</a></li>
                            </ul>
                        </li>
                        <li class="inputSearchMini">
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
                        <li><i class="bi bi-speedometer"></i> <a href="">Dashboard</a></li>
                        <li><i class="bi bi-book-half"></i> <a href="{{ route('devC-post-index') }}">Quản lý bài
                                viết</a></li>
                        <li>
                            <i class="bi bi-card-checklist"></i> <a href="{{ route('devC-cate-index') }}">Quản lý danh
                                mục</a>
                        </li>
                        <li><i class="bi bi-camera-video"></i> <a href="{{ route('devC-video-index') }}">Quản lý
                                video</a></li>

                        <li class="setting-menu">
                            <i class="bi bi-gear-wide-connected"></i> <button>Cài đặt website</button>
                            <span><i class="bi bi-caret-down-fill"></i></span>
                            <!-- <i class="bi bi-caret-up-fill"></i> -->
                            <ul class="setting-submenu unactive">
                                <li><i class="bi bi-palette"></i> <a href="{{ route('devC-overview') }}">Tổng quan</a></li>
                                <li><i class="bi bi-person-check"></i> <a href="{{ route('devC-user') }}">Tài khoản</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>

            <div id="content">
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
    integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@stack('select2')
<script src="{{ asset('assets/js/admin.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</html>
