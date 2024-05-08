@extends('index')
@section('content')
    <main id="main">
        <section>
            <div class="container">
                <div class="row">

                    <div class="col-md-9" data-aos="fade-up">
                        @foreach ($posts_list as $post)
                            <div class="d-md-flex post-entry-2 half">
                                <a href="{{ route('c-post-detail', ['slug' => $post->slug, 'id' => $post->id]) }}"
                                    class="me-4 thumbnail">
                                    <img src="{{ $post->overview_photo }}" alt="" class="img-fluid">
                                </a>
                                <div>
                                    <div class="post-meta"><span class="date">{{ $post->name }}</span> <span
                                            class="mx-1">&bullet;</span> <span>{{ $post->date_submitted }}</span></div>
                                    <h3><a
                                            href="{{ route('c-post-detail', ['slug' => $post->slug, 'id' => $post->id]) }}">{{ $post->title }}</a>
                                    </h3>
                                    <p>{{ $post->desc_short }}</p>
                                    <div class="d-flex align-items-center author">
                                        <div class="photo"><img src="{{ $post->avatar }}" alt="" class="img-fluid">
                                        </div>
                                        <div class="name">
                                            <h3 class="m-0 p-0">{{ $post->author_name }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="text-start py-4">
                            {!! $posts_list->links() !!}
                        </div>
                    </div>

                    <div class="col-md-3">
                        <!-- ======= Sidebar ======= -->
                        <div class="aside-block">

                            <ul class="nav nav-pills custom-tab-nav mb-4" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-trending-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-trending" type="button" role="tab"
                                        aria-controls="pills-trending" aria-selected="true">Nổi bật</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-latest-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-latest" type="button" role="tab"
                                        aria-controls="pills-latest" aria-selected="false">Bài viết cũ</button>
                                </li>
                            </ul>

                            <div class="tab-content" id="pills-tabContent">

                                <!-- Trending -->
                                <div class="tab-pane fade show active" id="pills-trending" role="tabpanel"
                                    aria-labelledby="pills-trending-tab">
                                    @foreach ($posts_tranding as $item)
                                        <div class="post-entry-1 border-bottom">
                                            <div class="post-meta"><span class="date">{{ $item->name }}</span> <span
                                                    class="mx-1">&bullet;</span> <span>{{ $item->created_at }}</span>
                                            </div>
                                            <h2 class="mb-2"><a
                                                    href="{{ route('c-post-detail', ['slug' => $item->slug, 'id' => $item->id]) }}">{{ $item->title }}</a>
                                            </h2>
                                            <span class="author mb-3 d-block">{{ $item->author_name }}</span>
                                        </div>
                                    @endforeach

                                </div> <!-- End Trending -->

                                <!-- Latest -->
                                <div class="tab-pane fade" id="pills-latest" role="tabpanel"
                                    aria-labelledby="pills-latest-tab">

                                    @foreach ($posts_old as $item)
                                        <div class="post-entry-1 border-bottom">
                                            <div class="post-meta"><span class="date">{{ $item->name }}</span> <span
                                                    class="mx-1">&bullet;</span> <span>{{ $item->created_at }}</span>
                                            </div>
                                            <h2 class="mb-2"><a
                                                    href="{{ route('c-post-detail', ['slug' => $item->slug, 'id' => $item->id]) }}">{{ $item->title }}</a>
                                            </h2>
                                            <span class="author mb-3 d-block">{{ $item->author_name }}</span>
                                        </div>
                                    @endforeach


                                </div> <!-- End Latest -->

                            </div>
                        </div>

                        <div class="aside-block">
                            <h3 class="aside-title">Danh mục</h3>
                            <ul class="aside-links list-unstyled">
                                @foreach ($category_menu as $item)
                                    <li><a href=""><i class="bi bi-chevron-right"></i> {{ $item->name }}</a></li>
                                @endforeach

                            </ul>
                        </div><!-- End Categories -->
                    </div>

                </div>
            </div>
        </section>
    </main><!-- End #main -->
@endsection
