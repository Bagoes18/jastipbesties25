<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jastipbesties</title>
    <link rel="icon" type="image/png" href="{{ asset('front/img/favicon.png') }}">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Css Styles -->

    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('front/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('front/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('front/css/magnific-popup.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('front/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('front/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('front/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}" type="text/css">
    <style>
        .nested-category {
            display: none;
            margin-left: 15px;
        }

        .nested-category.show {
            display: block;
        }

        .header a,
        .navbar a,
        .header__menu a {
            text-decoration: none !important;
        }

        @media (max-width: 991.98px) {
            .header__menu ul {
                padding-left: 0;
                margin-bottom: 0;
            }

            .header__menu ul li {
                display: block;
                border-bottom: 1px solid #eee;
                padding: 10px 0;
            }

            .mobile-icons a {
                padding: 0 8px;
            }

            .header__nav__option {
                display: none !important;
                /* Sembunyikan versi desktop */
            }
        }

        .cart-wrapper {
            position: relative;
            display: inline-block;
        }

        .cart-badge {
            position: absolute;
            top: -5px;
            right: -10px;
            background-color: red !important;
            color: white !important;
            padding: 2px 6px;
            border-radius: 50%;
            font-size: 12px;
            font-weight: bold;
            line-height: 1;
            z-index: 10;
        }
    </style>

</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__option">
            <div class="offcanvas__links">
                @auth
                <a href="/logout">Keluar</a>
                @else
                <a href="/login">Masuk</a>
                @endauth
                <a href="#">Syarat & Ketentuan</a>
            </div>
            {{-- <div class="offcanvas__top__hover">
                <span>Usd <i class="arrow_carrot-down"></i></span>
                <ul>
                    <li>USD</li>
                    <li>EUR</li>
                    <li>USD</li>
                </ul>
            </div> --}}
        </div>
        <div class="offcanvas__nav__option">
            <a href="#" class="search-switch"><img src="{{ asset('front/img/icon/search.png') }}" alt=""></a>
            {{-- <a href="#"><img src="{{ asset('front/img/icon/heart.png') }}" alt=""></a> --}}
            <a href="/keranjang"><img src="{{ asset('front/img/icon/cart.png') }}" alt="">@if(isset($cartCount) &&
                $cartCount > 0)
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
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__text">
            <p>Syarat dan ketentuan berlaku.</p>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    @include('front.layout.header')

    @yield('content')

    @include('front.layout.footer')

    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form" action="{{ url('search-products') }}" method="get">
                <input type="text" name="query" id="search-input" placeholder="Cari disini.....">
            </form>
        </div>
    </div>
    <!-- Search End -->

    <!-- Js Plugins -->
    <script src="{{ asset('front/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('front/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('front/js/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('front/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('front/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('front/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('front/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('front/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('front/js/main.js') }}"></script>
    <script src="{{ asset('front/js/custom.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggles = document.querySelectorAll('.toggle-arrow');

            toggles.forEach(function(toggle) {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    const parent = toggle.closest('li');
                    const nested = parent.querySelector('.nested-category');
                    if (nested) {
                        nested.classList.toggle('show');
                    }
                    toggle.textContent = toggle.textContent === '+' ? '-' : '+';
                });
            });
        });
        
    </script>
    <script src="{{ asset('front/js/jquery.slicknav.min.js') }}"></script>
    <script>
        $(document).ready(function() {
        $('.mobile-menu').slicknav({
            prependTo: '#mobile-menu-wrap',
            allowParentLinks: true
        });
    });
    </script>


</body>

</html>