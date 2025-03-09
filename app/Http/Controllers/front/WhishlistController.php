<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Whishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WhishlistController extends Controller
{
    public function viewWishlist()
    {
        $wishlists = Whishlist::where('user_id', Auth::user()->id)->with('product')->get();
        return view('front.profile.whishlist', compact('wishlists'));
    }

    public function addToWishlist(Request $request)
    {
        if (Auth::check() == false) {
            session(['url.intended' => url()->previous()]);
            return response()->json([
                'status' => false,
            ]);
        }

        $product = Product::where('id', $request->id)->first();

        if ($product == null) {
            return response()->json([
                'status' => true,
                'message' => 'Product Not Found',
            ]);
        }

        // Update or create wishlist entry
        Whishlist::updateOrCreate(
            [
                'product_id' => $request->id,
                'user_id' => Auth::user()->id,
            ],
            [
                'product_id' => $request->id,
                'user_id' => Auth::user()->id,

            ]
        );


        return response()->json([
            'status' => true,
            'message' => 'Product added to whiishlist',
        ]);
    }

    public function reomveWhishlistPro(Request $request)
    {
        $wishlist = Whishlist::where('user_id', Auth::user()->id)->where('product_id', $request->id)->first();

        if ($wishlist == null) {
            session()->flash('error', 'Product not found in your Wishlist');
            return response()->json([
                'status' => false
            ]);
        } else {
            Whishlist::where('user_id', Auth::user()->id)->where('product_id', $request->id)->delete();
            session()->flash('success', 'Product removed from your Wishlist');
            return response()->json([
                'status' => true,
                'message' => 'Product removed from your Wishlist'
            ]);
        }
    }
}
