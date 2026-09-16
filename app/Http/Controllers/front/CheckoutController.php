<?php

namespace App\Http\Controllers\front;

use Stripe\Stripe;
use Stripe\Charge;
use App\Models\Order;
use App\Mail\OrderMail;
use App\Models\Product;
use App\Models\Country;
use App\Models\Shipping;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\CustomerAddress;
use App\Http\Controllers\Controller;
use App\Notifications\AdminNewOrder;
use App\Notifications\CustomerOrderPlaced;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckoutController extends Controller
{
    public function viewCheckout()
    {
        $user = Auth::user();

        if ($user) {
            Cart::instance($user->id);
        }

        if (Cart::count() == 0) {
            return redirect()->route('front.shop');
        }

        $customerAddress = CustomerAddress::where('user_id', $user->id)->first();

        if (Auth::check() == false) {
            if (!session()->has('url.intended')) {
                session(['url.intended' => url()->current()]);
            }

            return redirect()->route('front.userLogin');
        }

        session()->forget('url.intended');

        $countries = Country::orderBy('name', 'asc')->get();
        $shippingInfo = null;
        $totalQty = 0;
        $totalShippingCharge = 0;
        $grandTotal = 0;

        foreach (Cart::content() as $item) {
            $totalQty += $item->qty;
        }

        // Calculate shipping, defaulting to zero when no rate is configured.
        if ($customerAddress != '') {
            $userCountry = $customerAddress->country_id;
            $shippingInfo = Shipping::where('country_id', $userCountry)->first();
        }

        $subTotal = cartTotal();
        if ($shippingInfo === null) {
            $shippingInfo = Shipping::where('country_id', 'rest_of_world')->first();
        }

        $totalShippingCharge = $shippingInfo
            ? $totalQty * $shippingInfo->amount
            : 0;
        $grandTotal = $subTotal + $totalShippingCharge;

        $data = [
            'countries' => $countries,
            'user' => $user,
            'customerAddress' => $customerAddress,
            'shippingCharge' => $totalShippingCharge,
            'grandTotal' => $grandTotal
        ];
        return view('front.pages.checkout', $data);
    }


    public function checkoutProcess(Request $request)
    {
        // Step 1: Validation
        $validate = Validator::make($request->all(), [
            'first_name' => 'required|min:3',
            'last_name' => 'required',
            'email' => 'required|email',
            'country' => 'required',
            'address' => 'required|min:10',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'phone' => 'required|numeric',
            'payment_method' => 'required|in:cod,stripe',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Please fix the errors',
                'errors' => $validate->errors()
            ]);
        }

        $user = Auth::user();
        if (!$user) {
            return redirect()->route('front.userLogin')->with('message', 'Please log in to proceed.');
        }

        Cart::instance($user->id);

        // Step 2: Save User Address
        CustomerAddress::updateOrCreate(
            ['user_id' => $user->id],
            [
                'user_id' => $user->id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'country_id' => $request->country,
                'address' => $request->address,
                'apartment' => $request->apartment,
                'city' => $request->city,
                'state' => $request->state,
                'zip' => $request->zip,
                'note' => $request->note,
            ]
        );

        // Step 3: Check Stock Availability
        foreach (Cart::content() as $item) {
            $product = Product::find($item->id);
            if (!$product) {
                return response()->json([
                    'status' => false,
                    'message' => "Sorry, the product '{$item->name}' does not exist.",
                ]);
            }

            if (!is_null($product->qty) && $product->qty < $item->qty) {
                return response()->json([
                    'status' => false,
                    'message' => "Sorry, only {$product->qty} of '{$item->name}' is available.",
                ]);
            }
        }

        // Step 4: Calculate Total Price
        $shipping = 0;
        $subTotal = cartTotal();
        $totalQty = Cart::count();
        $shippingInfo = Shipping::where('country_id', $request->country)->first();

        if ($shippingInfo) {
            $shipping = $totalQty * $shippingInfo->amount;
        } else {
            $shippingRestOf = Shipping::where('country_id', 'rest_of_world')->first();
            $shipping = $shippingRestOf ? $totalQty * $shippingRestOf->amount : 0;
        }

        $grandTotal = $subTotal + $shipping;

        // Step 5: Handle Payment Method
        if ($request->payment_method == 'stripe') {
            try {
                Stripe::setApiKey(env('STRIPE_SECRET'));

                $charge = Charge::create([
                    'amount' => $grandTotal * 100, // Convert to cents
                    'currency' => 'usd',
                    'source' => $request->stripeToken, // The token we sent from JavaScript
                    'description' => 'Order Payment',
                ]);

                $paymentStatus = 'paid';
            } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'message' => 'Payment failed: ' . $e->getMessage(),
                ]);
            }
        } else {
            $paymentStatus = 'not paid'; // For COD
        }

        // Step 6: Store Order Data
        $order = new Order();
        $order->subtotal = $subTotal;
        $order->shipping = $shipping;
        $order->grand_total = $grandTotal;
        $order->payment_status = $paymentStatus;
        $order->status = 'pending';
        $order->user_id = $user->id;
        $order->first_name = $request->first_name;
        $order->last_name = $request->last_name;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->country_id = $request->country;
        $order->address = $request->address;
        $order->apartment = $request->apartment;
        $order->city = $request->city;
        $order->state = $request->state;
        $order->zip = $request->zip;
        $order->note = $request->note;
        $order->save();

        // Step 7: Store Order Items & Reduce Stock
        foreach (Cart::content() as $item) {
            $product = Product::find($item->id);
            $price = $product->sale_price ?? $product->price;

            $orderItem = new OrderItem();
            $orderItem->product_id = $item->id;
            $orderItem->order_id = $order->id;
            $orderItem->name = $item->name;
            $orderItem->qty = $item->qty;
            $orderItem->price = $price;
            $orderItem->total = $price * $item->qty;
            $orderItem->save();

            if ($product) {
                $product->qty = max(0, $product->qty - $item->qty);
                $product->save();
            }
        }

        // Step 8: Clear Cart & Return Response
        Cart::destroy();

        $user->notify(new CustomerOrderPlaced($order));

        User::where('role', 'admin')->get()->each(function ($admin) use ($order) {
            $admin->notify(new AdminNewOrder($order));
        });

        $orderData = [
            'order' => $order,
            'mailSubject' => 'Order Information'
        ];

        try {
            Mail::to($order->email)->send(new OrderMail($orderData));
        } catch (\Throwable $exception) {
            Log::error('Order confirmation email could not be sent.', [
                'order_id' => $order->id,
                'error' => $exception->getMessage(),
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Order placed successfully',
            'orderid' => $order->id,
        ]);
    }

    public function getOrderSummery(Request $request)
    {

        $user = Auth::user();

        if ($user) {
            Cart::instance($user->id);
        } else {
            return redirect()->route('front.userLogin')->with('message', 'Please log in to view your cart.'); // Add 'return' to stop further execution
        }


        $subTotal = cartTotal();
        if ($request->country_id > 0) {

            $shippingInfo = Shipping::where('country_id', $request->country_id)->first();

            $totalQty = 0;
            foreach (Cart::content() as $item) {
                $totalQty += $item->qty;
            }
            // $grandTotal = Cart::subtotal(2, '.', '')+$totalShippingCharge;

            if ($shippingInfo != null) {
                $shippingCharge = $totalQty * $shippingInfo->amount;
                $grandTotal = $subTotal + $shippingCharge;

                return response()->json([
                    'status' => true,
                    'grandTotal' => number_format($grandTotal, 2),
                    'shippingCharge' => number_format($shippingCharge, 2)
                ]);
            } else {
                $shippingInfo = Shipping::where('country_id', 'rest_of_world')->first();

                $shippingCharge = $shippingInfo
                    ? $totalQty * $shippingInfo->amount
                    : 0;
                $grandTotal = $subTotal + $shippingCharge;

                return response()->json([
                    'status' => true,
                    'grandTotal' => number_format($grandTotal, 2),
                    'shippingCharge' => number_format($shippingCharge, 2)
                ]);
            }
        } else {
            return response()->json([
                'status' => true,
                'grandTotal' => number_format($subTotal, 2),
                'shippingCharge' => 0
            ]);
        }
    }
}
