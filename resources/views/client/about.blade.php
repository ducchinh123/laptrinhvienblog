@extends('index')
@section('content')
    <main id="main">
        <section>
            <div class="container" data-aos="fade-up">
                <div class="row">
                    <div class="col-lg-12 text-center mb-5">
                        <h1 class="page-title">Đôi chút giới thiệu về bản thân</h1>
                    </div>
                </div>

                <div class="row mb-5">

                    <div class="d-md-flex post-entry-2 half">
                        <a href="#" class="me-4 thumbnail">
                            <img src="{{ asset('assets/monopoly/tts.png ') }}" alt="" class="img-fluid">
                        </a>
                        <div class="ps-md-5 mt-4 mt-md-0">
                            {{-- <div class="post-meta mt-4">About us</div> --}}
                            <h2 class="mb-4 display-4">Thông tin cá nhân</h2>

                            <p>Họ và tên: Đặng Đức Chính</p>
                            <p>Giới tính: Nam</p>
                            <p>Độ tuổi: 22</p>
                            <p>Sinh ra và lớn lên tại Giao Thủy, Nam Định, năm 2021 theo học chuyên nghành Công nghệ thông
                                tin mảng lập trình web. Sau đó tốt nghiệp năm 2024, cậu ấy vẫn miệt mài và cố gắng từng
                                nghành trau dồi kiến thức, tích lũy kinh nghiệm và quyết tâm đi kiếm một nơi làm việc phù
                                hợp để tiếp tục phấn đấu và cống hiến.</p>
                        </div>
                    </div>

                    <div class="d-md-flex post-entry-2 half mt-5">
                        <a href="ve-toi.html" class="me-4 thumbnail order-2">
                            <img src="{{ asset('assets/monopoly/admin-devc.png') }}" alt="" class="img-fluid">
                        </a>
                        <div class="pe-md-5 mt-4 mt-md-0">
                            {{-- <div class="post-meta mt-4">Mission &amp; Vision</div> --}}
                            <h2 class="mb-4 display-4">Đến với lập trình trong giây phút "đắn đo" và dần hình thành niềm đam
                                mê lập trình</h2>

                            <p>Năm 2021, sau khi tham dự kì thi đại học và biết được kết quả, biết được mình đậu mình trượt
                                nghành nào. Bản thân cảm thấy có chút buồn và hoang mang mặc dù cũng đã có cố gắng và phấn
                                đấu hết mình trong những năm tháng cấp 3</p>
                            <p>Nhưng bản thân tôi chưa bao giờ bỏ cuộc cả, cũng không có bất cứ điều gì có thể ngăn cản niềm
                                hi vọng và mong ước của tôi. Sau khi được bố mẹ và em trai động viên, tôi tiếp tục tìm
                                trường theo học. Nhưng chọn trường, nghành học đây? Và thế là qua lời giới thiệu của bác họ
                                tôi đã tìm đến trường Cao đẳng thực hành FPT Polytechnic. Trong một danh sách các nghành học
                                vd: Lập trình web, lâp tình mobile, quản trị khách sạn, digital marketing, truyền thông & tổ
                                chức sự kiện... tôi đã chọn chuyên nghành lập trình website. Một cái nghành "khó nhằn" mà
                                tôi đã học tập cho đến khi tôi ra trường vào năm 2024 và đi kiếm việc làm.</p>
                        </div>
                    </div>

                </div>

            </div>
        </section>



        <section>
            <div class="container" data-aos="fade-up">
                <div class="row">
                    <div class="col-12 text-center mb-5">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <h2 class="display-4">Tóm tắt</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center mb-5"></div>
                    <div class="col-lg-4 text-center mb-5">
                        <img src="{{ asset('assets/monopoly/admin-tn.jpg') }}" alt=""
                            class="img-fluid rounded-circle w-50 mb-4">
                        <h4>Đặng Đức Chính</h4>
                        <span class="d-block mb-3 text-uppercase"></span>
                        <p>Đặng Đức Chính (DevC Dang) 22 tuổi, đến từ mảnh đất Nam Định, huyện Giao Thủy. Tốt nghiệp Cao
                            đằng chuyên nghành Công nghệ thông tin năm 2024.</p>
                    </div>
                    <div class="col-lg-4 text-center mb-5"></div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
