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
                        <div class="info-group w-100 mb-4 px-4">
                            <h4 class="mb-4">Order Tracking</h4>
                            @php
                                $timeline = $order->getStatusTimeline();
                                $statusLabels = [
                                    'pending' => 'Order placed',
                                    'confirmed' => 'Confirmed',
                                    'packed' => 'Packed',
                                    'shipped' => 'Shipped',
                                    'delivered' => 'Delivered',
                                    'cancelled' => 'Cancelled',
                                ];
                                $allStatuses = ['pending', 'confirmed', 'packed', 'shipped', 'delivered'];
                                $currentStatus = $order->status;
                                $currentIndex = array_search($currentStatus, $allStatuses, true);
                                $currentIndex = $currentIndex === false ? 0 : $currentIndex;
                                $progressPercent = count($allStatuses) > 1 ? (($currentIndex + 1) / count($allStatuses)) * 100 : 100;
                            @endphp

                            <div class="tracking-card w-100 p-4" style="background: #fff; border: 1px solid #f0f0f0; border-radius: 18px; box-shadow: 0 10px 24px rgba(17, 24, 39, 0.025);">
                                <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
                                    <div>
                                        <div class="text-uppercase small text-muted" style="letter-spacing: 0.16em; font-weight: 700; font-size: 11px;">Tracking</div>
                                        <!-- <div class="h4 mb-0 text-dark" style="font-weight: 700; letter-spacing: -0.03em;">
                                            {{ $statusLabels[$currentStatus] ?? ucfirst($currentStatus) }}
                                        </div> -->
                                    </div>
                                    <div class="d-flex align-items-center gap-2 px-3 py-2 rounded-pill" style="background: #f3fbf5; border: 1px solid rgba(34, 197, 94, 0.18);">
                                        <span class="rounded-circle bg-success" style="width: 9px; height: 9px; display: inline-block;"></span>
                                        <span class="fw-semibold text-success" style="font-size: 0.8rem;">{{ ucfirst($currentStatus) }}</span>
                                    </div>
                                </div>

                                <div class="position-relative mb-3" style="padding: 0 12px;">
                                    <div class="d-flex align-items-center position-relative" style="height: 40px;">
                                        <div class="position-absolute top-50 start-0 end-0 translate-middle-y" style="height: 3px; background: #efefef; border-radius: 999px;"></div>
                                        <div class="position-absolute top-50 start-0 translate-middle-y" style="height: 3px; width: {{ $progressPercent }}%; background: linear-gradient(90deg, #4ade80 0%, #16a34a 100%); border-radius: 999px;"></div>
                                        @foreach ($allStatuses as $index => $status)
                                            @php
                                                $isPast = $index < $currentIndex;
                                                $isActive = $status === $currentStatus;
                                            @endphp
                                            <div class="position-relative d-flex justify-content-center" style="z-index: 2; width: 20%;">
                                                <div class="rounded-circle d-flex align-items-center justify-content-center border {{ $isPast || $isActive ? 'bg-success border-success text-white' : 'bg-white border-secondary text-muted' }}" style="width: 28px; height: 28px; border-width: 2px; box-shadow: {{ $isPast || $isActive ? '0 8px 18px rgba(34,197,94,0.18)' : 'none' }};">
                                                    <i class="fa {{ $isPast || $isActive ? 'fa-check' : 'fa-circle' }}" style="font-size: 10px;"></i>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="row g-3 mt-1 px-3">
                                    @foreach ($allStatuses as $status)
                                        @php
                                            $statusEntry = collect($timeline)->firstWhere('status', $status);
                                            $isActive = $status === $currentStatus;
                                            $isPast = array_search($status, $allStatuses, true) < $currentIndex;
                                            $statusLabel = $statusLabels[$status] ?? ucfirst($status);
                                        @endphp
                                        <div class="col-sm-4 col-6 p-0" style="width: 20%;">
                                            <div class="text-center px-0">
                                                <div class="fw-semibold {{ $isPast || $isActive ? 'text-dark' : 'text-muted' }}" style="font-size: 0.82rem;">{{ $statusLabel }}</div>
                                                <div class="small mt-1 {{ $isPast || $isActive ? 'text-secondary' : 'text-muted' }}">
                                                    @if ($statusEntry && $statusEntry['date'])
                                                        {{ $statusEntry['date']->format('d M Y') }}
                                                    @else
                                                        {{ $isPast ? 'Done' : 'Pending' }}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
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