@extends('layouts.admin')

@section('title', 'Edit Product')

@section('content')
    <!-- main-content -->
    <div class="main-content">
        <!-- main-content-wrap -->
        <div class="main-content-inner">
            <!-- main-content-wrap -->
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3>Edit Product</h3>
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
                            <div class="text-tiny">Edit Product</div>
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

                <!-- form-edit-product -->
                <form action="{{ route('admin.product.update', $product->id) }}" method="POST"
                    enctype="multipart/form-data" class="tf-section-2 form-add-product">
                    @csrf
                    @method('POST')

                    <div class="wg-box">
                        <fieldset class="name">
                            <div class="body-title mb-10">Product name <span class="tf-color-1">*</span></div>
                            <input class="mb-10" type="text" placeholder="Enter product name" name="name"
                                tabindex="0" value="{{ old('name', $product->name) }}" aria-required="true" required>
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
                                                {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
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
                                        @if ($product->category)
                                            @foreach ($product->category->subcategories as $subcategory)
                                                <option value="{{ $subcategory->id }}"
                                                    {{ old('subcategory_id', $product->subcategory_id) == $subcategory->id ? 'selected' : '' }}>
                                                    {{ $subcategory->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </fieldset>
                        </div>

                        <div class="gap22 cols">
                            <fieldset class="brand">
                                <div class="body-title mb-10">Regular Price <span class="tf-color-1">*</span></div>
                                <input class="mb-10" type="number" step="0.01" placeholder="Enter regular price"
                                    name="regular_price" tabindex="0"
                                    value="{{ old('regular_price', $product->regular_price) }}" aria-required="true"
                                    required>
                            </fieldset>
                            <fieldset class="brand">
                                <div class="body-title mb-10">Discount Price</div>
                                <input class="mb-10" type="number" step="0.01" placeholder="Enter discount price"
                                    name="discount_price" tabindex="0"
                                    value="{{ old('discount_price', $product->discount_price) }}">
                            </fieldset>
                        </div>

                        <!-- Stock & Delivery Section -->
                        <div class="gap22 cols">
                            <fieldset class="stock">
                                <div class="body-title mb-10">Stock Quantity <span class="tf-color-1">*</span></div>
                                <input class="mb-10" type="number" min="0" placeholder="Enter stock quantity"
                                    name="stock_quantity" tabindex="0"
                                    value="{{ old('stock_quantity', $product->stock_quantity ?? 0) }}" aria-required="true"
                                    required>
                                <div class="text-tiny">Enter available stock quantity</div>
                            </fieldset>
                            <fieldset class="delivery">
                                <div class="body-title mb-10">Delivery Days</div>
                                <input class="mb-10" type="number" min="1" placeholder="e.g., 3-5 days"
                                    name="delivery_days" tabindex="0"
                                    value="{{ old('delivery_days', $product->delivery_days) }}">
                                <div class="text-tiny">Expected delivery time in days (optional)</div>
                            </fieldset>
                        </div>

                        <!-- Featured Product Checkbox -->
                        <fieldset class="featured">
                            <div class="body-title mb-10">Featured Product</div>
                            <div class="flex items-center gap10">
                                <input type="checkbox" name="is_featured" id="is_featured" value="1"
                                    {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                                <label for="is_featured" class="body-text">
                                    Mark this product as featured (will appear in featured sections)
                                </label>
                            </div>
                        </fieldset>

                        <fieldset class="trending mt-3">
                            <div class="body-title mb-10">Trending Product</div>
                            <div class="flex items-center gap10">
                                <input type="checkbox" name="is_trending" id="is_trending" value="1"
                                    {{ old('is_trending', $product->is_trending) ? 'checked' : '' }}>
                                <label for="is_trending" class="body-text">
                                    Mark this product as trending (will appear in trending sections)
                                </label>
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
                            <textarea class="mb-10" name="description" placeholder="Description" tabindex="0" aria-required="true" required>{{ old('description', $product->description) }}</textarea>
                            <div class="text-tiny">Do not exceed 100 characters when entering the product name.</div>
                        </fieldset>
                    </div>

                    <div class="wg-box">
                        <fieldset>
                            <div class="body-title mb-10">Current Thumbnail</div>
                            @if ($product->thumbnail)
                                <div class="mb-10">
                                    <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="Current Thumbnail"
                                        style="width: 100px; height: 100px; object-fit: cover; border-radius: 5px;">
                                </div>
                            @endif

                            <div class="body-title mb-10">Upload new thumbnail (Optional)</div>
                            <div class="upload-image mb-16">
                                <!-- Thumbnail preview -->
                                <div class="item">
                                    <img id="thumbnailPreview"
                                        src="{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : asset('images/upload/upload-1.png') }}"
                                        alt="Thumbnail Preview">
                                    <input type="file" name="thumbnail" id="thumbnail" hidden accept="image/*">
                                </div>
                            </div>

                            <!-- Current Gallery Images - with delete option -->
                            <div class="body-title mb-10">Current Gallery Images</div>
                            <div class="mb-10">
                                @if ($product->images->count() > 0)
                                    <div class="flex flex-wrap gap-10" id="existingImagesContainer">
                                        @foreach ($product->images as $image)
                                            <div class="existing-image-card relative group"
                                                data-image-id="{{ $image->id }}">
                                                <img src="{{ asset('storage/' . $image->image) }}" alt="Gallery Image"
                                                    style="width: 100px; height: 100px; object-fit: cover; border-radius: 5px; border: 2px solid #e5e7eb;">

                                                <!-- Delete button overlay -->
                                                <button type="button"
                                                    class="delete-existing-image absolute top-0 right-0 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200"
                                                    data-image-id="{{ $image->id }}"
                                                    style="transform: translate(30%, -30%); cursor: pointer;"
                                                    title="Delete this image">
                                                    ×
                                                </button>

                                                <!-- Image info -->
                                                <div class="text-center mt-2">
                                                    <div class="text-xs text-gray-500">
                                                        @php
                                                            $filename = basename($image->image);
                                                            echo strlen($filename) > 15
                                                                ? substr($filename, 0, 12) . '...'
                                                                : $filename;
                                                        @endphp
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="mt-3 text-sm text-gray-600">
                                        <strong>Note:</strong> Click the × button on any image to delete it. Deleted images
                                        cannot be recovered.
                                    </div>
                                @else
                                    <div class="body-text text-gray-500">No gallery images uploaded.</div>
                                @endif
                            </div>

                            <!-- Add More Images (Optional) -->
                            <div class="body-title mb-10">Add More Images (Optional)</div>
                            <div class="mb-10">
                                <div class="upload-image mb-16">
                                    <!-- Upload trigger -->
                                    <div class="item up-load">
                                        <label class="uploadfile" for="gallery">
                                            <span class="icon">
                                                <i class="icon-upload-cloud"></i>
                                            </span>
                                            <span class="text-tiny">
                                                Drop your images here or select
                                                <span class="tf-color">click to browse</span>
                                                <br>
                                                <small style="color: #ef4444; font-size: 11px;">Maximum 4 images
                                                    allowed</small>
                                            </span>
                                            <input type="file" id="gallery" name="images[]" multiple
                                                accept="image/*" max="4">
                                        </label>
                                    </div>
                                </div>

                                <div id="selectedImages" style="display: none;"></div>

                                <div class="body-text text-gray-600 mb-5">
                                    You can select maximum 4 images at once.
                                    <span style="color: #ef4445; font-weight: bold;">Total images cannot exceed 4.</span>
                                </div>

                                <!-- Current Count Display -->
                                <div id="imageCountInfo"
                                    style="margin-bottom: 10px; padding: 8px; background: #f0f9ff; border-radius: 5px;">
                                    <div style="font-size: 14px;">
                                        <strong>Current Status:</strong>
                                        <span id="existingCount">{{ $product->images->count() }}</span> existing images +
                                        <span id="newCount">0</span> new images =
                                        <span id="totalCount">{{ $product->images->count() }}</span> total images
                                        <span id="limitWarning" style="color: #ef4444; font-weight: bold; display: none;">
                                            (Limit reached! Maximum 4 images allowed)
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="cols gap22">
                                <fieldset class="dimensions">
                                    <div class="body-title mb-10">Dimensions (Optional)</div>

                                    <!-- Height -->
                                    <div class="mb-15">
                                        <label class="body-text mb-5 block text-gray-600">Height (cm)</label>
                                        <input type="number" step="0.1" min="0" class="form-input flex-1"
                                            placeholder="e.g., 10.5" name="height"
                                            value="{{ old('height', $product->height) }}">
                                    </div>

                                    <!-- Width -->
                                    <div class="mb-15">
                                        <label class="body-text mb-5 block text-gray-600">Width (cm)</label>
                                        <input type="number" step="0.1" min="0" class="form-input flex-1"
                                            placeholder="e.g., 8.2" name="width"
                                            value="{{ old('width', $product->width) }}">
                                    </div>

                                    <!-- Length -->
                                    <div class="mb-15">
                                        <label class="body-text mb-5 block text-gray-600">Length (cm)</label>
                                        <input type="number" step="0.1" min="0" class="form-input flex-1"
                                            placeholder="e.g., 15.0" name="length"
                                            value="{{ old('length', $product->length) }}">
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
                                            value="{{ old('product_code', $product->product_code) }}" required>
                                        <div class="text-tiny text-gray-500 mt-5">
                                            Enter a unique product code or SKU for inventory tracking
                                        </div>
                                    </div>
                                </fieldset>
                            </div>

                            <div class="cols gap10">
                                <button class="tf-button w-full" type="submit">Update product</button>
                                <a href="{{ route('admin.product-list') }}" class="tf-button style-2 w-full">Cancel</a>
                            </div>
                    </div>
                </form>
                <!-- /form-edit-product -->
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
            let selectedFiles = []; // Store newly selected files
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
                container.style.marginBottom = '15px';

                // Header with remove all button
                const headerDiv = document.createElement('div');
                headerDiv.style.display = 'flex';
                headerDiv.style.justifyContent = 'space-between';
                headerDiv.style.alignItems = 'center';
                headerDiv.style.marginBottom = '15px';

                const countInfo = document.createElement('div');
                countInfo.style.fontWeight = 'bold';
                countInfo.style.color = '#1e40af';
                countInfo.textContent = `New images selected: ${selectedFiles.length}`;

                const removeAllBtn = document.createElement('button');
                removeAllBtn.type = 'button';
                removeAllBtn.innerHTML = '× Remove All New Images';
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

                    // Remove button for newly selected images
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

                // Instructions
                const instructionDiv = document.createElement('div');
                instructionDiv.style.marginTop = '15px';
                instructionDiv.style.padding = '10px';
                instructionDiv.style.backgroundColor = '#f0f9ff';
                instructionDiv.style.borderRadius = '6px';
                instructionDiv.style.fontSize = '13px';
                instructionDiv.style.color = '#0369a1';
                instructionDiv.innerHTML = `
            <strong>Note:</strong> You can select multiple images at once or add more images later. 
            Click "click to browse" again to add more images. 
            Click the × button on any image to remove it.
        `;

                container.appendChild(instructionDiv);
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

                            // Select the current subcategory after loading
                            const currentSubcategoryId =
                                "{{ old('subcategory_id', $product->subcategory_id) }}";
                            if (currentSubcategoryId) {
                                subcategorySelect.value = currentSubcategoryId;
                            }
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

            // Trigger change event on page load if category is selected
            const currentCategoryId = document.getElementById('category_id').value;
            if (currentCategoryId) {
                document.getElementById('category_id').dispatchEvent(new Event('change'));
            }

            // AJAX request to delete existing images
            document.querySelectorAll('.delete-existing-image').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const imageId = this.getAttribute('data-image-id');
                    const imageCard = this.closest('.existing-image-card');

                    if (confirm('Are you sure you want to delete this image?')) {
                        fetch(`/admin/product-image/${imageId}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    imageCard.remove();
                                    // Show success message
                                    showAlert('Image deleted successfully!', 'success');
                                } else {
                                    showAlert('Failed to delete image: ' + data.message,
                                        'error');
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                showAlert('Error deleting image', 'error');
                            });
                    }
                });
            });

            function showAlert(message, type) {
                // Remove existing alerts
                document.querySelectorAll('.custom-alert').forEach(alert => alert.remove());

                const alertDiv = document.createElement('div');
                alertDiv.className = 'custom-alert';
                alertDiv.style.position = 'fixed';
                alertDiv.style.top = '20px';
                alertDiv.style.right = '20px';
                alertDiv.style.padding = '15px 20px';
                alertDiv.style.borderRadius = '5px';
                alertDiv.style.zIndex = '9999';
                alertDiv.style.fontWeight = '500';
                alertDiv.style.boxShadow = '0 4px 12px rgba(0,0,0,0.15)';

                if (type === 'success') {
                    alertDiv.style.backgroundColor = '#d4edda';
                    alertDiv.style.color = '#155724';
                    alertDiv.style.border = '1px solid #c3e6cb';
                } else {
                    alertDiv.style.backgroundColor = '#f8d7da';
                    alertDiv.style.color = '#721c24';
                    alertDiv.style.border = '1px solid #f5c6cb';
                }

                alertDiv.textContent = message;
                document.body.appendChild(alertDiv);

                // Auto remove after 3 seconds
                setTimeout(() => {
                    alertDiv.remove();
                }, 3000);
            }
        });
    </script>

@endsection
