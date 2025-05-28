<!-- Footer Section Begin -->
<?php
use App\Models\Category;
use App\Models\CmsPage;

$categories = Category::getCategories();

$cmspages = CmsPage::where('status', 1)->get()->toArray();
?>
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer__about">
                    <div class="footer__logo">
                        <a href="#"><img src="{{ asset('front/img/footer-logo.png') }}" alt=""></a>
                    </div>
                    <p>Melayani segala pesanan dengan sepenuh hati, anda ingin sesuatu tapi mager untuk beli, titipkan
                        pada kami.</p>
                    <a href="#"><img src="{{ asset('front/img/payment.png') }}" alt=""></a>
                </div>
            </div>
            <div class="col-lg-2 offset-lg-1 col-md-3 col-sm-6">
                <div class="footer__widget">
                    <h6>Katalog</h6>
                    <ul>
                        @foreach ($categories as $category)
                        <li>
                            <a href="{{ url($category['url']) }}">{{ $category['category_name'] }}</a>



                        </li>
                        @endforeach

                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-6">
                <div class="footer__widget">
                    <h6>Informasi</h6>
                    <ul>
                        @foreach ($cmspages as $cms)
                        <li>
                            <a href="{{ route('cms.page', $cms['url']) }}">{{ $cms['title'] }}</a>
                        </li>
                        @endforeach

                    </ul>

                </div>
            </div>

            <div class="col-lg-3 offset-lg-1 col-md-6 col-sm-6">
                <div class="footer__widget">
                    <h6>Hubungi Kami</h6>
                    <ul>
                        <li><a href="https://wa.me/6285748188010" target="_blank">Whatsapp</a></li>
                        <li><a href="mailto:bagus07washek@gmail.com">Email</a></li>
                        <li><a href="https://instagram.com/bags.harynt" target="_blank">Instagram</a></li>
                    </ul>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="footer__copyright__text">
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    <p>Copyright ©
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                        All rights reserved
                    </p>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->