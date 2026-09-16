@extends('admin.layouts.app')

@section('title', 'Notifications')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="card-title mb-0">Admin Notifications</div>
                        @if(Auth::guard('admin')->user()->unreadNotifications->count())
                            <a href="{{ route('admin.notifications.markAllRead') }}" class="btn btn-sm btn-primary">Mark all as read</a>
                        @endif
                    </div>
                    <div class="card-body p-0">
                        @forelse($notifications as $notification)
                            <div class="border-bottom p-3 {{ $notification->read_at ? '' : 'bg-light' }}">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ data_get($notification, 'data.title', 'Notification') }}</strong>
                                        <p class="mb-1 text-muted">{{ data_get($notification, 'data.message', 'No message') }}</p>
                                    </div>
                                    @if(is_null($notification->read_at))
                                        <span class="badge bg-primary">New</span>
                                    @endif
                                </div>
                                <div class="mt-2 d-flex justify-content-between align-items-center">
                                    <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                    @if(!empty($notification->data['url']))
                                        <a href="{{ route('admin.notifications.read', ['id' => $notification->id]) }}" class="btn btn-sm btn-outline-primary">View</a>
                                    @else
                                        <a href="{{ route('admin.notifications.read', ['id' => $notification->id]) }}" class="btn btn-sm btn-outline-primary">Mark read</a>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="p-4 text-center text-muted">
                                You have no notifications yet.
                            </div>
                        @endforelse
                    </div>
                    @if($notifications->hasPages())
                        <div class="card-footer">
                            {{ $notifications->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
