<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>{{ $title }}</title>
    <meta content="{{ $description }}" name="description">
    <meta content="" name="keywords">
    <base href="http://127.0.0.1:8000/">
    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500&family=Inter:wght@400;500&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">

    <!-- Template Main CSS Files -->
    <link href="{{ asset('assets/css/variables.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/plugins/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <!-- =======================================================
  * Template Name: ZenBlog
  * Template URL: https://bootstrapmade.com/zenblog-bootstrap-blog-template/
  * Updated: Mar 17 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https:///bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

            <a href="/" class="logo d-flex align-items-center">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assets/img/logo.png" alt=""> -->
                <h1>DevC Blog</h1>
            </a>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="/">Trang chủ</a></li>
                    <li><a href="{{ route('c-post-index') }}">Bài viết</a></li>
                    <li><a href="{{ route('c-video') }}">Video</a></li>
                    <li class="dropdown"><a href="" id="categorys"><span>Danh mục</span> <i
                                class="bi bi-chevron-down dropdown-indicator"></i></a>
                        <ul>
                            @foreach ($category_menu as $item)
                                <li><a
                                        href="{{ route('c-post-category', ['id' => $item->id]) }}">{{ $item->name }}</a>
                                </li>
                            @endforeach

                        </ul>
                    </li>

                    <li><a href="{{ route('c-about') }}">Về tôi</a></li>
                    <li><a href="{{ route('c-contact') }}">Liên lạc</a></li>
                </ul>
            </nav><!-- .navbar -->

            <div class="position-relative">
                <a href="https://www.facebook.com/chinhyoutubehihi" target="_blank" class="mx-2"><span
                        class="bi-facebook"></span></a>
                <a href="https://www.instagram.com/devc_dang" target="_blank" class="mx-2"><span
                        class="bi-instagram"></span></a>
                <a href="https://www.youtube.com/channel/UCTndRQVS4R72kFrL1BWbwoA" style="font-size: 18px;"
                    target="_blank" class="mx-2"><i class="bi bi-youtube"></i></span></a>
                @if (!Auth::check())
                    <a href="{{ route('c-login') }}" style="padding-left: 6px; padding-right: 6px;"
                        title="Tài khoản"><span><i class="bi bi-person-circle"></i></span></a>
                @endif

                @if (Auth::check())
                    <a href="{{ route('logout-user') }}"><i class="fa-solid fa-power-off"
                        style="padding-left: 6px; padding-right: 6px; color: black;"></i></a>
                @endif

                <a href="#" class="mx-2 js-search-open"><span class="bi-search"></span></a>
                <i class="bi bi-list mobile-nav-toggle"></i>

                <!-- ======= Search Form ======= -->
                <div class="search-form-wrap js-search-form-wrap">
                    <form action="search-result.html" class="search-form">
                        <span class="icon bi-search"></span>
                        <input type="text" placeholder="Tìm kiếm bài viết" class="form-control">
                        <button class="btn js-search-close"><span class="bi-x"></span></button>
                    </form>
                </div><!-- End Search Form -->



            </div>

        </div>

    </header><!-- End Header -->
