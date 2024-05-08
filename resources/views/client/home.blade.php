@extends('index')
@section('content')
    <main id="main">


        @if ($settings->choose_banner == 1)
            <!-- ======= Hero Slider Section ======= -->
            <section id="hero-slider" class="hero-slider">
                <div class="container-md" data-aos="fade-in">
                    <div class="row">
                        <div class="col-12">
                            <div class="swiper sliderFeaturedPosts">
                                <div class="swiper-wrapper">
                                    @foreach ($posts_slide_show as $post_slide)
                                        <div class="swiper-slide">
                                            <a href="{{ route('c-post-detail', ['slug' => $post_slide->slug, 'id' => $post_slide->id]) }}"
                                                class="img-bg d-flex align-items-end"
                                                style="background-image: url({{ $post_slide->overview_photo }});">
                                                <div class="img-bg-inner">
                                                    <h2>{{ $post_slide->title }}</h2>
                                                    <p>{{ $post_slide->desc_short }}</p>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach


                                </div>
                                <div class="custom-swiper-button-next">
                                    <span class="bi-chevron-right"></span>
                                </div>
                                <div class="custom-swiper-button-prev">
                                    <span class="bi-chevron-left"></span>
                                </div>

                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section><!-- End Hero Slider Section -->
        @endif


        <!-- ======= Post Grid Section ======= -->
        <section id="posts" class="posts">
            <div class="container" data-aos="fade-up">
                <div class="row g-5">
                    <div class="col-lg-4">
                        <div class="post-entry-1 lg">
                            <a href="{{ route('c-post-detail', ['slug' => $post_big->slug, 'id' => $post_big->id]) }}"><img
                                    src="assets/img/post-landscape-1.jpg" alt="" class="img-fluid"></a>
                            <div class="post-meta"><span class="date">{{ $post_big->category_name }}</span> <span
                                    class="mx-1">&bullet;</span>
                                <span>{{ $post_big->date_submitted }}</span>
                            </div>
                            <h2><a
                                    href="{{ route('c-post-detail', ['slug' => $post_big->slug, 'id' => $post_big->id]) }}">{{ $post_big->title }}</a>
                            </h2>
                            <p class="mb-4 d-block">{{ $post_big->desc_short }}</p>

                            <div class="d-flex align-items-center author">
                                <div class="photo"><img src="{{ $post_big->avatar }}" alt="" class="img-fluid">
                                </div>
                                <div class="name">
                                    <h3 class="m-0 p-0">{{ $post_big->author_name }}</h3>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-8">
                        <div class="row g-5">
                            <div class="col-lg-8 border-start custom-border">
                                <div class="row">
                                    @foreach ($posts_list as $post_item)
                                        <div class="col-md-6">

                                            <div class="post-entry-1">
                                                <a href="{{ route('c-post-detail', ['slug' => $post_item->slug, 'id' => $post_item->id_post]) }}"><img src="{{ $post_item->overview_photo }}"
                                                        alt="" class="img-fluid"></a>
                                                <div class="post-meta"><span class="date">{{ $post_item->name }}</span>
                                                    <span class="mx-1">&bullet;</span>
                                                    <span>{{ $post_item->date_submitted }}</span>
                                                </div>
                                                <h2><a href="{{ route('c-post-detail', ['slug' => $post_item->slug, 'id' => $post_item->id_post]) }}">{{ $post_item->title }}</a></h2>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                {!! $posts_list->links() !!}
                            </div>


                            <!-- Trending Section -->
                            <div class="col-lg-4">

                                <div class="trending">
                                    <h3>Nổi bật trên trang</h3>
                                    <ul class="trending-post">
                                        @foreach ($posts_tranding as $post_trand)
                                            <li>
                                                <a href="{{ route('c-post-detail', ['slug' => $post_trand->slug, 'id' => $post_trand->id]) }}">
                                                    <span class="number">{{ $loop->iteration }}</span>
                                                    <h3>{{ $post_trand->title }}</h3>
                                                    <span class="author">{{ $post_trand->author }}</span>
                                                </a>
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>

                            </div> <!-- End Trending Section -->
                        </div>
                    </div>

                </div> <!-- End .row -->
            </div>
        </section> <!-- End Post Grid Section -->

        <!-- ======= Culture Category Section ======= -->
        <section class="category-section">
            <div class="container" data-aos="fade-up">

                <div class="section-header d-flex justify-content-between align-items-center mb-5">
                    <h2>Video trên sóng</h2>
                    <div><a href="{{ route('c-video') }}" class="more">Xem tất cả video</a></div>
                </div>

                <div class="row">
                    <div class="col-md-9">

                        @foreach ($videos_list as $video_item)
                            <div class="d-lg-flex post-entry-2">
                                <a href="https://youtu.be/{{ $video_item->link_youtube }}" target="_blank"
                                    class="me-4 thumbnail mb-4 mb-lg-0 d-inline-block">
                                    <img src="{{ $video_item->image_video }}" alt="" class="img-fluid">
                                </a>
                                <div>
                                    <div class="post-meta"><span class="date">{{ $video_item->category_name }}</span>
                                        <span class="mx-1">&bullet;</span> <span>{{ $video_item->created_at }}</span>
                                    </div>
                                    <h3><a href="https://youtu.be/{{ $video_item->link_youtube }}"
                                            target="_blank">{{ $video_item->title }}</a></h3>
                                    <p>{{ $video_item->desc_video }}</p>
                                    <div class="d-flex align-items-center author">
                                        <div class="photo"><img src="{{ $video_item->avatar }}" alt=""
                                                class="img-fluid">
                                        </div>
                                        <div class="name">
                                            <h3 class="m-0 p-0">{{ $video_item->author_name }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        {!! $videos_list->links() !!}
                    </div>

                    <div class="col-md-3">
                        @foreach ($videos_recently as $video_recently)
                            <div class="post-entry-1 border-bottom">
                                <div class="post-meta"><span class="date">{{ $video_recently->category_name }}</span>
                                    <span class="mx-1">&bullet;</span>
                                    <span>{{ $video_recently->created_at }}</span>
                                </div>
                                <h2 class="mb-2"><a href="https://youtu.be/{{ $video_recently->link_youtube }}"
                                        target="_blank">{{ $video_recently->title }}</a></h2>
                                <span class="author mb-3 d-block">{{ $video_recently->author_name }}</span>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </section><!-- End Culture Category Section -->

    </main><!-- End #main -->
@endsection
