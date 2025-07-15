<?php

namespace App\Trait;

use App\Models\Product;
use Illuminate\Http\Request;


trait ProductList
{
    public function getProductData(Request $request, $status = null)
    {
        $query = Product::orderBy('id', 'desc')->with('categories');

        if ($status) {
            $query->where('status', $status);
        }

        if (!empty($request->get('keyword'))) {
            $query->where('title', 'like', '%' . $request->get('keyword') . '%');
        }

        $products = $query->paginate(10);

        return [
            'products' => $products,
            'count' => Product::count(),
            'publishedCount' => Product::where('status', 'publish')->count(),
            'draftCount' => Product::where('status', 'draft')->count(),
        ];
    }
}
