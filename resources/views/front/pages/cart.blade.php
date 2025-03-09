@extends('front.pages.layouts.app')

@section('front-title', 'Cart - ')
@section('content')


    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shopping Cart</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ route('front.home') }}">Home</a>
                            <a href="{{ route('front.shop') }}">Shop</a>
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
            <div id="alert-message" class="alert alert-danger alert-dismissible fade show" style="display: none" role="alert">
                <h4><i class="icon fa fa-ban"></i> Error!</h4>
                <span id="display-message"></span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @include('front.profile.layouts.message')
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
                                @if ($cartContent->isNotEmpty())
                                    @foreach ($cartContent as $item)
                                        <tr>
                                            <td class="product__cart__item">
                                                <div class="product__cart__item__pic">
                                                    <img src="{{ asset('uploads/product-image/' . $item->options->productImage) }}"
                                                        alt=""
                                                        style="width: 80px; height: 80px; object-fit: cover; object-position: top;">
                                                </div>
                                                <div class="product__cart__item__text">
                                                    <h6>{{ $item->name }}</h6>
                                                    @if ($item->options->salePrice > 0)
                                                        <h5>${{ $item->options->salePrice }}</h5>
                                                    @else
                                                        <h5>${{ $item->price }}</h5>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="quantity__item">
                                                <div class="quantity">
                                                    <div class="pro-qty-2">
                                                        <input type="number" name="qty" class="cart-qty"
                                                            data-rowid="{{ $item->rowId }}" value="{{ $item->qty }}">
                                                    </div>
                                                </div>
                                            </td>
                                            @if ($item->options->salePrice > 0)
                                                <td class="cart__price">${{ $item->options->salePrice * $item->qty }}</td>
                                            @else
                                                <td class="cart__price">${{ $item->price * $item->qty }}</td>
                                            @endif

                                            <td class="cart__close"><span onclick="deleteItem('{{ $item->rowId }}')"><i
                                                        class="fa fa-close"></i></span></td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="{{ route('front.shop') }}">Continue Shopping</a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn update__btn">
                                <a href="javascript:void(0)" onclick="updateAllCart()">
                                    <span id="update-loder" style="display: none"><i class="fa fa-spinner"></i></span>
                                    Update Cart
                                </a>
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
                            <li>Subtotal <span>${{ cartTotal() }}</span></li>
                            <li>Total <span>${{ cartTotal() }}</span></li>
                        </ul>
                        <a href="{{ route('front.viewCheckout') }}" class="primary-btn">Proceed to checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->

@endsection
@section('customJS')
    <script>
        function updateAllCart() {
            let cartData = [];

            $(".cart-qty").each(function() {
                let rowId = $(this).data("rowid");
                let qty = parseInt($(this).val(), 10) || 0;

                if (rowId && !isNaN(qty) && qty > 0) {
                    cartData.push({ rowId: rowId, qty: qty });
                }
            });

            console.log("Cart Data Sent:", cartData);

            if (cartData.length === 0) {
                alert("No valid items to update!");
                return;
            }

            $.ajax({
                url: "{{ route('front.updateCart') }}",
                type: 'POST',
                data: {
                    cartItems: cartData,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                beforeSend: function() {
                    $('#update-loder').show();
                },
                success: function(response) {
                    console.log("Response:", response);
                    if (response.status) {
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    } else {
                        $('#alert-message').show(function() {
                            $('#display-message').html(response.errors);
                        });
                        $('#update-loder').hide();
                    }
                },
                error: function(xhr) {
                    console.log("AJAX Error:", xhr.responseText);
                    alert("Something went wrong!");
                    $('#update-loder').hide();
                }
            });
        }
    </script>
@endsection
