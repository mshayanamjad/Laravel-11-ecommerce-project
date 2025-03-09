@extends('admin.layouts.app')
@section('title', 'Edit Shipping  - ')

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
                <a href="{{ route('shipping.index') }}">Shippiing</a>
                </li>
                <li class="separator">
                <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    
                </li>
            </ul>
            <button class="btn btn-primary btn-round ms-auto" onclick='window.location.href="{{ route("shipping.create") }}"'>
              Add New
            </button>
        </div>
        {{-- Message Alert --}}
        <div class="col-12">
          @include('admin.dashboard.message')
        </div>
        <form action="" method="post" id="shippingForm">
            @csrf
            <div class="row">
              <div class="col-md-12">
                <div class="card mb-2">
                  <div class="card-header">
                    <div class="card-title">Edit Shipping</div>
                  </div>
                  <div class="card-body px-5 py-4">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="row">
                            {{-- Country Field --}}
                            <div class="form-group col-md-6">
                            <label for="country">country Name</label>
                            <select class="form-control" id="country" name="country">
                                <option selected disabled>Select Country</option>
                                @if ($countries->isNotEmpty())
                                    <option {{ ($shipping->country_id == 'rest_of_world') ? 'selected' : '' }} class="text-primary text-uppercase" value="rest_of_world">Rest of World</option>
                                    @foreach ($countries as $country)   
                                        <option {{ ($shipping->country_id == $country->id) ? 'selected' : '' }} value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                @endif                              
                            </select>
                            <p class="error m-0"></p>
                            </div>
                            {{-- Shippiing Amount Field --}}
                            <div class="form-group col-md-6">
                            <label for="amount">Amount</label>
                            <input type="text" class="form-control" name="amount" id="amount" placeholder="Amount" value="{{ $shipping->amount }}" />
                            <p class="error m-0"></p>
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
  $('#shippingForm').submit(function (e) {
    e.preventDefault();
    $('#submit').prop('disabled', true);
    let ele = $(this);

    $.ajax({
      url: '{{ route("shipping.update", $shipping->id) }}',
      type: 'put',
      data: ele.serializeArray(),
      dataType: 'json',
      success: function (resp) {
          $('#submit').prop('disabled', false);
        if (resp.status == true) {
          $('.error').removeClass('invalid-feedback').html('');
          $('input, select').removeClass('is-invalid');

          window.location.href="{{ route('shipping.edit', $shipping->id) }}";
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