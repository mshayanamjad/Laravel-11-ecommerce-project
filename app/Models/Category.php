<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function sub_categories()
    {
        return $this->hasMany(SubCategory::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_categories');
    }
}
