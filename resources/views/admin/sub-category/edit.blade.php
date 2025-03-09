@extends('admin.layouts.app')
@section('title', 'Edit Sub Category  - ')

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
                <a href="{{ route('sub-category.index') }}">Sub Category</a>
                </li>
                <li class="separator">
                <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                <a>{{ $subCategory->slug }}</a>
                </li>
            </ul>
            <button class="btn btn-primary btn-round ms-auto" onclick='window.location.href="{{ route("sub-category.create") }}"'>
              Add New
            </button>
        </div>
        {{-- Message Alert --}}
        <div class="col-12">
          @include('admin.dashboard.message')
        </div>
        <form action="" method="post" id="subCategoryForm">
            @csrf
            <div class="row">
              <div class="col-md-12">
                <div class="card mb-2">
                  <div class="card-header">
                    <div class="card-title">Edit Sub Category</div>
                  </div>
                  <div class="card-body px-5 py-4">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="row">
                          {{-- Sub Category Name Field --}}
                          <div class="form-group col-md-6">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Sub Category Name" value="{{ $subCategory->name }}" />
                            <p class="error m-0"></p>
                          </div>
                          {{-- Sub Category Slug Field --}}
                          <div class="form-group col-md-6">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control" name="slug" id="slug" placeholder="Slug" value="{{ $subCategory->slug }}" />
                            <p class="error m-0"></p>
                          </div>
                          {{-- Category Field --}}
                          <div class="form-group col-md-6">
                            <label for="category_id">Category</label>
                            <select class="form-control" id="category_id" name="category_id">
                                <option selected disabled>Select Category</option>
                                @if ($categories->isNotEmpty())
                                    @foreach ($categories as $category)   
                                        <option {{ ($subCategory->category_id == $category->id) ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                @endif                              
                            </select>
                            <p class="error m-0"></p>
                          </div>
                          {{-- Sub Category Status Field --}}
                          <div class="form-group col-md-6">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                              <option {{ ($subCategory->status == 'active') ? 'selected' : '' }} value="active">Active</option>
                              <option {{ ($subCategory->status == 'block') ? 'selected' : '' }} value="block">Block</option>
                            </select>
                          </div>
                        </div>
                        <div class="action-btns mt-3">
                          <button type="submit" id="submit" class="btn btn-primary">Update</button>
                          <button type="button" class="btn btn-black mx-2">Cancel</button>
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
  $('#subCategoryForm').submit(function (e) {
    e.preventDefault();
    $('#submit').prop('disabled', true);
    let ele = $(this);

    $.ajax({
      url: '{{ route("sub-category.update", $subCategory->id) }}',
      type: 'put',
      data: ele.serializeArray(),
      dataType: 'json',
      success: function (resp) {
        if (resp.status == 200) {
          $('#submit').prop('disabled', false);
          $('.error').removeClass('invalid-feedback').html('');
          $('input, select').removeClass('is-invalid');

          window.location.href="{{ route('sub-category.edit', $subCategory->id) }}";
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