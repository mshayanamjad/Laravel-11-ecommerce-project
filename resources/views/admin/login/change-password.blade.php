<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Change Password</title>
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
            <form action="" method="post" id="changePasswordForm">
              @csrf
              <div class="row">
                <div class="col-md-12">
                  <div class="card mb-2">
                    <div class="card-header">
                      <div class="card-title text-center">Change Password</div>
                    </div>
                    <div class="card-body px-5 py-4">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="row">
                            {{-- User Old Password Field --}}
                            <div class="form-group col-md-12">
                                <label for="old_password">Old Password</label>
                                <input type="password" class="form-control" name="old_password" id="old_password" placeholder="Old Password" />
                                <p class="error m-0"></p>
                            </div>
                            {{-- User New Password Field --}}
                            <div class="form-group col-md-12">
                                <label for="new_password">New Password</label>
                                <input type="password" class="form-control" name="new_password" id="new_password" placeholder="New Password" />
                                <p class="error m-0"></p>
                            </div>
                            {{-- User Confirm Password Field --}}
                            <div class="form-group col-md-12">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password" />
                                <p class="error m-0"></p>
                          </div>
                          </div>
                          <div class="action-btns mt-3">
                            <button type="submit" id="submit" class="btn btn-primary">Change Password</button>
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
        $('#changePasswordForm').submit(function (e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route("admin.changePassProcess") }}',
                type: 'post',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function (response) {
                    if(response.status == true) {
                        $('.error').removeClass('invalid-feedback').html('');
                        $('input').removeClass('is-invalid');
                        
                        window.location.href="{{ route('admin.login') }}";
                    } else {
                        let errors = response['errors'];
                        $('.error').removeClass('invalid-feedback').html('');
                        $('input').removeClass('is-invalid');

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