@extends('admin.layouts.app')
@section('title', 'Edit Product - ')

@section('content')

<!-- Main Content -->
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <!-- <h3 class="fw-bold mb-3">Create Category</h3> -->
            <ul class="breadcrumbs mb-3 p-0 m-0 border-0">
                <li class="nav-home">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="icon-home"></i>
                </a>
                </li>
                <li class="separator">
                <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                <a href="{{ route('product.index') }}">Products</a>
                </li>
                <li class="separator">
                <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                <a>{{ $product->slug }}</a>
                </li>
            </ul>
            <button class="btn btn-primary btn-round ms-auto" onclick='window.location.href="{{ route("product.create") }}"'>
                Add New
            </button>
        </div>
        {{-- Message Alert --}}
        <div class="col-12">
          @include('admin.dashboard.message')
        </div>
        <form action="" method="post" id="productForm" enctype="multipart/form-data">
            @csrf
            <div class="row">
                {{-- Product Col 1 --}}
                <div class="col-12 col-md-8">
                    <div class="card mb-3">
                        <div class="card-header">
                            <div class="card-title">Edit Product</div>
                        </div>
                        <div class="card-body px-4 px-md-5 py-4">
                            <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                {{-- Product Name Field --}}
                                <div class="form-group col-md-12">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" name="title" id="title" placeholder="Product Title" value="{{ $product->title }}" />
                                    <p class="error m-0"></p>
                                </div>
                                {{-- Product Slug Field --}}
                                <div class="form-group col-md-12">
                                    <label for="slug">Slug</label>
                                    <input type="text" class="form-control" name="slug" id="slug" placeholder="Slug" value="{{ $product->slug }}" />
                                    <p class="error m-0"></p>
                                </div>
                                {{-- Product Description Field --}}
                                <div class="form-group col-md-12 description_field">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" cols="30" rows="10" class="summernote" placeholder="Description">{{ $product->description }}</textarea>
                                    <p class="error m-0"></p>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    {{-- Product Gallery --}}
                    <div class="card my-2">
                        <div class="card-header">
                            <div class="card-title">Product Gallery</div>
                        </div>
                        <div class="card-body px-4 px-md-5 py-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="gallery-container">
                                            <div class="m-0" id="preview" style="display: flex; gap: 10px; margin-top: 10px; position: absolute; left: 10px; top:10px; z-index: 99999;"></div>
                                            <div class="m-0">Drop files here or click to upload.</div>
                                            <input type="file" name="gallery[]" id="gallery" multiple accept="image/*">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Old Images (Check the box to remove an image)</label>
                                            <div class="row">
                                                @foreach($product->gallery as $image)
                                                    @php
                                                        $imagePath = public_path('uploads/product-gallery/' . $image->gallery);
                                                    @endphp
                                                    @if (file_exists($imagePath))
                                                    <div class="col-3 col-sm-3 px-2">
                                                        <label class="imagecheck mb-3">
                                                            <input name="delete_images[]" type="checkbox" value="{{ $image->id }}" class="imagecheck-input">
                                                            <figure class="imagecheck-figure">
                                                                <img src="{{ asset('uploads/product-gallery/' . $image->gallery) }}" alt="Product Image" class="imagecheck-image">
                                                            </figure>
                                                        </label>
                                                    </div>
                                                    @else
                                                    
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>

                    {{-- Product Data --}}
                    <div class="card my-3">
                        <div class="card-header">
                        <div class="card-title">Product Data</div>
                        </div>
                        <div class="card-body px-4 px-md-5 py-4">
                        <div class="row">
                            <div class="col-md-12">
                                {{-- Product Data Table --}}
                                <div class="row">
                                    <ul class="nav nav-pills nav-secondary" id="pills-tab" role="tablist">
										<li class="nav-item submenu" role="presentation">
											<a class="nav-link active" id="pills-general-tab" data-bs-toggle="pill" href="#pills-general" role="tab" aria-controls="pills-general" aria-selected="true">General</a>
										</li>
										<li class="nav-item submenu" role="presentation">
											<a class="nav-link" id="pills-inventory-tab" data-bs-toggle="pill" href="#pills-inventory" role="tab" aria-controls="pills-inventory" aria-selected="false" tabindex="-1">Inventory</a>
										</li>
										<li class="nav-item submenu" role="presentation">
											<a class="nav-link" id="pills-attributes-tab" data-bs-toggle="pill" href="#pills-attributes" role="tab" aria-controls="pills-attributes" aria-selected="false" tabindex="-1">Attributes</a>
										</li>
									</ul>
                                    <div class="tab-content mt-2 mb-3" id="pills-tabContent">
										<div class="tab-pane fade active show" id="pills-general" role="tabpanel" aria-labelledby="pills-general-tab">
                                            {{-- Product Regular Price --}}
                                            <div class="form-group col-md-12 p-2 ">
                                                <label style="width: 33%" for="price">Price</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">$</span>
                                                    <input type="number" class="form-control" name="price" id="price" placeholder="Price" aria-label="Amount (to the nearest dollar)" value="{{ $product->price }}">
                                                    <span class="input-group-text">.00</span>
                                                    <p class="error m-0"></p>
                                                </div>
                                            </div>
                                            {{-- Product Sale Price --}}
                                            <div class="form-group col-md-12 p-2">
                                                <label style="width: 33%" for="sale_price">Sale Price</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">$</span>
                                                    <input type="text" class="form-control" name="sale_price" id="sale_price" placeholder="Sale Price" aria-label="Amount (to the nearest dollar)" value="{{ $product->sale_price }}">
                                                    <span class="input-group-text">.00</span>
                                                    <p class="error m-0"></p>
                                                </div>
                                            </div>
										</div>
										<div class="tab-pane fade" id="pills-inventory" role="tabpanel" aria-labelledby="pills-inventory-tab">
                                            {{-- Product QTY --}}
                                            <div class="form-group col-md-12 p-2">
                                                <label style="width: 33%" for="qty">Quantity</label>
                                                <input type="number" class="form-control" name="qty" id="qty" placeholder="Quantity" value="{{ $product->qty }}" />
                                                <p class="error m-0"></p>
                                            </div>
                                            {{-- Product SKU --}}
                                            <div class="form-group col-md-12 p-2">
                                                <label style="width: 33%" for="sku">SKU</label>
                                                <input type="text" class="form-control" name="sku" id="sku" placeholder="SKU" value="{{ $product->sku }}" />
                                                <p class="error m-0"></p>
                                            </div>
                                            {{-- Product Barcode --}}
                                            <div class="form-group col-md-12 p-2">
                                                <label style="width: 33%" for="barcode">Barcode</label>
                                                <input type="text" class="form-control" name="barcode" id="barcode" placeholder="Barcode" value="{{ $product->barcode }}" />
                                                <p class="error m-0"></p>
                                            </div>
										</div>
										<div class="tab-pane fade" id="pills-attributes" role="tabpanel" aria-labelledby="pills-attributes-tab">
											<p>Pityful a rethoric question ran over her cheek, then she continued her way. On her way she met a copy. The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word "and" and the Little Blind Text should turn around and return to its own, safe country.</p>

											<p> But nothing the copy said could convince her and so it didn’t take long until a few insidious Copy Writers ambushed her, made her drunk with Longe and Parole and dragged her into their agency, where they abused her for their</p>
										</div>
									</div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                {{-- Product Sidebar --}}
                <div class="col-12 col-md-4">
                    <div class="mx-3 mt-2 m-md-0">
                        <div class="col-12">
                            <div class="row">
                                {{-- Product Status --}}
                                <div class="card p-0 m-0 mb-2">
                                    <div class="card-header">
                                        <div class="card-title">Product Status</div>
                                    </div>
                                    <div class="card-body p-3">
                                        {{-- Product Status Field --}}
                                        <div class="form-group col-md-12">
                                            <label for="status">Status</label>
                                            <select class="form-control" id="status" name="status">
                                            <option {{ ($product->status == 'publish') ? 'selected' : '' }} value="publish">Published</option>
                                            <option {{ ($product->status == 'draft') ? 'selected' : '' }} value="draft">Draft</option>
                                            </select>
                                            <p class="error m-0"></p>
                                        </div>
                                        {{-- Product Status Field --}}
                                        <div class="form-group col-md-12">
                                            <label for="is_featured">Featured</label>
                                            <select class="form-control" id="is_featured" name="is_featured">
                                                <option {{ ($product->is_featured == 'no') ? 'selected' : '' }} value="no">No</option>
                                                <option {{ ($product->is_featured == 'yes') ? 'selected' : '' }} value="yes">Yes</option>
                                            </select>
                                            <p class="error m-0"></p>
                                        </div>
                                        <div class="action-btns mt-2 d-none d-md-flex px-3 justify-content-end">
                                            <button type="submit" id="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </div>
                                {{-- Product Categories --}}
                                @if($categories->isNotEmpty())
                                    <div class="card my-2 p-0">
                                        <div class="card-header">
                                            <div class="card-title">Product Categories</div>
                                        </div>
                                        <div class="card-body p-3">
                                            <div class="form-group col-md-12 product-catelog">
                                                    @foreach ($categories as $category)
                                                        <div class="form-check p-0">
                                                            <input {{ ($product->categories->contains($category->id)) ? 'checked' : '' }} class="form-check-input" type="checkbox" name="categories[]" id="{{ $category->id }}" value="{{ $category->id }}">
                                                            <label class="form-check-label" for="{{ $category->id }}">
                                                                {{ $category->name }}
                                                            </label>
                                                    </div>
                                                    @endforeach
                                                <p class="error m-0"></p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                {{-- Product Sub Categories --}}
                                @if($subCategories->isNotEmpty())
                                    <div class="card my-2 p-0">
                                        <div class="card-header">
                                            <div class="card-title">Product Sub Categories</div>
                                        </div>
                                        <div class="card-body p-3">
                                            <div class="form-group col-md-12 product-catelog">
                                                @foreach ($subCategories as $subCategory)
                                                    <div class="form-check p-0">
                                                        <input {{ ($product->subCategories->contains($subCategory->id)) ? 'checked' : '' }} class="form-check-input" type="checkbox" name="sub_category[]" id="{{ $subCategory->slug }}">
                                                        <label class="form-check-label" for="{{ $subCategory->slug }}">
                                                            {{ $subCategory->name }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                                <p class="error m-0"></p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                {{-- Product Brands --}}
                                @if ($brands->isNotEmpty())
                                    <div class="card my-2 p-0">
                                        <div class="card-header">
                                            <div class="card-title">Product Brands</div>
                                        </div>
                                        <div class="card-body p-3">
                                            <div class="form-group col-md-12 product-catelog">
                                                @foreach ($brands as $brand)
                                                    <div class="form-check p-0">
                                                        <input  {{ ($product->brands->contains($brand->id)) ? 'checked' : '' }} class="form-check-input" type="checkbox" name="brands[]" id="{{ $brand->slug }}" value="{{ $brand->id }}">
                                                        <label class="form-check-label" for="{{ $brand->slug }}">
                                                            {{ $brand->name }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                                <p class="error m-0"></p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                {{-- Product Image --}}
                                <div class="card my-2 p-0">
                                    <div class="card-header">
                                        <div class="card-title">Featured Image</div>
                                    </div>
                                    <div class="card-body p-3">
                                        <div class="featured-img position-relative">
                                            <div id="image-preview" class="text-center">
                                                <img src="{{ asset('uploads/product-image/' . $product->image) }}" alt="" style="width:100%; height:200px; object-fit:cover;">
                                            </div>
                                            <input type="file" name="image" id="image">
                                            <a href="#">+Add Featured Image</a>
                                        </div>
                                    </div>
                                </div>
                                {{-- Product Short Description --}}
                                <div class="card my-2 p-0">
                                    <div class="card-header">
                                        <div class="card-title">Short Description</div>
                                    </div>
                                    <div class="card-body p-3">
                                        <div class="form-group">
                                            <div class="input-group">
                                              <textarea class="form-control" name="short_desc" id="short_desc" style="height: 200px !important;">{{ $product->short_desc }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Action Buttons --}}
                <div class="action-btns mt-3 d-flex d-md-none">
                    <button type="submit" id="submit" class="btn btn-primary">Update</button>
                    <button class="btn btn-black mx-2">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection
@section('customJs')
<script>

$('#productForm').submit(function(e) {
    e.preventDefault();

    let ele = $(this);

    let formData = new FormData(ele[0]);
    formData.append('_method', 'PUT');

    $.ajax({
        url: '{{ route("product.update", $product->id) }}',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function (resp) {
            if (resp.status == 200) {
                $('.error').removeClass('invalid-feedback').html('');
                $('input, select').removeClass('is-invalid');

                window.location.href='{{ route("product.edit", $product->id) }}';
            } else {
                let errors = resp['errors'];
                $('.error').removeClass('invalid-feedback').html('');
                $('input, select').removeClass('is-invalid');

                $.each(errors, function(key, value) {
                    $(`#${key}`).addClass('is-invalid').siblings('.error').addClass('invalid-feedback').html(value);
                });

            }
        }
    });
});




const fileUploads = document.querySelectorAll('#image');
const imagePreviews = document.querySelectorAll('#image-preview');

fileUploads.forEach((fileUpload, index) => {
    fileUpload.addEventListener('change', () => {
        const file = fileUpload.files[0];
        if (file && fileUpload.name === 'image') {
            const reader = new FileReader();
            reader.onload = (e) => imagePreviews[0].innerHTML = `<img src="${e.target.result}" alt="Preview" style="height:200px; object-fit:cover;">`;
            reader.readAsDataURL(file);
        } else if (!file && fileUpload.name === 'image') {
            imagePreviews[0].innerHTML = ''; // Clear preview if no file
        }
    });
});


const imagesInput = document.getElementById('gallery');
    const previewContainer = document.getElementById('preview');

    // Store the selected files in an array for better management
    let selectedFiles = [];

    // Handle file selection
    imagesInput.addEventListener('change', function (event) {
        const files = Array.from(event.target.files);

        // Append new files to the selected files array
        files.forEach((file, index) => {
            const fileReader = new FileReader();
            fileReader.readAsDataURL(file);

            fileReader.onload = function (e) {
                // Create a preview element
                const previewDiv = document.createElement('div');
                previewDiv.style.position = 'relative';

                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.width = '100px';
                img.style.height = '100px';
                img.style.objectFit = 'cover';
                img.style.border = '1px solid #ddd';

                // Create a remove button
                const removeButton = document.createElement('button');
                removeButton.textContent = 'X';
                removeButton.style.position = 'absolute';
                removeButton.style.top = '5px';
                removeButton.style.right = '5px';
                removeButton.style.background = '#ff4d4d';
                removeButton.style.color = '#fff';
                removeButton.style.border = 'none';
                removeButton.style.borderRadius = '50%';
                removeButton.style.cursor = 'pointer';
                removeButton.style.width = '20px';
                removeButton.style.height = '20px';
                removeButton.style.display = 'flex';
                removeButton.style.alignItems = 'center';
                removeButton.style.justifyContent = 'center';

                removeButton.addEventListener('click', function () {
                    // Remove from preview
                    previewDiv.remove();

                    // Remove from selected files array
                    selectedFiles = selectedFiles.filter((_, fileIndex) => fileIndex !== index);

                    // Update the input files
                    updateInputFiles();
                });

                previewDiv.appendChild(img);
                previewDiv.appendChild(removeButton);
                previewContainer.appendChild(previewDiv);
            };

            selectedFiles.push(file);
        });

        // Update the input files
        updateInputFiles();
    });

    // Update the input files programmatically
    function updateInputFiles() {
        const dataTransfer = new DataTransfer();
        selectedFiles.forEach(file => dataTransfer.items.add(file));
        imagesInput.files = dataTransfer.files;
    }

</script>
@endsection