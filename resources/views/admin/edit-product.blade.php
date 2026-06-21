@extends('layouts.admin')

@section('title', 'Edit Product')

@section('content')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">

    <style>
        .custom-form-input {
            width: 100%;
            padding: 14px 20px;
            border: 1px solid #e2e8f0;
            border-radius: 16px; /* নিখুঁত রাউন্ডেড কর্নার */
            font-size: 15px;
            color: #334155;
            background-color: #ffffff;
            transition: all 0.3s ease;
            outline: none;
            box-sizing: border-box;
        }
        .custom-form-input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        .custom-form-input::placeholder {
            color: #94a3b8;
        }
        .form-label {
            font-size: 15px;
            color: #64748b;
            margin-bottom: 8px;
            display: block;
            font-weight: 400;
        }
    </style>

    <div class="main-content">
        <div class="main-content-inner">
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
                                <div class="body-title mb-10">Regular Price (Per KG) <span class="tf-color-1">*</span></div>
                                <input class="mb-10" type="number" step="0.01" placeholder="Enter regular price per kg"
                                    name="regular_price" tabindex="0"
                                    value="{{ old('regular_price', $product->regular_price) }}" aria-required="true"
                                    required>
                            </fieldset>
                            <fieldset class="brand">
                                <div class="body-title mb-10">Discount Price (Per KG)</div>
                                <input class="mb-10" type="number" step="0.01" placeholder="Enter discount price per kg"
                                    name="discount_price" tabindex="0"
                                    value="{{ old('discount_price', $product->discount_price) }}">
                            </fieldset>
                        </div>

                        <div class="gap22 cols">
                            <fieldset class="stock">
                                <div class="body-title mb-10">Stock Quantity (in KG) <span class="tf-color-1">*</span></div>
                                <input class="mb-10" type="number" step="0.01" min="0" placeholder="e.g., 50.50"
                                    name="stock_quantity" tabindex="0"
                                    value="{{ old('stock_quantity', $product->stock_quantity ?? 0) }}" aria-required="true"
                                    required>
                                <div class="text-tiny">Enter available stock weight in Kilograms (KG)</div>
                            </fieldset>
                            <fieldset class="delivery">
                                <div class="body-title mb-10">Delivery Days</div>
                                <input class="mb-10" type="number" min="1" placeholder="e.g., 3"
                                    name="delivery_days" tabindex="0"
                                    value="{{ old('delivery_days', $product->delivery_days) }}">
                                <div class="text-tiny">Expected delivery time in days (optional)</div>
                            </fieldset>
                        </div>

                        <fieldset class="featured">
                            <div class="flex items-center gap10">
                                <input type="checkbox" name="is_featured" id="is_featured" value="1"
                                    {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                                <label for="is_featured" class="body-text">Featured Product</label>
                            </div>
                        </fieldset>

                        <fieldset class="trending">
                            <div class="flex items-center gap10">
                                <input type="checkbox" name="is_trending" id="is_trending" value="1"
                                    {{ old('is_trending', $product->is_trending) ? 'checked' : '' }}>
                                <label for="is_trending" class="body-text">Trending Product</label>
                            </div>
                        </fieldset>

                        <fieldset class="banner">
                            <div class="flex items-center gap10">
                                <input type="checkbox" name="is_banner" id="is_banner" value="1"
                                    {{ old('is_banner', $product->is_banner) ? 'checked' : '' }}>
                                <label for="is_banner" class="body-text">Show in Home Banner Slider</label>
                            </div>
                        </fieldset>
                        
                        <fieldset class="description">
                            <div class="body-title mb-10">Description <span class="tf-color-1">*</span></div>
                            <textarea id="summernote-add" name="description" placeholder="Description" aria-required="true" required>{{ old('description', $product->description) }}</textarea>
                        </fieldset>
                    </div>

                    <div class="wg-box">
                        <fieldset>
                            <div class="body-title mb-10">Current Thumbnail</div>
                            @if ($product->thumbnail)
                                <div class="mb-10">
                                    <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="Current Thumbnail"
                                        style="width: 100px; height: 100px; object-fit: cover; border-radius: 12px; border: 1px solid #e2e8f0;">
                                </div>
                            @endif

                            <div class="body-title mb-10">Upload new thumbnail (Optional)</div>
                            <div class="upload-image mb-16">
                                <div class="item up-load">
                                    <img id="thumbnailPreview"
                                        src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 24 24' fill='none' stroke='%23cbd5e1' stroke-width='2'><rect x='3' y='3' width='18' height='18' rx='2'/><circle cx='8.5' cy='8.5' r='1.5'/><path d='M21 15l-5-5L5 21'/></svg>"
                                        alt="Thumbnail Preview" style="width: 100%; height: 100px; object-fit: contain;">
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
                            </div>

                            <div class="body-title mb-10">Current Gallery Images</div>
                            <div class="mb-10">
                                @if ($product->images->count() > 0)
                                    <div class="flex flex-wrap gap-10" id="existingImagesContainer" style="display: flex; flex-wrap: wrap; gap: 15px;">
                                        @foreach ($product->images as $image)
                                            <div class="existing-image-card relative group" data-image-id="{{ $image->id }}" style="position: relative;">
                                                <img src="{{ asset('storage/' . $image->image) }}" alt="Gallery Image"
                                                    style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px; border: 2px solid #e5e7eb;">

                                                <button type="button"
                                                    class="delete-existing-image"
                                                    data-image-id="{{ $image->id }}"
                                                    style="position: absolute; top: -5px; right: -5px; background: #ef4444; color: white; border: none; border-radius: 50%; width: 24px; height: 24px; font-size: 14px; cursor: pointer; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 4px rgba(0,0,0,0.15);"
                                                    title="Delete this image">
                                                    ×
                                                </button>

                                                <div class="text-center mt-2">
                                                    <div class="text-xs text-gray-500" style="font-size: 11px; text-align: center; color: #6b7280; max-width: 100px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                                        @php
                                                            $filename = basename($image->image);
                                                            echo strlen($filename) > 12 ? substr($filename, 0, 9) . '...' : $filename;
                                                        @endphp
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="mt-3 text-sm text-gray-600" style="font-size: 12px; color: #4b5563; margin-top: 10px;">
                                        <strong>Note:</strong> Click the × button on any image to delete it from the gallery immediately.
                                    </div>
                                @else
                                    <div class="body-text text-gray-500" style="color: #9ca3af;">No gallery images uploaded.</div>
                                @endif
                            </div>

                            <div class="body-title mb-10" style="margin-top: 20px;">Add More Images (Optional)</div>
                            <div class="mb-10">
                                <div class="upload-image mb-16">
                                    <div class="item up-load">
                                        <label class="uploadfile" for="gallery">
                                            <span class="icon">
                                                <i class="icon-upload-cloud"></i>
                                            </span>
                                            <span class="text-tiny">
                                                Drop your images here or select
                                                <span class="tf-color">click to browse</span>
                                                <br>
                                                <small style="color: #ef4444; font-size: 11px;">Maximum 4 images allowed in total</small>
                                            </span>
                                            <input type="file" id="gallery" name="images[]" multiple accept="image/*" hidden>
                                        </label>
                                    </div>
                                </div>

                                <div id="selectedImages" style="display: none;"></div>

                                <div id="imageCountInfo" style="margin-bottom: 15px; padding: 10px; background: #f0f9ff; border-radius: 8px; border: 1px solid #bae6fd; color: #0369a1;">
                                    <div style="font-size: 13px; font-weight: 500;">
                                        <strong>Gallery Status:</strong>
                                        <span id="existingCount">{{ $product->images->count() }}</span> existing image(s) +
                                        <span id="newCount">0</span> newly selected =
                                        <span id="totalCount">{{ $product->images->count() }}</span> / 4 Total
                                        <span id="limitWarning" style="color: #ef4444; font-weight: bold; display: none; margin-left: 5px;">
                                            (Limit reached! Total cannot exceed 4)
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <div class="cols gap22" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; align-items: start;">
                           

                            <fieldset class="product-code">
                                <div class="body-title mb-10" style="font-weight: 700; font-size: 16px; color: #000;">Product Inventory Code</div>

                                <div style="margin-bottom: 15px;">
                                    <label class="form-label">Product Code / SKU <span class="tf-color-1">*</span></label>
                                    <input type="text" class="custom-form-input"
                                        placeholder="e.g., PROD-2023-001 or SKU-12345" name="product_code"
                                        value="{{ old('product_code', $product->product_code) }}" required>
                                    <div class="text-tiny text-gray-500 mt-5">
                                        Enter a unique product code or SKU for inventory tracking
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                        <div class="cols gap10" style="margin-top: 20px;">
                            <button class="tf-button w-full" type="submit">Update product</button>
                            <a href="{{ route('admin.product-list') }}" class="tf-button style-2 w-full">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="bottom-page">
            <div class="body-text">Copyright © Annoghor. All rights reserved. Designed and Developed </div>
            <div class="body-text">by <a href="https://innovatechbd.net/">Innovatech</a></div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>

    <script>
        function initializeScripts() {
            if (window.jQuery && $.fn.summernote) {
                // Summernote অ্যাক্টিভেশন
                $('#summernote-add').summernote({
                    placeholder: 'Write a detailed product description here...',
                    tabsize: 2,
                    height: 200,
                    toolbar: [
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['insert', ['link']],
                        ['view', ['fullscreen', 'codeview']]
                    ]
                });

                // ক্যাটাগরি এবং সাবক্যাটাগরি ইভেন্ট হ্যান্ডলার
                $('#category_id').on('change', function() {
                    const categoryId = this.value;
                    const subcategorySelect = document.getElementById('subcategory_id');

                    if (categoryId) {
                        fetch(`/admin/categories/${categoryId}/subcategories`)
                            .then(response => {
                                if (!response.ok) throw new Error('Network response error');
                                return response.json();
                            })
                            .then(data => {
                                subcategorySelect.innerHTML = '<option value="">Choose Subcategory</option>';
                                data.forEach(subcategory => {
                                    const option = document.createElement('option');
                                    option.value = subcategory.id;
                                    option.textContent = subcategory.name;
                                    subcategorySelect.appendChild(option);
                                });

                                // রিডাইরেক্ট ওল্ড ভ্যালু চেক
                                const currentSubcategoryId = "{{ old('subcategory_id', $product->subcategory_id) }}";
                                if (currentSubcategoryId) {
                                    subcategorySelect.value = currentSubcategoryId;
                                }

                                if ($.fn.niceSelect) {
                                    $(subcategorySelect).niceSelect('update');
                                }
                            })
                            .catch(error => console.error('Subcategory load error:', error));
                    } else {
                        subcategorySelect.innerHTML = '<option value="">Choose Subcategory</option>';
                        if ($.fn.niceSelect) $(subcategorySelect).niceSelect('update');
                    }
                });

                // কাস্টম থিমের NiceSelect কনফ্লিক্ট বাইপাসার
                $(document).on('click', '.select .list li, .nice-select .list li', function() {
                    setTimeout(() => {
                        $('#category_id').trigger('change');
                    }, 100);
                });

            } else {
                setTimeout(initializeScripts, 50);
            }
        }

        // রান করানো হলো
        initializeScripts();

        // ইমেজ ম্যানেজমেন্ট হ্যান্ডলার (ভ্যানিলা জাভাস্ক্রিপ্ট)
        document.addEventListener('DOMContentLoaded', function() {
            let selectedFiles = []; 
            let galleryInput = document.getElementById('gallery');
            let maxAllowedTotal = 4;

            // Thumbnail trigger
            document.getElementById('thumbnailPreview').addEventListener('click', function() {
                document.getElementById('thumbnail').click();
            });

            document.getElementById('thumbnail').addEventListener('change', function(e) {
                if (e.target.files.length > 0) {
                    const file = e.target.files[0];
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const previewImg = document.getElementById('thumbnailPreview');
                        previewImg.src = e.target.result;
                        previewImg.style.objectFit = 'cover';
                    }
                    reader.readAsDataURL(file);
                }
            });

            // Multi gallery changer
            galleryInput.addEventListener('change', function(e) {
                const newFiles = Array.from(e.target.files);
                let currentExistingCount = document.querySelectorAll('.existing-image-card').length;

                newFiles.forEach(newFile => {
                    const exists = selectedFiles.some(existingFile =>
                        existingFile.name === newFile.name && existingFile.size === newFile.size
                    );
                    
                    if (!exists && (currentExistingCount + selectedFiles.length < maxAllowedTotal)) {
                        selectedFiles.push(newFile);
                    }
                });

                updateFileInput();
                displaySelectedImages();
                updateCounts();
            });

            function updateFileInput() {
                const dataTransfer = new DataTransfer();
                selectedFiles.forEach(file => { dataTransfer.items.add(file); });
                galleryInput.files = dataTransfer.files;
            }

            function updateCounts() {
                let existingCount = document.querySelectorAll('.existing-image-card').length;
                let newCount = selectedFiles.length;
                let total = existingCount + newCount;

                document.getElementById('existingCount').textContent = existingCount;
                document.getElementById('newCount').textContent = newCount;
                document.getElementById('totalCount').textContent = total;

                if (total >= maxAllowedTotal) {
                    document.getElementById('limitWarning').style.display = 'inline';
                } else {
                    document.getElementById('limitWarning').style.display = 'none';
                }
            }

            function displaySelectedImages() {
                const container = document.getElementById('selectedImages');
                container.innerHTML = '';
                if (selectedFiles.length === 0) { container.style.display = 'none'; return; }

                container.style.display = 'block';
                container.style.padding = '15px';
                container.style.backgroundColor = '#f8fafc';
                container.style.borderRadius = '8px';
                container.style.marginTop = '15px';
                container.style.marginBottom = '15px';

                const headerDiv = document.createElement('div');
                headerDiv.style.display = 'flex';
                headerDiv.style.justifyContent = 'space-between';
                headerDiv.style.alignItems = 'center';
                headerDiv.style.marginBottom = '15px';

                const countInfo = document.createElement('div');
                countInfo.style.fontWeight = 'bold';
                countInfo.style.color = '#1e40af';
                countInfo.textContent = `Newly Selected: ${selectedFiles.length} image(s)`;

                const removeAllBtn = document.createElement('button');
                removeAllBtn.type = 'button';
                removeAllBtn.innerHTML = '× Clear New';
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
                    updateCounts();
                });

                headerDiv.appendChild(countInfo);
                headerDiv.appendChild(removeAllBtn);
                container.appendChild(headerDiv);

                const imagesGrid = document.createElement('div');
                imagesGrid.style.display = 'grid';
                imagesGrid.style.gridTemplateColumns = 'repeat(auto-fill, minmax(120px, 1fr))';
                imagesGrid.style.gap = '15px';

                selectedFiles.forEach((file, index) => {
                    const imageCard = document.createElement('div');
                    imageCard.style.cssText = 'position:relative; border:1px solid #e5e7eb; border-radius:8px; overflow:hidden; background:white;';

                    const removeBtn = document.createElement('button');
                    removeBtn.type = 'button';
                    removeBtn.innerHTML = '×';
                    removeBtn.style.cssText = 'position:absolute; top:5px; right:5px; background:#ef4444; color:white; border:none; border-radius:50%; width:22px; height:22px; cursor:pointer; display:flex; align-items:center; justify-content:center;';
                    removeBtn.addEventListener('click', function() {
                        selectedFiles.splice(index, 1);
                        updateFileInput();
                        displaySelectedImages();
                        updateCounts();
                    });

                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.style.cssText = 'width:100%; height:100px; object-fit:cover;';
                            imageCard.appendChild(img);
                        };
                        reader.readAsDataURL(file);
                    }

                    const infoDiv = document.createElement('div');
                    infoDiv.style.padding = '8px';
                    const fileName = document.createElement('div');
                    fileName.textContent = file.name.length > 15 ? file.name.substring(0, 9) + '...' : file.name;
                    fileName.style.fontSize = '11px';
                    fileName.style.overflow = 'hidden';
                    fileName.style.textOverflow = 'ellipsis';
                    fileName.style.whiteSpace = 'nowrap';

                    infoDiv.appendChild(fileName);
                    imageCard.appendChild(infoDiv);
                    imageCard.appendChild(removeBtn);
                    imagesGrid.appendChild(imageCard);
                });

                container.appendChild(imagesGrid);
            }

            // AJAX request to delete existing gallery images
            document.querySelectorAll('.delete-existing-image').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const imageId = this.getAttribute('data-image-id');
                    const imageCard = this.closest('.existing-image-card');

                    if (confirm('Are you sure you want to delete this image from server?')) {
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
                                    updateCounts();
                                    showAlert('Image deleted successfully!', 'success');
                                } else {
                                    showAlert('Failed to delete image: ' + data.message, 'error');
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
                document.querySelectorAll('.custom-alert').forEach(alert => alert.remove());
                const alertDiv = document.createElement('div');
                alertDiv.className = 'custom-alert';
                alertDiv.style.cssText = 'position:fixed; top:20px; right:20px; padding:15px 20px; border-radius:8px; z-index:9999; font-weight:500; box-shadow:0 4px 12px rgba(0,0,0,0.15);';

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
                setTimeout(() => { alertDiv.remove(); }, 3000);
            }
        });
    </script>
@endsection