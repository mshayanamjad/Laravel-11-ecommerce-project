@extends('admin.layouts.app')
@section('title', 'Edit Order - ')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <ul class="breadcrumbs mb-3 p-0 m-0 border-0">
                <li class="nav-home"><a href="{{ route('admin.dashboard') }}"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('order.index') }}">Orders</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a>Order #{{ $order->id }}</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="card-title mb-0">Update Order #{{ $order->id }}</div>
                        <span class="text-muted small">{{ $order->created_at->format('d M Y, h:i A') }}</span>
                    </div>
                    <form action="{{ route('order.update', $order) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="status">Order Status</label>
                                    <select name="status" id="status" class="form-select" required>
                                        @foreach (['pending' => 'Pending', 'confirmed' => 'Confirmed', 'packed' => 'Packed', 'shipped' => 'Shipped', 'delivered' => 'Delivered', 'cancelled' => 'Cancelled'] as $value => $label)
                                            <option value="{{ $value }}" @selected(old('status', $order->status) === $value)>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="payment_status">Payment Status</label>
                                    <select name="payment_status" id="payment_status" class="form-select" required>
                                        <option value="not paid" @selected(old('payment_status', $order->payment_status) === 'not paid')>Not paid</option>
                                        <option value="paid" @selected(old('payment_status', $order->payment_status) === 'paid')>Paid</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end gap-2">
                            <a href="{{ route('order.index') }}" class="btn btn-light">Cancel</a>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save me-1"></i> Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header"><div class="card-title mb-0">Customer Details</div></div>
                    <div class="card-body">
                        <h5 class="mb-1">{{ $order->first_name }} {{ $order->last_name }}</h5>
                        <p class="text-muted mb-3">{{ $order->email }}</p>
                        <dl class="row mb-0">
                            <dt class="col-5">Phone</dt><dd class="col-7">{{ $order->phone }}</dd>
                            <dt class="col-5">Address</dt><dd class="col-7">{{ $order->address }}, {{ $order->city }}</dd>
                            <dt class="col-5">Total</dt><dd class="col-7 fw-bold">${{ number_format($order->grand_total, 2) }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
