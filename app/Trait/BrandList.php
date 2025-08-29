<?php

namespace App\Trait;

use App\Models\Brand;
use Illuminate\Http\Request;

trait BrandList
{
    public function getBrandData(Request $request, $status = null)
    {
        $query = Brand::orderBy('id', 'asc');

        if ($status) {
            $query->where('status', $status);
        }

        if (!empty($request->get('keyword'))) {
            $query->where('name', 'like', '%' . $request->get('keyword') . '%');
        }

        $brands = $query->paginate(10);

        return [
            'brands' => $brands,
            'count' => Brand::count(),
            'activeCount' => Brand::where('status', 'active')->count(),
            'blockCount' => Brand::where('status', 'block')->count(),
        ];
    }
}
