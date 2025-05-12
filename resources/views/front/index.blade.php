@extends('front.layout.layout')
@section('content')
<!-- Hero Section Begin -->
<section class="hero">
    <div class="hero__slider owl-carousel">
        @foreach ($homeSlideBanners as $slideBanners)
        <div class="hero__items set-bg" data-setbg="{{ asset('front/images/banners/'.$slideBanners['image']) }}"
            alt="{{ $slideBanners['alt'] }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-7 col-md-8">
                        <div class="hero__text">
                            <h6>{{ $slideBanners['title'] }}</h6>
                            <h2>{{ $slideBanners['title'] }}</h2>

                            <a href="{{ $slideBanners['link'] }}" class="primary-btn">Belanja Sekarang<span
                                    class="arrow_right"></span></a>
                            {{-- <div class="hero__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @endforeach

    </div>
</section>
<!-- Hero Section End -->

<!-- Banner Section Begin -->
<section class="banner spad">
    <div class="container">
        <div class="row">
            @if (isset($homeFixBanners[0]['image']))
            <div class="col-lg-7 offset-lg-4">
                <div class="banner__item">
                    <div class="banner__item__pic">
                        <img src="{{ asset('front/images/banners/'.$homeFixBanners[0]['image']) }}"
                            alt="{{ $homeFixBanners[0]['alt'] }}">
                    </div>
                    <div class="banner__item__text">
                        <h2>{{ $homeFixBanners[0]['title'] }}</h2>
                        <a href="{{ $homeFixBanners[0]['link'] }}">Belanja</a>
                    </div>
                </div>
            </div>

            @endif
            @if (isset($homeFixBanners[1]['image']))
            <div class="col-lg-5">
                <div class="banner__item banner__item--middle">
                    <div class="banner__item__pic">
                        <img src="{{ asset('front/images/banners/'.$homeFixBanners[1]['image']) }}"
                            alt="{{ $homeFixBanners[1]['alt'] }}">
                    </div>
                    <div class="banner__item__text">
                        <h2>{{ $homeFixBanners[1]['title'] }}</h2>
                        <a href="{{ $homeFixBanners[1]['link'] }}">Belanja</a>
                    </div>
                </div>
            </div>
            @endif
            @if (isset($homeFixBanners[2]['image']))
            <div class="col-lg-7">
                <div class="banner__item banner__item--last">
                    <div class="banner__item__pic">
                        <img src="{{ asset('front/images/banners/'.$homeFixBanners[2]['image']) }}"
                            alt="{{ $homeFixBanners[2]['alt'] }}">
                    </div>
                    <div class="banner__item__text">
                        <h2>{{ $homeFixBanners[2]['title'] }}</h2>
                        <a href="{{ $homeFixBanners[2]['link'] }}">Belanja</a>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</section>
<!-- Banner Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="filter__controls">
                    <li class="active" data-filter="*">Semua</li>
                    <li data-filter=".featured">Unggulan</li>
                    <li data-filter=".best-seller">Paling Laku</li>
                    <li data-filter=".new-arrivals">Baru Datang</li>
                    <li data-filter=".hot-sales">Promo Diskon</li>
                </ul>
            </div>
        </div>
        <div class="row product__filter">
            @foreach ($newProducts as $product)
            <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals">
                <div class="product__item">
                    @if (isset($product['images'][0]['image']) && !empty($product['images'][0]['image']))
                    <div class="product__item__pic set-bg"
                        data-setbg="{{ asset('front/images/products/small/'.$product['images'][0]['image']) }}">
                        <span class="label">Baru</span>
                        {{-- <ul class="product__hover">
                            <li><a href="#"><img src="{{ asset('front/img/icon/heart.png') }}" alt=""></a></li>
                            <li><a href="#"><img src="{{ asset('front/img/icon/compare.png') }}" alt="">
                                    <span>Compare</span></a></li>
                            <li><a href="#"><img src="{{ asset('front/img/icon/search.png') }}" alt=""></a></li>
                        </ul> --}}
                    </div>
                    @else
                    <div class="product__item__pic set-bg" data-setbg="{{ asset('front/images/products/dummy.png') }}">
                        <span class="label">Baru</span>
                        {{-- <ul class="product__hover">
                            <li><a href="#"><img src="{{ asset('front/img/icon/heart.png') }}" alt=""></a></li>
                            <li><a href="#"><img src="{{ asset('front/img/icon/compare.png') }}" alt="">
                                    <span>Compare</span></a></li>
                            <li><a href="#"><img src="{{ asset('front/img/icon/search.png') }}" alt=""></a></li>
                        </ul> --}}
                    </div>

                    @endif
                    <div class="product__item__text">
                        <h6 style="color: darkgray">
                            {{ $product['brand']['brand_name'] ?? 'Merek Tidak Diketahui' }}
                        </h6>
                        <h6><b>{{ $product['product_name'] }}</b> </h6>
                        <a href="#" class="add-cart"><i class="fa fa-cart-plus"></i> Keranjang</a>
                        <div class="rating">
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        @if ($product['discount_type']!="")
                        <h6 style="color: red"><s>Rp. {{ $product['product_price'] }}</s></h6>
                        <h5>Rp. {{ $product['final_price'] }}</h5>
                        @else
                        <h5>Rp. {{ $product['final_price'] }}</h5>
                        @endif
                        <div class="product__color__select">
                            <label for="pc-1">
                                <input type="radio" id="pc-1">
                            </label>
                            <label class="active black" for="pc-2">
                                <input type="radio" id="pc-2">
                            </label>
                            <label class="grey" for="pc-3">
                                <input type="radio" id="pc-3">
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @foreach ($featuredProducts as $product)
            <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix featured">
                <div class="product__item">
                    @if (isset($product['images'][0]['image']) && !empty($product['images'][0]['image']))
                    <div class="product__item__pic set-bg"
                        data-setbg="{{ asset('front/images/products/small/'.$product['images'][0]['image']) }}">
                        <span class="label" style="color: blue">TOP</span>
                        {{-- <ul class="product__hover">
                            <li><a href="#"><img src="{{ asset('front/img/icon/heart.png') }}" alt=""></a></li>
                            <li><a href="#"><img src="{{ asset('front/img/icon/compare.png') }}" alt="">
                                    <span>Compare</span></a></li>
                            <li><a href="#"><img src="{{ asset('front/img/icon/search.png') }}" alt=""></a></li>
                        </ul> --}}
                    </div>
                    @else
                    <div class="product__item__pic set-bg" data-setbg="{{ asset('front/images/products/dummy.png') }}">
                        <span class="label" style="color: blue">TOP</span>
                        {{-- <ul class="product__hover">
                            <li><a href="#"><img src="{{ asset('front/img/icon/heart.png') }}" alt=""></a></li>
                            <li><a href="#"><img src="{{ asset('front/img/icon/compare.png') }}" alt="">
                                    <span>Compare</span></a></li>
                            <li><a href="#"><img src="{{ asset('front/img/icon/search.png') }}" alt=""></a></li>
                        </ul> --}}
                    </div>

                    @endif
                    <div class="product__item__text">
                        <h6 style="color: darkgray">
                            {{ $product['brand']['brand_name'] ?? 'Merek Tidak Diketahui' }}
                        </h6>
                        <h6><b>{{ $product['product_name'] }}</b> </h6>
                        <a href="#" class="add-cart"><i class="fa fa-cart-plus"></i> Keranjang</a>
                        <div class="rating">
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        @if ($product['discount_type']!="")
                        <h6 style="color: red"><s>Rp. {{ $product['product_price'] }}</s></h6>
                        <h5>Rp. {{ $product['final_price'] }}</h5>
                        @else
                        <h5>Rp. {{ $product['final_price'] }}</h5>
                        @endif
                        <div class="product__color__select">
                            <label for="pc-1">
                                <input type="radio" id="pc-1">
                            </label>
                            <label class="active black" for="pc-2">
                                <input type="radio" id="pc-2">
                            </label>
                            <label class="grey" for="pc-3">
                                <input type="radio" id="pc-3">
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @foreach ($bestSellers as $product)
            <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix best-seller">
                <div class="product__item">
                    @if (isset($product['images'][0]['image']) && !empty($product['images'][0]['image']))
                    <div class="product__item__pic set-bg"
                        data-setbg="{{ asset('front/images/products/small/'.$product['images'][0]['image']) }}">
                        {{-- <span class="label" style="color: gold">TOP</span> --}}
                        {{-- <ul class="product__hover">
                            <li><a href="#"><img src="{{ asset('front/img/icon/heart.png') }}" alt=""></a></li>
                            <li><a href="#"><img src="{{ asset('front/img/icon/compare.png') }}" alt="">
                                    <span>Compare</span></a></li>
                            <li><a href="#"><img src="{{ asset('front/img/icon/search.png') }}" alt=""></a></li>
                        </ul> --}}
                    </div>
                    @else
                    <div class="product__item__pic set-bg" data-setbg="{{ asset('front/images/products/dummy.png') }}">
                        {{-- <span class="label">Baru</span> --}}
                        {{-- <ul class="product__hover">
                            <li><a href="#"><img src="{{ asset('front/img/icon/heart.png') }}" alt=""></a></li>
                            <li><a href="#"><img src="{{ asset('front/img/icon/compare.png') }}" alt="">
                                    <span>Compare</span></a></li>
                            <li><a href="#"><img src="{{ asset('front/img/icon/search.png') }}" alt=""></a></li>
                        </ul> --}}
                    </div>

                    @endif
                    <div class="product__item__text">
                        <h6 style="color: darkgray">
                            {{ $product['brand']['brand_name'] ?? 'Merek Tidak Diketahui' }}
                        </h6>
                        <h6><b>{{ $product['product_name'] }}</b> </h6>
                        <a href="#" class="add-cart"><i class="fa fa-cart-plus"></i> Keranjang</a>
                        <div class="rating">
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        @if ($product['discount_type']!="")
                        <h6 style="color: red"><s>Rp. {{ $product['product_price'] }}</s></h6>
                        <h5>Rp. {{ $product['final_price'] }}</h5>
                        @else
                        <h5>Rp. {{ $product['final_price'] }}</h5>
                        @endif
                        <div class="product__color__select">
                            <label for="pc-1">
                                <input type="radio" id="pc-1">
                            </label>
                            <label class="active black" for="pc-2">
                                <input type="radio" id="pc-2">
                            </label>
                            <label class="grey" for="pc-3">
                                <input type="radio" id="pc-3">
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @foreach ($discountedProducts as $product)
            <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix hot-sales">
                <div class="product__item">
                    @if (isset($product['images'][0]['image']) && !empty($product['images'][0]['image']))
                    <div class="product__item__pic set-bg"
                        data-setbg="{{ asset('front/images/products/small/'.$product['images'][0]['image']) }}">
                        <span class="label" style="color: gold">Diskon</span>
                        {{-- <ul class="product__hover">
                            <li><a href="#"><img src="{{ asset('front/img/icon/heart.png') }}" alt=""></a></li>
                            <li><a href="#"><img src="{{ asset('front/img/icon/compare.png') }}" alt="">
                                    <span>Compare</span></a></li>
                            <li><a href="#"><img src="{{ asset('front/img/icon/search.png') }}" alt=""></a></li>
                        </ul> --}}
                    </div>
                    @else
                    <div class="product__item__pic set-bg" data-setbg="{{ asset('front/images/products/dummy.png') }}">
                        <span class="label" style="color: gold">Diskon</span>

                        {{-- <ul class="product__hover">
                            <li><a href="#"><img src="{{ asset('front/img/icon/heart.png') }}" alt=""></a></li>
                            <li><a href="#"><img src="{{ asset('front/img/icon/compare.png') }}" alt="">
                                    <span>Compare</span></a></li>
                            <li><a href="#"><img src="{{ asset('front/img/icon/search.png') }}" alt=""></a></li>
                        </ul> --}}
                    </div>

                    @endif
                    <div class="product__item__text">
                        <h6 style="color: darkgray">
                            {{ $product['brand']['brand_name'] ?? 'Merek Tidak Diketahui' }}
                        </h6>
                        <h6><b>{{ $product['product_name'] }}</b> </h6>
                        <a href="#" class="add-cart"><i class="fa fa-cart-plus"></i> Keranjang</a>
                        <div class="rating">
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        @if ($product['discount_type']!="")
                        <h6 style="color: red"><s>Rp. {{ $product['product_price'] }}</s></h6>
                        <h5>Rp. {{ $product['final_price'] }}</h5>
                        @else
                        <h5>Rp. {{ $product['final_price'] }}</h5>
                        @endif
                        <div class="product__color__select">
                            <label for="pc-1">
                                <input type="radio" id="pc-1">
                            </label>
                            <label class="active black" for="pc-2">
                                <input type="radio" id="pc-2">
                            </label>
                            <label class="grey" for="pc-3">
                                <input type="radio" id="pc-3">
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>
<!-- Product Section End -->

<!-- Categories Section Begin -->
<section class="categories spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="categories__text">
                    <h2>Busana Trendy <br /> <span>Koleksi Sepatu</span> <br /> Aksesoris</h2>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="categories__hot__deal">
                    <img src="{{ asset('front/img/product-sale.png') }}" alt="">
                    <div class="hot__deal__sticker">
                        <span>DISCOUNT</span>
                        <h5>On Store</h5>

                    </div>
                </div>
            </div>
            <div class="col-lg-4 offset-lg-1">
                <div class="categories__deal__countdown">
                    <span>Dapatkan Banyak Promo Dengan Datang ke TOKO</span>
                    <h2>PROMO ON STORE</h2>
                    {{-- <div class="categories__deal__countdown__timer" id="countdown">
                        <div class="cd-item">
                            <span>3</span>
                            <p>Days</p>
                        </div>
                        <div class="cd-item">
                            <span>1</span>
                            <p>Hours</p>
                        </div>
                        <div class="cd-item">
                            <span>50</span>
                            <p>Minutes</p>
                        </div>
                        <div class="cd-item">
                            <span>18</span>
                            <p>Seconds</p>
                        </div>
                    </div> --}}
                    <a href="#" class="primary-btn">Ke TOKO</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Categories Section End -->

<!-- Instagram Section Begin -->
{{-- <section class="instagram spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="instagram__pic">
                    <div class="instagram__pic__item set-bg"
                        data-setbg="{{ asset('front/img/instagram/instagram-1.jpg') }}"></div>
                    <div class="instagram__pic__item set-bg"
                        data-setbg="{{ asset('front/img/instagram/instagram-2.jpg') }}"></div>
                    <div class="instagram__pic__item set-bg"
                        data-setbg="{{ asset('front/img/instagram/instagram-3.jpg') }}"></div>
                    <div class="instagram__pic__item set-bg"
                        data-setbg="{{ asset('front/img/instagram/instagram-4.jpg') }}"></div>
                    <div class="instagram__pic__item set-bg"
                        data-setbg="{{ asset('front/img/instagram/instagram-5.jpg') }}"></div>
                    <div class="instagram__pic__item set-bg"
                        data-setbg="{{ asset('front/img/instagram/instagram-6.jpg') }}"></div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="instagram__text">
                    <h2>Instagram</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua.</p>
                    <h3>#Male_Fashion</h3>
                </div>
            </div>
        </div>
    </div>
</section> --}}
<!-- Instagram Section End -->

<!-- Latest Blog Section Begin -->
{{-- <section class="latest spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <span>Latest Barus</span>
                    <h2>Fashion Baru Trends</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic set-bg" data-setbg="{{ asset('front/img/blog/blog-1.jpg') }}"></div>
                    <div class="blog__item__text">
                        <span><img src="{{ asset('front/img/icon/calendar.png') }}" alt=""> 16 February 2020</span>
                        <h5>What Curling Irons Are The Best Ones</h5>
                        <a href="#">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic set-bg" data-setbg="{{ asset('front/img/blog/blog-2.jpg') }}"></div>
                    <div class="blog__item__text">
                        <span><img src="{{ asset('front/img/icon/calendar.png') }}" alt=""> 21 February 2020</span>
                        <h5>Eternity Bands Do Last Forever</h5>
                        <a href="#">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic set-bg" data-setbg="{{ asset('front/img/blog/blog-3.jpg') }}"></div>
                    <div class="blog__item__text">
                        <span><img src="{{ asset('front/img/icon/calendar.png') }}" alt=""> 28 February 2020</span>
                        <h5>The Health Benefits Of Sunglasses</h5>
                        <a href="#">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}
<!-- Latest Blog Section End -->
@endsection