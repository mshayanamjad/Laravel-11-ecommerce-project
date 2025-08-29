<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Stripe\Customer;

class Product extends Model
{
    protected $fillable = ['title', 'slug', 'price', 'description', 'image', 
    'user_id', 'qty', 'status', 'barcode'];
    

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }

    public function brands()
    {
        return $this->belongsToMany(Brand::class, 'product_brands');
    }

    public function gallery()
    {
        return $this->hasMany(ProductImage::class);
    }

    // Product.php
    public function relatedProducts()
    {
        return Product::whereHas('categories', function ($query) {
            $query->whereIn('categories.id', $this->categories->pluck('id'));
        })
            ->where('id', '!=', $this->id) // Exclude the current product
            ->take(4)
            ->get(); // Execute the query
    }

    public function reviews()
    {
        return $this->hasMany(CustomerReview::class);
    }

}
