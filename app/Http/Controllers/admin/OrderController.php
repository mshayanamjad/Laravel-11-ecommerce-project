<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::orderBy('id', 'asc')->get();

        // $orders = $query->paginate(10);

        $data = [
            'orders' => $orders,
        ];

        return view('admin.order.list', $data);
    }
}
