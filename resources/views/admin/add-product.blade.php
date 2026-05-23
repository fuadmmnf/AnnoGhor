@extends('layouts.admin')

@section('title', 'Add Product')

@section('content')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">

    <style>
        .custom-form-input {
            width: 100%;
            padding: 14px 20px;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
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
                    <h3>Add Product</h3>
                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                        <li>
                            <a href="{{ route('admin.dashboard') }}">
                                <div class="text-tiny">Dashboard</div>
                            </a>
                        </li>
                        <li><i class="icon-chevron-right"></i></li>
                        <li>
                            <a href="{{ route('admin.product-list') }}">
                                <div class="text-tiny">Ecommerce</div>
                            </a>
                        </li>
                        <li><i class="icon-chevron-right"></i></li>
                        <li><div class="text-tiny">Add product</div></li>
                    </ul>
                </div>

                @if (session('success'))
                    <div class="alert alert-success mb-4" style="background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger mb-4" style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger mb-4" style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
                        <ul class="mb-0" style="margin: 0; padding-left: 20px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data" class="tf-section-2 form-add-product">
                    @csrf

                    <div class="wg-box">
                        <fieldset class="name">
                            <div class="body-title mb-10">Product name <span class="tf-color-1">*</span></div>
                            <input class="mb-10" type="text" placeholder="Enter product name" name="name" tabindex="0" value="{{ old('name') }}" aria-required="true" required>
                            <div class="text-tiny">Do not exceed 20 characters when entering the product name.</div>
                        </fieldset>

                        <div class="gap22 cols">
                            <fieldset class="category">
                                <div class="body-title mb-10">Category <span class="tf-color-1">*</span></div>
                                <div class="select">
                                    <select class="" name="category_id" id="category_id" required>
                                        <option value="">Choose category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                                    </select>
                                </div>
                            </fieldset>
                        </div>

                        <div class="gap22 cols">
                            <fieldset class="brand">
                                <div class="body-title mb-10">Regular Price (Per KG) <span class="tf-color-1">*</span></div>
                                <input class="mb-10" type="number" step="0.01" placeholder="Enter regular price per kg" name="regular_price" value="{{ old('regular_price') }}" required>
                            </fieldset>
                            <fieldset class="brand">
                                <div class="body-title mb-10">Discount Price (Per KG)</div>
                                <input class="mb-10" type="number" step="0.01" placeholder="Enter discount price per kg" name="discount_price" value="{{ old('discount_price') }}">
                            </fieldset>
                        </div>

                        <div class="gap22 cols">
                            <fieldset class="stock">
                                <div class="body-title mb-10">Stock Quantity (in KG) <span class="tf-color-1">*</span></div>
                                <input class="mb-10" type="number" step="0.01" min="0" placeholder="e.g., 50.50" name="stock_quantity" value="{{ old('stock_quantity', 0) }}" required>
                                <div class="text-tiny">Enter available stock weight in Kilograms (KG)</div>
                            </fieldset>
                            <fieldset class="delivery">
                                <div class="body-title mb-10">Delivery Days</div>
                                <input class="mb-10" type="number" min="1" placeholder="e.g., 3" name="delivery_days" value="{{ old('delivery_days') }}">
                                <div class="text-tiny">Expected delivery time in days (optional)</div>
                            </fieldset>
                        </div>

                        <fieldset class="featured">
                            <div class="flex items-center gap10">
                                <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                <label for="is_featured" class="body-text">Featured Product</label>
                            </div>
                        </fieldset>
                        <fieldset class="trending">
                            <div class="flex items-center gap10">
                                <input type="checkbox" name="is_trending" id="is_trending" value="1" {{ old('is_trending') ? 'checked' : '' }}>
                                <label for="is_trending" class="body-text">Trending Product</label>
                            </div>
                        </fieldset>
                        <fieldset class="banner">
                            <div class="flex items-center gap10">
                                <input type="checkbox" name="is_banner" id="is_banner" value="1" {{ old('is_banner') ? 'checked' : '' }}>
                                <label for="is_banner" class="body-text">Show in Home Banner Slider</label>
                            </div>
                        </fieldset>
                        
                        <fieldset class="description">
                            <div class="body-title mb-10">Description <span class="tf-color-1">*</span></div>
                            <textarea id="summernote-add" name="description" placeholder="Description" aria-required="true" required>{{ old('description') }}</textarea>
                        </fieldset>
                    </div>

                    <div class="wg-box">
                        <fieldset>
                            <div class="body-title mb-10">Upload images</div>
                            <div class="upload-image mb-16">
                                <div class="item up-load">
                                    <img id="thumbnailPreview" src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 24 24' fill='none' stroke='%23cbd5e1' stroke-width='2'><rect x='3' y='3' width='18' height='18' rx='2'/><circle cx='8.5' cy='8.5' r='1.5'/><path d='M21 15l-5-5L5 21'/></svg>" alt="" style="width:100%; height:100px; object-fit:contain;">
                                    <label class="uploadfile" for="thumbnail">
                                        <span class="icon"><i class="icon-upload-cloud"></i></span>
                                        <span class="text-tiny">Upload a product thumbnail or <span class="tf-color">click to browse</span></span>
                                        <input type="file" name="thumbnail" id="thumbnail" hidden accept="image/*">
                                    </label>
                                </div>
                                <div class="item up-load">
                                    <label class="uploadfile" for="gallery">
                                        <span class="icon"><i class="icon-upload-cloud"></i></span>
                                        <span class="text-tiny">Drop your images here or select <span class="tf-color">click to browse</span></span>
                                        <input type="file" id="gallery" name="images[]" multiple accept="image/*" hidden>
                                    </label>
                                </div>
                            </div>
                            <div id="selectedImages" style="display: none;"></div>
                            <div class="body-text">Upload up to 4 images (JPEG, PNG, JPG, GIF, WEBP), max 2MB each.</div>
                        </fieldset>

                        <div class="cols gap22" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; align-items: start;">

                            <fieldset class="product-code">
                                <div class="body-title mb-10" style="font-weight: 700; font-size: 16px; color: #000;">Product Inventory Code</div>
                                <div style="margin-bottom: 15px;">
                                    <label class="form-label">Product Code / SKU <span class="tf-color-1">*</span></label>
                                    <input type="text" class="custom-form-input" placeholder="e.g., PROD-2023-001" name="product_code" value="{{ old('product_code') }}" required>
                                </div>
                            </fieldset>
                        </div>

                        <div class="cols gap10" style="margin-top: 20px;">
                            <button class="tf-button w-full" type="submit">Add product</button>
                            <a href="{{ route('admin.product-list') }}" class="tf-button style-2 w-full">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>

    <script>
        function initializeScripts() {
            // উইন্ডোতে জেকোয়েরি এবং সামারনেট অ্যাভেলেবল হওয়া মাত্রই রান করবে
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

                // ক্যাটাগরি চেঞ্জ ইভেন্ট লজিক
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

                                const currentSubcategoryId = "{{ old('subcategory_id') }}";
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

                // ওল্ড ভ্যালু চেক অ্যান্ড রিস্টোর
                const oldCategoryId = "{{ old('category_id') }}";
                if (oldCategoryId) {
                    $('#category_id').val(oldCategoryId).trigger('change');
                    setTimeout(() => {
                        const oldSubcategoryId = "{{ old('subcategory_id') }}";
                        if (oldSubcategoryId) {
                            $('#subcategory_id').val(oldSubcategoryId);
                            if ($.fn.niceSelect) $('#subcategory_id').niceSelect('update');
                        }
                    }, 500);
                }

                // কাস্টম থিমের ড্রপডাউন ক্লিক হ্যান্ডলার বাইপাস
                $(document).on('click', '.select .list li, .nice-select .list li', function() {
                    setTimeout(() => {
                        $('#category_id').trigger('change');
                    }, 100);
                });

            } else {
                // জেকোয়েরি এভেলেবল না হলে পুনরায় ট্রাই করবে (পোলিং মেকানিজম)
                setTimeout(initializeScripts, 50);
            }
        }

        // ইনিশিয়াল কল
        initializeScripts();

        // প্রিভিউ এবং গ্যালারি ইমেজ আপলোড হ্যান্ডলিং (ভ্যানিলা জাভাস্ক্রিপ্ট)
        document.addEventListener('DOMContentLoaded', function() {
            let selectedFiles = []; 
            let galleryInput = document.getElementById('gallery');

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
                        
                        const uploadLabel = document.querySelector('.upload-image .item.up-load label[for="thumbnail"]');
                        if (uploadLabel) uploadLabel.style.display = 'none';
                    }
                    reader.readAsDataURL(file);
                }
            });

            galleryInput.addEventListener('change', function(e) {
                const newFiles = Array.from(e.target.files);
                newFiles.forEach(newFile => {
                    const exists = selectedFiles.some(existingFile =>
                        existingFile.name === newFile.name && existingFile.size === newFile.size
                    );
                    if (!exists) selectedFiles.push(newFile);
                });
                updateFileInput();
                displaySelectedImages();
            });

            function updateFileInput() {
                const dataTransfer = new DataTransfer();
                selectedFiles.forEach(file => { dataTransfer.items.add(file); });
                galleryInput.files = dataTransfer.files;
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
                if (selectedFiles.length > 0) { headerDiv.appendChild(removeAllBtn); }
                container.appendChild(headerDiv);

                const imagesGrid = document.createElement('div');
                imagesGrid.style.display = 'grid';
                imagesGrid.style.gridTemplateColumns = 'repeat(auto-fill, minmax(120px, 1fr))';
                imagesGrid.style.gap = '15px';

                selectedFiles.forEach((file, index) => {
                    const imageCard = document.createElement('div');
                    imageCard.style.position = 'relative';
                    imageCard.style.border = '1px solid #e5e7eb';
                    imageCard.style.borderRadius = '8px';
                    imageCard.style.overflow = 'hidden';
                    imageCard.style.backgroundColor = 'white';

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
                    }

                    const infoDiv = document.createElement('div');
                    infoDiv.style.padding = '8px';
                    const fileName = document.createElement('div');
                    fileName.textContent = file.name.length > 15 ? file.name.substring(0, 15) + '...' : file.name;
                    fileName.style.fontSize = '12px';
                    fileName.style.fontWeight = '500';
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
        });
    </script>
@endsection