@extends('front.profile.layouts.app')
@section('title', 'Edit User - ')

@section('content')

<!-- Main Content -->
<div class="container">
    <div class="page-inner pt-md-5 mt-md-3">
        {{-- Message Alert --}}
        <div class="col-12">
          @include('front.profile.layouts.message')
        </div>
        <form action="" method="post" id="registerForm" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-md-12">
                <div class="card mb-2">
                  <div class="card-header">
                    <div class="card-title">My Profile</div>
                  </div>
                  <div class="card-body px-5 py-4">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="row">
                          {{-- User Name Field --}}
                          <div class="form-group col-md-6">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter Your Name" value="{{ $user->name }}" />
                            <p class="error m-0"></p>
                          </div>
                          {{-- User Email Field --}}
                          <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{ $user->email }}" disabled />
                            <p class="error m-0"></p>
                          </div>
                          {{-- User Phone Field --}}
                          <div class="form-group col-md-6">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone" value="{{ $user->phone }}" />
                            <p class="error m-0"></p>
                          </div>
                          {{-- User Avatar Field --}}
                          <div class="form-group col-md-6">
                            <label for="">Avatar</label>
                            <input type="file" class="form-control" id="avatar" name="avatar" />
                            <p class="error m-0"></p>
                          </div>
                          {{-- User Avatar Preview --}}
                          <div class="form-group col-md-6">
                            <label class="d-block" for="">Old Avatar</label>
                            @if (!empty($user->avatar))
                            <img src="{{ asset('uploads/profiles/' . $user->avatar) }}" style="width: 150px; height: 150px; object-fit: cover;" >
                            @else
                            @endif
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
    $('#registerForm').submit(function (e) {
    e.preventDefault();

    let element = $(this);
    let formData = new FormData(this);
    
    formData.append('_method', 'PUT');
    $.ajax({
      url: '{{ route("front.updateProfile", $user->id) }}',
      type: 'post',
      data: formData,
      contentType: false,
      processData: false,
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