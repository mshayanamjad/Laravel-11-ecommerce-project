<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubCategoryController extends Controller
{


    public function active(Request $request)
    {
        $activeSubCategories = SubCategory::select('sub_categories.*', 'categories.name as categoryName')
            ->latest('id')
            ->leftJoin('categories', 'categories.id', 'sub_categories.category_id');

        if (!empty($request->get('keyword'))) {
            $activeSubCategories = $activeSubCategories->where('sub_categories.name', 'like', '%' . $request->get('keyword') . '%');
            $activeSubCategories = $activeSubCategories->orWhere('categories.name', 'like', '%' . $request->get('keyword') . '%');
        }



        $subCategories = $activeSubCategories->paginate(10);
        $count = SubCategory::count();

        // Count published SubCategorys
        $activeCount = SubCategory::where('status', 'active')->count();

        // Count draft SubCategorys
        $blockCount = SubCategory::where('status', 'block')->count();

        $data = [
            'subCategories' => $subCategories,
            'count' => $count,
            'activeCount' => $activeCount,
            'blockCount' => $blockCount,
        ];

        return view('admin.sub-category.active', $data);
    }

    public function block(Request $request)
    {
        $blockSubCategories = SubCategory::select('sub_categories.*', 'categories.name as categoryName')
            ->latest('id')
            ->leftJoin('categories', 'categories.id', 'sub_categories.category_id');

        if (!empty($request->get('keyword'))) {
            $blockSubCategories = $blockSubCategories->where('sub_categories.name', 'like', '%' . $request->get('keyword') . '%');
            $blockSubCategories = $blockSubCategories->orWhere('categories.name', 'like', '%' . $request->get('keyword') . '%');
        }


        $subCategories = $blockSubCategories->paginate(10);
        $count = SubCategory::count();

        // Count published SubCategorys
        $activeCount = SubCategory::where('status', 'active')->count();

        // Count draft SubCategorys
        $blockCount = SubCategory::where('status', 'block')->count();

        $data = [
            'subCategories' => $subCategories,
            'count' => $count,
            'activeCount' => $activeCount,
            'blockCount' => $blockCount,
        ];

        return view('admin.sub-category.block', $data);
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $subCategories = SubCategory::select('sub_categories.*', 'categories.name as categoryName')
            ->latest('id')
            ->leftJoin('categories', 'categories.id', 'sub_categories.category_id');

        if (!empty($request->get('keyword'))) {
            $subCategories = $subCategories->where('sub_categories.name', 'like', '%' . $request->get('keyword') . '%');
            $subCategories = $subCategories->orWhere('categories.name', 'like', '%' . $request->get('keyword') . '%');
        }

        $subCategories = $subCategories->paginate(10);
        $count = SubCategory::count();

        // Count published SubCategorys
        $activeCount = SubCategory::where('status', 'active')->count();

        // Count draft SubCategorys
        $blockCount = SubCategory::where('status', 'block')->count();

        $data = [
            'subCategories' => $subCategories,
            'count' => $count,
            'activeCount' => $activeCount,
            'blockCount' => $blockCount,
        ];

        return view('admin.sub-category.list', $data);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->where('status', 'active')->get();
        return view('admin.sub-category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:sub_categories,slug',
            'status' => 'required|in:active,block',
            'category_id' => 'required'
        ]);

        if ($validator->passes()) {

            $subCategory = new SubCategory();

            $subCategory->name = $request->name;
            $subCategory->slug = $request->slug;
            $subCategory->category_id = $request->category_id;
            $subCategory->status = $request->status;
            $subCategory->save();

            session()->flash('success', 'Sub Category Added');
            return response()->json([
                'status' => 200,
                'message' => 'Sub Category Added'
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
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
        $subCategory = SubCategory::find($id);

        if (empty($subCategory)) {
            return redirect()->back()->with('error', 'Record Not Found');
        }

        $categories = Category::orderBy('name', 'Asc')->get();
        $data['categories'] = $categories;
        $data['subCategory'] = $subCategory;

        return view('admin.sub-category.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:sub_categories,slug,' . $id,
            'status' => 'required|in:active,block',
            'category_id' => 'required'
        ]);

        if ($validator->passes()) {

            $subCategory = SubCategory::find($id);

            $subCategory->name = $request->name;
            $subCategory->slug = $request->slug;
            $subCategory->category_id = $request->category_id;
            $subCategory->status = $request->status;
            $subCategory->save();

            session()->flash('success', 'Sub Category Updated');
            return response()->json([
                'status' => 200,
                'message' => 'Sub Category Updated'
            ], 200);
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
        $subCategory = SubCategory::find($id);

        if (empty($subCategory)) {
            return redirect()->back()->with('error', 'Record Not Found');
        }

        $subCategory->delete();

        return redirect()->back()->with('success', 'Record deleted');
    }
}
