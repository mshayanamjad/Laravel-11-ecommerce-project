@extends('admin.layouts.app')
@section('title', 'Edit Review - ')

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
                <a href="{{ route('review.index') }}">Reviews</a>
                </li>
            </ul>
        </div>
        {{-- Message Alert --}}
        <div class="col-12">
          @include('admin.dashboard.message')
        </div>
        <form action="" method="post" id="reviewForm">
            @csrf
            <div class="row">
              <div class="col-md-12">
                <div class="card mb-2">
                  <div class="card-header">
                    <div class="card-title">Edit Review</div>
                  </div>
                  <div class="card-body px-5 py-4">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="row">
                            {{-- Commented product --}}
                           <div class="form-group col-md-6">
                            <label for="">Product</label>
                            <input type="text" class="form-control" name="" id="" value="{{ $review->product->id }} - {{ $review->product->title }}" readonly />
                            <p class="error m-0"></p>
                          </div>
                          {{-- Comment Field --}}
                          <div class="form-group col-md-6">
                            <label for="review_text">Comment</label>
                            <input type="text" class="form-control" name="review_text" id="review_text" placeholder="Enter Comment" value="{{ $review->review_text }}" />
                            <p class="error m-0"></p>
                          </div>
                          {{-- Rating Field --}}
                          <div class="form-group col-md-6 my-rating">
                            <label for="rating">Rating</label>
                            <select class="form-control" id="rating" name="rating">
                                @for($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}" {{ $review->rating == $i ? 'selected' : '' }}>
                                        {{ str_repeat('★', $i) . str_repeat('☆', 5 - $i) }}
                                    </option>
                                @endfor
                            </select>
                          </div>
                          {{-- Comment Status Field --}}
                          <div class="form-group col-md-6">
                            <label for="approved">Status</label>
                            <select class="form-control" id="approved" name="approved">
                                <option {{ ($review->approved == 1) ? 'selected' : '' }} value="1">Approved</option>
                                <option {{ ($review->approved == 0) ? 'selected' : '' }} value="0">Not Approved</option>
                            </select>
                          </div>
                        </div>
                        <div class="action-btns mt-3">
                          <button type="submit" id="submit" class="btn btn-primary">Update</button>
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
  $('#reviewForm').submit(function (e) {
    e.preventDefault();
    $('#submit').prop('disabled', true);
    let ele = $(this);

    $.ajax({
      url: '{{ route("review.update", $review->id) }}',
      type: 'put',
      data: ele.serialize(),
      dataType: 'json',
      success: function (resp) {
        if (resp.status == true) {
          $('#submit').prop('disabled', false);

          $('.error').removeClass('invalid-feedback').html('');
          $('input, select').removeClass('is-invalid');

          window.location.href="{{ route('review.edit', $review->id) }}"

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