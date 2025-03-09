<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Registration</title>
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
      .btn-loader {
          border: 4px solid #fff;
          border-left-color: transparent;
          width: 20px;
          height: 20px;
          display: inline-block;
          animation: spin89345 1s linear infinite;
      }

      .btn-loader {
          border: 4px solid #fff;
          border-left-color: transparent;
          border-radius: 50%;
          margin-left: 10px;
          margin-bottom: -4px;
      }

      @keyframes spin89345 {
          0% {
              transform: rotate(0deg);
          }

          100% {
              transform: rotate(360deg);
          }
      }
    </style>
  </head>
  <body>
    <div class="wrapper">
      <div class="main-panel w-100">
        <div class="container">
          <div class="page-inner">
            {{-- Message Alert --}}
            <div class="col-12">
              @include('admin.dashboard.message')
            </div>
            <form action="" method="post" id="userRegisterForm" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <!-- Step 1: User Info Form -->
                <div class="col-md-12" id="user-info-step">
                  <div class="card mb-2">
                    <div class="card-header">
                      <div class="card-title text-center">Registration</div>
                    </div>
                    <div class="card-body px-5 py-4">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="row">
                            <div class="form-group col-md-6">
                              <label for="name">Name</label>
                              <input type="text" class="form-control" name="name" id="name" placeholder="Enter Your Name" />
                              <p class="error m-0"></p>
                            </div>
                            <div class="form-group col-md-6">
                              <label for="email">Email</label>
                              <input type="email" class="form-control" name="email" id="email" placeholder="Email" />
                              <p class="error m-0"></p>
                            </div>
                            <div class="form-group col-md-12">
                              <label for="phone">Phone</label>
                              <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone" />
                              <p class="error m-0"></p>
                            </div>
                            <div class="form-group col-md-12">
                              <label for="password">Password</label>
                              <input type="password" class="form-control" name="password" id="password" placeholder="Password" />
                              <p class="error m-0"></p>
                            </div>
                            <div class="form-group col-md-12">
                              <label for="">Avatar</label>
                              <input type="file" class="form-control" id="avatar" name="avatar" />
                              <p class="error m-0"></p>
                            </div>
                          </div>
                          <div class="action-btns mt-3">
                            <button type="button" id="sendOtpBtn" class="btn btn-primary">
                              Send OTP
                              <span class="btn-loader" id="btn-loader" style="display:none;"></span>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Step 2: OTP Verification Form -->
                <div class="col-md-12" id="otp-step" style="display:none;">
                  <div class="card mb-2">
                    <div class="card-header">
                      <div class="card-title text-center">OTP Verification</div>
                    </div>
                    <div class="card-body px-5 py-4">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group col-md-12">
                            <label for="otp">Enter OTP</label>
                            <input type="text" class="form-control" name="otp" id="otp" placeholder="Enter OTP" />
                            <p class="error m-0"></p>
                          </div>
                          <div class="action-btns mt-3">
                            <button type="submit" id="submitOtpBtn" class="btn btn-primary">
                              Verify OTP
                              <span class="btn-loader" id="btn-loader-1" style="display:none;"></span>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="link text-center">
                <p class="m-0">
                  Already have an account?
                <a href="{{ route('front.userLogin') }}">Login</a>
                </p>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!--   Core JS Files   -->
    <script src="{{ asset('admin-assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/core/bootstrap.min.js') }}"></script>

    <script>
      // Step 1: Send OTP when the user clicks the button
      $('#sendOtpBtn').click(function () {
        // Show the loader
        $('#btn-loader').show();
        // Disable the button to prevent multiple clicks
        $('#sendOtpBtn').prop('disabled', true);

        let formData = new FormData($('#userRegisterForm')[0]);

        $.ajax({
          url: '{{ route("front.sendOtp") }}', // URL to send OTP
          type: 'post',
          data: formData,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function (response) {
            // Hide the loader
            $('#btn-loader').hide();
            // Enable the button again
            $('#sendOtpBtn').prop('disabled', false);

            if (response.status == true) {
              // Hide the first step (user info form)
              $('#user-info-step').hide();
              // Show the second step (OTP verification form)
              $('#otp-step').show();
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

      // Step 2: Verify OTP and create user when the OTP is correct
      $('#userRegisterForm').submit(function (e) {
        e.preventDefault();

        // Show the loader for verify OTP button
        $('#btn-loader-1').show();
        // Disable the button
        $('#submitOtpBtn').prop('disabled', true);

        let formData = new FormData($('#userRegisterForm')[0]);

        $.ajax({
          url: '{{ route("front.verifyOtp") }}', // URL to verify OTP and register user
          type: 'post',
          data: formData,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function (response) {
            // Hide the loader
            $('#btn-loader-1').hide();
            // Enable the button again
            $('#submitOtpBtn').prop('disabled', false);

            if (response.status == true) {
              window.location.href = "{{ route('front.userLogin') }}"; // Redirect to login page
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
