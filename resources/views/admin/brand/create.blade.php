@extends('admin.layouts.app')
@section('title', 'Create Brands - ')

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
                <a href="{{ route('brands.index') }}">Brands</a>
                </li>
                <li class="separator">
                <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                <a>Create Brand</a>
                </li>
            </ul>
            <button class="btn btn-primary btn-round ms-auto" onclick='window.location.href="{{ route("brands.create") }}"'>
              Add New
            </button>
        </div>
        {{-- Message Alert --}}
        <div class="col-12">
          @include('admin.dashboard.message')
        </div>
        <form action="" method="post" id="brandForm">
            @csrf
            <div class="row">
              <div class="col-md-12">
                <div class="card mb-2">
                  <div class="card-header">
                    <div class="card-title">Create Brand</div>
                  </div>
                  <div class="card-body px-5 py-4">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="row">
                          {{-- Brand Name Field --}}
                          <div class="form-group col-md-6">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter Brand Name" />
                            <p class="error m-0"></p>
                          </div>
                          {{-- Brand Slug Field --}}
                          <div class="form-group col-md-6">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control" name="slug" id="slug" placeholder="Slug" />
                            <p class="error m-0"></p>
                          </div>
                          {{-- Brand Status Field --}}
                          <div class="form-group col-md-6">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                              <option value="active">Active</option>
                              <option value="block">Block</option>
                            </select>
                          </div>
                        </div>
                        <div class="action-btns mt-3">
                          <button type="submit" id="submit" class="btn btn-primary">Create</button>
                          <button class="btn btn-black mx-2">Cancel</button>
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
    $('#brandForm').submit(function (e) {
        e.preventDefault();
        $('#submit').prop('disabled', true);
        let ele = $(this);

        $.ajax({
            url: '{{ route("brands.store") }}',
            type: 'post',
            data: ele.serializeArray(),
            dataType: 'json',
            success: function (resp) {
                if (resp.status == 200) {
                    $('#submit').prop('disabled', false);

                    $('.error').removeClass('invalid-feedback').html('');
                    $('input, select').removeClass('is-invalid');

                    window.location.href="{{ route('brands.create') }}"

                } else {
                    let errors = resp['errors'];
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