<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $products = Product::where('status', 'publish')
            ->latest()
            ->whereNull('sale_price') // or ->where('sale_price', 0)
            ->take(8)
            ->get();


        $productsOnSale = Product::where('status', 'publish')
            ->whereNotNull('sale_price')
            ->whereColumn('sale_price', '<', 'price') // Ensure sale price is lower than price
            ->latest()
            ->take(8)
            ->get();

        // Get the product with the highest discount (must be at least 50% off)
        $highestDiscountProduct = $productsOnSale
            ->filter(fn($item) => $item->price > 0 && (($item->price - $item->sale_price) / $item->price) * 100 >= 50)
            ->sortByDesc(fn($item) => (($item->price - $item->sale_price) / $item->price) * 100)
            ->first(); // Get the product with the max discount

        $data = [
            'products' => $products,
            'productsOnSale' => $productsOnSale,
            'highestDiscountProduct' => $highestDiscountProduct, // Only one product
        ];

        return view('front.pages.home', $data);
    }

    public function about() {
        return view('front.pages.about');
    }
    
    public function contact() {
        return view('front.pages.contact');
    }
}
