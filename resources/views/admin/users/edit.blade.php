@extends('admin.layouts.app')
@section('title', 'Edit User - ')

@section('content')

<!-- Main Content -->
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <!-- <h3 class="fw-bold mb-3">Create Category</h3> -->
            <ul class="breadcrumbs mb-3 p-0 m-0 border-0">
              <li class="nav-home">
              <a href="{{ route('admin.dashboard') }}">
                  <i class="icon-home"></i>
              </a>
              </li>
              <li class="separator">
              <i class="icon-arrow-right"></i>
              </li>
              <li class="nav-item">
              <a href="{{ route('user.list') }}">Users</a>
              </li>
              <li class="separator">
              <i class="icon-arrow-right"></i>
              </li>
              <li class="nav-item">
              <a>{{ $user->name }}</a>
              </li>
            </ul>
            <button class="btn btn-primary btn-round ms-auto" onclick='window.location.href="{{ route("admin.register") }}"'>
              Add New
            </button>
        </div>
        <form action="" method="post" id="registerForm" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-md-12">
                <div class="card mb-2">
                  <div class="card-header">
                    <div class="card-title">Edit User</div>
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
                          {{-- User Role Field --}}
                          <div class="form-group col-md-6">
                            <label for="role">Role</label>
                            <select class="form-control" id="role" name="role">
                              <option {{ ($user->role == 'admin') ? 'selected' : '' }} value="admin">Admin</option>
                              <option {{ ($user->role == 'customer') ? 'selected' : '' }} value="customer">Customer</option>
                              <option {{ ($user->role == 'manager') ? 'selected' : '' }} value="manager">Manager</option>
                            </select>
                            <p class="error m-0"></p>
                          </div>
                          {{-- User Status Field --}}
                          <div class="form-group col-md-6">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                              <option {{ ($user->status == 'active') ? 'selected' : '' }} value="active">Active</option>
                              <option {{ ($user->status == 'inactive') ? 'selected' : '' }} value="inactive">Inactive</option>
                              <option {{ ($user->status == 'banned') ? 'selected' : '' }} value="banned">Banned</option>
                            </select>
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
                            <img src="{{ asset('uploads/profiles/' . $user->avatar) }}" style="width: 200px; height: 200px; object-fit: cover;" >
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
      url: '{{ route("user.update", $user->id) }}',
      type: 'post',
      data: formData,
      contentType: false,
      processData: false,
      dataType: 'json',
      success: function (response) {
        if (response.status == true) {
          $('.error').removeClass('invalid-feedback').html('');
          $('input, select').removeClass('is-invalid');
          
          window.location.href="{{ route('user.list') }}";
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