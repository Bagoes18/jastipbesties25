@foreach ($categoryProducts as $product)
<div class="col-lg-4 col-md-6 col-sm-6">
    <div class="product__item">
        @if (isset($product['images'][0]['image']) && !empty($product['images'][0]['image']))
        <div class="product__item__pic set-bg"
            data-setbg="{{ asset('front/images/products/small/'.$product['images'][0]['image']) }}">
            {{-- <span class="label" style="color: blue">TOP</span> --}}
            {{-- <ul class="product__hover">
                <li><a href="#"><img src="{{ asset('front/img/icon/heart.png') }}" alt=""></a></li>
                <li><a href="#"><img src="{{ asset('front/img/icon/compare.png') }}" alt="">
                        <span>Compare</span></a></li>
                <li><a href="#"><img src="{{ asset('front/img/icon/search.png') }}" alt=""></a></li>
            </ul> --}}
        </div>
        @else
        <div class="product__item__pic set-bg" data-setbg="{{ asset('front/images/products/dummy.png') }}">
            {{-- <span class="label" style="color: blue">TOP</span> --}}
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
@endforeach