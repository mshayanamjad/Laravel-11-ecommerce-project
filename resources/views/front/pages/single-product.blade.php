@extends('front.pages.layouts.app')

@section('front-title', 'Shop - ')
@section('content')

    <!-- Shop Details Section Begin -->
    <section class="shop-details">
        <div class="product__details__pic">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__breadcrumb">
                            <a href="{{ route('front.home') }}">Home</a>
                            <a href="{{ route('front.shop') }}">Shop</a>
                            <span>{{ $product->slug }}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-0" role="tab">
                                    <div class="product__thumb__pic set-bg"
                                        data-setbg="{{ asset('uploads/product-image/' . $product->image) }}">
                                    </div>
                                </a>
                            </li>

                            @foreach ($product->gallery as $index => $galleryImage)
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-{{ $index + 1 }}" role="tab">
                                        <div class="product__thumb__pic set-bg"
                                            data-setbg="{{ asset('uploads/product-gallery/' . $galleryImage->gallery) }}">
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-9">
                        <div class="tab-content">
                            <!-- Main product image (Active by default) -->
                            <div class="tab-pane fade show active" id="tabs-0" role="tabpanel">
                                <div class="product__details__pic__item">
                                    <img src="{{ asset('uploads/product-image/' . $product->image) }}" alt="">
                                </div>
                            </div>

                            <!-- Gallery images (Hidden by default) -->
                            @foreach ($product->gallery as $index => $galleryImage)
                                <div class="tab-pane fade" id="tabs-{{ $index + 1 }}" role="tabpanel">
                                    <div class="product__details__pic__item">
                                        <img src="{{ asset('uploads/product-gallery/' . $galleryImage->gallery) }}"
                                            alt="">
                                    </div>
                                </div>
                            @endforeach
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
                            <h4>{{ $product->title }}</h4>
                            <div class="rating">
                                @php
                                    $averageRating = getAverageRating($product->id);
                                @endphp                                
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= floor($averageRating))
                                        <i class="fa fa-star"></i> <!-- Full Star -->
                                    @else
                                        <i class="fa fa-star-o"></i> <!-- Empty Star -->
                                    @endif
                                @endfor
                                <span> - {{ ($reviews->count() <= 1) ? $reviews->count() . ' Review' : $reviews->count() . ' Reviews' }}</span>
                            </div>
                            @if ($product->sale_price > 0)
                                <h3>
                                    ${{ $product->sale_price }}
                                    <span>${{ $product->price }}</span>
                                </h3>
                            @else
                                <h3>
                                    ${{ $product->price }}
                                </h3>
                            @endif
                            <p>{{ $product->short_desc }}</p>
                            <div class="product__details__cart__option">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" id="quantity-{{ $product->id }}" name="qty"
                                            value="1">
                                            {{-- <input type="number" name="qty" class="cart-qty"
                                            data-rowid="{{ $product->rowId }}" value="{{ $item->qty }}"> --}}
                                    </div>
                                </div>
                                <a href="javascript:void(0)" onclick="addToCart({{ $product->id }})"
                                    class="primary-btn">add to cart</a>
                            </div>
                            <div class="product__details__btns__option">
                                @if (whishlistedProducts()->contains('product_id', $product->id))
                                    <a href="javascript:void(0)" id="whishlist-{{ $product->id }}"
                                        onclick="whishlist({{ $product->id }})"><i class="fa fa-heart"
                                            style="color: #ff0000"></i> wishlisted</a>
                                @else
                                    <a href="javascript:void(0)" id="whishlist-{{ $product->id }}"
                                        onclick="whishlist({{ $product->id }})"><i class="fa fa-heart"></i>Add to
                                        wishlist</a>
                                @endif
                                <a href="#"><i class="fa fa-exchange"></i> Add To Compare</a>
                            </div>
                            <div class="product__details__last__option">
                                <h5><span>Guaranteed Safe Checkout</span></h5>
                                <img src="{{ asset('front-assets/img/shop-details/details-payment.png') }}" alt="">
                                <ul>
                                    <li>
                                        <span>Categories:</span>
                                        @if ($product->categories->isNotEmpty())
                                            @foreach ($product->categories as $category)
                                                {{ $category->name }}@if (!$loop->last)
                                                    ,
                                                @endif
                                            @endforeach
                                        @endif
                                    </li>
                                    <li>
                                        <span>Brands:</span>
                                        @if ($product->brands->isNotEmpty())
                                            @foreach ($product->brands as $brand)
                                                {{ $brand->name }}@if (!$loop->last)
                                                    ,
                                                @endif
                                            @endforeach
                                        @endif
                                    </li>
                                    <li><span>SKU:</span> {{ $product->sku }}</li>
                                    <li><span>Barcode:</span><svg id="barcode"></svg></li>
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
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-5"
                                        role="tab">Description</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">Customer
                                        Previews({{ $reviews->count() }})</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <div class="product__details__tab__content__item">
                                            {!! $product->description !!}
                                        </div>

                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-6" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <div class="product__details__tab__content__item">
                                            @include('front.pages.layouts.review')
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
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="related-title">Related Product</h3>
                </div>
            </div>
            <div class="row">
                @foreach ($product->relatedProducts() as $relatedProduct)
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="product__item sale">
                            <div class="product__item__pic set-bg"
                                data-setbg="{{ asset('uploads/product-image/' . $relatedProduct->image) }}">
                                @if ($relatedProduct->sale_price)
                                    <span class="label">Sale</span>
                                @endif
                                <ul class="product__hover">
                                    @if (whishlistedProducts())
                                        <li><a href="javascript:void(0)" id="whishlist-{{ $relatedProduct->id }}"
                                                onclick="whishlist({{ $relatedProduct->id }})"><img
                                                    src="{{ asset('front-assets/img/icon/heart-filled.png') }}"
                                                    width="36" alt=""></a></li>
                                    @else
                                        <li><a href="javascript:void(0)" id="whishlist-{{ $relatedProduct->id }}"
                                                onclick="whishlist({{ $relatedProduct->id }})"><img
                                                    src="{{ asset('front-assets/img/icon/heart.png') }}"
                                                    alt=""></a></li>
                                    @endif
                                    <li><a href="javascript:void(0)" onclick="addToCart({{ $relatedProduct->id }})"><img
                                                src="{{ asset('front-assets/img/icon/cart.png') }}" alt="">
                                            <span>Add To Cart</span></a></li>
                                    <li><a href="{{ route('front.product', $relatedProduct->slug) }}"><img
                                                src="{{ asset('front-assets/img/icon/search.png') }}" alt=""></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6 class="product-title"><a
                                        href="{{ route('front.product', $relatedProduct->slug) }}">{{ $relatedProduct->title }}</a>
                                </h6>
                                <div class="rating">
                                    @php
                                        $averageRating = getAverageRating($relatedProduct->id);
                                    @endphp
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= floor($averageRating))
                                            <i class="fa fa-star"></i> <!-- Full Star -->
                                        @else
                                            <i class="fa fa-star-o"></i> <!-- Empty Star -->
                                        @endif
                                    @endfor
                                </div>
                                @if ($relatedProduct->sale_price > 0)
                                    <h5>
                                        ${{ $relatedProduct->sale_price }}
                                        <span>${{ $relatedProduct->price }}</span>
                                    </h5>
                                @else
                                    <h5>
                                        ${{ $relatedProduct->price }}
                                    </h5>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Related Section End -->

@endsection
@section('customJS')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var barcodeValue = "{{ $product->barcode }}"; // Get barcode value from Laravel
            if (barcodeValue) {
                JsBarcode("#barcode", barcodeValue, {
                    format: "CODE128",
                    displayValue: false,
                    lineColor: "#000",
                    width: 2,
                    height: 25
                });
            }
        });

        $(document).ready(function () {
            const starButtons = $('.ers-star-btn');
            const ratingInput = $('#rating-input');
            let selectedRating = 0; // Default rating

            // Handle star click (Final selection)
            starButtons.click(function () {
                selectedRating = $(this).data('value');
                ratingInput.val(selectedRating); // Update hidden input
                updateStars(selectedRating);
            });

            // Handle mouseenter (Hover effect)
            starButtons.mouseenter(function () {
                const hoverRating = $(this).data('value');
                updateStars(hoverRating);
            });

            // Handle mouseleave (Restore selected rating)
            starButtons.mouseleave(function () {
                updateStars(selectedRating);
            });

            function updateStars(rating) {
                starButtons.each(function () {
                    $(this).toggleClass('active', $(this).data('value') <= rating);
                });
            }

            // AJAX Form Submission
            $('#reviewForm').submit(function (e) {
                e.preventDefault(); // Prevent default form submission

                console.log("Submitting Form Data:", $(this).serialize()); // Debugging

                $.ajax({
                    url: "{{ route('front.reviewStore') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function (res) {
                        if (res.status === true) {
                            $('#submission-message').html('Review submitted successfully!')
                                .css('color', 'green');
                            $('#reviewForm')[0].reset(); // Reset form
                            selectedRating = 0; // Reset rating
                            updateStars(0); // Reset stars
                        } else {
                            $('#submission-message').html('Failed to submit review. Check your Fields.')
                                .css('color', 'red');

                        }
                    },
                    error: function (xhr) {
                        console.error("AJAX Error:", xhr.responseText);
                        alert("Something went wrong. Please try again.");
                    }
                });
            });

            // Toggle dropdown when clicking the button
            $(".dropdown-toggle").click(function (e) {
                e.stopPropagation(); // Prevents click from reaching body
                let dropdownMenu = $(this).siblings(".dropdown-menu");

                // Close any open dropdowns except the clicked one
                $(".dropdown-menu").not(dropdownMenu).slideUp(200);
                
                // Toggle the clicked dropdown
                dropdownMenu.slideToggle(200);
            });

            // Close dropdown when clicking outside
            $(document).click(function () {
                $(".dropdown-menu").slideUp(200);
            });

            // Prevent closing when clicking inside the menu
            $(".dropdown-menu").click(function (e) {
                e.stopPropagation();
            }); 
        });


        $('.edit-review-btn').on('click', function (e) {
            e.preventDefault();
            e.stopPropagation(); // Prevent dropdown from closing unexpectedly

            let reviewCard = $(this).closest('.ers-review-card'); // Find the nearest review card
            let firstReview = reviewCard.find('.first-review');
            let editReview = reviewCard.find('.edit-review');

            if (editReview.is(':visible')) {
                // If edit form is open, hide it and show the review text
                editReview.slideUp(200, function () {
                    firstReview.slideDown(300);
                });
            } else {
                // If edit form is hidden, hide the review text and show the edit form
                firstReview.slideUp(200, function () {
                    editReview.slideDown(300);
                });
            }
        });
    </script>

@endsection
