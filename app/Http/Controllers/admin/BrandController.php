<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Trait\BrandList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    use BrandList;

    public function active(Request $request)
    {
        $data = $this->getBrandData($request, 'active');
        return view('admin.brand.active', $data);
    }

    public function block(Request $request)
    {
        $data = $this->getBrandData($request, 'block');
        return view('admin.brand.block', $data);
    }

    public function index(Request $request)
    {
        $data = $this->getBrandData($request);
        return view('admin.brand.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:brands,slug',
            'status' => 'required|in:active,block'
        ]);

        if ($validator->passes()) {

            $brand = new Brand();

            $brand->name = $request->name;
            $brand->slug = $request->slug;
            $brand->status = $request->status;
            $brand->save();

            session()->flash('success', 'Brand Added');

            return response()->json([
                'status' => 200,
                'message' => 'Brand Added'
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
        $brand = Brand::find($id);

        if (empty($brand)) {
            return redirect()->back()->with('error', 'Record Not Found');
        }

        return view('admin.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:brands,slug,' . $id,
            'status' => 'required|in:active,block'
        ]);

        if ($validator->passes()) {

            $brand = Brand::find($id);

            $brand->name = $request->name;
            $brand->slug = $request->slug;
            $brand->status = $request->status;
            $brand->save();

            session()->flash('success', 'Brand Updated');

            return response()->json([
                'status' => 200,
                'message' => 'Brand Updated'
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
        $brand = Brand::find($id);

        if (empty($brand)) {
            return redirect()->back()->with('error', 'Record Not Found');
        }

        $brand->delete();

        return redirect()->back()->with('success', 'Record Deleted');
    }
}
