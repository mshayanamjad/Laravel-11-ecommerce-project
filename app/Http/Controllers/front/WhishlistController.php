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
            return response()->json([
                'status' => false,
                'message' => 'Please log in to add items to your wishlist.',
                'redirect' => route('front.userLogin'),
            ]);
        }

        $product = Product::where('id', $request->id)->first();

        if ($product == null) {
            return response()->json([
                'status' => false,
                'message' => 'Product Not Found',
            ]);
        }

        $wishlist = Whishlist::where('user_id', Auth::user()->id)
            ->where('product_id', $request->id)
            ->first();

        if ($wishlist) {
            $wishlist->delete();

            return response()->json([
                'status' => true,
                'removed' => true,
                'message' => 'Product removed from your wishlist.',
            ]);
        }

        Whishlist::create([
            'product_id' => $request->id,
            'user_id' => Auth::user()->id,
        ]);

        return response()->json([
            'status' => true,
            'removed' => false,
            'message' => 'Product added to wishlist.',
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
