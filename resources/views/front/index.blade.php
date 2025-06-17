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
                            <li><a href="{{ url('product/'.$product['id']) }}"><img
                                        src="{{ asset('front/img/icon/search.png') }}" alt=""></a></li>
                        </ul> --}}
                    </div>
                    @else
                    <div class="product__item__pic set-bg" data-setbg="{{ asset('front/images/products/dummy.png') }}">
                        <span class="label">Baru</span>
                        {{-- <ul class="product__hover">
                            <li><a href="{{ url('product/'.$product['id']) }}"><img
                                        src="{{ asset('front/img/icon/search.png') }}" alt=""></a></li>
                        </ul> --}}
                    </div>

                    @endif
                    <div class="product__item__text">
                        <h6 style="color: darkgray">
                            {{ $product['brand']['brand_name'] ?? 'Merek Tidak Diketahui' }}
                        </h6>
                        <h6><b>{{ $product['product_name'] }}</b> </h6>
                        <a href="{{ url('product/'.$product['id']) }}" class="add-cart">+ Detail</a>

                        @if ($product['discount_type']!="")
                        <h6 style="color: red"><s>Rp. {{ $product['product_price'] }}</s></h6>
                        <h5>Rp. {{ $product['final_price'] }}</h5>
                        @else
                        <h5>Rp. {{ $product['final_price'] }}</h5>
                        @endif

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
                            <li><a href="{{ url('product/'.$product['id']) }}"><img
                                        src="{{ asset('front/img/icon/search.png') }}" alt=""></a></li>
                        </ul> --}}
                    </div>
                    @else
                    <div class="product__item__pic set-bg" data-setbg="{{ asset('front/images/products/dummy.png') }}">
                        <span class="label" style="color: blue">TOP</span>
                        {{-- <ul class="product__hover">
                            <li><a href="{{ url('product/'.$product['id']) }}"><img
                                        src="{{ asset('front/img/icon/search.png') }}" alt=""></a></li>
                        </ul> --}}
                    </div>

                    @endif
                    <div class="product__item__text">
                        <h6 style="color: darkgray">
                            {{ $product['brand']['brand_name'] ?? 'Merek Tidak Diketahui' }}
                        </h6>
                        <h6><b>{{ $product['product_name'] }}</b> </h6>
                        <a href="{{ url('product/'.$product['id']) }}" class="add-cart">+ Detail</a>

                        @if ($product['discount_type']!="")
                        <h6 style="color: red"><s>Rp. {{ $product['product_price'] }}</s></h6>
                        <h5>Rp. {{ $product['final_price'] }}</h5>
                        @else
                        <h5>Rp. {{ $product['final_price'] }}</h5>
                        @endif

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
                            <li><a href="{{ url('product/'.$product['id']) }}"><img
                                        src="{{ asset('front/img/icon/search.png') }}" alt=""></a></li>
                        </ul> --}}
                    </div>
                    @else
                    <div class="product__item__pic set-bg" data-setbg="{{ asset('front/images/products/dummy.png') }}">
                        {{-- <span class="label">Baru</span> --}}
                        {{-- <ul class="product__hover">
                            <li><a href="{{ url('product/'.$product['id']) }}"><img
                                        src="{{ asset('front/img/icon/search.png') }}" alt=""></a></li>
                        </ul> --}}
                    </div>

                    @endif
                    <div class="product__item__text">
                        <h6 style="color: darkgray">
                            {{ $product['brand']['brand_name'] ?? 'Merek Tidak Diketahui' }}
                        </h6>
                        <h6><b>{{ $product['product_name'] }}</b> </h6>
                        <a href="{{ url('product/'.$product['id']) }}" class="add-cart">+ Detail</a>

                        @if ($product['discount_type']!="")
                        <h6 style="color: red"><s>Rp. {{ $product['product_price'] }}</s></h6>
                        <h5>Rp. {{ $product['final_price'] }}</h5>
                        @else
                        <h5>Rp. {{ $product['final_price'] }}</h5>
                        @endif

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
                            <li><a href="{{ url('product/'.$product['id']) }}"><img
                                        src="{{ asset('front/img/icon/search.png') }}" alt=""></a></li>
                        </ul> --}}
                    </div>
                    @else
                    <div class="product__item__pic set-bg" data-setbg="{{ asset('front/images/products/dummy.png') }}">
                        <span class="label" style="color: gold">Diskon</span>

                        {{-- <ul class="product__hover">
                            <li><a href="{{ url('product/'.$product['id']) }}"><img
                                        src="{{ asset('front/img/icon/search.png') }}" alt=""></a></li>
                        </ul> --}}
                    </div>

                    @endif
                    <div class="product__item__text">
                        <h6 style="color: darkgray">
                            {{ $product['brand']['brand_name'] ?? 'Merek Tidak Diketahui' }}
                        </h6>
                        <h6><b>{{ $product['product_name'] }}</b> </h6>
                        <a href="{{ url('product/'.$product['id']) }}" class="add-cart">+ Detail</a>

                        @if ($product['discount_type']!="")
                        <h6 style="color: red"><s>Rp. {{ $product['product_price'] }}</s></h6>
                        <h5>Rp. {{ $product['final_price'] }}</h5>
                        @else
                        <h5>Rp. {{ $product['final_price'] }}</h5>
                        @endif

                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>
<!-- Product Section End -->

<!-- Categories Section Begin -->
{{-- <section class="categories spad">
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

                    <a href="#" class="primary-btn">Ke TOKO</a>
                </div>
            </div>
        </div>
    </div>
</section> --}}

@endsection