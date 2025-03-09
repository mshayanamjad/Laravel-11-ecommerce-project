<?php

use App\Models\CustomerReview;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Product;
use App\Models\Whishlist;
use Illuminate\Support\Facades\Auth;

function cartTotal()
{
    $cartContent = Cart::content();
    $cartSubtotal = 0;

    foreach ($cartContent as $item) {
        // Check if salePrice exists and is greater than 0
        $price = (!empty($item->options['salePrice']) && $item->options['salePrice'] > 0)
            ? $item->options['salePrice']
            : $item->price;

        $cartSubtotal += $price * $item->qty;
    }

    return number_format($cartSubtotal, 2);
}

if (!function_exists('searchProducts')) {
    function searchProducts($keyword)
    {
        if (!$keyword) {
            return Product::all(); // Return all products if no search keyword is provided
        }

        return Product::where('title', 'LIKE', "%$keyword%")
            ->orWhere('description', 'LIKE', "%$keyword%")
            ->get();
    }
}

function whishlistedProducts()
{
    if (!Auth::check()) {
        return collect([]); // Return an empty collection if the user is not logged in
    }

    return Whishlist::where('user_id', Auth::id())->with('product')->get();
}

function getProductImage($productId)
{
    return Product::where('id', $productId)->first();
}


function getAverageRating($productId)
{
    $product = Product::find($productId);

    if (!$product) {
        return 0; // Return 0 if product not found
    }

    $reviews = CustomerReview::where('product_id', $product->id)
        ->where('approved', 1)
        ->get();

    return $reviews->count() > 0 ? round($reviews->avg('rating'), 1) : 0;
}
