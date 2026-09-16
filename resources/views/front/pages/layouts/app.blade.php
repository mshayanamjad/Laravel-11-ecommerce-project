<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('front-title')Male Fashion</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
    rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('front-assets/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('front-assets/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('front-assets/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('front-assets/css/magnific-popup.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('front-assets/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('front-assets/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('front-assets/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('front-assets/css/style.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('front-assets/css/review.css') }}" type="text/css">
    <style>
        .header__top__notification {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 16px;
        }

        .header__top__notification .dropdown-toggle {
            display: inline-flex;
            width: 34px;
            height: 34px;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-decoration: none;
            border-radius: 50%;
            transition: background-color .2s ease;
        }

        .header__top__notification .dropdown-toggle:hover,
        .header__top__notification .dropdown-toggle:focus {
            color: #fff;
            background: rgba(255, 255, 255, .15);
            outline: none;
        }

        .header__top__notification .notification-badge {
            position: absolute;
            top: -3px;
            right: -4px;
            min-width: 19px;
            height: 19px;
            border-radius: 50%;
            background: #e74c3c;
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            line-height: 19px;
            text-align: center;
            border: 2px solid #111;
        }

        .notification-menu {
            width: 340px;
            max-width: calc(100vw - 30px);
            margin-top: 12px;
            border: 1px solid #e9ecef !important;
            border-radius: 10px;
            padding: 0;
            overflow: hidden;
            box-shadow: 0 12px 30px rgba(0, 0, 0, .16) !important;
        }

        .notification-menu::before {
            content: '';
            position: absolute;
            top: -6px;
            right: 18px;
            width: 12px;
            height: 12px;
            background: #fff;
            border-left: 1px solid #e9ecef;
            border-top: 1px solid #e9ecef;
            transform: rotate(45deg);
        }

        .notification-menu .dropdown-item {
            position: relative;
            z-index: 1;
            display: block;
            padding: 12px 15px !important;
            white-space: normal;
            border-bottom: 1px solid #f2f2f2;
            background: #fff;
            transition: background-color .2s ease;
        }

        .notification-menu .dropdown-item:hover,
        .notification-menu .dropdown-item:focus {
            background: #f8f9fa;
        }

        .notification-menu .dropdown-item:last-child {
            border-bottom: none;
        }

        .notification-menu .notification-empty {
            cursor: default;
        }

        @media (max-width: 575px) {
            .notification-menu {
                position: fixed !important;
                top: 42px !important;
                right: 15px !important;
                left: auto !important;
                transform: none !important;
            }
        }
    </style>
    <!-- Chatbot Styles -->    
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
                <a href="#">Sign in</a>
                <a href="#">FAQs</a>
            </div>
            <div class="offcanvas__top__hover">
                <span>Usd <i class="arrow_carrot-down"></i></span>
                <ul>
                    <li>USD</li>
                    <li>EUR</li>
                    <li>USD</li>
                </ul>
            </div>
        </div>
        <div class="offcanvas__nav__option">
            <a href="#" class="search-switch"><img src="{{ asset('front-assets/img/icon/search.png') }}" alt=""></a>
            <a href="#"><img src="{{ asset('front-assets/img/icon/heart.png') }}" alt=""></a>
            <a href="#"><img src="{{ asset('front-assets/img/icon/cart.png') }}" alt=""> <span>0</span></a>
            <div class="price">$0.00</div>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__text">
            <p>Free shipping, 30-day return or refund guarantee.</p>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-7">
                        <div class="header__top__left">
                            <p>Free shipping, 30-day return or refund guarantee.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5">
                        <div class="header__top__right">
                            {{-- <div class="header__top__links">
                                <a href="#">FAQs</a>
                            </div>
                            <div class="header__top__hover">
                                <span>Usd <i class="arrow_carrot-down"></i></span>
                                <ul>
                                    <li>USD</li>
                                    <li>EUR</li>
                                    <li>USD</li>
                                </ul>
                            </div> --}}


                            <div class="header__top__hover user-name">
                                @if (auth()->check())
                                    <span>Hi, {{ explode(' ', auth()->user()->name)[0] }} <i class="arrow_carrot-down"></i></span>
                                    <ul class="py-2 profile-options">
                                        <li class="text-left">
                                            <a class="d-block w-100" href="{{ route('front.userProfile') }}">Profile</a>
                                        </li>
                                        <li class="text-left">
                                            <a class="d-block w-100" href="{{ route('front.orderList') }}">My Orders</a>
                                        </li>
                                        <li class="text-left">
                                            <a class="d-block w-100 position-relative" href="{{ route('front.notifications') }}">Notifications 
                                                @if (auth()->user()->unreadNotifications->count() > 0)
                                                <span class="badge badge-danger" style="position:absolute; right:18px; top:6px; min-width:18px; height:18px; padding:2px 5px; border-radius:50%; font-size:10px; line-height:14px;">{{ auth()->user()->unreadNotifications->count() }}</span>
                                                @endif
                                            </a>
                                        </li>
                                        <li class="text-left">
                                            <a class="d-block w-100" href="{{ route('front.changePassword') }}">Change Password</a>
                                        </li>
                                        <li class="text-left">
                                            <a class="d-block w-100" href="{{ route('front.viewWishlist') }}">whishlist</a>
                                        </li>
                                        <li class="text-left">
                                            <a class="d-block w-100" href="{{ route('front.logout') }}">Logout</a>
                                        </li>
                                    </ul>
                                @else 
                                    <span><a href="{{ route('front.userLogin') }}">Sign in</a></span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="header__logo">
                        <a href="{{ route('front.home') }}"><img src="{{ asset('front-assets/img/logo.png') }}" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li class=""><a href="{{ route('front.home') }}">Home</a></li>
                            <li><a href="{{ route('front.shop') }}">Shop</a></li>
                            <li><a href="{{ route('front.about') }}">About Us</a></li>
                            <li><a href="{{ route('front.contact') }}">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="header__nav__option">
                        <a href="javascript:void(0)" class="search-switch"><img src="{{ asset('front-assets/img/icon/search.png') }}" alt=""></a>
                        <a href="{{ route('front.viewWishlist') }}"><img src="{{ asset('front-assets/img/icon/heart.png') }}" alt=""></a>
                        <?php
                            use Gloudemans\Shoppingcart\Facades\Cart;
                            use Illuminate\Support\Facades\Auth;
                    
                            // Set cart instance to the current user's ID
                            $user = Auth::user();
                            if ($user) {
                                Cart::instance($user->id);
                            }

                            $cartContent = Cart::content();
                        ?>
                        @if($cartContent)
                             <a onclick="openCart()" id="cart-icon" class="cart-img" href="javascript:void(0)">
                                <div style="display: inline-block; position: relative; margin-right: 25px;">
                                    <img src="{{ asset('front-assets/img/icon/cart.png') }}" alt=""> 
                                    <span>{{ Cart::count() }}</span>
                                </div>
                                <div class="price ms-4">${{ cartTotal() }}</div>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </header>
    <!-- Header Section End -->
    <div class="main">
        @yield('content')
    </div>


    
    <!-- Footer Section Begin -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__logo">
                            <a href="{{ route('front.home') }}"><img src="{{ asset('front-assets/img/footer-logo.png') }}" alt="Male Fashion"></a>
                        </div>
                        <p>Modern essentials for everyday style — premium fashion, curated for comfort, confidence, and quality.</p>
                        <a href="{{ route('front.shop') }}"><img src="{{ asset('front-assets/img/payment.png') }}" alt="Payment methods"></a>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-1 col-md-3 col-sm-6">
                    <div class="footer__widget">
                        <h6>Shop</h6>
                        <ul>
                            <li><a href="{{ route('front.home') }}">Home</a></li>
                            <li><a href="{{ route('front.shop') }}">Shop</a></li>
                            <li><a href="#">New Arrivals</a></li>
                            <li><a href="#">Sale</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="footer__widget">
                        <h6>Support</h6>
                        <ul>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Shipping</a></li>
                            <li><a href="#">Returns</a></li>
                            <li><a href="#">FAQ</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 offset-lg-1 col-md-6 col-sm-6">
                    <div class="footer__widget">
                        <h6>Newsletter</h6>
                        <div class="footer__newslatter">
                            <p>Get the latest product drops, styling inspiration, and promotional offers.</p>
                            <form action="#">
                                <input type="text" placeholder="Your email">
                                <button type="submit"><span class="icon_mail_alt"></span></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="footer__copyright__text">
                        <p>Copyright © <span class="current-year"></span> Male Fashion Store. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form action="{{ route('front.shop') }}" method="get" class="search-model-form">
                <input type="text" name="keyword" value="{{ request('keyword') }}" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search End -->
    <!-- Mini Cart Begin -->
    @if($cartContent)
        <div class="mini-cart" id="mini-cart">
            @include('front.pages.layouts.mini-cart')
        </div>
    @endif
    <!-- Mini Cart End -->
    <!-- Success Modal -->
    <div class="modal align-items-center justify-content-center" style="background: rgba(0, 0, 0, 0.5)" id="addFavModel" tabindex="-1">
        <div class="modal-dialog w-100">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="text-shadow: none">Modal title</h5>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <a href="" class="btn btn-primary">Go to whishlist</a>
            </div>
            </div>
        </div>
    </div>    
    

    <!-- Js Plugins -->
    <script src="{{ asset('front-assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('front-assets/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://js.stripe.com/v3/"></script>

    <script>
        const currYearElements = document.querySelectorAll('.current-year'); 
        const newDate = new Date().getFullYear();
    
        currYearElements.forEach(element => {
            element.textContent = newDate; // Correct way to update text
        });


        document.querySelector('.close-cart').addEventListener('click', () => {
        document.querySelector('.sidebar-cart').classList.remove('open');
        document.querySelector('.sidebar-cart-overlay').style.display = 'none';
        });

        document.querySelector('.sidebar-cart-overlay').addEventListener('click', () => {
        document.querySelector('.sidebar-cart').classList.remove('open');
        document.querySelector('.sidebar-cart-overlay').style.display = 'none';
        });

        // Example function to open the cart
        function openCart() {
        document.querySelector('.sidebar-cart').classList.add('open');
        document.querySelector('.sidebar-cart-overlay').style.display = 'block';
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });



        jQuery(document).ready(function($) {
            // Hide modal when clicking outside of it
            $(document).on('click', function(event) {
                if (!$(event.target).closest('#addFavModel .modal-content').length) {
                    $('#addFavModel').slideUp('slow');
                }
            });
        });

        function showAjaxMessage(message, success = true) {
            if (typeof toastr !== 'undefined') {
                if (success) {
                    toastr.success(message);
                } else {
                    toastr.error(message);
                }
                return;
            }

            alert(message);
        }

        function refreshMiniCart(response) {
            if (response && response.cartCount !== undefined) {
                var cartBadge = $('#cart-icon span');
                if (cartBadge.length) {
                    cartBadge.text(response.cartCount);
                }
            }

            if (response && response.miniCartHtml) {
                $('#mini-cart').html(response.miniCartHtml);
            }
        }

        function addToCart(id) {
            var quantity = $('#quantity-' + id).val();
            $.ajax({
                url: "{{ route('front.addToCart') }}",
                type: 'post',
                data: {
                    id: id,
                    quantity: quantity,
                },
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.status == true) {
                        showAjaxMessage(response.message, true);
                        refreshMiniCart(response);
                    } else {
                        showAjaxMessage(response.message, false);
                        if (response.redirect) {
                            setTimeout(function() {
                                window.location.href = response.redirect;
                            }, 800);
                        }
                    }
                },
                error: function(xhr) {
                    var response = xhr.responseJSON || {};
                    showAjaxMessage(response.message || 'Something went wrong.', false);
                }
            });
        }

        function deleteItem(rowId) {
            if (confirm('Are you sure you want to delete this item from the cart?')) {
                $.ajax({
                    url: "{{ route('front.deleteCartItem') }}",
                    type: 'post',
                    data: { rowId: rowId },
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        location.reload(); // Reload the page after successful deletion
                    }
                });
            }
        }
        

        function whishlist(id) {
            $.ajax({
                url: "{{ route('front.addToWishlist') }}",
                type: 'post',
                data: { id: id },
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.status == true) {
                        var btn = $('#whishlist-' + id);
                        if (btn.length) {
                            if (response.removed === true) {
                                btn.find('img').attr('src', "{{ asset('front-assets/img/icon/heart.png') }}");
                            } else {
                                btn.find('img').attr('src', "{{ asset('front-assets/img/icon/heart-filled.png') }}");
                            }
                        }
                        showAjaxMessage(response.message, true);
                    } else {
                        showAjaxMessage(response.message, false);
                        if (response.redirect) {
                            setTimeout(function() {
                                window.location.href = response.redirect;
                            }, 800);
                        }
                    }
                },
                error: function(xhr) {
                    var response = xhr.responseJSON || {};
                    showAjaxMessage(response.message || 'Something went wrong.', false);
                }
            });
        }

        function removeWhishlist(id) {
            $.ajax({
                url: "{{ route('front.reomveWhishlistPro') }}",
                type: 'post',
                data: {id:id},
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.status == true) {
                        showAjaxMessage(response.message, true);
                        var btn = $('#whishlist-' + id);
                        if (btn.length) {
                            btn.find('img').attr('src', "{{ asset('front-assets/img/icon/heart.png') }}");
                        }
                        $('#wishlist-item-' + id).remove();
                    } else {
                        showAjaxMessage(response.message, false);
                    }
                },
                error: function(xhr) {
                    var response = xhr.responseJSON || {};
                    showAjaxMessage(response.message || 'Something went wrong.', false);
                }
            });
        }

    </script>
    @yield('customJS')
</body>
</html>