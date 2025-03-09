@extends('front.profile.layouts.app')
@section('title', 'Whishlist - ')

@section('content')

<!-- Main Content -->
<div class="container">
    <div class="page-inner pt-md-5 mt-md-3">
        {{-- Message Alert --}}
        <div class="col-12">
            @include('admin.dashboard.message')
        </div>
        <div class="row">
            <div class="col-md-12">
            <div class="card mb-2">
                <div class="card-header">
                <div class="card-title">My Wishlist</div>
                </div>
                <div class="card-body px-5 py-4">
                <div class="row">
                    @if ($wishlists->isNotEmpty())
                        @foreach ($wishlists as $wishlist)
                            <div class="col-md-4">
                                <div class="card card-post card-round">
                                <img class="card-img-top" src="{{ asset('uploads/product-image/'. $wishlist->product->image) }}" alt="Card image" style="width: 100%; height: 250px; object-fit: cover; object-position: center;">
                                <div class="card-body">
                                    <h3 class="card-title text-center">
                                    <a href="{{ $wishlist->product->slug }}">{{ $wishlist->product->title }}</a>
                                    </h3>
                                    <a href="javascript:void(0)" onclick="removeWhishlist({{ $wishlist->product->id }})" class="btn btn-danger btn-rounded btn-sm w-100 mt-3">Remove</a>
                                </div>
                                </div>
                            </div>   
                        @endforeach
                    @else
                        <p>No wishlist Product found</p>
                    @endif
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('customJs')
<script>
    function removeWhishlist(id) {
        $.ajax({
            url: "{{ route('front.reomveWhishlistPro') }}",
            type: 'post',
            data: {id:id},
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.status == true) {
                    window.location.href = "{{ route('front.viewWishlist') }}";
                } else {
                    alert(response.message);
                }
            }
        });
    }
</script>
@endsection