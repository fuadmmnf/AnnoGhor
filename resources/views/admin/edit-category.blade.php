@extends('layouts.admin')

@section('title', 'Edit Category')

@section('content')
    <style>
        .subcategory-item {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
            border: 1px solid #e9ecef;
        }
        
        .subcategory-item input[type="text"] {
            flex: 1;
            padding: 10px 15px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            font-size: 14px;
        }
        
        .subcategory-item input[type="text"]:focus {
            outline: none;
            border-color: #2377fc;
            box-shadow: 0 0 0 3px rgba(35, 119, 252, 0.1);
        }
        
        .btn-remove {
            background: #dc3545;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s;
            white-space: nowrap;
        }
        
        .btn-remove:hover {
            background: #c82333;
        }
        
        .btn-add-subcategory {
            background: #28a745;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            margin-top: 10px;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-add-subcategory:hover {
            background: #218838;
        }
        
        .btn-add-subcategory i {
            font-size: 16px;
        }
        
        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
        }
        
        .subcategories-section {
            margin-top: 30px;
            padding: 20px;
            background: #ffffff;
            border-radius: 8px;
            border: 1px solid #e9ecef;
        }
        
        .section-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #212529;
        }
        
        .empty-state {
            text-align: center;
            padding: 40px;
            color: #6c757d;
            font-size: 14px;
        }
    </style>

    <!-- main-content -->
    <div class="main-content">
        <!-- main-content-wrap -->
        <div class="main-content-inner">
            <!-- main-content-wrap -->
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3>Edit Category</h3>
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
                            <a href="{{ route('admin.category-list') }}">
                                <div class="text-tiny">Category</div>
                            </a>
                        </li>
                        <li>
                            <i class="icon-chevron-right"></i>
                        </li>
                        <li>
                            <div class="text-tiny">Edit category</div>
                        </li>
                    </ul>
                </div>
                
                <!-- Success/Error Messages -->
                @if(session('success'))
                    <div class="alert alert-success mb-4" style="background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger mb-4" style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
                        {{ session('error') }}
                    </div>
                @endif
                
                @if($errors->any())
                    <div class="alert alert-danger mb-4" style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
                        <ul class="mb-0" style="margin: 0; padding-left: 20px;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- edit-category -->
                <div class="wg-box">
                    <form action="{{ route('admin.category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <!-- Category Name -->
                        <fieldset class="name">
                            <div class="body-title mb-10">Category Name <span class="tf-color-1">*</span></div>
                            <input class="flex-grow" type="text" placeholder="Category name" name="category_name" 
                                   tabindex="0" value="{{ old('category_name', $category->name) }}" aria-required="true" required>
                        </fieldset>
                        
                        <fieldset class="name">
    <div class="body-title mb-10">Category Icon/Image</div>
    <div class="flex items-center gap20">
        @if($category->image)
            <div class="item">
                <img src="{{ asset('uploads/category/' . $category->image) }}" 
                     alt="{{ $category->name }}" 
                     style="width: 80px; height: 80px; object-fit: contain; border-radius: 50%; background: #f8f9fa; border: 1px solid #ddd;">
            </div>
        @endif
        <div class="flex-grow">
            <input type="file" name="category_image" accept="image/*" onchange="previewImage(this)">
            <div class="text-tiny mt-1">Upload a transparent PNG for the Ghorerbazar animation effect.</div>
        </div>
    </div>
    <div id="new-preview-container" style="display:none; margin-top: 15px;">
        <div class="text-tiny mb-5">New Image Preview:</div>
        <img id="new-preview" src="#" style="width: 60px; height: 60px; object-fit: contain; border-radius: 50%; border: 2px dashed #2377fc;">
    </div>
</fieldset>
                        <!-- Subcategories Section -->
                        <div class="subcategories-section">
                            <div class="section-title">Subcategories</div>
                            
                            <div id="subcategories-container">
                                @if($category->subcategories->count() > 0)
                                    @foreach($category->subcategories as $index => $sub)
                                        <div class="subcategory-item" data-subcategory-id="{{ $sub->id }}">
                                            <input type="hidden" name="subcategory_ids[]" value="{{ $sub->id }}">
                                            <input type="text" name="subcategories[]" value="{{ old('subcategories.' . $index, $sub->name) }}" 
                                                   placeholder="Subcategory name" required>
                                            <button type="button" class="btn-remove remove-subcategory">
                                                <i class="icon-trash-2"></i> Remove
                                            </button>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="empty-state" id="empty-state">
                                        No subcategories yet. Click "Add Subcategory" to add one.
                                    </div>
                                @endif
                            </div>
                            
                            <button type="button" class="btn-add-subcategory" id="add-subcategory">
                                <i class="icon-plus"></i> Add Subcategory
                            </button>
                        </div>
                        
                        <!-- Form Actions -->
                        <div class="form-actions">
                            <button class="tf-button w180" type="submit">Update Category</button>
                            <a href="{{ route('admin.category-list') }}" class="tf-button style-1 w180">Cancel</a>
                        </div>
                    </form>
                </div>
                <!-- /edit-category -->
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
            const container = document.getElementById('subcategories-container');
            const addButton = document.getElementById('add-subcategory');
            const emptyState = document.getElementById('empty-state');
            
            // Add new subcategory
            addButton.addEventListener('click', function() {
                // Remove empty state if exists
                if (emptyState) {
                    emptyState.remove();
                }
                
                const newSubcategory = document.createElement('div');
                newSubcategory.className = 'subcategory-item';
                newSubcategory.innerHTML = `
                    <input type="text" name="new_subcategories[]" placeholder="New subcategory name" required>
                    <button type="button" class="btn-remove remove-subcategory">
                        <i class="icon-trash-2"></i> Remove
                    </button>
                `;
                
                container.appendChild(newSubcategory);
                
                // Focus on the new input
                newSubcategory.querySelector('input').focus();
            });
            
            // Remove subcategory (using event delegation)
            container.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-subcategory') || e.target.closest('.remove-subcategory')) {
                    const button = e.target.closest('.remove-subcategory');
                    const item = button.closest('.subcategory-item');
                    
                    if (confirm('Are you sure you want to remove this subcategory?')) {
                        item.remove();
                        
                        // Show empty state if no subcategories left
                        if (container.children.length === 0) {
                            const emptyDiv = document.createElement('div');
                            emptyDiv.className = 'empty-state';
                            emptyDiv.id = 'empty-state';
                            emptyDiv.textContent = 'No subcategories yet. Click "Add Subcategory" to add one.';
                            container.appendChild(emptyDiv);
                        }
                    }
                }
            });
        });
        function previewImage(input) {
    const preview = document.getElementById('new-preview');
    const container = document.getElementById('new-preview-container');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            container.style.display = 'block';
        }
        reader.readAsDataURL(input.files[0]);
    }
}
    </script>
@endsection