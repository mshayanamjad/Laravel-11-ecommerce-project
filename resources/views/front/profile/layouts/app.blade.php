<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>@yield('title')Male Fashion</title>
        <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
    
        <!-- Fonts and icons -->
        <script src="{{ asset('admin-assets/js/plugin/webfont/webfont.min.js') }}"></script>
        <script>
          WebFont.load({
            google: { families: ["Public Sans:300,400,500,600,700"] },
            custom: {
              families: ["Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
              urls: ["{{ asset('admin-assets/css/fonts.min.css') }}"],
            },
            active: function () {
              sessionStorage.fonts = true;
            },
          });
        </script>
    
        <!-- CSS Files -->
        <link rel="stylesheet" href="{{ asset('admin-assets/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('admin-assets/css/plugins.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('admin-assets/css/kaiadmin.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('admin-assets/plugins/summernote/summernote-bs5.min.css') }}">
    
        <!-- CSS Just for demo purpose, don't include it in your project -->
        <link rel="stylesheet" href="{{ asset('admin-assets/css/demo.css') }}" />
        <style>        
            .order-info {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 20px 80px;
                margin: 24px 0 0;
            }
            .items-list {
                margin: 20px 0;
                border-top: 1px solid #eee;
                padding-top: 16px;
            }

            .item-row {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 12px 0;
                border-bottom: 1px solid #f5f5f5;
            }

            .item-info {
                display: flex;
                align-items: center;
                gap: 16px;
            }
            .item-image {
                width: 50px;
                height: 50px;
                border-radius: 8px;
                object-fit: cover;
            }

            .info-group p {
                font-size: 14px;
                color: #333;
                margin-bottom: 4px;
            }

            .info-group p .badge {
                font-size: 16px;
                padding: 8px 10px;
                min-width: 100px;
                border-radius: 50px;
            }
        
            /* .info-group h4 {
                font-size: 0.9rem;
                color: #666;
                margin-bottom: 8px;
        }
        
        
        
            .totals {
                margin-top: 24px;
                text-align: right;
            }
        
            .totals p {
                margin-bottom: 8px;
                color: #666;
            }
        
            .status-badge {
                padding: 6px 12px;
                border-radius: 20px;
                font-size: 0.85rem;
                font-weight: 500;
                background: #e8f5e9;
                color: #2e7d32;
                display: inline-block;
            }
        
            .action-buttons {
                margin-top: 24px;
                display: flex;
                gap: 12px;
                justify-content: flex-end;
            }
        
            .btn {
                padding: 10px 20px;
                border: none;
                border-radius: 8px;
                cursor: pointer;
                font-weight: 500;
            }
        
            .btn-primary {
                background: #2196f3;
                color: white;
            }
        
            .btn-secondary {
                background: #eee;
                color: #333;
            } */

            .front-nav a {
                color: #111111 !important;
                font-weight: 500 !important;
                font-size: 16px !important;
            }
        
            @media (max-width: 480px) {
                .order-info {
                    grid-template-columns: 1fr;
                }
            }
        </style>
    </head>
<body>
    <div class="wrapper">
      <!-- Sidebar -->
        @include('front.profile.layouts.sidebar')
      <!-- End Sidebar -->

        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <!-- Logo Header -->
                    <div class="logo-header" data-background-color="dark">
                        <a href="index.html" class="logo">
                            <img src="{{ asset('admin-assets/img/logo.png') }}" alt="navbar brand" class="navbar-brand" height="20" />
                        </a>
                        <div class="nav-toggle">
                            <button class="btn btn-toggle toggle-sidebar">
                            <i class="gg-menu-right"></i>
                            </button>
                            <button class="btn btn-toggle sidenav-toggler">
                            <i class="gg-menu-left"></i>
                            </button>
                        </div>
                        <button class="topbar-toggler more">
                            <i class="gg-more-vertical-alt"></i>
                        </button>
                    </div>
                    <!-- End Logo Header -->
                </div>
                <!-- Navbar Header -->
                <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
                    <div class="container-fluid">
                        <ul class="navbar-nav topbar-nav front-nav">
                            <li class="nav-item">
                                <a href="{{ route('front.home') }}" class="nav-link">Home</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('front.shop') }}" class="nav-link">Shop</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Contact</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                            <li class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#"
                                    role="button" aria-expanded="false" aria-haspopup="true">
                                    <i class="fa fa-search"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-search animated fadeIn">
                                    <form class="navbar-left navbar-form nav-search">
                                    <div class="input-group">
                                        <input type="text" placeholder="Search ..." class="form-control"/>
                                    </div>
                                    </form>
                                </ul>
                            </li>
                            <li class="nav-item topbar-user dropdown hidden-caret">
                                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown"  href="#" aria-expanded="false" >
                                    <div class="avatar-sm d-flex justify-content-center align-items-center" style="width: 40px; height: 40px; border-radius: 50%; overflow: hidden; font-size: 16px; font-weight: bold; color: white;">
                                        @if (!empty(auth()->user()->avatar))
                                            <img src="{{ asset('uploads/profiles/' . auth()->user()->avatar) }}" alt="image profile" class="avatar-img rounded-circle" style="width: 100%; height: 100%; object-fit: cover;">
                                        @else
                                            @php
                                                $user = auth()->user();
                                                $firstLetter = strtoupper(substr($user->name, 0, 1));
                                                $colors = ['#FF5733', '#33FF57', '#3357FF', '#F333FF', '#FF33A1', '#FFC133', '#33FFC1'];
                                                $hash = crc32($user->email); // Generate a consistent hash based on email
                                                $index = $hash % count($colors); // Map hash to a color index
                                                $bgColor = $colors[$index];
                                            @endphp
                                            <div style="background-color: {{ $bgColor }}; width: 100%; height: 100%; display: flex; justify-content: center; align-items: center;">
                                                {{ $firstLetter }}
                                            </div>
                                        @endif
                                    </div>
                                
                                
                                    <span class="profile-username">
                                    <span class="op-7">Hi,</span>
                                    <span class="fw-bold">{{ explode(' ', auth()->user()->name)[0] }}</span>
                                    </span>
                                </a>
                                <ul class="dropdown-menu dropdown-user animated fadeIn">
                                    <div class="dropdown-user-scroll scrollbar-outer">
                                    <li>
                                        <div class="user-box">
                                            <div class="u-text p-0">
                                                <h4>{{ auth()->user()->name }}</h4>
                                                <p class="text-muted">{{ auth()->user()->email }}</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ route('front.logout') }}">Logout</a>
                                    </li>
                                    </div>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- End Navbar -->
            </div>

            <!-- Content -->
            @yield('content')
            <!-- End Content -->

            <footer class="footer">
                <div class="container-fluid d-flex justify-content-between">
                <nav class="pull-left">
                    <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="http://www.themekita.com">
                        ThemeKita
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"> Help </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"> Licenses </a>
                    </li>
                    </ul>
                </nav>
                <div class="copyright">
                    2024, made with <i class="fa fa-heart heart text-danger"></i> by
                    <a href="http://www.themekita.com">ThemeKita</a>
                </div>
                <div>
                    Distributed by
                    <a target="_blank" href="https://themewagon.com/">ThemeWagon</a>.
                </div>
                </div>
            </footer>
        </div>
    <!-- End Custom template -->
    </div>
    <!-- Core JS Files -->
    <script src="{{ asset('admin-assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/core/bootstrap.min.js') }}"></script>

    <!-- jQuery Plugins -->
    <script src="{{ asset('admin-assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Chart Libraries -->
    <script src="{{ asset('admin-assets/js/plugin/chart.js/chart.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/plugin/chart-circle/circles.min.js') }}"></script>

    <!-- Datatables -->
    <script src="{{ asset('admin-assets/js/plugin/datatables/datatables.min.js') }}"></script>

    <!-- Notifications -->
    <script src="{{ asset('admin-assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    <!-- Vector Maps -->
    <script src="{{ asset('admin-assets/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/plugin/jsvectormap/world.js') }}"></script>

    <!-- SweetAlert -->
    <script src="{{ asset('admin-assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>


    <!-- Kaiadmin Core and Demo Scripts -->
    <script src="{{ asset('admin-assets/js/kaiadmin.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/setting-demo.js') }}"></script>
    <script src="{{ asset('admin-assets/js/demo.js') }}"></script>

    <!-- Summernote Scripts -->
    <script src="{{ asset('admin-assets/plugins/summernote/summernote-bs5.min.js') }}"></script>

    @yield('customJs')
</body>
</html>
