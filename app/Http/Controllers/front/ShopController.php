<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CustomerReview;
use App\Models\Product;
use App\Models\Whishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{

    public function shop(Request $request)
    {
        $query = Product::latest('id')->where('status', 'publish');

        if (!empty($request->get('keyword'))) {
            $query->where('title', 'like', '%' . $request->get('keyword') . '%');
        }

        $keyword = $request->input('keyword');
        $products = searchProducts($keyword); // Using the helper function

        $categories = Category::orderBy('name', 'asc')->where('status', 'active')->get();
        $brands = Brand::orderBy('name', 'asc')->where('status', 'active')->get();

        // Apply category filters if selected (multiple categories)
        if ($request->has('category') && !empty($request->category)) {
            $query->whereHas('categories', function ($query) use ($request) {
                $query->whereIn('categories.slug', $request->category);  // Filter products by multiple categories
            });
        }

        // Apply brand filters if selected (multiple brands)
        if ($request->has('brand') && !empty($request->brand)) {
            $query->whereHas('brands', function ($query) use ($request) {
                $query->whereIn('brands.slug', $request->brand);  // Filter products by multiple brands
            });
        }

        $products = $query->paginate(12);

        $data = [
            'products' => $products,
            'categories' => $categories,
            'brands' => $brands,
            'keyword' => $keyword
        ];

        return view('front.pages.shop', $data);
    }

    public function product($slug)
    {
        $product = Product::where('slug', $slug)->with(['gallery', 'categories', 'brands'])->first();

        $description = $product->short_desc ?: $product->description;
        $product->short_desc = $this->getShortDescription($description);


        $reviews = CustomerReview::where('product_id', $product->id)->where('approved', 1)->with('user')->latest()->get();



        $data = [
            'product' => $product,
            'reviews' => $reviews,
        ];

        return view('front.pages.single-product', $data);
    }

    private function getShortDescription($description, $wordLimit = 30)
    {
        $words = explode(' ', strip_tags($description));

        if (count($words) > $wordLimit) {
            $words = array_slice($words, 0, $wordLimit);
            return implode(' ', $words);
        }

        return implode(' ', $words);
    }
}
