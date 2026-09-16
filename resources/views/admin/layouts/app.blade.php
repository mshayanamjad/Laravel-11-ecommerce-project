<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>@yield('title')Admin Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />

    <!-- Fonts and icons -->
    <script src="{{ asset('admin-assets/js/plugin/webfont/webfont.min.js') }}"></script>

    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: ["{{ asset('admin-assets/css/fonts.min.css') }}"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('admin-assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin-assets/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin-assets/css/kaiadmin.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/summernote/summernote-bs5.min.css') }}">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css">

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{ asset('admin-assets/css/demo.css') }}" />
</head>

<body>

    <div class="wrapper">

        <!-- Sidebar -->
        @include('admin.layouts.sidebar')
        <!-- End Sidebar -->

        <div class="main-panel">

            <div class="main-header">

                <div class="main-header-logo">

                    <!-- Logo Header -->
                    <div class="logo-header" data-background-color="dark">

                        <a href="index.html" class="logo">
                            <img src="{{ asset('admin-assets/img/logo.png') }}"
                                alt="navbar brand"
                                class="navbar-brand"
                                height="20" />
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

                        <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">

                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <button type="submit" class="btn btn-search pe-1">
                                        <i class="fa fa-search search-icon"></i>
                                    </button>
                                </div>

                                <input
                                    type="text"
                                    placeholder="Search ..."
                                    class="form-control" />

                            </div>

                        </nav>


                        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">

                            <!-- Mobile Search -->
                            <li class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">

                                <a
                                    class="nav-link dropdown-toggle"
                                    data-bs-toggle="dropdown"
                                    href="#"
                                    role="button"
                                    aria-expanded="false"
                                    aria-haspopup="true">

                                    <i class="fa fa-search"></i>

                                </a>

                                <ul class="dropdown-menu dropdown-search animated fadeIn">

                                    <form class="navbar-left navbar-form nav-search">

                                        <div class="input-group">

                                            <input
                                                type="text"
                                                placeholder="Search ..."
                                                class="form-control" />

                                        </div>

                                    </form>

                                </ul>

                            </li>


                            <!-- Messages -->
                            <li class="nav-item topbar-icon dropdown hidden-caret">

                                <a
                                    class="nav-link dropdown-toggle"
                                    href="#"
                                    id="messageDropdown"
                                    role="button"
                                    data-bs-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false">

                                    <i class="fa fa-envelope"></i>

                                </a>

                                <ul
                                    class="dropdown-menu messages-notif-box animated fadeIn"
                                    aria-labelledby="messageDropdown">

                                    <li>

                                        <div class="dropdown-title d-flex justify-content-between align-items-center">

                                            Messages

                                            <a href="#" class="small">
                                                Mark all as read
                                            </a>

                                        </div>

                                    </li>

                                    <li>

                                        <div class="message-notif-scroll scrollbar-outer">

                                            <div class="notif-center">

                                                <a href="#">

                                                    <div class="notif-img">

                                                        <img
                                                            src="{{ asset('admin-assets/img/jm_denis.jpg') }}"
                                                            alt="Img Profile" />

                                                    </div>

                                                    <div class="notif-content">

                                                        <span class="subject">
                                                            Jimmy Denis
                                                        </span>

                                                        <span class="block">
                                                            How are you ?
                                                        </span>

                                                        <span class="time">
                                                            5 minutes ago
                                                        </span>

                                                    </div>

                                                </a>


                                                <a href="#">

                                                    <div class="notif-img">

                                                        <img
                                                            src="{{ asset('admin-assets/img/chadengle.jpg') }}"
                                                            alt="Img Profile" />

                                                    </div>

                                                    <div class="notif-content">

                                                        <span class="subject">
                                                            Chad
                                                        </span>

                                                        <span class="block">
                                                            Ok, Thanks !
                                                        </span>

                                                        <span class="time">
                                                            12 minutes ago
                                                        </span>

                                                    </div>

                                                </a>


                                                <a href="#">

                                                    <div class="notif-img">

                                                        <img
                                                            src="{{ asset('admin-assets/img/mlane.jpg') }}"
                                                            alt="Img Profile" />

                                                    </div>

                                                    <div class="notif-content">

                                                        <span class="subject">
                                                            Jhon Doe
                                                        </span>

                                                        <span class="block">
                                                            Ready for the meeting today...
                                                        </span>

                                                        <span class="time">
                                                            12 minutes ago
                                                        </span>

                                                    </div>

                                                </a>


                                                <a href="#">

                                                    <div class="notif-img">

                                                        <img
                                                            src="{{ asset('admin-assets/img/talha.jpg') }}"
                                                            alt="Img Profile" />

                                                    </div>

                                                    <div class="notif-content">

                                                        <span class="subject">
                                                            Talha
                                                        </span>

                                                        <span class="block">
                                                            Hi, Apa Kabar ?
                                                        </span>

                                                        <span class="time">
                                                            17 minutes ago
                                                        </span>

                                                    </div>

                                                </a>

                                            </div>

                                        </div>

                                    </li>

                                    <li>

                                        <a
                                            class="see-all"
                                            href="javascript:void(0);">

                                            See all messages
                                            <i class="fa fa-angle-right"></i>

                                        </a>

                                    </li>

                                </ul>

                            </li>


                            <!-- ================================================= -->
                            <!-- DYNAMIC NOTIFICATIONS -->
                            <!-- ================================================= -->

                            @php
                                $adminUser = Auth::guard('admin')->user();

                                $unreadNotifications = $adminUser
                                    ? $adminUser->unreadNotifications
                                    : collect();

                                $notifications = $adminUser
                                    ? $adminUser->notifications()
                                        ->latest()
                                        ->take(5)
                                        ->get()
                                    : collect();

                                /*
                                 * Determine notification icon/color.
                                 *
                                 * If your notification data contains:
                                 *
                                 * 'type' => 'user'
                                 * 'type' => 'comment'
                                 * 'type' => 'success'
                                 * 'type' => 'danger'
                                 *
                                 * those values will be used.
                                 *
                                 * Otherwise "primary" is used.
                                 */
                                $notificationStyles = [
                                    'user' => [
                                        'icon' => 'fa-user-plus',
                                        'class' => 'notif-primary',
                                    ],
                                    'registered' => [
                                        'icon' => 'fa-user-plus',
                                        'class' => 'notif-primary',
                                    ],
                                    'comment' => [
                                        'icon' => 'fa-comment',
                                        'class' => 'notif-success',
                                    ],
                                    'message' => [
                                        'icon' => 'fa-envelope',
                                        'class' => 'notif-primary',
                                    ],
                                    'success' => [
                                        'icon' => 'fa-check',
                                        'class' => 'notif-success',
                                    ],
                                    'order' => [
                                        'icon' => 'fa-shopping-cart',
                                        'class' => 'notif-primary',
                                    ],
                                    'heart' => [
                                        'icon' => 'fa-heart',
                                        'class' => 'notif-danger',
                                    ],
                                    'danger' => [
                                        'icon' => 'fa-exclamation',
                                        'class' => 'notif-danger',
                                    ],
                                    'warning' => [
                                        'icon' => 'fa-exclamation-triangle',
                                        'class' => 'notif-warning',
                                    ],
                                    'info' => [
                                        'icon' => 'fa-info',
                                        'class' => 'notif-info',
                                    ],
                                ];
                            @endphp


                            <li class="nav-item topbar-icon dropdown hidden-caret">

                                <a
                                    class="nav-link dropdown-toggle"
                                    href="#"
                                    id="notifDropdown"
                                    role="button"
                                    data-bs-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false">

                                    <i class="fa fa-bell"></i>

                                    @if ($unreadNotifications->count() > 0)

                                        <span class="notification">
                                            {{ $unreadNotifications->count() }}
                                        </span>

                                    @endif

                                </a>


                                <ul
                                    class="dropdown-menu notif-box animated fadeIn"
                                    aria-labelledby="notifDropdown">


                                    <!-- Notification Header -->
                                    <li>

                                        <div class="dropdown-title">

                                            @if ($unreadNotifications->count() > 0)

                                                You have
                                                {{ $unreadNotifications->count() }}
                                                new
                                                {{ $unreadNotifications->count() == 1 ? 'notification' : 'notifications' }}

                                            @else

                                                You have no new notifications

                                            @endif

                                        </div>

                                    </li>


                                    <!-- Notification List -->
                                    <li>

                                        <div class="notif-scroll scrollbar-outer">

                                            <div class="notif-center">


                                                @forelse ($notifications as $notification)

                                                    @php

                                                        $type = data_get(
                                                            $notification,
                                                            'data.type',
                                                            'info'
                                                        );

                                                        $style = $notificationStyles[$type]
                                                            ?? [
                                                                'icon' => 'fa-bell',
                                                                'class' => 'notif-primary',
                                                            ];

                                                        $title = data_get(
                                                            $notification,
                                                            'data.title',
                                                            'Notification'
                                                        );

                                                        $message = data_get(
                                                            $notification,
                                                            'data.message',
                                                            ''
                                                        );

                                                        /*
                                                         * Allow custom icon from notification data.
                                                         *
                                                         * Example:
                                                         * 'icon' => 'fa-user'
                                                         */
                                                        $customIcon = data_get(
                                                            $notification,
                                                            'data.icon'
                                                        );

                                                        /*
                                                         * Allow custom notification class.
                                                         *
                                                         * Example:
                                                         * 'color' => 'notif-danger'
                                                         */
                                                        $customClass = data_get(
                                                            $notification,
                                                            'data.color'
                                                        );

                                                        $icon = $customIcon ?: $style['icon'];
                                                        $iconClass = $customClass ?: $style['class'];

                                                    @endphp


                                                    <a
                                                        href="{{ route('admin.notifications.read', ['id' => $notification->id]) }}"
                                                        class="{{ $notification->read_at ? '' : 'fw-bold' }}">


                                                        <div class="notif-icon {{ $iconClass }}">

                                                            <i class="fa {{ $icon }}"></i>

                                                        </div>


                                                        <div class="notif-content">

                                                            @if ($title)

                                                                <span class="block">
                                                                    {{ $title }}
                                                                </span>

                                                            @endif


                                                            @if ($message)

                                                                <span class="block">
                                                                    {{ $message }}
                                                                </span>

                                                            @endif


                                                            <span class="time">

                                                                {{ $notification->created_at->diffForHumans() }}

                                                            </span>

                                                        </div>

                                                    </a>


                                                @empty

                                                    <!-- Empty State -->
                                                    <a href="{{ route('admin.notifications') }}">

                                                        <div class="notif-icon notif-primary">

                                                            <i class="fa fa-check"></i>

                                                        </div>


                                                        <div class="notif-content">

                                                            <span class="block">
                                                                No notifications
                                                            </span>

                                                            <span class="time">
                                                                You are all caught up.
                                                            </span>

                                                        </div>

                                                    </a>

                                                @endforelse


                                            </div>

                                        </div>

                                    </li>


                                    <!-- See All -->
                                    <li>

                                        <a
                                            class="see-all"
                                            href="{{ route('admin.notifications') }}">

                                            See all notifications

                                            <i class="fa fa-angle-right"></i>

                                        </a>

                                    </li>

                                </ul>

                            </li>


                            <!-- User Profile -->
                            <li class="nav-item topbar-user dropdown hidden-caret">

                                <a
                                    class="dropdown-toggle profile-pic"
                                    data-bs-toggle="dropdown"
                                    href="#"
                                    aria-expanded="false">

                                    <div
                                        class="avatar-sm d-flex justify-content-center align-items-center"
                                        style="
                                            width: 40px;
                                            height: 40px;
                                            border-radius: 50%;
                                            overflow: hidden;
                                            font-size: 16px;
                                            font-weight: bold;
                                            color: white;
                                        ">

                                        @if (!empty(Auth::guard('admin')->user()->avatar))

                                            <img
                                                src="{{ asset('uploads/profiles/' . Auth::guard('admin')->user()->avatar) }}"
                                                alt="image profile"
                                                class="avatar-img rounded-circle"
                                                style="
                                                    width: 100%;
                                                    height: 100%;
                                                    object-fit: cover;
                                                ">

                                        @else

                                            @php

                                                $user = Auth::guard('admin')->user();

                                                $firstLetter = strtoupper(
                                                    substr($user->name, 0, 1)
                                                );

                                                $colors = [
                                                    '#FF5733',
                                                    '#33FF57',
                                                    '#3357FF',
                                                    '#F333FF',
                                                    '#FF33A1',
                                                    '#FFC133',
                                                    '#33FFC1'
                                                ];

                                                $hash = crc32($user->email);

                                                $index = $hash % count($colors);

                                                $bgColor = $colors[$index];

                                            @endphp


                                            <div
                                                style="
                                                    background-color: {{ $bgColor }};
                                                    width: 100%;
                                                    height: 100%;
                                                    display: flex;
                                                    justify-content: center;
                                                    align-items: center;
                                                ">

                                                {{ $firstLetter }}

                                            </div>

                                        @endif

                                    </div>


                                    <span class="profile-username">

                                        <span class="op-7">
                                            Hi,
                                        </span>

                                        <span class="fw-bold">
                                            {{ explode(' ', Auth::guard('admin')->user()->name)[0] }}
                                        </span>

                                    </span>

                                </a>


                                <ul class="dropdown-menu dropdown-user animated fadeIn">

                                    <div class="dropdown-user-scroll scrollbar-outer">

                                        <li>

                                            <div class="user-box">

                                                <div class="u-text p-0">

                                                    <h4>
                                                        {{ Auth::guard('admin')->user()->name }}
                                                    </h4>

                                                    <p class="text-muted">
                                                        {{ Auth::guard('admin')->user()->email }}
                                                    </p>

                                                </div>

                                            </div>

                                        </li>


                                        <li>

                                            <div class="dropdown-divider"></div>

                                            <a
                                                class="dropdown-item"
                                                href="{{ route('user.edit', Auth::guard('admin')->user()->id) }}">

                                                Account Setting

                                            </a>


                                            <a
                                                class="dropdown-item"
                                                href="{{ route('admin.changePass') }}">

                                                Change Password

                                            </a>


                                            <a
                                                class="dropdown-item"
                                                href="#">

                                                Inbox

                                            </a>


                                            <div class="dropdown-divider"></div>


                                            <a
                                                class="dropdown-item"
                                                href="{{ route('admin.logout') }}">

                                                Logout

                                            </a>

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

                                <a
                                    class="nav-link"
                                    href="{{ route('admin.dashboard') }}">

                                    Dashboard

                                </a>

                            </li>


                            <li class="nav-item">

                                <a
                                    class="nav-link"
                                    href="{{ route('order.index') }}">

                                    Orders

                                </a>

                            </li>


                            <li class="nav-item">

                                <a
                                    class="nav-link"
                                    href="{{ route('admin.notifications') }}">

                                    Notifications

                                </a>

                            </li>

                        </ul>

                    </nav>


                    <div class="copyright">

                        © {{ date('Y') }} Male Fashion Admin.
                        All rights reserved.

                    </div>


                    <div>

                        Powered by

                        <a
                            target="_blank"
                            href="{{ route('front.home') }}">

                            Male Fashion Store

                        </a>

                    </div>

                </div>

            </footer>

        </div>

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


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <!-- Summernote Scripts -->
    <script src="{{ asset('admin-assets/plugins/summernote/summernote-bs5.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>


    <script>

        jQuery(document).ready(function ($) {


            /*
             * Summernote dropdown handling
             */

            $(document).on('click', function (e) {

                if (!$(e.target).closest('.dropdown-menu, .note-btn').length) {

                    $('.note-btn-group .dropdown-menu').removeClass('show');

                }

            });


            $(document).on('click', '.note-btn', function (e) {

                e.stopPropagation();

                $('.note-btn-group .dropdown-menu')
                    .not(
                        $(this)
                            .closest('.note-btn-group')
                            .find('.dropdown-menu')
                    )
                    .removeClass('show');


                $(this)
                    .closest('.note-btn-group')
                    .find('.dropdown-menu')
                    .toggleClass('show');

            });


            /*
             * Summernote
             */

            $('.summernote').summernote({
                height: '300px'
            });


            /*
             * Sparkline
             */

            $("#lineChart2").sparkline(
                [99, 125, 122, 105, 110, 124, 115],
                {
                    type: "line",
                    height: "70",
                    width: "100%",
                    lineWidth: "2",
                    lineColor: "#f3545d",
                    fillColor: "rgba(243, 84, 93, .14)"
                }
            );


            $("#lineChart3").sparkline(
                [105, 103, 123, 100, 95, 105, 115],
                {
                    type: "line",
                    height: "70",
                    width: "100%",
                    lineWidth: "2",
                    lineColor: "#ffa534",
                    fillColor: "rgba(255, 165, 52, .14)"
                }
            );


            /*
             * Generate slug
             */

            $("#name, #title").change(function () {

                $("#submit").prop("disabled", true);

                $ele = $(this);


                $.ajax({

                    url: "{{ route('getSlug') }}",

                    type: "get",

                    data: {
                        title: $ele.val()
                    },

                    dataType: "json",

                    success: function (resp) {

                        $("#submit").prop("disabled", false);

                        if (resp["status"] == 200) {

                            $("#slug").val(resp["slug"]);

                        }

                    }

                });

            });

        });

    </script>


    @yield('customJs')

</body>

</html>