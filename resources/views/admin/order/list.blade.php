@extends('admin.layouts.app')
@section('title', 'All Orders - ')

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
                <a>Orders</a>
                </li>
                <li class="separator">
                <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                <a>All Orders</a>
                </li>
            </ul>
            {{-- <button class="btn btn-primary btn-round ms-auto" onclick='window.location.href="{{ route("product.create") }}"'>
                Add New
            </button> --}}
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
                            <div class="card-title" style="white-space: nowrap;">Orders List</div>
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
                                        <form action="{{ route('order.index') }}" method="get">
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
                                    class="nav-link active"
                                    id="line-home-tab"
                                    href="{{ route('order.index') }}"
                                    >All({{ $orders->total() }})</a
                                >
                                </li>
                            </ul>
                            <div class="tab-content mt-3 mb-3" id="line-tabContent">
                                <div class="tab-pane fade active show" id="line-home" role="tabpanel" aria-labelledby="line-home-tab">
                                    <div class="table-responsive">
                                        <table id="add-row" class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Customer</th>
                                                    <th>Email</th>
                                                    <th>Total</th>
                                                    <th>Status</th>
                                                    <th style="width: 12%">Date</th>
                                                    <th style="width: 10%">Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Customer</th>
                                                    <th>Email</th>
                                                    <th>Total</th>
                                                    <th>Status</th>
                                                    <th style="width: 12%">Date</th>
                                                    <th style="width: 10%">Action</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                @if ($orders->isNotEmpty())
                                                    @foreach ($orders as $order)
                                                        <tr>
                                                            <td>{{ $order->id }}</td>
                                                            <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                                                            <td>{{ $order->email }}</td>
                                                            <td>${{ number_format($order->grand_total, 2) }}<br><small class="text-muted">{{ ucfirst($order->payment_status) }}</small></td>
                                                            <td>
                                                            @if ($order->status == 'pending')
                                                                    <span class="badge badge-warning">Pending</span>
                                                                @elseif ($order->status == 'shipped')
                                                                    <span class="badge badge-primary">Shipped</span>
                                                                @elseif ($order->status == 'delivered')
                                                                    <span class="badge badge-success">Delivered</span>
                                                                @else
                                                                    <span class="badge badge-secondary">{{ ucfirst($order->status) }}</span>
                                                                @endif
                                                            
                                                            </td>
                                                            
                                                            <td>{{ $order->created_at->format('d M, Y') }}</td>
                                                            <td>
                                                                <div class="form-button-action">
                                                                    <a href="{{ route('order.edit', $order) }}" data-bs-toggle="tooltip" title="Edit order" class="btn btn-link btn-primary btn-lg p-0 pe-4">
                                                                            <i class="fa fa-edit"></i>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="7" class="text-center py-5 text-muted">No orders found.</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>                          
                                    </div>
                                    <div>
                                        {{ $orders->links('pagination::bootstrap-5') }}
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