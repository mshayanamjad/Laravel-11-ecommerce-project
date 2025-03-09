<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Registeration</title>
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

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{ asset('admin-assets/css/demo.css') }}" />
    <style>
      .container {
        max-width: 650px !important;
        margin: 0 auto;
      }
    </style>
  </head>
  <body>
    <div class="wrapper">
      <div class="main-panel w-100">
        <!-- Main Content -->
        <div class="container">
          <div class="page-inner">
            {{-- Message Alert --}}
            <div class="col-12">
              @include('admin.dashboard.message')
            </div>
            <form action="" method="post" id="registerForm" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <div class="col-md-12">
                  <div class="card mb-2">
                    <div class="card-header">
                      <div class="card-title text-center">Resgistration</div>
                    </div>
                    <div class="card-body px-5 py-4">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="row">
                            {{-- User Name Field --}}
                            <div class="form-group col-md-6">
                              <label for="name">Name</label>
                              <input type="text" class="form-control" name="name" id="name" placeholder="Enter Your Name" />
                              <p class="error m-0"></p>
                            </div>
                            {{-- User Email Field --}}
                            <div class="form-group col-md-6">
                              <label for="email">Email</label>
                              <input type="email" class="form-control" name="email" id="email" placeholder="Email" />
                              <p class="error m-0"></p>
                            </div>
                            {{-- User Phone Field --}}
                            <div class="form-group col-md-12">
                              <label for="phone">Phone</label>
                              <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone" />
                              <p class="error m-0"></p>
                            </div>
                            {{-- User Password Field --}}
                            <div class="form-group col-md-12">
                              <label for="password">Password</label>
                              <input type="password" class="form-control" name="password" id="password" placeholder="Password" />
                              <p class="error m-0"></p>
                            </div>
                            {{-- User Role Field --}}
                            <div class="form-group col-md-12">
                              <label for="role">Role</label>
                              <select class="form-control" id="role" name="role">
                                <option value="admin">Admin</option>
                                <option value="customer">Customer</option>
                                <option value="manager">Manager</option>
                              </select>
                              <p class="error m-0"></p>
                            </div>
                            {{-- User Avatar Field --}}
                            <div class="form-group col-md-12">
                              <label for="">Avatar</label>
                              <input type="file" class="form-control" id="avatar" name="avatar" />
                              <p class="error m-0"></p>
                            </div>
                          </div>
                          <div class="action-btns mt-3">
                            <button type="submit" id="submit" class="btn btn-primary">Sign Up</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="link text-center">
                    <p class="m-0">
                      Already have an account?
                    <a href="{{ route('admin.login') }}">Login Now</a>
                    </p>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- End Custom template -->
    </div>
    <!--   Core JS Files   -->
    <script src="{{ asset('admin-assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/core/bootstrap.min.js') }}"></script>

    <script>
      $('#registerForm').submit(function (e) {
        e.preventDefault();

        let element = $(this);
        let formData = new FormData(element[0]);
        $.ajax({
          url: '{{ route("admin.processRegister") }}',
          type: 'post',
          data: formData,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function (response) {
            if (response.status == true) {
              $('.error').removeClass('invalid-feedback').html('');
              $('input, select').removeClass('is-invalid');
              
              window.location.href="{{ route('admin.login') }}";
            } else {
              let errors = response['errors'];
              $('.error').removeClass('invalid-feedback').html('');
              $('input, select').removeClass('is-invalid');

              $.each(errors, function(key, value) {
                  $(`#${key}`).addClass('is-invalid').siblings('.error').addClass('invalid-feedback').html(value);
              });
            }
          }
        });

      });
    </script>
  </body>
</html>