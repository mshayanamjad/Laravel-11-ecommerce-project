<?php

namespace App\Http\Controllers\admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\CustomerReview;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = CustomerReview::orderBy('id', 'asc')->with('user', 'product');

        if (!empty($request->get('keyword'))) {
            $query->where('review_text', 'like', '%' . $request->get('keyword') . '%');
        }

        $reviews = $query->paginate(20);

        $reviewCount = CustomerReview::count();

        $data = [
            'reviews' => $reviews,
            'reviewCount' => $reviewCount,
        ];

        return view('admin.review.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $review = CustomerReview::find($id);

        return view('admin.review.edit', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $review = CustomerReview::find($id);

        $validator = Validator::make($request->all(), [
            'rating' => 'required',
            'review_text' => 'required'
        ]);

        if ($validator->passes()) {

            $review->rating = $request->rating;
            $review->review_text = $request->review_text;
            $review->save();

            return response()->json([
                'status' => true,
                'message' => 'Review Updated Successfuly'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $review = CustomerReview::find($id);

        if (empty($review)) {
            return redirect()->back()->with('error', 'Record Not Found');
        }

        $review->delete();

        return redirect()->back()->with('success', 'Record Deleted');
    }
}
