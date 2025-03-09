@extends('front.pages.layouts.app')

@section('front-title', 'Shop - ')
@section('content')

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Shop</h4>
                    <div class="breadcrumb__links">
                        <a href="{{ route('front.home') }}">Home</a>
                        <span>Shop</span>
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
        @include('front.profile.layouts.message')
        <div class="row">
            <div class="col-lg-3">
                @include('front.pages.layouts.filter')
            </div>
            <div class="col-lg-9">
                <div class="row">
                    @if ($products->isNotEmpty()) 
                        @foreach ($products as $product)
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item sale">
                                    <div class="product__item__pic set-bg" data-setbg="{{ asset('uploads/product-image/' . $product->image) }}">
                                        @if ($product->sale_price)
                                            <span class="label">Sale</span>
                                        @endif
                                        <ul class="product__hover">
                                            @if (whishlistedProducts()->contains('product_id', $product->id))
                                                <li><a href="javascript:void(0)" id="whishlist-{{ $product->id }}" onclick="removeWhishlist({{ $product->id }})"><img src="{{ asset('front-assets/img/icon/heart-filled.png') }}" width="36" alt=""></a></li>
                                            @else
                                                <li><a href="javascript:void(0)" id="whishlist-{{ $product->id }}" onclick="whishlist({{ $product->id }})"><img src="{{ asset('front-assets/img/icon/heart.png') }}" alt=""></a></li>
                                            @endif
                                            <li><a href="javascript:void(0)" onclick="addToCart({{ $product->id }})"><img src="{{ asset('front-assets/img/icon/cart.png') }}" alt=""> <span>Add To Cart</span></a></li>
                                            <li><a href="{{ route('front.product', $product->slug) }}"><img src="{{ asset('front-assets/img/icon/search.png') }}" alt=""></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6 class="product-title"><a href="{{ route('front.product', $product->slug) }}">{{ $product->title }}</a></h6>
                                        {{-- <a href="#" class="add-cart">+ Add To Cart</a> --}}
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
                                        </div>
                                        @if ($product->sale_price > 0)
                                            <h5>
                                                ${{ $product->sale_price }} 
                                                <span>${{ $product->price}}</span>
                                            </h5>
                                        @else
                                            <h5>
                                                ${{ $product->price }} 
                                            </h5>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach 
                    @endif
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__pagination">
                            {{-- <a class="active" href="#">1</a>
                            <a href="#">2</a>
                            <a href="#">3</a>
                            <span>...</span>
                            <a href="#">21</a> --}}
                        </div>
                        {{ $products->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Section End -->
@endsection
@section('customJS')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    // Get all checkboxes
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');

    checkboxes.forEach(checkbox => {
        // Add event listener to each checkbox
        checkbox.addEventListener('change', function() {
            // Find the associated label
            const label = document.querySelector(`label[for="${this.id}"]`);
            
            // Toggle the bold class based on checkbox state
            if (this.checked) {
                label.classList.add('bold-label');
            } else {
                label.classList.remove('bold-label');
            }
        });

        // Initialize the bold class if the checkbox is already checked
        if (checkbox.checked) {
            const label = document.querySelector(`label[for="${checkbox.id}"]`);
            label.classList.add('bold-label');
        }
    });
});
    </script>
@endsection