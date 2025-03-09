@extends('admin.layouts.app')
@section('title', 'Create Category - ')

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
                <a href="{{ route('category.index') }}">All Categories</a>
                </li>
                <li class="separator">
                <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                <a>{{ $category->slug }}</a>
                </li>
            </ul>
            <button class="btn btn-primary btn-round ms-auto" onclick='window.location.href="{{ route("category.create") }}"'>
              Add New
            </button>
        </div>
        {{-- Message Alert --}}
        <div class="col-12">
          @include('admin.dashboard.message')
        </div>
        <form action="" method="post" id="categoryForm" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-md-12">
                <div class="card mb-2">
                  <div class="card-header">
                    <div class="card-title">Edit Category</div>
                  </div>
                  <div class="card-body px-5 py-4">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="row">
                          {{-- Category Name Field --}}
                          <div class="form-group col-md-6">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Category Name" value="{{ $category->name }}" />
                            <p class="error m-0"></p>
                          </div>
                          {{-- Category Slug Field --}}
                          <div class="form-group col-md-6">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control" name="slug" id="slug" placeholder="Slug" value="{{ $category->slug }}" />
                            <p class="error m-0"></p>
                          </div>
                          {{-- Category Status Field --}}
                          <div class="form-group col-md-6">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                              <option {{ ($category->status == 'active') ? 'selected' : '' }} value="active">Active</option>
                              <option {{ ($category->status == 'block') ? 'selected' : '' }} value="block">Block</option>
                            </select>
                            <p class="error m-0"></p>
                          </div>
                          {{-- Category Image Field --}}
                          <div class="form-group col-md-6">
                            <label for="">image</label>
                            <input type="file" class="form-control" id="image" name="image" />
                            <p class="error m-0"></p>
                          </div>
                        {{-- Category Old Image --}}
                        <div class="form-group col-md-6">
                            <label class="d-block" for="">Old Image</label>
                            @if ($category->image)
                                <img src="{{ asset('uploads/cate_img/' . $category->image) }}" style="width: 200px; height: 200px; object-fit: cover" >
                            @else
                                <p class="m-0">Image not uploaded Before</p>
                            @endif
                            </div>
                        </div>
                        <div class="action-btns mt-3">
                          <button type="submit" id="submit" class="btn btn-primary">Update</button>
                          <button onclick="window.location.href='{{ route('category.index') }}'" type="button" class="btn btn-black mx-2">Cancel</button>
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
$('#categoryForm').submit(function (e) {
    e.preventDefault();
    $('#submit').prop('disabled', true);
    let ele = $(this);
    let formData = new FormData(this);

    formData.append('_method', 'PUT');

    $.ajax({
        url: "{{ route('category.update', $category->id) }}",
        type: 'post',
        data: formData,
        contentType: false, // Fixed typo
        processData: false,
        dataType: 'json',
        success: function (resp) {
            if (resp.status == 200) {
              $('#submit').prop('disabled', false);
                $('.error').removeClass('invalid-feedback').html('');
                $('input, select').removeClass('is-invalid');
                window.location.href="{{ route('category.edit', $category->id) }}";
            } else {
                let errors = resp['errors'];

                $('.error').removeClass('invalid-feedback').html(''); // Fixed class name typo
                $('input, select').removeClass('is-invalid');

                $.each(errors, function (key, value) {
                    $(`#${key}`).addClass('is-invalid').siblings('.error').addClass('invalid-feedback').html(value); // Fixed key typo
                });
            }
        }
    });
});

</script>
@endsection