@extends('index')
@section('content')
    <main id="main">

        <section class="single-post-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 post-content" data-aos="fade-up">

                        <!-- ======= Single Post Content ======= -->
                        <div class="single-post">
                            <div class="post-meta"><span class="date">{{ $post_detail->name }}</span> <span
                                    class="mx-1">&bullet;</span>
                                <span>{{ $post_detail->created_at }}</span>
                            </div>
                            <h1 class="mb-5" style="font-size: 2.5rem;">{{ $post_detail->title }}</h1>
                            <input type="hidden" name="" value="{{ $post_detail->id }}" id="adevc_post">
                            <p>{!! $post_detail->desc_detail !!}</p>
                        </div><!-- End Single Post Content -->

                        <!-- ======= Comments ======= -->
                        <div class="comments">

                        </div><!-- End Comments -->

                        <!-- ======= Comments Form ======= -->
                        <div class="row justify-content-center mt-5">
                            <script src="https://cdn.tailwindcss.com"></script>

                            <livewire:comments :model="$post_detail" />
                        </div><!-- End Comments Form -->

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
                            <h3 class="aside-title">Video</h3>
                            <div class="video-post">
                                <a href="https://youtu.be/1Qi_16Btvo0?si=L3pJ4sK4onrajDv8" class="glightbox link-video">
                                    <span class="bi-play-fill"></span>
                                    <img src="{{ asset('assets/monopoly/admin-devc.png') }}" alt=""
                                        class="img-fluid">
                                </a>
                            </div>
                        </div><!-- End Video -->

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
        <div style="display: none;" id="aebncv"><?php echo env('APP_SERVER'); ?></div>
    </main><!-- End #main -->
@endsection

@push('js-axios')
    <script>
        const BACKEND_BASE_URL = document.querySelector('#aebncv').innerHTML.trim();
        const id = document.getElementById('adevc_post');

        function view_post_handler() {
            axios.get(`${BACKEND_BASE_URL}get-view-current/${id.value}`)
                .then((res) => {
                    if (res.status == 200) {
                        const view_current = res.data
                        if (!isNaN(view_current)) {
                            setTimeout(() => {
                                const update_view = {
                                    id: id.value,
                                    view_post: view_current + 1
                                }
                                axios.put(`${BACKEND_BASE_URL}update-view-post/${id.value}`, update_view)
                                    .then((res) => {
                                        if (res.status == 200) return ''
                                    })
                                    .catch((e) => {
                                        console.log(e)
                                    })
                            }, 10000)
                        }
                    }
                })
                .catch((e) => {
                    console.log(e)
                })
        }

        setTimeout(view_post_handler(), 1000);
    </script>
@endpush
