<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $product = Product::with(['gallery', 'categories', 'brands'])->find($request->id);
        if ($product == null) {
            return response()->json([
                'status' => false,
                'message' => 'Product Not Found'
            ]);
        }

        $user = Auth::user();

        if ($user) {
            Cart::instance($user->id);
        } else {
            return redirect()->route('front.userLogin')->with('message', 'Please log in to add items to the cart.');
        }

        $cartContent = Cart::content();

        $productAlreadyExist = false;

        foreach ($cartContent as $item) {
            if ($item->id == $product->id) {
                $productAlreadyExist = true;
                break;
            }
        }

        // Get quantity from the request (default to 1 if not provided)
        $quantity = $request->input('quantity', 1);
        if (!$productAlreadyExist) {
            Cart::add($product->id, $product->title, $quantity, $product->price, [
                'productImage' => $product->image ?? '',
                'salePrice' => $product->sale_price ?? 0,
            ]);


            $status = true;
            $message = 'Added to cart';
        } else {
            $status = false;
            $message = 'Product Already Exists in Cart';
        }

        return response()->json([
            'status' => $status,
            'message' => $message
        ]);
    }


    public function cart()
    {
        $user = Auth::user();
        if ($user) {
            Cart::instance($user->id);
        } else {
            return redirect()->route('account.login')->with('message', 'Please log in to view your cart.');
        }

        $cartContent = Cart::content();


        $data = [
            'cartContent' => $cartContent,
        ];

        return view('front.pages.cart', $data);
    }


    public function updateCart(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            Cart::instance($user->id);
        }

        $cartItems = $request->cartItems;
        if (!$cartItems) {
            return response()->json([
                'status' => false,
                'message' => 'No cart items received!'
            ]);
        }

        $errors = [];

        foreach ($cartItems as $cartItem) {
            $rowId = $cartItem['rowId'];
            $qty = $cartItem['qty'];

            $itemInfo = Cart::get($rowId);
            if (!$itemInfo) {
                $errors[] = "Invalid cart item: RowId '{$rowId}' not found.";
                continue;
            }

            $product = Product::find($itemInfo->id);
            if (!$product) {
                $errors[] = "Product ID '{$itemInfo->id}' not found in database.";
                continue;
            }

            // **NEW CONDITION: Update only if track_id is 'yes'**
            if ($product->track_id !== 'yes') {
                $errors[] = "Product '{$product->name}' cannot be updated because it is not tracked.";
                continue;
            }

            $productQty = $product->qty;

            // **Check if product qty is null, allow max 100**
            if (is_null($productQty)) {
                if ($qty > 100) {
                    $errors[] = "Product '{$product->name}' has an unlimited stock, but you can only purchase up to 100 pieces.";
                    continue;
                }
                Cart::update($rowId, $qty);
            } else {
                // **Normal case: Check if requested qty is within available stock**
                if ($qty <= $productQty) {
                    Cart::update($rowId, $qty);
                } else {
                    $errors[] = "Product '{$product->name}' has only {$productQty} available, but you requested {$qty}.";
                }
            }
        }

        return response()->json([
            'status' => empty($errors),
            'message' => empty($errors) ? 'Cart updated successfully!' : 'Some items could not be updated.',
            'errors' => $errors,
            'cart' => Cart::content()
        ]);
    }


    // Delete Item Method
    public function deleteItem(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            Cart::instance($user->id);
        }

        $rowId = $request->rowId;
        $itemInfo = Cart::get($rowId);

        if ($itemInfo == null) {
            session()->flash('error', 'Item Not Found In Cart');

            return response()->json([
                'status' => false,
                'message' => 'Item Not Found In Cart'
            ]);
        }

        Cart::remove($rowId);
        session()->flash('success', 'Item Removed From Cart');

        return response()->json([
            'status' => true,
            'message' => 'Item Removed From Cart'
        ]);
    }
}
