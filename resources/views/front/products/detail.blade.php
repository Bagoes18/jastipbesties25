@extends('front.layout.layout')
@section('content')

<!-- Shop Details Section Begin -->
<section class="shop-details">
    <div class="product__details__pic">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__details__breadcrumb">
                        <a href="/">Beranda</a>
                        <a href="">Toko</a>
                        <span>{{ $productDetails['product_name'] }}</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <ul class="nav nav-tabs" role="tablist">
                        @foreach ($productDetails['images'] as $index => $image)
                        <li class="nav-item">
                            <a class="nav-link {{ $index === 0 ? 'active' : '' }}" data-toggle="tab"
                                href="#tabs-{{ $index+1 }}" role="tab">
                                <div class="product__thumb__pic set-bg"
                                    data-setbg="{{ asset('front/images/products/small/' . $image['image']) }}"></div>
                            </a>
                        </li>
                        @endforeach
                        @if (!empty($productDetails['product_video']))
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-video" role="tab">
                                <div class="product__thumb__pic set-bg"
                                    data-setbg="{{ asset('front/videos/products/' . pathinfo($productDetails['product_video'], PATHINFO_FILENAME) . '.jpg') }}">
                                    <i class="fa fa-play"></i>
                                </div>
                            </a>
                        </li>
                        @endif

                    </ul>
                </div>
                <div class="col-lg-6 col-md-9">
                    <div class="tab-content">
                        @foreach ($productDetails['images'] as $index => $image)
                        <div class="tab-pane {{ $index === 0 ? 'active' : '' }}" id="tabs-{{ $index+1 }}"
                            role="tabpanel">
                            <div class="product__details__pic__item">
                                <img src="{{ asset('front/images/products/large/' . $image['image']) }}" alt="">
                            </div>
                        </div>
                        @endforeach
                        @if (!empty($productDetails['product_video']))
                        <div class="tab-pane" id="tabs-video" role="tabpanel">
                            <div class="product__details__pic__item">
                                <video width="100%" height="auto" controls>
                                    <source
                                        src="{{ asset('front/videos/products/' . $productDetails['product_video']) }}"
                                        type="video/mp4">
                                    {{-- Your browser does not support the video tag. --}}
                                </video>
                            </div>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product__details__content">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <div class="product__details__text">
                        <h4>{{ $productDetails['product_name'] }}</h4>
                        <div class="rating">
                            <span>{{ $productDetails['brand']['brand_name'] }}</span>
                        </div>
                        <h3>Rp. {{ number_format($productDetails['final_price'], 0, ',', '.') }}
                            @if ($productDetails['discount_type'] != '')
                            <span>Rp. {{ number_format($productDetails['product_price'], 0, ',', '.') }}</span>
                            @endif
                        </h3>
                        <p>{{ $productDetails['description'] }}</p>
                        <div class="product__details__option">
                            <div class="product__details__option__size">
                                <span>Size:</span>
                                @foreach ($productDetails['attributes'] as $attribute)
                                <label>
                                    {{ $attribute['size'] }}
                                    <input type="radio" name="size" value="{{ $attribute['size'] }}">
                                </label>
                                @endforeach
                            </div>

                        </div>
                        <div class="product__details__cart__option">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" value="1">
                                </div>
                            </div>
                            <a href="#" class="primary-btn">+ Keranjang</a>
                        </div>

                        <div class="product__details__last__option">
                            <h5><span>Detail Produk</span></h5>
                            <img src="{{ asset('front/img/payment.png') }}" alt="">
                            <ul>

                                <li><span>Warna:</span> {{ $productDetails['product_color'] }}</li>
                                <li><span>Bahan:</span> {{ $productDetails['fabric'] }}</li>
                                <li><span>Pola:</span> {{ $productDetails['pattern'] }}</li>
                                <li><span>Lengan:</span> {{ $productDetails['sleeve'] }}</li>
                                <li><span>Ketetatan:</span> {{ $productDetails['fit'] }}</li>
                                <li><span>Style:</span> {{ $productDetails['occasion'] }}</li>
                                <li><span>Berat:</span> {{ $productDetails['product_weight'] }} kg</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-5" role="tab">Deskripsi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">Informasi Tambahan</a>
                            </li>

                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                <div class="product__details__tab__content">

                                    <div class="product__details__tab__content__item">
                                        <h5>Deskripsi</h5>
                                        <p>{{ $productDetails['description'] }}</p>

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-6" role="tabpanel">
                                <div class="product__details__tab__content">
                                    <div class="product__details__tab__content__item">
                                        <h5>Informasi Tambahan</h5>
                                        <p>Wash Care: {{ $productDetails['wash_care'] }}</p>
                                        <p>SKU: {{ $productDetails['product_code'] }}</p>

                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Details Section End -->

<!-- Related Section Begin -->
<section class="related spad">
    <div class="container">
        {{-- <div class="row">
            <div class="col-lg-12">
                <h3 class="related-title">Produk yang Sama
                </h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="img/product/product-1.jpg">
                        <span class="label">New</span>
                        <ul class="product__hover">
                            <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                            <li><a href="#"><img src="img/icon/compare.png" alt=""> <span>Compare</span></a></li>
                            <li><a href="#"><img src="img/icon/search.png" alt=""></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6>Piqué Biker Jacket</h6>
                        <a href="#" class="add-cart">+ Add To Cart</a>
                        <div class="rating">
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        <h5>$67.24</h5>
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
            <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="img/product/product-2.jpg">
                        <ul class="product__hover">
                            <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                            <li><a href="#"><img src="img/icon/compare.png" alt=""> <span>Compare</span></a></li>
                            <li><a href="#"><img src="img/icon/search.png" alt=""></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6>Piqué Biker Jacket</h6>
                        <a href="#" class="add-cart">+ Add To Cart</a>
                        <div class="rating">
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        <h5>$67.24</h5>
                        <div class="product__color__select">
                            <label for="pc-4">
                                <input type="radio" id="pc-4">
                            </label>
                            <label class="active black" for="pc-5">
                                <input type="radio" id="pc-5">
                            </label>
                            <label class="grey" for="pc-6">
                                <input type="radio" id="pc-6">
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                <div class="product__item sale">
                    <div class="product__item__pic set-bg" data-setbg="img/product/product-3.jpg">
                        <span class="label">Sale</span>
                        <ul class="product__hover">
                            <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                            <li><a href="#"><img src="img/icon/compare.png" alt=""> <span>Compare</span></a></li>
                            <li><a href="#"><img src="img/icon/search.png" alt=""></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6>Multi-pocket Chest Bag</h6>
                        <a href="#" class="add-cart">+ Add To Cart</a>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        <h5>$43.48</h5>
                        <div class="product__color__select">
                            <label for="pc-7">
                                <input type="radio" id="pc-7">
                            </label>
                            <label class="active black" for="pc-8">
                                <input type="radio" id="pc-8">
                            </label>
                            <label class="grey" for="pc-9">
                                <input type="radio" id="pc-9">
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="img/product/product-4.jpg">
                        <ul class="product__hover">
                            <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                            <li><a href="#"><img src="img/icon/compare.png" alt=""> <span>Compare</span></a></li>
                            <li><a href="#"><img src="img/icon/search.png" alt=""></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6>Diagonal Textured Cap</h6>
                        <a href="#" class="add-cart">+ Add To Cart</a>
                        <div class="rating">
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        <h5>$60.9</h5>
                        <div class="product__color__select">
                            <label for="pc-10">
                                <input type="radio" id="pc-10">
                            </label>
                            <label class="active black" for="pc-11">
                                <input type="radio" id="pc-11">
                            </label>
                            <label class="grey" for="pc-12">
                                <input type="radio" id="pc-12">
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</section>
<!-- Related Section End -->


@endsection