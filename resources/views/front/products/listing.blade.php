@extends('front.layout.layout')
@section('content')

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Toko</h4>
                    {{-- <div class="breadcrumb__links">
                        <a href="/">Beranda</a>
                        {!! $categoryDetails['breadcrumbs'] !!}

                    </div> --}}
                    <div class="breadcrumb__links">
                        <a href="/">Beranda</a>
                        @isset($categoryDetails)
                        {!! $categoryDetails['breadcrumbs'] !!}
                        @elseif(isset($brand))
                        <span> / Brand / {{ $brand->name }}</span>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shop Section Begin -->
<section class="shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                @include('front.products.filter')
            </div>
            <div class="col-lg-9">
                <div class="shop__product__option">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__left">
                                {{-- <p>{{ count($categoryProducts) }} Produk</p> --}}
                                <p>{{ $categoryProducts->total() }} Produk</p>

                            </div>
                        </div>
                        {{-- <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__right">
                                <p>Sort by Price:</p>
                                <select>
                                    <option value="">Low To High</option>
                                    <option value="">$0 - $55</option>
                                    <option value="">$55 - $100</option>
                                </select>
                            </div>
                        </div> --}}
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__right">
                                <p>Sortir dengan:</p>
                                <form name="sortProducts" id="sortProducts">
                                    <input type="hidden" name="sort" value="{{ $url }}">
                                    <select name="sort" id="sort">
                                        <option @if (isset($_GET['sort']) && !empty($_GET['sort']) &&
                                            $_GET['sort']=='product_latest' ) selected="" @endif value="product_latest">
                                            Produk Terbaru</option>
                                        <option @if (isset($_GET['sort']) && !empty($_GET['sort']) &&
                                            $_GET['sort']=='best_selling' ) selected="" @endif value="best_selling">
                                            Paling Laris</option>
                                        <option @if (isset($_GET['sort']) && !empty($_GET['sort']) &&
                                            $_GET['sort']=='best_rating' ) selected="" @endif value="best_rating">Rating
                                            Terbaik</option>
                                        <option @if (isset($_GET['sort']) && !empty($_GET['sort']) &&
                                            $_GET['sort']=='lowest_price' ) selected="" @endif value="lowest_price">
                                            Harga : Rendah -> Tinggi</option>
                                        <option @if (isset($_GET['sort']) && !empty($_GET['sort']) &&
                                            $_GET['sort']=='highest_price' ) selected="" @endif value="highest_price">
                                            Harga : Tinggi -> Rendah</option>
                                        <option @if (isset($_GET['sort']) && !empty($_GET['sort']) &&
                                            $_GET['sort']=='featured_items' ) selected="" @endif value="featured_items">
                                            Unggulan</option>
                                        <option @if (isset($_GET['sort']) && !empty($_GET['sort']) &&
                                            $_GET['sort']=='discounted_items' ) selected="" @endif
                                            value="discounted_items">Sedang Diskon</option>
                                    </select>
                                </form>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    @include('front.products.ajax_product_listing')
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__pagination">
                            {{ $categoryProducts->links() }}
                            {{-- <a class="active" href="#">1</a>
                            <a href="#">2</a>
                            <a href="#">3</a>
                            <span>...</span>
                            <a href="#">21</a>

                            <a class="active" href="#">1</a> --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Section End -->


@endsection