@extends('front.pages.layouts.app')

@section('content')
    
<!-- Hero Section Begin -->
<section class="hero">
    <div class="hero__slider owl-carousel">
        <div class="hero__items set-bg" data-setbg="{{ asset('front-assets/img/hero/hero-1.jpg') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-7 col-md-8">
                        <div class="hero__text">
                            <h6>Summer Collection</h6>
                            <h2>
                                Fall - Winter Collections 
                                <span class="current-year"></span>
                            </h2>
                            <p>A specialist label creating luxury essentials. Ethically crafted with an unwavering
                            commitment to exceptional quality.</p>
                            <a href="{{ route('front.shop') }}" class="primary-btn">Shop now <span class="arrow_right"></span></a>
                            <div class="hero__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero__items set-bg" data-setbg="{{ asset('front-assets/img/hero/hero-2.jpg') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-7 col-md-8">
                        <div class="hero__text">
                            <h6>Summer Collection</h6>
                            <h2>
                                Fall - Winter Collections 
                                <span class="current-year"></span>
                            </h2>
                            <p>A specialist label creating luxury essentials. Ethically crafted with an unwavering
                            commitment to exceptional quality.</p>
                            <a href="{{ route('front.shop') }}" class="primary-btn">Shop now <span class="arrow_right"></span></a>
                            <div class="hero__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<!-- Banner Section Begin -->
<section class="banner spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 offset-lg-4">
                <div class="banner__item">
                    <div class="banner__item__pic">
                        <img src="{{ asset('front-assets/img/banner/banner-1.jpg') }}" alt="">
                    </div>
                    <div class="banner__item__text">
                        <h2>
                            Clothing Collections 
                            <span class="current-year"></span>
                        </h2>
                        <a href="/male-fashion/shop?category%5B%5D=clothing">Shop now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="banner__item banner__item--middle">
                    <div class="banner__item__pic">
                        <img src="{{ asset('front-assets/img/banner/banner-2.jpg') }}" alt="">
                    </div>
                    <div class="banner__item__text">
                        <h2>Accessories</h2>
                        <a href="/male-fashion/shop?category%5B%5D=accessories">Shop now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="banner__item banner__item--last">
                    <div class="banner__item__pic">
                        <img src="{{ asset('front-assets/img/banner/banner-3.jpg') }}" alt="">
                    </div>
                    <div class="banner__item__text">
                        <h2>
                            Shoes Spring 
                            <span class="current-year"></span>
                        </h2>
                        <a href="/male-fashion/shop?category%5B%5D=shoes">Shop now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="filter__controls">
                    <li class="active" data-filter="*">Best Sellers</li>
                    <li data-filter=".new-arrivals">New Arrivals</li>
                    <li data-filter=".hot-sales">Hot Sales</li>
                </ul>
            </div>
        </div>
        <div class="row product__filter">
            @if ($products->isNotEmpty()) 
                @foreach ($products->take(8) as  $product) 
                    <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="{{ asset('uploads/product-image/' . $product->image) }}">
                                {{-- <span class="label">New</span> --}}
                                <ul class="product__hover">
                                    @if (whishlistedProducts()->contains('product_id', $product->id))
                                        <li><a href="javascript:void(0)" id="whishlist-{{ $product->id }}" onclick="whishlist({{ $product->id }})"><img src="{{ asset('front-assets/img/icon/heart-filled.png') }}" width="36" alt=""></a></li>
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
                                {{-- <div class="product__color__select">
                                    <label for="pc-1">
                                        <input type="radio" id="pc-1">
                                    </label>
                                    <label class="active black" for="pc-2">
                                        <input type="radio" id="pc-2">
                                    </label>
                                    <label class="grey" for="pc-3">
                                        <input type="radio" id="pc-3">
                                    </label>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    @endforeach 
                @endif
            @if ($productsOnSale->isNotEmpty())
                @foreach ($productsOnSale->take(8) as $productOnSale)
                    <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix hot-sales">
                        <div class="product__item sale">
                            <div class="product__item__pic set-bg" data-setbg="{{ asset('uploads/product-image/' . $productOnSale->image) }}">
                                <span class="label">Sale</span>
                                <ul class="product__hover">
                                    @if (whishlistedProducts()->contains('product_id', $productOnSale->id))
                                        <li><a href="javascript:void(0)" id="whishlist-{{ $productOnSale->id }}" onclick="whishlist({{ $productOnSale->id }})"><img src="{{ asset('front-assets/img/icon/heart-filled.png') }}" width="36" alt=""></a></li>
                                    @else
                                        <li><a href="javascript:void(0)" id="whishlist-{{ $productOnSale->id }}" onclick="whishlist({{ $productOnSale->id }})"><img src="{{ asset('front-assets/img/icon/heart.png') }}" alt=""></a></li>
                                    @endif
                                    <li><a href="javascript:void(0)" onclick="addToCart({{ $productOnSale->id }})"><img src="{{ asset('front-assets/img/icon/cart.png') }}" alt=""> <span>Add To Cart</span></a></li>
                                    <li><a href="{{ route('front.product', $productOnSale->slug) }}"><img src="{{ asset('front-assets/img/icon/search.png') }}" alt=""></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6 class="product-title"><a href="{{ route('front.product', $productOnSale->slug) }}">{{ $productOnSale->title }}</a></h6>
                                {{-- <a href="#" class="add-cart">+ Add To Cart</a> --}}
                                <div class="rating">
                                    @php
                                        $averageRating = getAverageRating($productOnSale->id);
                                    @endphp
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= floor($averageRating))
                                            <i class="fa fa-star"></i> <!-- Full Star -->
                                        @else
                                            <i class="fa fa-star-o"></i> <!-- Empty Star -->
                                        @endif
                                    @endfor
                                </div>
                                @if ($productOnSale->sale_price > 0)
                                    <h5>
                                        ${{ $productOnSale->sale_price }} 
                                        <span>${{ $productOnSale->price}}</span>
                                    </h5>
                                @else
                                    <h5>
                                        ${{ $productOnSale->price }} 
                                    </h5>
                                @endif
                                {{-- <div class="product__color__select">
                                    <label for="pc-4">
                                        <input type="radio" id="pc-4">
                                    </label>
                                    <label class="active black" for="pc-5">
                                        <input type="radio" id="pc-5">
                                    </label>
                                    <label class="grey" for="pc-6">
                                        <input type="radio" id="pc-6">
                                    </label>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

        </div>
    </div>
</section>
<!-- Product Section End -->

<!-- Categories Section Begin -->
@if($highestDiscountProduct)
<section class="categories spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="categories__text">
                    <h2>Clothings Hot <br /> <span>Shoe Collection</span> <br /> Accessories</h2>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="categories__hot__deal">
                    <img src="{{ asset('uploads/product-image/' . $highestDiscountProduct->image) }}" alt="" style="width: 100%; height: 400px; object-fit:contain;">
                    <div class="hot__deal__sticker">
                        <span>{{ round((($highestDiscountProduct->price - $highestDiscountProduct->sale_price) / $highestDiscountProduct->price) * 100) }}% OFF</span>
                        <h5>${{ $highestDiscountProduct->sale_price }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 offset-lg-1">
                <div class="categories__deal__countdown">
                    <span>Deal Of The Week</span>
                    <h2>{{ $highestDiscountProduct->title }}</h2>
                    <p>{{ $highestDiscountProduct->short_desc }}</p>
                    <a href="{{ route('front.product', $highestDiscountProduct->slug) }}" class="primary-btn">Shop now</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
<!-- Categories Section End -->

<!-- Instagram Section Begin -->
<section class="instagram spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="instagram__pic">
                    <div class="instagram__pic__item set-bg" data-setbg="{{ asset('front-assets/img/instagram/instagram-1.jpg') }}"></div>
                    <div class="instagram__pic__item set-bg" data-setbg="{{ asset('front-assets/img/instagram/instagram-2.jpg') }}"></div>
                    <div class="instagram__pic__item set-bg" data-setbg="{{ asset('front-assets/img/instagram/instagram-3.jpg') }}"></div>
                    <div class="instagram__pic__item set-bg" data-setbg="{{ asset('front-assets/img/instagram/instagram-4.jpg') }}"></div>
                    <div class="instagram__pic__item set-bg" data-setbg="{{ asset('front-assets/img/instagram/instagram-5.jpg') }}"></div>
                    <div class="instagram__pic__item set-bg" data-setbg="{{ asset('front-assets/img/instagram/instagram-6.jpg') }}"></div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="instagram__text">
                    <h2>Instagram</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                    labore et dolore magna aliqua.</p>
                    <h3>#Male_Fashion</h3>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Instagram Section End -->

<!-- Latest Blog Section Begin -->
<section class="latest spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <span>Latest News</span>
                    <h2>Fashion New Trends</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic set-bg" data-setbg="{{ asset('front-assets/img/blog/blog-1.jpg') }}"></div>
                    <div class="blog__item__text">
                        <span><img src="{{ asset('front-assets/img/icon/calendar.png') }}" alt=""> 16 February 2020</span>
                        <h5>What Curling Irons Are The Best Ones</h5>
                        <a href="#">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic set-bg" data-setbg="{{ asset('front-assets/img/blog/blog-2.jpg') }}"></div>
                    <div class="blog__item__text">
                        <span><img src="{{ asset('front-assets/img/icon/calendar.png') }}" alt=""> 21 February 2020</span>
                        <h5>Eternity Bands Do Last Forever</h5>
                        <a href="#">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic set-bg" data-setbg="{{ asset('front-assets/img/blog/blog-3.jpg') }}"></div>
                    <div class="blog__item__text">
                        <span><img src="{{ asset('front-assets/img/icon/calendar.png') }}" alt=""> 28 February 2020</span>
                        <h5>The Health Benefits Of Sunglasses</h5>
                        <a href="#">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Latest Blog Section End -->
@endsection