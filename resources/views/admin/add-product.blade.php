@extends('layouts.admin')

@section('title', 'Add Product')

@section('content')
    <!-- main-content -->
    <div class="main-content">
        <!-- main-content-wrap -->
        <div class="main-content-inner">
            <!-- main-content-wrap -->
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3>Add Product</h3>
                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                        <li>
                            <a href="{{ route('admin.dashboard') }}">
                                <div class="text-tiny">Dashboard</div>
                            </a>
                        </li>
                        <li>
                            <i class="icon-chevron-right"></i>
                        </li>
                        <li>
                            <a href="{{ route('admin.product-list') }}">
                                <div class="text-tiny">Ecommerce</div>
                            </a>
                        </li>
                        <li>
                            <i class="icon-chevron-right"></i>
                        </li>
                        <li>
                            <div class="text-tiny">Add product</div>
                        </li>
                    </ul>
                </div>

                <!-- Success/Error Messages -->
                @if (session('success'))
                    <div class="alert alert-success mb-4"
                        style="background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger mb-4"
                        style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger mb-4"
                        style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
                        <ul class="mb-0" style="margin: 0; padding-left: 20px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- form-add-product -->
                <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data"
                    class="tf-section-2 form-add-product">
                    @csrf

                    <div class="wg-box">
                        <fieldset class="name">
                            <div class="body-title mb-10">Product name <span class="tf-color-1">*</span></div>
                            <input class="mb-10" type="text" placeholder="Enter product name" name="name"
                                tabindex="0" value="{{ old('name') }}" aria-required="true" required>
                            <div class="text-tiny">Do not exceed 20 characters when entering the product name.</div>
                        </fieldset>

                        <div class="gap22 cols">
                            <fieldset class="category">
                                <div class="body-title mb-10">Category <span class="tf-color-1">*</span></div>
                                <div class="select">
                                    <select class="" name="category_id" id="category_id" required>
                                        <option value="">Choose category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </fieldset>
                            <fieldset class="male">
                                <div class="body-title mb-10">Subcategory <span class="tf-color-1">*</span></div>
                                <div class="select">
                                    <select class="" name="subcategory_id" id="subcategory_id" required>
                                        <option value="">Choose Subcategory</option>
                                        <!-- Subcategories will be loaded via AJAX -->
                                    </select>
                                </div>
                            </fieldset>
                        </div>

                        <div class="gap22 cols">
                            <fieldset class="brand">
                                <div class="body-title mb-10">Regular Price <span class="tf-color-1">*</span></div>
                                <input class="mb-10" type="number" step="0.01" placeholder="Enter regular price"
                                    name="regular_price" tabindex="0" value="{{ old('regular_price') }}"
                                    aria-required="true" required>
                            </fieldset>
                            <fieldset class="brand">
                                <div class="body-title mb-10">Discount Price</div>
                                <input class="mb-10" type="number" step="0.01" placeholder="Enter discount price"
                                    name="discount_price" tabindex="0" value="{{ old('discount_price') }}">
                            </fieldset>
                        </div>

                        <!-- New Stock & Delivery Section -->
                        <div class="gap22 cols">
                            <fieldset class="stock">
                                <div class="body-title mb-10">Stock Quantity <span class="tf-color-1">*</span></div>
                                <input class="mb-10" type="number" min="0" placeholder="Enter stock quantity"
                                    name="stock_quantity" tabindex="0" value="{{ old('stock_quantity', 0) }}"
                                    aria-required="true" required>
                                <div class="text-tiny">Enter available stock quantity</div>
                            </fieldset>
                            <fieldset class="delivery">
                                <div class="body-title mb-10">Delivery Days</div>
                                <input class="mb-10" type="number" min="1" placeholder="e.g., 3-5 days"
                                    name="delivery_days" tabindex="0" value="{{ old('delivery_days') }}">
                                <div class="text-tiny">Expected delivery time in days (optional)</div>
                            </fieldset>
                        </div>

                        <!-- Featured Product Checkbox -->
                        <fieldset class="featured">
                            <div class="flex items-center gap10">
                                <input type="checkbox" name="is_featured" id="is_featured" value="1"
                                    {{ old('is_featured') ? 'checked' : '' }}>
                                <label for="is_featured" class="body-text">Featured Product</label>
                            </div>
                        </fieldset>

                        <fieldset class="trending">
                            <div class="flex items-center gap10">
                                <input type="checkbox" name="is_trending" id="is_trending" value="1"
                                    {{ old('is_trending') ? 'checked' : '' }}>
                                <label for="is_trending" class="body-text">Trending Product</label>
                            </div>
                        </fieldset>

                        <fieldset class="banner">
                            <div class="flex items-center gap10">
                                <input type="checkbox" name="is_banner" id="is_banner" value="1"
                                    {{ isset($product) && $product->is_banner ? 'checked' : (old('is_banner') ? 'checked' : '') }}>
                                <label for="is_banner" class="body-text">Show in Home Banner Slider</label>
                            </div>
                        </fieldset>
                        <fieldset class="description">
                            <div class="body-title mb-10">Description <span class="tf-color-1">*</span></div>
                            <textarea class="mb-10" name="description" placeholder="Description" tabindex="0" aria-required="true" required>{{ old('description') }}</textarea>
                            <div class="text-tiny">Do not exceed 100 characters when entering the product name.</div>
                        </fieldset>
                    </div>

                    <div class="wg-box">
                        <fieldset>
                            <div class="body-title mb-10">Upload images</div>

                            <div class="upload-image mb-16">
                                <!-- Thumbnail preview -->
                                <div class="item up-load">
                                    <img id="thumbnailPreview" alt="">
                                    <label class="uploadfile" for="thumbnail">
                                        <span class="icon">
                                            <i class="icon-upload-cloud"></i>
                                        </span>
                                        <span class="text-tiny">
                                            Upload a product thumbnail or
                                            <span class="tf-color">click to browse</span>
                                        </span>
                                        <input type="file" name="thumbnail" id="thumbnail" hidden accept="image/*">
                                    </label>
                                </div>

                                <!-- Upload trigger -->
                                <div class="item up-load">
                                    <label class="uploadfile" for="gallery">
                                        <span class="icon">
                                            <i class="icon-upload-cloud"></i>
                                        </span>
                                        <span class="text-tiny">
                                            Drop your images here or select
                                            <span class="tf-color">click to browse</span>
                                        </span>
                                        <input type="file" id="gallery" name="images[]" multiple accept="image/*">
                                    </label>
                                </div>
                            </div>

                            <div id="selectedImages" style="display: none;">
                                <!-- Selected images will appear here -->
                            </div>

                            <div class="body-text">Upload up to 4 images (JPEG, PNG, JPG, GIF, WEBP), max 2MB each, 2048 ×
                                2048 px.</div>
                        </fieldset>

                        <div class="cols gap22">
                            <fieldset class="dimensions">
                                <div class="body-title mb-10">Dimensions (Optional)</div>

                                <!-- Height -->
                                <div class="mb-15">
                                    <label class="body-text mb-5 block text-gray-600">Height (cm)</label>
                                    <input type="number" step="0.1" min="0" class="form-input flex-1"
                                        placeholder="e.g., 10.5" name="height" value="{{ old('height') }}">
                                </div>

                                <!-- Width -->
                                <div class="mb-15">
                                    <label class="body-text mb-5 block text-gray-600">Width (cm)</label>
                                    <input type="number" step="0.1" min="0" class="form-input flex-1"
                                        placeholder="e.g., 8.2" name="width" value="{{ old('width') }}">
                                </div>

                                <!-- Length -->
                                <div class="mb-15">
                                    <label class="body-text mb-5 block text-gray-600">Length (cm)</label>
                                    <input type="number" step="0.1" min="0" class="form-input flex-1"
                                        placeholder="e.g., 15.0" name="length" value="{{ old('length') }}">
                                </div>

                                <!-- Note -->
                                <div class="text-tiny text-gray-500 italic">
                                    Optional: Enter product dimensions for shipping calculations
                                </div>
                            </fieldset>

                            <fieldset class="product-code">
                                <div class="body-title mb-10">Product Code <span class="tf-color-1">*</span></div>

                                <!-- Product Code Input -->
                                <div class="mb-15">
                                    <input type="text" class="form-input w-full"
                                        placeholder="e.g., PROD-2023-001 or SKU-12345" name="product_code"
                                        value="{{ old('product_code') }}" required>
                                    <div class="text-tiny text-gray-500 mt-5">
                                        Enter a unique product code or SKU for inventory tracking
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                        <div class="cols gap10">
                            <button class="tf-button w-full" type="submit">Add product</button>
                            <a href="{{ route('admin.product-list') }}" class="tf-button style-2 w-full">Cancel</a>
                        </div>
                    </div>
                </form>
                <!-- /form-add-product -->
            </div>
            <!-- /main-content-wrap -->
        </div>
        <!-- /main-content-wrap -->
        <!-- bottom-page -->
        <div class="bottom-page">
            <div class="body-text">Copyright © 2026 Earth Craft. All
                rights
                reserved. Designed and Developed </div>
            {{-- <i class="icon-heart"></i> --}}
            <div class="body-text">by <a href="https://innovatechbd.net/">Innovatech</a></div>
        </div>
        <!-- /bottom-page -->
    </div>
    <!-- /main-content -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let selectedFiles = []; // Store all selected files
            let galleryInput = document.getElementById('gallery');

            // Thumbnail click handler
            document.getElementById('thumbnailPreview').addEventListener('click', function() {
                document.getElementById('thumbnail').click();
            });

            // Thumbnail preview
            document.getElementById('thumbnail').addEventListener('change', function(e) {
                if (e.target.files.length > 0) {
                    const file = e.target.files[0];
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        document.getElementById('thumbnailPreview').src = e.target.result;
                        document.getElementById('thumbnailPreview').style.objectFit = 'cover';

                        const uploadLabel = document.querySelector(
                            '.upload-image .item.up-load label[for="thumbnail"]');
                        uploadLabel.style.display = 'none';
                    }

                    reader.readAsDataURL(file);
                }
            });

            // FIXED: Store and preview multiple files without replacing
            galleryInput.addEventListener('change', function(e) {
                const newFiles = Array.from(e.target.files);

                // Add new files to existing files (avoid duplicates)
                newFiles.forEach(newFile => {
                    // Check if file already exists (by name and size)
                    const exists = selectedFiles.some(existingFile =>
                        existingFile.name === newFile.name &&
                        existingFile.size === newFile.size
                    );

                    if (!exists) {
                        selectedFiles.push(newFile);
                    }
                });

                // Update the input files
                updateFileInput();

                // Display preview
                displaySelectedImages();
            });

            // Function to update the actual file input
            function updateFileInput() {
                const dataTransfer = new DataTransfer();

                selectedFiles.forEach(file => {
                    dataTransfer.items.add(file);
                });

                galleryInput.files = dataTransfer.files;
            }

            // Function to display selected images
            function displaySelectedImages() {
                const container = document.getElementById('selectedImages');
                container.innerHTML = '';

                if (selectedFiles.length === 0) {
                    container.style.display = 'none';
                    return;
                }

                container.style.display = 'block';
                container.style.padding = '15px';
                container.style.backgroundColor = '#f8fafc';
                container.style.borderRadius = '8px';
                container.style.marginTop = '15px';

                // Header with remove all button
                const headerDiv = document.createElement('div');
                headerDiv.style.display = 'flex';
                headerDiv.style.justifyContent = 'space-between';
                headerDiv.style.alignItems = 'center';
                headerDiv.style.marginBottom = '15px';

                const countInfo = document.createElement('div');
                countInfo.style.fontWeight = 'bold';
                countInfo.style.color = '#1e40af';
                countInfo.textContent = `Selected ${selectedFiles.length} image(s)`;

                const removeAllBtn = document.createElement('button');
                removeAllBtn.type = 'button';
                removeAllBtn.innerHTML = '× Clear All';
                removeAllBtn.style.backgroundColor = '#ef4444';
                removeAllBtn.style.color = 'white';
                removeAllBtn.style.border = 'none';
                removeAllBtn.style.borderRadius = '4px';
                removeAllBtn.style.padding = '5px 10px';
                removeAllBtn.style.fontSize = '12px';
                removeAllBtn.style.cursor = 'pointer';
                removeAllBtn.addEventListener('click', function() {
                    selectedFiles = [];
                    updateFileInput();
                    displaySelectedImages();
                });

                headerDiv.appendChild(countInfo);
                if (selectedFiles.length > 0) {
                    headerDiv.appendChild(removeAllBtn);
                }
                container.appendChild(headerDiv);

                // Images grid
                const imagesGrid = document.createElement('div');
                imagesGrid.style.display = 'grid';
                imagesGrid.style.gridTemplateColumns = 'repeat(auto-fill, minmax(120px, 1fr))';
                imagesGrid.style.gap = '15px';

                // Display each file
                selectedFiles.forEach((file, index) => {
                    const imageCard = document.createElement('div');
                    imageCard.style.position = 'relative';
                    imageCard.style.border = '1px solid #e5e7eb';
                    imageCard.style.borderRadius = '8px';
                    imageCard.style.overflow = 'hidden';
                    imageCard.style.backgroundColor = 'white';

                    // Remove button
                    const removeBtn = document.createElement('button');
                    removeBtn.type = 'button';
                    removeBtn.innerHTML = '×';
                    removeBtn.style.position = 'absolute';
                    removeBtn.style.top = '5px';
                    removeBtn.style.right = '5px';
                    removeBtn.style.backgroundColor = '#ef4444';
                    removeBtn.style.color = 'white';
                    removeBtn.style.border = 'none';
                    removeBtn.style.borderRadius = '50%';
                    removeBtn.style.width = '24px';
                    removeBtn.style.height = '24px';
                    removeBtn.style.fontSize = '14px';
                    removeBtn.style.cursor = 'pointer';
                    removeBtn.style.zIndex = '10';
                    removeBtn.style.display = 'flex';
                    removeBtn.style.alignItems = 'center';
                    removeBtn.style.justifyContent = 'center';

                    removeBtn.addEventListener('click', function() {
                        selectedFiles.splice(index, 1);
                        updateFileInput();
                        displaySelectedImages();
                    });

                    // Image preview
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.style.width = '100%';
                            img.style.height = '100px';
                            img.style.objectFit = 'cover';

                            imageCard.appendChild(img);
                        };
                        reader.readAsDataURL(file);
                    } else {
                        const fileIcon = document.createElement('div');
                        fileIcon.style.width = '100%';
                        fileIcon.style.height = '100px';
                        fileIcon.style.display = 'flex';
                        fileIcon.style.alignItems = 'center';
                        fileIcon.style.justifyContent = 'center';
                        fileIcon.style.backgroundColor = '#f3f4f6';
                        fileIcon.innerHTML =
                            '<i class="icon-file" style="font-size: 24px; color: #6b7280;"></i>';
                        imageCard.appendChild(fileIcon);
                    }

                    // File info
                    const infoDiv = document.createElement('div');
                    infoDiv.style.padding = '8px';

                    const fileName = document.createElement('div');
                    fileName.textContent = file.name.length > 15 ?
                        file.name.substring(0, 15) + '...' :
                        file.name;
                    fileName.style.fontSize = '12px';
                    fileName.style.fontWeight = '500';
                    fileName.style.marginBottom = '3px';
                    fileName.style.overflow = 'hidden';
                    fileName.style.textOverflow = 'ellipsis';
                    fileName.style.whiteSpace = 'nowrap';

                    const fileSize = document.createElement('div');
                    const sizeInKB = Math.round(file.size / 1024);
                    fileSize.textContent = `${sizeInKB} KB`;
                    fileSize.style.fontSize = '11px';
                    fileSize.style.color = '#6b7280';

                    infoDiv.appendChild(fileName);
                    infoDiv.appendChild(fileSize);
                    imageCard.appendChild(infoDiv);
                    imageCard.appendChild(removeBtn);

                    imagesGrid.appendChild(imageCard);
                });

                container.appendChild(imagesGrid);

            }

            // Initial display
            displaySelectedImages();

            // Load subcategories when category changes
            document.getElementById('category_id').addEventListener('change', function() {
                const categoryId = this.value;
                const subcategorySelect = document.getElementById('subcategory_id');

                if (categoryId) {
                    fetch(`/admin/categories/${categoryId}/subcategories`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            subcategorySelect.innerHTML =
                                '<option value="">Choose Subcategory</option>';
                            data.forEach(subcategory => {
                                const option = document.createElement('option');
                                option.value = subcategory.id;
                                option.textContent = subcategory.name;
                                subcategorySelect.appendChild(option);
                            });
                        })
                        .catch(error => {
                            console.error('Error loading subcategories:', error);
                            subcategorySelect.innerHTML =
                                '<option value="">Error loading subcategories</option>';
                        });
                } else {
                    subcategorySelect.innerHTML = '<option value="">Choose Subcategory</option>';
                }
            });

            // If old category_id exists, load its subcategories
            const oldCategoryId = "{{ old('category_id') }}";
            if (oldCategoryId) {
                document.getElementById('category_id').value = oldCategoryId;
                document.getElementById('category_id').dispatchEvent(new Event('change'));

                // Set old subcategory_id after loading subcategories
                setTimeout(() => {
                    const oldSubcategoryId = "{{ old('subcategory_id') }}";
                    if (oldSubcategoryId) {
                        document.getElementById('subcategory_id').value = oldSubcategoryId;
                    }
                }, 500);
            }
        });
    </script>
@endsection
