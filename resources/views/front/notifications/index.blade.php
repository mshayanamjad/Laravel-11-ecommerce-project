@extends('front.profile.layouts.app')

@section('content')
<div class="container py-5">
    <div class="page-inner">
        <div class="col-lg-12">
            <div class="card shadow-sm border-0">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">My Notifications</h4>
                    @if(auth()->user()->unreadNotifications->count())
                        <a href="{{ route('front.notifications.markAllRead') }}" class="btn btn-sm btn-light" style="background-color: #ebecec !important;">Mark all as read</a>
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
                                    <a href="{{ route('front.notifications.read', ['id' => $notification->id]) }}" class="btn btn-sm btn-outline-dark">View</a>
                                @else
                                    <a href="{{ route('front.notifications.read', ['id' => $notification->id]) }}" class="btn btn-sm btn-outline-dark">Mark read</a>
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
@endsection
