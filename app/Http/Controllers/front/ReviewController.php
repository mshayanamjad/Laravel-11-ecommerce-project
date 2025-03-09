<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\CustomerReview;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Stripe\Customer;

class ReviewController extends Controller
{
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'rating' => 'required',
            'review_text' => 'required'
        ]);

        if (Auth::check() == false) {
            session(['url.intended' => url()->previous()]);
            return response()->json([
                'status' => false,
            ]);
        }

        $user = Auth::user();

        $productID = $request->input('product_id');


        if ($validator->passes()) {

            $review = new CustomerReview();

            $review->user_id = $user->id;
            $review->product_id = $productID;
            $review->rating = $request->rating;
            $review->review_text = $request->review_text;
            $review->save();

            return response()->json([
                'status' => true,
                'message' => 'Review Submitted Successfuly'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }


    public function edit($id)
    {
        $review = CustomerReview::find($id);

        return view('front.pages.single-product', compact('review'));
    }
}
