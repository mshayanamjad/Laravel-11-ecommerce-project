@extends('front.profile.layouts.app')
@section('title', 'Orders List - ')

@section('content')

<!-- Main Content -->
<div class="container">
    <div class="page-inner">
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
                                    <a class="nav-link active" id="line-home-tab" href="{{ route('front.orderList') }}">
                                        All({{ $orders->count() }})
                                    </a>
                                </li>
                                <li class="nav-item submenu" role="presentation">
                                    <a class="nav-link" id="line-home-tab" href="{{ route('front.orderPendingList') }}">
                                        Pending({{ $orders->where('status', 'pending')->count() }})
                                    </a>
                                </li>
                                <li class="nav-item submenu" role="presentation">
                                    <a class="nav-link" id="line-home-tab" href="{{ route('front.orderDeliveredList') }}">
                                        Delivered({{ $orders->where('status', 'delivered')->count() }})
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
                                                    <th>Customer</th>
                                                    <th>Email</th>
                                                    <th>Total</th>
                                                    <th>Status</th>
                                                    <th style="width: 19%">Date Purchased</th>
                                                    <th>Detail</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Customer</th>
                                                    <th>Email</th>
                                                    <th>Total</th>
                                                    <th>Status</th>
                                                    <th style="width: 19%">Date Purchased</th>
                                                    <th>Detail</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                @if ($orders->isNotEmpty())
                                                    @foreach ($orders as $order)                                                   
                                                        <tr>
                                                            <td id="order-detail-btn">{{ $order->id }}</td>
                                                            <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                                                            <td>{{ $order->email }}</td>
                                                            <td>${{ $order->grand_total }}</td>
                                                            <td>
                                                                @if ($order->status == 'pending')
                                                                    <span class="badge badge-warning">Pending</span>
                                                                @elseif ($order->status == 'shipped')
                                                                    <span class="badge badge-primary">Shipped</span>
                                                                @else
                                                                    <span class="badge badge-success">Delivered</span>
                                                                @endif
                                                            
                                                            </td>
                                                            
                                                            <td>{{ $order->created_at->format('d M, Y') }}</td>
                                                            <td>
                                                                {{-- <button type="button" class="btn btn-primary view-order" data-id="{{ $order->id }}">View</button> --}}
                                                                <a href="{{ route('front.orderDetail', $order->id) }}">View</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
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