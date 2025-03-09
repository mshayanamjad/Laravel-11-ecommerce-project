@extends('admin.layouts.app')
@section('title', 'All Brands - ')

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
                <a>Brands</a>
                </li>
                <li class="separator">
                <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                <a>All Brands</a>
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
        <form>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title" style="white-space: nowrap;">Brands List</div>
                            <div id="add-row_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                <div class="d-flex justify-content-end align-items-center">
                                    {{-- <div class="col-sm-12 col-md-8 text-end">
                                        <form id="filter-form" method="GET" action="{{ route('user.list') }}">
                                            <div class="dataTables_length" id="add-row_length">
                                                <label>
                                                    Show
                                                    <select name="add-row_length" onchange="document.getElementById('filter-form').submit()" aria-controls="add-row" class="form-control form-control-sm">
                                                        <option value="1" {{ request('add-row_length') == 1 ? 'selected' : '' }}>1</option>
                                                        <option value="25" {{ request('add-row_length') == 25 ? 'selected' : '' }}>25</option>
                                                        <option value="50" {{ request('add-row_length') == 50 ? 'selected' : '' }}>50</option>
                                                        <option value="100" {{ request('add-row_length') == 100 ? 'selected' : '' }}>100</option>
                                                    </select>
                                                    entries
                                                </label>
                                            </div>
                                        </form>
                                    </div> --}}
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
                                <a
                                    class="nav-link"
                                    id="line-home-tab"
                                    href="{{ route('brands.index') }}"
                                    >All({{ $count }})</a
                                >
                                </li>
                                <li class="nav-item submenu">
                                <a class="nav-link" href="{{ route('brands.active') }}">
                                    Active({{ $activeCount }})
                                </a>
                                </li>
                                <li class="nav-item submenu" role="presentation">
                                    <a
                                        class="nav-link active"
                                        id="line-contact-tab"
                                        href="{{ route('brands.block') }}"
                                        >Block({{ $blockCount }})</a
                                    >
                                </li>
                            </ul>
                            <div class="tab-content mt-3 mb-3" id="line-tabContent">
                                <div class="tab-pane fade active show" id="line-home" role="tabpanel" aria-labelledby="line-home-tab">
                                    <div class="table-responsive">
                                        <table id="add-row" class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Slug</th>
                                                    <th>Status</th>
                                                    <th style="width: 10%">Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Slug</th>
                                                    <th>Status</th>
                                                    <th style="width: 10%">Action</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                @if ($brands->isNotEmpty())
                                                    @foreach ($brands as $brand)                                                   
                                                        <tr>
                                                            <td>{{ $brand->name }}</td>
                                                            <td>{{ $brand->slug }}</td>
                                                            <td>
                                                                @if ($brand->status == 'active')
                                                                    <button type="button" class="btn btn-icon btn-link btn-success op-8">
                                                                        <i class="far fa-check-circle"></i>
                                                                    </button>
                                                                @else
                                                                    <button type="button" class="btn btn-icon btn-link btn-danger op-8">
                                                                        <i class="fas fa-ban"></i>
                                                                    </button>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <div class="form-button-action">
                                                                    <a href="{{ route('brands.edit', $brand->id) }}">
                                                                        <button
                                                                            type="button"
                                                                            data-bs-toggle="tooltip"
                                                                            title=""
                                                                            class="btn btn-link btn-primary btn-lg p-0 pe-4"
                                                                            data-original-title="Edit Task"
                                                                        >
                                                                            <i class="fa fa-edit"></i>
                                                                        </button>
                                                                    </a>
                                                                    <form action="{{ route('brands.destroy', $brand->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this record?');">
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
                                        {{ $brands->links('pagination::bootstrap-5') }}
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