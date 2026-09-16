<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function customerInbox()
    {
        $notifications = auth()->user()->notifications()->latest()->paginate(20);

        return view('front.notifications.index', compact('notifications'));
    }

    public function adminInbox()
    {
        $notifications = Auth::guard('admin')->user()->notifications()->latest()->paginate(20);

        return view('admin.notifications.index', compact('notifications'));
    }

    public function markAsRead(Request $request, $id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->markAsRead();

        if (!empty($notification->data['url'])) {
            return redirect()->to($notification->data['url']);
        }

        return redirect()->back()->with('success', 'Notification marked as read.');
    }

    public function adminMarkAsRead(Request $request, $id)
    {
        $notification = Auth::guard('admin')->user()->notifications()->findOrFail($id);
        $notification->markAsRead();

        if (!empty($notification->data['url'])) {
            return redirect()->to($notification->data['url']);
        }

        return redirect()->back()->with('success', 'Notification marked as read.');
    }

    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();

        return redirect()->back()->with('success', 'All notifications marked as read.');
    }

    public function adminMarkAllAsRead()
    {
        Auth::guard('admin')->user()->unreadNotifications->markAsRead();

        return redirect()->back()->with('success', 'All notifications marked as read.');
    }
}
