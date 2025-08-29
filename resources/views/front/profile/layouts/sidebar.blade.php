<!-- Sidebar -->
<div class="sidebar" data-background-color="dark">
  <div class="sidebar-logo">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="dark">
      <a href="{{ route('front.home') }}" class="logo">
        <img src="{{ asset('admin-assets/img/footer-logo.png') }}" alt="navbar brand" class="navbar-brand" height="20" />
      </a>
      <div class="nav-toggle">
        <button class="btn btn-toggle toggle-sidebar" style="height: 40px">
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
  <div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
      <ul class="nav nav-secondary">
        <li class="nav-item">
          <a href="{{ route('front.userProfile') }}" class="collapsed">
            <i class="fas fa-user-cog"></i>
            <p>Personal Information</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('front.orderList') }}" class="collapsed">
            <i class="fas fa-cart-plus"></i>
            <p>Orders</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('front.viewWishlist') }}" class="collapsed">
            <i class="fas fa-heart"></i>
            <p>Wishlist</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('front.changePassword') }}" class="collapsed">
            <i class="fas fa-lock"></i>
            <p>Change Password</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('front.deleteAcc') }}" class="collapsed">
            <i class="fas fa-trash"></i>
            <p>Delete Account</p>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>
<!-- End Sidebar -->