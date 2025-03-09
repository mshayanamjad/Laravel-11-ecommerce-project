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
                            <div class="card-title" style="white-space: nowrap;">
                                Orders #{{ $order->id }}
                            </div>
                            <div class="action-buttons">
                                <a href="{{ route('front.orderList') }}" class="btn btn-primary me-3">Order List</a>
                                <button class="btn btn-secondary">Download Invoice</button>
                            </div>
                        </div>
                        
                        <div class="card-body pt-0">
                            <div class="order-info">
                                
                                <div class="info-group">
                                    <h4>Shipping Information</h4>
                                    <p>{{ $order->first_name }} {{ $order->last_name }}</p>
                                    <p>{{ $order->email }}</p>
                                    <p>{{ $order->phone }}</p>
                                    @if ($order->apartment != null)
                                    <p>{{ $order->apartment }}</p> 
                                    @endif
                                    <p>{{ $order->address }}</p>
                                </div>
                                
                                <div class="info-group">
                                    <h4>Payment Information</h4>
                                    <p>Credit Card ending in 4242</p>
                                    <p>Total: ${{ number_format($order->grand_total, 2) }}</p>
                                    <p>
                                        @if ($order->payment_status == 'not paid')
                                            <span class="badge badge-warning">Not Paid</span>
                                        @else
                                            <span class="badge badge-success">Paid</span>
                                        @endif
                                    </p>
                                </div>
                                <div class="item-list">
                                    <h4>Item List</h4>
                                    @foreach ($orderItems as $item)
                                        @php
                                            $productImage = getProductImage($item->product_id);
                                        @endphp    
                                        <div class="item-row">
                                            <div class="item-info">
                                                <img src="{{ asset('uploads/product-image/'. $productImage->image) }}" alt="Product" class="item-image">
                                                <div>
                                                    <p>{{ $item->name }}</p>
                                                    <small>Qty: {{ $item->qty }}</small>
                                                </div>
                                            </div>
                                            <p>${{ number_format($item->price, 2) }}</p>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="totals">
                                    <h4>Items Total</h4>
                                    <p>Subtotal: ${{ number_format($order->subtotal, 2) }}</p>
                                    <p>Shipping: ${{ number_format($order->shipping, 2) }}</p>
                                    <p>Total: ${{ number_format($order->grand_total, 2) }}</p>
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