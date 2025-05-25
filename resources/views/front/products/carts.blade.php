@extends('front.layout.layout')
@section('content')

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Shopping Cart</h4>
                    <div class="breadcrumb__links">
                        <a href="{{ url('/') }}">Home</a>
                        <a href="{{ url('/shop') }}">Shop</a>
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shopping Cart Section Begin -->
<section class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="shopping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $subtotal = 0; @endphp
                            @forelse($cartItems as $item)
                            @php
                            $productTotal = $item->product->final_price * $item->product_qty;
                            $subtotal += $productTotal;
                            @endphp
                            <tr data-cartid="{{ $item->id }}">
                                <td class="product__cart__item">
                                    <div class="product__cart__item__pic">
                                        <img src="{{ asset('front/images/products/small/'.$item->product->product_image) }}"
                                            alt="{{ $item->product->product_name }}">
                                    </div>
                                    <div class="product__cart__item__text">
                                        <h6>{{ $item->product->product_name }}</h6>
                                        <h5>Rp. {{ number_format($item->product->final_price, 0, ',', '.') }}</h5>
                                        <p>Size: {{ $item->product_size }}</p>
                                    </div>
                                </td>
                                <td class="quantity__item">
                                    <div class="quantity">
                                        <div class="pro-qty-2">
                                            <input type="text" value="{{ $item->product_qty }}"
                                                data-cartid="{{ $item->id }}">
                                        </div>
                                    </div>
                                </td>
                                <td class="cart__price">Rp. {{ number_format($productTotal, 0, ',', '.') }}</td>
                                <td class="cart__close"><i class="fa fa-close remove-from-cart"></i></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">Your cart is empty</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn">
                            <a href="{{ url('/shop') }}">Continue Shopping</a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn update__btn">
                            <a href="#" id="update-cart"><i class="fa fa-spinner"></i> Update cart</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="cart__discount">
                    <h6>Discount codes</h6>
                    <form action="#">
                        <input type="text" placeholder="Coupon code">
                        <button type="submit">Apply</button>
                    </form>
                </div>
                <div class="cart__total">
                    <h6>Cart total</h6>
                    <ul>
                        <li>Subtotal <span>Rp. {{ number_format($subtotal, 0, ',', '.') }}</span></li>
                        <li>Total <span>Rp. {{ number_format($subtotal, 0, ',', '.') }}</span></li>
                    </ul>
                    <a href="{{ route('checkout') }}" class="primary-btn">Proceed to checkout</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shopping Cart Section End -->

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
    // Update quantity
    $('.pro-qty-2 input').on('change', function() {
        var cart_id = $(this).data('cartid');
        var new_qty = $(this).val();
        
        $.ajax({
            url: '{{ route("update.cart") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                cart_id: cart_id,
                product_qty: new_qty
            },
            success: function(response) {
                if(response.status == 'success') {
                    location.reload();
                }
            }
        });
    });

    // Remove item from cart
    $('.remove-from-cart').on('click', function() {
        var cart_id = $(this).closest('tr').data('cartid');
        
        if(confirm('Are you sure you want to remove this item?')) {
            $.ajax({
                url: '{{ route("remove.from.cart") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    cart_id: cart_id
                },
                success: function(response) {
                    if(response.status == 'success') {
                        location.reload();
                    }
                }
            });
        }
    });

    // Update all cart items
    $('#update-cart').on('click', function(e) {
        e.preventDefault();
        location.reload(); // Since we're updating on each change, just refresh
    });
});
</script>
@endpush