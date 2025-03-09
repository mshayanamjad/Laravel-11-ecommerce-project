      <!-- Sidebar -->
      <div class="sidebar" data-background-color="dark">
        <div class="sidebar-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="dark">
            <a href="{{ route('admin.dashboard') }}" class="logo">
                <img src="{{ asset('admin-assets/img/footer-logo.png') }}" alt="navbar brand" class="navbar-brand" height="20" />
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar" style="height: 40px;">
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
              <li class="nav-item active">
                <a
                  href="{{ route('admin.dashboard') }}"
                  class="collapsed"
                >
                  <i class="fas fa-home"></i>
                  <p>Dashboard</p>
                </a>
              </li>
              <li class="nav-section">
                <span class="sidebar-mini-icon">
                  <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">Product Management</h4>
              </li>
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#category">
                  <i class="fas fa-layer-group"></i>
                  <p>Categories</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="category">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="{{ route('category.index') }}">
                        <span class="sub-item">All Categories</span>
                      </a>
                    </li>
                    <li>
                      <a href="{{ route('category.create') }}">
                        <span class="sub-item">Create Category</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#comment">
                  <i class="fas fa-comments"></i>
                  <p>Comments</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="comment">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="{{ route('review.index') }}">
                        <span class="sub-item">All Comments</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#brand">
                  <i class="fas fa-tag"></i>
                  <p>Brands</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="brand">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="{{ route('brands.index') }}">
                        <span class="sub-item">All Brands</span>
                      </a>
                    </li>
                    <li>
                      <a href="{{ route('brands.create') }}">
                        <span class="sub-item">Create Brand</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#product">
                  <i class="fas fa-shopping-bag"></i>
                  <p>Products</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="product">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="{{ route('product.index') }}">
                        <span class="sub-item">All Products</span>
                      </a>
                    </li>
                    <li>
                      <a href="{{ route('product.create') }}">
                        <span class="sub-item">Create product</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#shipping">
                  <i class="fas fa-shipping-fast"></i>
                  <p>Shipping</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="shipping">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="{{ route('shipping.index') }}">
                        <span class="sub-item">All Shippings</span>
                      </a>
                    </li>
                    <li>
                      <a href="{{ route('shipping.create') }}">
                        <span class="sub-item">Create Shipping</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#sub-category">
                  <i class="fas fa-folder"></i>
                  <p>Sub Categories</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="sub-category">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="{{ route('sub-category.index') }}">
                        <span class="sub-item">All Sub Categories</span>
                      </a>
                    </li>
                    <li>
                      <a href="{{ route('sub-category.create') }}">
                        <span class="sub-item">Create Sub Category</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#order">
                  <i class="fas fa-shopping-cart"></i>
                  <p>Orders</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="order">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="{{ route('order.index') }}">
                        <span class="sub-item">All Orders</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#discount">
                  <i class="fas fa-money-bill-alt"></i>
                  <p>Discounts</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="discount">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="components/buttons.html">
                        <span class="sub-item">All Discounts</span>
                      </a>
                    </li>
                    <li>
                      <a href="components/buttons.html">
                        <span class="sub-item">Create Discount Coupens</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#users">
                  <i class="fas fa-users"></i>
                  <p>Users</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="users">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="{{ route('user.list') }}">
                        <span class="sub-item">All Users</span>
                      </a>
                    </li>
                    <li>
                      <a href="{{ route('admin.register') }}">
                        <span class="sub-item">Create User</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- End Sidebar -->