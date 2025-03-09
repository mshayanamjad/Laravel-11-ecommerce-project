<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    public function active(Request $request)
    {
        $query = Category::orderBy('id', 'asc')->where('status', 'active');

        if (!empty($request->get('keyword'))) {
            $query->where('name', 'like', '%' . $request->get('keyword') . '%');
        }

        $categories = $query->paginate(10);
        $count = Category::count();
        $activeCount = Category::where('status', 'active')->count();
        $blockCount = Category::where('status', 'block')->count();

        $data = [
            'categories' => $categories,
            'count' => $count,
            'activeCount' => $activeCount,
            'blockCount' => $blockCount,
        ];

        return view('admin.category.active', $data);
    }

    public function block(Request $request)
    {
        $query = Category::orderBy('id', 'asc')->where('status', 'block');

        if (!empty($request->get('keyword'))) {
            $query->where('name', 'like', '%' . $request->get('keyword') . '%');
        }

        $categories = $query->paginate(10);
        $count = Category::count();
        $activeCount = Category::where('status', 'active')->count();
        $blockCount = Category::where('status', 'block')->count();

        $data = [
            'categories' => $categories,
            'count' => $count,
            'activeCount' => $activeCount,
            'blockCount' => $blockCount,
        ];

        return view('admin.category.block', $data);
    }



    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Category::orderBy('id', 'asc');

        if (!empty($request->get('keyword'))) {
            $query->where('name', 'like', '%' . $request->get('keyword') . '%');
        }

        $categories = $query->paginate(10);
        $count = Category::count();
        $activeCount = Category::where('status', 'active')->count();
        $blockCount = Category::where('status', 'block')->count();

        $data = [
            'categories' => $categories,
            'count' => $count,
            'activeCount' => $activeCount,
            'blockCount' => $blockCount,
        ];

        return view('admin.category.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:categories,slug',
            'status' => 'required|in:active,block',
            'image' => 'image|mimes:png,jpg,jpeg,webp|max:2048'

        ]);

        if ($validator->passes()) {

            $category = new Category();

            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->status = $request->status;
            $category->save();

            if ($request->hasFile('image')) {
                $image = $request->file('image');

                $imageName = $category->id . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/cate_img'), $imageName);

                $category->image = $imageName;

                $category->save();
            }

            session()->flash('success', 'Category Added');
            return response()->json([
                'status' => 200,
                'message' => 'Category Added'
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
        $category = Category::find($id);

        if (empty($category)) {
            return redirect()->back()->with('error', 'Record Not Found');
        }

        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,' . $id,
            'status' => 'required|in:active,block',
            'image' => 'image|mimes:png,jpg,jpeg,webp|max:2048'

        ]);

        if ($validator->passes()) {

            $category = Category::find($id);

            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->status = $request->status;

            if ($request->hasFile('image')) {
                $image = $request->file('image');

                $imagePath = public_path('uploads/cate_img/' . $category->image);

                // Delete the old image if it exists using File facade
                if ($category->image && File::exists($imagePath)) {
                    File::delete($imagePath);
                }

                $imageName = $category->id . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/cate_img'), $imageName);

                $category->image = $imageName;
            }
            $category->save();

            session()->flash('success', 'Category Updated');
            return response()->json([
                'status' => 200,
                'message' => 'Category Updated'
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
        $category = Category::find($id);

        if (empty($category)) {
            return redirect()->back()->with('error', 'Record Not Found');
        }

        if (!empty($category->image)) {
            $imagePath = public_path('uploads/cate_img/' . $category->image);

            if (file_exists($imagePath) && is_file($imagePath)) {
                unlink($imagePath);
            }
        }

        $category->delete();

        return redirect()->back()->with('success', 'Record Deleted');
    }
}
