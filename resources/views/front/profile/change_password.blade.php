@extends('front.profile.layouts.app')
@section('title', 'Change Password - ')

@section('content')

<!-- Main Content -->
<div class="container">
    <div class="page-inner pt-md-5 mt-md-3">
        {{-- Message Alert --}}
        <div class="col-12">
          @include('front.profile.layouts.message')
        </div>
        <form action="" method="post" id="changePssForm">
            @csrf
            <div class="row">
              <div class="col-md-12">
                <div class="card mb-2">
                  <div class="card-header">
                    <div class="card-title">Change Password</div>
                  </div>
                  <div class="card-body px-5 py-4">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="row">
                          {{-- User Name Field --}}
                          <div class="form-group col-md-6">
                            <label for="old_password">Current Password</label>
                            <input type="password" class="form-control" name="old_password" id="old_password" placeholder="Enter Your Current Password" value="" />
                            <p class="error m-0"></p>
                          </div>
                          {{-- User Email Field --}}
                          <div class="form-group col-md-6">
                            <label for="new_password">New Password</label>
                            <input type="password" class="form-control" name="new_password" id="new_password" placeholder="New Password" value="" />
                            <p class="error m-0"></p>
                          </div>
                          {{-- User Phone Field --}}
                          <div class="form-group col-md-6">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password" value="" />
                            <p class="error m-0"></p>
                          </div>
                          <div class="col-md-6"></div>
                        </div>
                        <div class="action-btns mt-3">
                          <button type="submit" id="submit" class="btn btn-primary">Update</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </form>
    </div>
</div>


@endsection
@section('customJs')
<script>
    $('#changePssForm').submit(function (e) {
    e.preventDefault();

    let element = $(this);
    
    $.ajax({
      url: '{{ route("front.changePasswordProcess") }}',
      type: 'post',
      data: element.serializeArray(),
      dataType: 'json',
      success: function (response) {
        if (response.status == true) {
          $('.error').removeClass('invalid-feedback').html('');
          $('input, select').removeClass('is-invalid');
          
          window.location.reload();

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
@endsection