@extends('index')
@section('content')
    <main id="main">
        <section>
            <div class="container">
                <div class="row">

                    <div class="col-md-9" data-aos="fade-up">

                        @foreach ($lists_video as $item)
                            <div class="d-md-flex post-entry-2 half">
                                <a href="https://youtu.be/{{ $item->link_youtube }}" target="_blank" class="me-4 thumbnail">
                                    <img src="{{ $item->image_video }}" alt="" class="img-fluid">
                                </a>
                                <div>
                                    <div class="post-meta"><span class="date">{{ $item->name }}</span> <span
                                            class="mx-1">&bullet;</span> <span>{{ $item->created_at }}</span></div>
                                    <h3><a href="https://youtu.be/{{ $item->link_youtube }}"
                                            target="_blank">{{ $item->title }}</a></h3>
                                    <p>
                                        {{ $item->desc_video }}
                                    </p>
                                    <div class="d-flex align-items-center author">
                                        <div class="photo"><img src="{{ $item->avatar }}" alt="" class="img-fluid">
                                        </div>
                                        <div class="name">
                                            <h3 class="m-0 p-0">{{ $item->author_name }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                        <div class="text-start py-4">
                            {!! $lists_video->links() !!}
                        </div>

                    </div>



                </div>
            </div>
        </section>
    </main><!-- End #main -->
@endsection
