@extends('admin.layouts.app')
@section('title', 'All Comments - ')

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
                <a>Comments</a>
                </li>
                <li class="separator">
                <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                <a>All Comments</a>
                </li>
            </ul>
        </div>
        {{-- Message Alert --}}
        <div class="col-12">
            @include('admin.dashboard.message')
        </div>
        <form>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title" style="white-space: nowrap;">Comments List</div>
                            <div id="add-row_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                <div class="d-flex justify-content-end align-items-center">
                                    <div class="col-sm-12 col-md-4">
                                        <form action="" method="get">
                                            <div id="add-row_filter" class="dataTables_filter">
                                                <label>
                                                    Search:
                                                    <input type="search" name="keyword" value="{{ Request::get('keyword') }}" class="form-control form-control-sm" placeholder="Search here..." aria-controls="add-row" />
                                                </label>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body pt-0">
                            <ul class="nav nav-tabs nav-line nav-color-secondary" id="line-tab" role="tablist">
                                <li class="nav-item submenu" role="presentation">
                                <a class="nav-link active" id="line-home-tab" href="{{ route('brands.index') }}">
                                    All({{ $reviewCount }})
                                </a>
                                </li>
                            </ul>
                            <div class="tab-content mt-3 mb-3" id="line-tabContent">
                                <div class="tab-pane fade active show" id="line-home" role="tabpanel" aria-labelledby="line-home-tab">
                                    <div class="table-responsive">
                                        <table id="add-row" class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    {{-- <th>User Name</th> --}}
                                                    <th>Product</th>
                                                    <th>Comment</th>
                                                    <th style="width: 12%">Rating</th>
                                                    <th style="width: 8%">Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>ID</th>
                                                    {{-- <th>User Name</th> --}}
                                                    <th>Product</th>
                                                    <th>Comment</th>
                                                    <th style="width: 12%">Rating</th>
                                                    <th style="width: 8%">Action</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                @if ($reviews->isNotEmpty())
                                                    @foreach ($reviews as $review)                                                   
                                                        <tr>
                                                            <td>{{ $review->id }}</td>
                                                            {{-- <td>{{ $review->user->name }}</td> --}}
                                                            <td>{{ $review->product->title }}</td>
                                                            <td>{{ $review->review_text }}</td>
                                                            <td>
                                                                {{-- {{ $review->rating }} --}}
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    @if ($i <= $review->rating)
                                                                        <i class="fa fa-star" style="color: #f7941d; font-size: 10px;"></i>
                                                                    @else
                                                                        <i class="far fa-star" style="color: #f7941d; font-size: 10px;"></i>
                                                                    @endif
                                                                @endfor
                                                            </td>
                                                            <td>
                                                                <div class="form-button-action">
                                                                    <a href="{{ route('review.edit', $review->id) }}">
                                                                        <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg p-0 pe-4" data-original-title="Edit Task">
                                                                            <i class="fa fa-edit"></i>
                                                                        </button>
                                                                    </a>
                                                                    <form action="{{ route('review.destroy', $review->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" data-bs-toggle="tooltip" title="Remove" class="btn btn-link btn-danger p-0">
                                                                            <i class="fa fa-times"></i>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>                          
                                    </div>
                                    <div>
                                        {{ $reviews->links('pagination::bootstrap-5') }}
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