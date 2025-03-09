<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function userProfile()
    {
        $user = Auth::user();
        return view('front.profile.profile', compact('user'));
    }

    public function updateProfile($id, Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'avatar' => 'image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        if ($validator->passes()) {

            $user->name = $request->name;
            $user->phone = $request->phone;

            if ($request->hasFile('avatar')) {
                $image = $request->file('avatar');

                $imagePath = public_path('uploads/profiles/' . $user->avatar);

                if ($user->avatar && File::exists($imagePath)) {
                    File::delete($imagePath);
                }


                $imageName = $user->id . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/profiles'), $imageName);

                $user->avatar = $imageName;
            }

            $user->save();

            session()->flash('success', 'Profile Updated');

            return response()->json([
                'status' => true,
                'message' => 'Profile Updated'
            ]);
        }

        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ]);
    }



    public function orderList()
    {

        $user = Auth::user();
        $query = Order::where('user_id', $user->id)->orderBy('id', 'desc');

        $orders = $query->paginate(20);

        $data = [
            'orders' => $orders,
        ];

        return view('front.profile.orders.orders-list', $data);
    }

    public function orderPendingList()
    {

        $user = Auth::user();
        $query = Order::where('user_id', $user->id)->where('status', 'pending')->orderBy('id', 'desc');
        $orders = Order::where('user_id', $user->id)->orderBy('id', 'desc')->get();

        $pendingOrders = $query->paginate(20);

        $data = [
            'pendingOrders' => $pendingOrders,
            'orders' => $orders,
        ];

        return view('front.profile.orders.pendingOrder', $data);
    }

    public function orderDeliveredList()
    {

        $user = Auth::user();
        $query = Order::where('user_id', $user->id)->where('status', 'delivered')->where('payment_status', 'paid')->orderBy('id', 'desc');
        $orders = Order::where('user_id', $user->id)->orderBy('id', 'desc')->get();

        $deliveredOrders = $query->paginate(20);

        $data = [
            'deliveredOrders' => $deliveredOrders,
            'orders' => $orders,
        ];

        return view('front.profile.orders.deliveredOrder', $data);
    }

    public function orderDetail($id)
    {
        $user = Auth::user();
        $order = Order::where('user_id', $user->id)->where('id', $id)->first();

        $orderItems = OrderItem::where('order_id', $id)->get();

        $data = [
            'order' => $order,
            'orderItems' => $orderItems
        ];

        return view('front.profile.orders.order-detail', $data);
    }
}
