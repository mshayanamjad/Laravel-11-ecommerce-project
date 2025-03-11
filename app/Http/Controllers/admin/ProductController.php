<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function publish(Request $request)
    {
        $query = Product::orderBy('id', 'desc')->with('categories')->where('status', 'publish');

        if (!empty($request->get('keyword'))) {
            $query->where('title', 'like', '%' . $request->get('keyword') . '%');
        }

        $publishedProducts = $query->paginate(10);
        // Count all products in the database
        $count = Product::count();

        // Count published products
        $publishedCount = Product::where('status', 'publish')->count();

        // Count draft products
        $draftCount = Product::where('status', 'draft')->count();

        $data = [
            'publishedProducts' => $publishedProducts,
            'count' => $count,
            'publishedCount' => $publishedCount,
            'draftCount' => $draftCount,
        ];

        return view('admin.product.publish', $data);
    }

    public function draft(Request $request)
    {
        $query = Product::orderBy('id', 'desc')->with('categories')->where('status', 'draft');

        if (!empty($request->get('keyword'))) {
            $query->where('title', 'like', '%' . $request->get('keyword') . '%');
        }

        $draftProducts = $query->paginate(10);
        // Count all products in the database
        $count = Product::count();

        // Count published products
        $publishedCount = Product::where('status', 'publish')->count();

        // Count draft products
        $draftCount = Product::where('status', 'draft')->count();

        $data = [
            'draftProducts' => $draftProducts,
            'count' => $count,
            'publishedCount' => $publishedCount,
            'draftCount' => $draftCount,
        ];

        return view('admin.product.draft', $data);
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::orderBy('id', 'desc')->with('categories');

        if (!empty($request->get('keyword'))) {
            $query->where('title', 'like', '%' . $request->get('keyword') . '%');
        }

        $products = $query->paginate(10);
        // Count all products in the database
        $count = Product::count();

        // Count published products
        $publishedCount = Product::where('status', 'publish')->count();

        // Count draft products
        $draftCount = Product::where('status', 'draft')->count();

        $data = [
            'products' => $products,
            'count' => $count,
            'publishedCount' => $publishedCount,
            'draftCount' => $draftCount,
        ];

        return view('admin.product.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->where('status', 'active')->get();
        $subCategories = SubCategory::orderBy('name', 'asc')->where('status', 'active')->get();
        $brands = Brand::orderBy('name', 'asc')->where('status', 'active')->get();

        $data = [
            'categories' => $categories,
            'subCategories' => $subCategories,
            'brands' => $brands,
        ];
        return view('admin.product.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'slug' => 'required|unique:products,slug',
            'price' => 'numeric',
            'sku' => 'unique:products,sku',
            'barcode' => 'unique:products,barcode',
            'is_featured' => 'required|in:yes,no',
            'image' => 'image|mimes:png,jpg,jpeg,webp',
            'categories' => 'array', // Validate that categories is an array
            'categories.*' => 'exists:categories,id', // Validate that each category ID exists
            'brands' => 'array', // Validate that brands is an array
            'brands.*' => 'exists:brands,id', // Validate that each Brand ID exists
            'gallery' => 'array',
            'gallery.*' => 'image|mimes:jpeg,png,jpg,webp',
        ]);

        $user = null;

        if (Auth::guard('admin')->check()) {
            $user = Auth::guard('admin')->user();
        } elseif (Auth::guard('manager')->check()) {
            $user = Auth::guard('manager')->user();
        }

        // If no user is authenticated, return an error response
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User is not authenticated',
            ]);
        }

        if ($validator->passes()) {

            $product = new Product();

            // Set product attributes
            $product->title = $request->title;
            $product->slug = $request->slug;
            $product->description = $request->description;
            $product->status = $request->status;
            $product->is_featured = $request->is_featured;
            $product->price = $request->price;
            $product->sale_price = $request->sale_price;
            $product->qty = $request->qty;
            $product->short_desc = $request->short_desc;
            $product->user_id = $user->id;

            // Check if SKU is set, if not generate automatically
            if (empty($request->sku)) {
                $product->sku = 'SKU-' . now()->format('Ymd') . '-' . strtoupper(substr(uniqid(), -3));
            } else {
                $product->sku = $request->sku;
            }


            // Check if Barcode is set, if not generate automatically
            if (empty($request->barcode)) {
                $product->barcode = rand(100000000000, 999999999999); // or any other barcode generation logic
            } else {
                $product->barcode = $request->barcode;
            }


            $product->save();
            // Assign Taxsonomy to the product
            $product->categories()->sync($request->categories);
            $product->brands()->sync($request->brands);

            if ($request->hasFile('image')) {
                $image = $request->file('image');

                $imageName = $product->id . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/product-image'), $imageName);

                $product->image = $imageName;

                $product->save();
            }


            if ($request->hasFile('gallery')) {
                $images = [];
                foreach ($request->file('gallery') as $image) {
                    // Generate a unique image name
                    $imageName = $product->id . '_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

                    // Move the image to your custom directory
                    $image->move(public_path('uploads/product-gallery'), $imageName);

                    // Store the image path in the database
                    $images[] = ['gallery' => $imageName];
                }

                // Save image paths into the product's gallery (assuming you have a 'gallery' relationship)
                foreach ($images as $imageData) {
                    $product->gallery()->create($imageData);
                }
            }





            return response()->json([
                'status' => 200,
                'message' => 'Product Published'
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
        $product = Product::find($id);
        $categories = Category::orderBy('name', 'asc')->where('status', 'active')->get();
        $subCategories = SubCategory::orderBy('name', 'asc')->where('status', 'active')->get();
        $brands = Brand::orderBy('name', 'asc')->where('status', 'active')->get();

        if (empty($product)) {
            return redirect()->back()->with('error', 'Record Not Found');
        }

        $data = [
            'product' => $product,
            'categories' => $categories,
            'subCategories' => $subCategories,
            'brands' => $brands,
        ];

        return view('admin.product.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'slug' => 'required|unique:products,slug,' . $id,
            'price' => 'numeric',
            'sku' => 'nullable|unique:products,sku,' . $id,
            'barcode' => 'nullable|unique:products,barcode,' . $id,
            'is_featured' => 'required|in:yes,no',
            'image' => 'image|mimes:png,jpg,jpeg,webp',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
            'brands' => 'array',
            'brands.*' => 'exists:brands,id',
            'gallery' => 'array',
            'gallery.*' => 'image|mimes:jpeg,png,jpg,webp',
            'delete_images' => 'nullable|array',
            'delete_images.*' => 'exists:product_images,id',
        ]);

        if ($validator->passes()) {
            $product = Product::findOrFail($id);

            // Update other product details
            $product->title = $request->title;
            $product->slug = $request->slug;
            $product->description = $request->description;
            $product->status = $request->status;
            $product->is_featured = $request->is_featured;
            $product->price = $request->price;
            $product->sale_price = $request->sale_price;
            $product->qty = $request->qty;
            $product->short_desc = $request->short_desc;


            // Assign Taxonomy to the product
            $product->categories()->sync($request->categories);
            $product->brands()->sync($request->brands);

            // Handle product image update
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imagePath = public_path('uploads/product-image/' . $product->image);

                // Delete old product image if it exists
                if ($product->image && File::exists($imagePath)) {
                    File::delete($imagePath);
                }

                $imageName = $product->id . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/product-image'), $imageName);

                $product->image = $imageName;
            }

            // Handle deleting selected gallery images
            if ($request->has('delete_images')) {
                foreach ($request->delete_images as $imageId) {
                    $image = ProductImage::findOrFail($imageId);

                    // Delete the image file from storage
                    $imagePath = public_path('uploads/product-gallery/' . $image->gallery);
                    if (File::exists($imagePath)) {
                        File::delete($imagePath); // Delete file from storage
                    }

                    // Delete the image record from the database
                    $image->delete();
                }
            }

            // Handle adding new gallery images
            if ($request->hasFile('gallery')) {
                foreach ($request->file('gallery') as $image) {
                    // Generate a unique image name for the gallery image
                    $imageName = $product->id . '_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

                    // Move the image to the custom directory
                    $image->move(public_path('uploads/product-gallery'), $imageName);

                    // Store the image path in the database
                    $product->gallery()->create(['gallery' => $imageName]);
                }
            }

            // Update the product after handling images and gallery
            $product->save();

            return response()->json([
                'status' => 200,
                'message' => 'Product Updated'
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
        $product = Product::find($id);

        if (empty($product)) {
            return redirect()->back()->with('error', 'Record Not Found');
        }

        if (!empty($product->image)) {
            $imagePath = public_path('uploads/product-image/' . $product->image);

            if (file_exists($imagePath) && is_file($imagePath)) {
                unlink($imagePath);
            }
        }

        foreach ($product->gallery as $galleryImage) {

            $galleryImagePath = public_path('uploads/product-gallery/' . $galleryImage->gallery);
            if (File::exists($galleryImagePath)) {
                File::delete($galleryImagePath); // Delete file from storage
            }
        }

        $product->delete();

        return redirect()->back()->with('success', 'Record Deleted');
    }
}
