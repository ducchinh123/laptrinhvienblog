<!-- ======= Footer ======= -->
<footer id="footer" class="footer">

    <div class="footer-content">
        <div class="container">

            <div class="row g-5">
                <div class="col-lg-4">
                    <h3 class="footer-heading">Về DevC Blog</h3>
                    <p>Là một blog của một cậu sinh viên theo ngành it (mảng lập trình website), qua blog này
                        cậu sinh viên muốn viết ra đây những lời tâm sự, sự trải nghiệm, niềm vui nỗi buồn mà cá
                        nhân cậu ấy cảm nhận được. Không mong blog
                        được nhiều đọc giả vào đọc chỉ mong rằng những bài viết được đọc giả quan tâm và đóng góp ý
                        kiến, sự chia sẻ ngược lại một cách tích cực nhất. Đó là một hạnh phúc lớn lao của cậu ấy.</p>
                    <p><a href="{{ route('c-about') }}" class="footer-link-more">Tìm hiểu thêm</a></p>
                </div>
                <div class="col-6 col-lg-2">
                    <h3 class="footer-heading">Điều hướng</h3>
                    <ul class="footer-links list-unstyled">
                        <li><a href="/"><i class="bi bi-chevron-right"></i> Trang chủ</a></li>
                        <li><a href="{{ route('c-post-index') }}"><i class="bi bi-chevron-right"></i> Bài viết</a>
                        </li>
                        <li><a href="#categorys"><i class="bi bi-chevron-right"></i> Danh mục</a></li>
                        <li><a href="{{ route('c-about') }}"><i class="bi bi-chevron-right"></i>Về tôi</a></li>
                        <li><a href="{{ route('c-contact') }}"><i class="bi bi-chevron-right"></i>Liên lạc</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-2">
                    <h3 class="footer-heading">Danh mục hiện có</h3>
                    <ul class="footer-links list-unstyled">
                        @foreach ($category_menu as $item)
                        <li><i class="bi bi-chevron-right"></i> <a href="{{ route('c-post-category', ['id' => $item->id]) }}">{{ $item->name }}</a></li>     
                        @endforeach

                    </ul>
                </div>

                <div class="col-lg-4">
                    <h3 class="footer-heading">Bài viết gần đây</h3>

                    <ul class="footer-links footer-blog-entry list-unstyled">
                        @foreach ($posts_menu as $item)
                        <li>
                            <a href="{{ route('c-post-detail', ['slug' => $item->slug, 'id' => $item->idPost ]) }}" class="d-flex align-items-center">
                                <img src="{{ $item->overview_photo }}" alt="" class="img-fluid me-3">
                                <div>
                                    <div class="post-meta d-block"><span class="date">{{ $item->name }}</span> <span
                                            class="mx-1">&bullet;</span> <span>{{ $item->created_at }}</span></div>
                                    <span>{{ $item->title }}</span>
                                </div>
                            </a>
                        </li>

                        @endforeach
                        
                    </ul>

                </div>
            </div>
        </div>
    </div>

    <div class="footer-legal">
        <div class="container">

            <div class="row justify-content-between">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <div class="copyright">
                        © Copyright <strong><span>DevC Blog</span></strong>. All Rights Reserved
                    </div>

                    <div class="credits">
                        <!-- All the links in the footer should remain intact. -->
                        <!-- You can delete the links only if you purchased the pro version. -->
                        <!-- Licensing information: https://bootstrapmade.com/license/ -->
                        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/herobiz-bootstrap-business-template/ -->
                        {{-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> --}}
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="social-links mb-3 mb-lg-0 text-center text-md-end">
                        <a href="https://www.facebook.com/chinhyoutubehihi" target="_blank" class="mx-2"><span
                                class="bi-facebook"></span></a>
                        <a href="https://www.instagram.com/devc_dang" target="_blank" class="mx-2"><span
                                class="bi-instagram"></span></a>
                        <a href="https://www.youtube.com/channel/UCTndRQVS4R72kFrL1BWbwoA"
                            style="font-size: 18px;" target="_blank" class="mx-2"><i
                                class="bi bi-youtube"></i></span></a>
                    </div>

                </div>

            </div>

        </div>
    </div>

</footer>

<a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

<!-- Template Main JS File -->
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.8/axios.min.js"></script>
@stack('js-axios')
</body>

</html>
