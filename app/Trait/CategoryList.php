<?php

namespace App\Trait;

use Illuminate\Http\Request;
use App\Models\Category;

trait CategoryList
{
    public function getCategoryData(Request $request, $status = null)
    {
        $query = Category::orderBy('id', 'asc');

        if ($status) {
            $query->where('status', $status);
        }

        if (!empty($request->get('keyword'))) {
            $query->where('name', 'like', '%' . $request->get('keyword') . '%');
        }

        $categories = $query->paginate(10);

        return [
            'categories' => $categories,
            'count' => Category::count(),
            'activeCount' => Category::where('status', 'active')->count(),
            'blockCount' => Category::where('status', 'block')->count(),
        ];
    }
}
