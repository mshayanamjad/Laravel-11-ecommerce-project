@extends('front.pages.layouts.app')

@section('front-title', 'Checkout - ')
@section('content')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Checkout</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ route('front.home') }}">Home</a>
                            <a href="{{ route('front.shop') }}">Shop</a>
                            <span>Checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <form action="#" method="post" id="orderForm">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <h6 class="coupon__code"><span class="icon_tag_alt"></span> Have a coupon? <a
                                    href="#">Click
                                    here</a> to enter your code</h6>
                            <h6 class="checkout__title">Billing Details</h6>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>First Name<span>*</span></p>
                                        <input type="text" name="first_name" value="{{ (!empty($customerAddress)) ? $customerAddress->first_name : '' }}">
                                        <p class="error"></p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input type="text" name="last_name" value="{{ (!empty($customerAddress)) ? $customerAddress->last_name : '' }}">
                                        <p class="error"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input country mb-3">
                                <p>Country<span>*</span></p>
                                {{-- <input type="text" name="first_name"> --}}
                                <select name="country" id="country">
                                    @if ($countries->isNotEmpty())
                                        @foreach ($countries as $country)
                                            <option {{ (!empty($customerAddress && $customerAddress->country_id == $country->id)) ? 'selected' : '' }} value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    @endif

                                </select>
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" name="address" placeholder="Street Address" class="checkout__input__add" value="{{ (!empty($customerAddress)) ? $customerAddress->address : '' }}">
                                <input type="text" name="apartment" placeholder="Apartment, suite, unite ect (optinal)" value="{{ (!empty($customerAddress)) ? $customerAddress->apartment : '' }}">
                            </div>
                            <div class="checkout__input">
                                <p>Town/City<span>*</span></p>
                                <input type="text" name="city" value="{{ (!empty($customerAddress)) ? $customerAddress->city : '' }}">
                            </div>
                            <div class="checkout__input">
                                <p>Country/State<span>*</span></p>
                                <input type="text" name="state" value="{{ (!empty($customerAddress)) ? $customerAddress->state : '' }}">
                            </div>
                            <div class="checkout__input">
                                <p>Postcode / ZIP<span>*</span></p>
                                <input type="text" name="zip" value="{{ (!empty($customerAddress)) ? $customerAddress->zip : '' }}">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text" name="phone" value="{{ (!empty($customerAddress)) ? $customerAddress->phone : $user->phone }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text" name="email" value="{{ (!empty($customerAddress)) ? $customerAddress->email : $user->email }}">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Order notes<span>*</span></p>
                                <input type="text" name="note" placeholder="Notes about your order, e.g. special notes for delivery." value="{{ (!empty($customerAddress)) ? $customerAddress->note : '' }}">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4 class="order__title">Your order</h4>
                                <div class="checkout__order__products">
                                    Product 
                                    <span>Total</span>
                                    <span style="margin-right: 15px;">qty</span>
                                </div>
                                <ul class="checkout__total__products">
                                    @foreach (Cart::content() as $item)
                                        <li>
                                            {{ $item->name }}
                                            <span>
                                                {{ $item->qty }} x
                                                @if ($item->options->salePrice > 0)
                                                    ${{ $item->options->salePrice }}
                                                @else
                                                    ${{ $item->price }}
                                                @endif
                                                {{-- ${{ $item->price }} --}}
                                            </span>
                                        </li>
                                    @endforeach
                                    {{-- <li>02. German chocolate <span>$ 170.0</span></li>
                                    <li>03. Sweet autumn <span>$ 170.0</span></li>
                                    <li>04. Cluten free mini dozen <span>$ 110.0</span></li> --}}
                                </ul>
                                <ul class="checkout__total__all">
                                    <li>Subtotal <span>${{ cartTotal() }}</span></li>
                                    <li>Shipping <span id="shippingCharge">${{ number_format($shippingCharge, 2) }}</span></li>
                                    <li>Total <span id="grandTotal">${{ $grandTotal }}</span></li>
                                </ul>
                                <h6 class="checkout__title mb-3 pb-3">Payment Method</h6>
                                <div class="checkout__input__checkbox">
                                    <label for="cod">
                                        Check Payment
                                        <input type="radio" id="cod" name="payment_method" value="cod" checked>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="stripe">
                                        Card Payment
                                        <input type="radio" id="stripe" name="payment_method" value="stripe">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div id="stripeCard" style="display: none;">
                                    <label>Card Details</label>
                                    <div id="card-element" class="form-control" style="height: 50px; align-content: center;"></div>
                                    <div id="card-errors" class="text-danger mt-2"></div>
                                </div>
                                <button type="submit" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->

@endsection
@section('customJS')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        var stripe = Stripe('{{ env("STRIPE_KEY") }}');
            var elements = stripe.elements();
            var card = elements.create('card');
            card.mount('#card-element');
            
            $('input[name="payment_method"]').change(function() {
                if ($('#stripe').is(':checked')) {
                    $('#stripeCard').slideDown();
                } else {
                    $('#stripeCard').slideUp();
                }
            });

        $('#orderForm').submit(function (e) {
            e.preventDefault();
            let form = $(this);
            $('.site-btn').prop('disabled', true);

            if ($('#stripe').is(':checked')) {
                // Handle Stripe Payment
                stripe.createToken(card).then(function (result) {
                    if (result.error) {
                        $('#card-errors').text(result.error.message);
                        $('.site-btn').prop('disabled', false);
                    } else {
                        form.append("<input type='hidden' name='stripeToken' value='" + result.token.id + "'>");
                        processOrder(form);
                    }
                });
            } else {
                processOrder(form);
            }
        });

        function processOrder(form) {
            $.ajax({
                url: '{{ route("front.checkoutProcess") }}',
                type: 'post',
                data: form.serialize(),
                dataType: 'json',
                success: function (resp) {

                    if (resp.status == true) {
                        $('.error').removeClass('invalid-feedback').html('');
                        $('input, select').removeClass('is-invalid');

                        window.location.href='{{ route("front.viewCheckout") }}';
                    } else {
                        // Show validation errors
                        let errors = resp['errors'];
                        $('.error').removeClass('invalid-feedback').html('');
                        $('input, select').removeClass('is-invalid');

                        $.each(errors, function (key, value) {
                            $(`[name="${key}"]`).addClass('is-invalid').siblings('.error').addClass('invalid-feedback').html(value);
                        });
                    }
                },
                error: function () {
                    alert("Something went wrong. Please try again.");
                    $('.site-btn').prop('disabled', false);
                }
            });
        }


            function updateShipping() {
            var countryId = $('#country').val();
            if (countryId) { // Ensure a country is selected
                $.ajax({
                    url: '{{ route("front.getOrderSummery") }}',
                    type: 'post',
                    data: { 
                        country_id: countryId, 
                        _token: '{{ csrf_token() }}' // ✅ CSRF token added
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == true) {
                            $('#shippingCharge').html('$' + parseFloat(response.shippingCharge).toFixed(2)); // ✅ Proper formatting
                            $('#grandTotal').html('$' + parseFloat(response.grandTotal).toFixed(2)); // ✅ Proper formatting
                        }
                    }
                });
            }
        }

        $(document).ready(function() {
            updateShipping(); // ✅ Run on page load

            $('#country').change(function() {
                updateShipping(); // ✅ Run when country is changed
            });
        });


    </script>
@endsection
