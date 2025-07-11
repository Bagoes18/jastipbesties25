<?php
use App\Models\Category;
$categories = Category::getCategories();
?>

<!-- Header Section Begin -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-7">
                    <div class="header__top__left">
                        <p>Syarat dan ketentuan berlaku.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-5">
                    <div class="header__top__right">
                        <div class="header__top__links">
                            @auth
                            <a href="/logout">Keluar</a>
                            @else
                            <a href="/login">Masuk</a>
                            @endauth
                            {{-- <a href="#">Syarat & Ketentuan</a> --}}
                        </div>
                        {{-- <div class="header__top__hover">
                            <span>Usd <i class="arrow_carrot-down"></i></span>
                            <ul>
                                <li>USD</li>
                                <li>EUR</li>
                                <li>USD</li>
                            </ul>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <div class="header__logo">
                    <a href="/"><img src="{{ asset('front/img/logo.png') }}" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <nav class="header__menu mobile-menu">
                    <ul>
                        @if (Session::get('page') == 'home')
                        @php $active='active' @endphp
                        @else
                        @php $active='' @endphp
                        @endif
                        <li class="{{ $active }}"><a href="/">Beranda</a></li>
                        @if (Session::get('page') == 'product')
                        @php $active='active' @endphp
                        @else
                        @php $active='' @endphp
                        @endif
                        <li class="{{ $active }}"><a href="#">Kategori</a>
                            <ul class="dropdown">
                                @foreach ($categories as $category)
                                <li>
                                    <a href="{{ url($category['url']) }}">{{ $category['category_name'] }}</a>

                                    @if (!empty($category['subcategories']) && count($category['subcategories']) > 0)
                                    <ul class="dropdown">
                                        @foreach ($category['subcategories'] as $subcategory)
                                        <li>
                                            <a href="{{ url($subcategory['url']) }}">{{ $subcategory['category_name']
                                                }}</a>

                                            @if (!empty($subcategory['subcategories']) &&
                                            count($subcategory['subcategories']) > 0)
                                            <ul class="dropdown">
                                                @foreach ($subcategory['subcategories'] as $subsubcategory)
                                                <li>
                                                    <a href="{{ url($subsubcategory['url']) }}">{{
                                                        $subsubcategory['category_name'] }}</a>
                                                </li>
                                                @endforeach
                                            </ul>
                                            @endif

                                        </li>
                                        @endforeach
                                    </ul>
                                    @endif

                                </li>
                                @endforeach
                            </ul>
                        </li>


                        {{-- <li><a href="#">Pages</a>
                            <ul class="dropdown">
                                <li><a href="./about.html">About Us</a></li>
                                <li><a href="./shop-details.html">Shop Details</a></li>
                                <li><a href="./shopping-cart.html">Shopping Cart</a></li>
                                <li><a href="./checkout.html">Check Out</a></li>
                                <li><a href="./blog-details.html">Blog Details</a></li>
                            </ul>
                        </li> --}}
                        @if (Session::get('page') == 'riwayat')
                        @php $active='active' @endphp
                        @else
                        @php $active='' @endphp
                        @endif
                        <li class="{{ $active }}"><a href="/riwayat">Riwayat Jastip</a></li>
                        @if (Session::get('page') == 'request')
                        @php $active='active' @endphp
                        @else
                        @php $active='' @endphp
                        @endif
                        <li class="{{ $active }}"><a href="/request">Request Produk</a></li>

                    </ul>
                </nav>
            </div>
            <div class="col-lg-3 col-md-3">
                <div class="header__nav__option">
                    <a href="#" class="search-switch"><img src="{{ asset('front/img/icon/search.png') }}" alt=""></a>
                    {{-- <a href="#"><img src="{{ asset('front/img/icon/heart.png') }}" alt=""></a> --}}
                    <a href="/keranjang"><img src="{{ asset('front/img/icon/cart.png') }}" alt="">
                        @if(isset($cartCount) && $cartCount > 0)
                        <span class="cart-badge">{{ $cartCount }}</span>
                        @endif</a>
                    <a href="/riwayat"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black"
                            class="bi bi-wallet2" viewBox="0 0 16 16">
                            <path
                                d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5z" />
                        </svg> </a>
                    <a href="/profile"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="black"
                            class="bi bi-person-fill" viewBox="0 0 16 16">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                        </svg></a>

                </div>
            </div>
        </div>
        <div class="canvas__open"><i class="fa fa-bars"></i></div>
    </div>
</header>
<!-- Header Section End -->