<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Notifications\CustomerOrderStatusUpdated;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::query()->latest('id');

        if ($request->filled('keyword')) {
            $keyword = trim($request->keyword);

            $query->where(function ($orderQuery) use ($keyword) {
                $orderQuery->where('id', $keyword)
                    ->orWhere('first_name', 'like', "%{$keyword}%")
                    ->orWhere('last_name', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$keyword}%");
            });
        }

        $orders = $query->paginate(15)->withQueryString();

        return view('admin.order.list', compact('orders'));
    }

    public function edit(Order $order)
    {
        return view('admin.order.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $previousStatus = $order->status;

        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,packed,shipped,delivered,cancelled',
            'payment_status' => 'required|in:paid,not paid',
        ]);

        $order->status = $validated['status'];
        $order->payment_status = $validated['payment_status'];
        $order->save();

        $order->recordStatusChange($previousStatus, $order->status, auth()->id(), 'Status updated by admin.');

        if ($previousStatus !== $order->status) {
            $customer = User::find($order->user_id);

            if ($customer) {
                $customer->notify(new CustomerOrderStatusUpdated($order, $previousStatus));
            }
        }

        return redirect()->route('order.index')
            ->with('success', "Order #{$order->id} updated successfully.");
    }
}
