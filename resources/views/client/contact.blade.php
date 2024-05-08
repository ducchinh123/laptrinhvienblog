@extends('index')
@section('content')
    <main id="main">
        <section id="contact" class="contact mb-5">
            <div class="container" data-aos="fade-up">

                <div class="row">
                    <div class="col-lg-12 text-center mb-5">
                        <h1 class="page-title">Liên hệ tôi</h1>
                    </div>
                </div>

                <div class="row gy-4">

                    <div class="col-md-4">
                        <div class="info-item">
                            <i class="bi bi-geo-alt"></i>
                            <h3>Địa chỉ</h3>
                            <address>xã Vân Canh, huyện Hoài Đức, TP Hà Nội</address>
                        </div>
                    </div><!-- End Info Item -->

                    <div class="col-md-4">
                        <div class="info-item info-item-borders">
                            <i class="bi bi-phone"></i>
                            <h3>SĐT</h3>
                            <p><a href="tel:0888525597">0888525597</a></p>
                        </div>
                    </div><!-- End Info Item -->

                    <div class="col-md-4">
                        <div class="info-item">
                            <i class="bi bi-envelope"></i>
                            <h3>Email</h3>
                            <p><a href="mailto:chinhdd.ph28756@gmail.com">chinhdd.ph28756@gmail.com</a></p>
                        </div>
                    </div><!-- End Info Item -->

                </div>



                <form action="{{ route('send-contact') }}" method="POST" class="mt-5">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6 mb-3">
                            <input type="text" name="fullname" class="form-control" id="name"
                                placeholder="Họ và tên của bạn">
                            @error('fullname')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <input type="email" class="form-control" name="email" id="email"
                                placeholder="Email của bạn">
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="content" rows="5" placeholder="Nội dung"></textarea>
                        @error('content')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror

                        @if (session('success'))
                            <p class="mt-2 text-success" style="font-weight: bold"> {{ session('success') }}</p>
                        @endif
                    </div>

                    <div class="text-center mt-3"><button class="btn btn-dark" type="submit">Gửi liên hệ</button></div>
                </form>
            </div><!-- End Contact Form -->

            </div>
        </section>

    </main><!-- End #main -->
@endsection
