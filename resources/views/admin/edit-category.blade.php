@extends('layouts.admin')

@section('title', 'Edit Category')

@section('content')
    <style>
        /* 🎨 Custom Modern Admin Form Styles */
        .modern-admin-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 32px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.04);
            border: 1px solid #f1f5f9;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .custom-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .custom-input {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            background-color: #f8fafc;
            font-size: 15px;
            color: #334155;
            transition: all 0.3s ease;
        }

        .custom-input:focus {
            background-color: #ffffff;
            border-color: #6366f1;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
            outline: none;
        }

        /* 📁 File Upload Drag & Drop Style */
        .file-upload-wrapper {
            position: relative;
            border: 2px dashed #cbd5e1;
            border-radius: 12px;
            padding: 30px 20px;
            text-align: center;
            background-color: #f8fafc;
            transition: all 0.3s ease;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            flex-grow: 1;
        }

        .file-upload-wrapper:hover {
            border-color: #6366f1;
            background-color: #eff6ff;
        }

        .file-upload-wrapper input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
            z-index: 10;
        }

        .upload-icon {
            font-size: 28px;
            color: #94a3b8;
            margin-bottom: 8px;
        }

        /* 🟢 Modern Alert Box */
        .custom-alert {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 16px 20px;
            border-radius: 12px;
            font-weight: 500;
            margin-bottom: 24px;
        }
        .custom-alert-success { background: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; }
        .custom-alert-danger { background: #fef2f2; border: 1px solid #fecaca; color: #991b1b; }

        /* ➕ Dynamic Subcategory Styles */
        .subcategory-item {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
            align-items: center;
            background: #ffffff;
            padding: 12px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.02);
        }
        
        .btn-remove-sub {
            background: #fee2e2;
            color: #ef4444;
            border: none;
            border-radius: 10px;
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: 0.2s;
            flex-shrink: 0;
        }
        .btn-remove-sub:hover { background: #fecaca; color: #dc2626; }
        
        .btn-add-outline {
            background: transparent;
            border: 2px dashed #6366f1;
            color: #6366f1;
            padding: 12px 20px;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
            width: 100%;
            margin-top: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .btn-add-outline:hover { background: #eff6ff; }

        .empty-state {
            text-align: center;
            padding: 30px;
            color: #64748b;
            font-size: 14px;
            background: #f8fafc;
            border-radius: 10px;
            border: 1px dashed #cbd5e1;
            margin-bottom: 15px;
        }
    </style>

    <div class="main-content">
        <div class="main-content-inner">
            <div class="main-content-wrap">
                
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3 class="fw-bold" style="color: #0f172a;">Edit Category</h3>
                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                        <li>
                            <a href="{{ route('admin.dashboard') }}">
                                <div class="text-tiny text-muted">Dashboard</div>
                            </a>
                        </li>
                        <li><i class="icon-chevron-right text-muted"></i></li>
                        <li>
                            <a href="{{ route('admin.category-list') }}">
                                <div class="text-tiny text-muted">Category</div>
                            </a>
                        </li>
                        <li><i class="icon-chevron-right text-muted"></i></li>
                        <li>
                            <div class="text-tiny fw-bold" style="color: #6366f1;">Edit category</div>
                        </li>
                    </ul>
                </div>
                
                @if(session('success'))
                    <div class="custom-alert custom-alert-success">
                        <i class="fas fa-check-circle mt-1" style="font-size: 18px;"></i>
                        <div>{{ session('success') }}</div>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="custom-alert custom-alert-danger">
                        <i class="fas fa-exclamation-triangle mt-1" style="font-size: 18px;"></i>
                        <div>{{ session('error') }}</div>
                    </div>
                @endif
                
                @if($errors->any())
                    <div class="custom-alert custom-alert-danger">
                        <i class="fas fa-exclamation-circle mt-1" style="font-size: 18px;"></i>
                        <ul class="mb-0" style="margin: 0; padding-left: 20px;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="modern-admin-card wg-box">
                    <form action="{{ route('admin.category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label class="custom-label">Category Name <span style="color: #ef4444;">*</span></label>
                            <input class="custom-input" type="text" placeholder="Category name" name="category_name" 
                                   value="{{ old('category_name', $category->name) }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="custom-label">Category Icon / Image</label>
                            <div class="flex items-center gap20 flex-wrap">
                                
                                @if($category->image)
                                    <div class="item" style="flex-shrink: 0;">
                                        <div style="width: 100px; height: 100px; border-radius: 12px; background: #f8fafc; border: 2px solid #e2e8f0; display: flex; align-items: center; justify-content: center; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
                                            <img src="{{ asset('uploads/category/' . $category->image) }}" 
                                                 alt="{{ $category->name }}" 
                                                 style="width: 100%; height: 100%; object-fit: contain;">
                                        </div>
                                        <div class="text-center text-tiny text-muted mt-2 fw-bold">Current Image</div>
                                    </div>
                                @endif
                                
                                <div class="file-upload-wrapper">
                                    <i class="fas fa-cloud-upload-alt upload-icon"></i>
                                    <h6 class="mb-2 text-dark">Upload New Image (Optional)</h6>
                                    <p class="text-tiny text-muted mb-0">Upload a transparent PNG for the Ghorerbazar animation effect.</p>
                                    <input type="file" name="category_image" accept="image/*" onchange="previewImage(this)">
                                </div>
                            </div>
                            
                            <div id="new-preview-container" style="display:none; margin-top: 15px;">
                                <label class="custom-label text-muted">New Image Preview:</label>
                                <img id="new-preview" src="#" style="width: 100px; height: 100px; object-fit: contain; border-radius: 12px; border: 2px dashed #6366f1; padding: 5px;">
                            </div>
                        </div>

                        <div class="form-group mt-5 pt-4" style="border-top: 1px solid #f1f5f9;">
                            <label class="custom-label mb-3" style="font-size: 16px;">Subcategories</label>
                            
                            <div id="subcategories-container">
                                @if($category->subcategories->count() > 0)
                                    @foreach($category->subcategories as $index => $sub)
                                        <div class="subcategory-item" data-subcategory-id="{{ $sub->id }}">
                                            <input type="hidden" name="subcategory_ids[]" value="{{ $sub->id }}">
                                            <input type="text" name="subcategories[]" class="custom-input" 
                                                   value="{{ old('subcategories.' . $index, $sub->name) }}" 
                                                   placeholder="Subcategory name" required>
                                            <button type="button" class="btn-remove-sub remove-subcategory" title="Remove Subcategory">
                                                <i class="icon-trash-2"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="empty-state" id="empty-state">
                                        No subcategories yet. Click "Add Subcategory" to add one.
                                    </div>
                                @endif
                            </div>
                            
                            <button type="button" class="btn-add-outline" id="add-subcategory">
                                <i class="icon-plus"></i> Add Subcategory
                            </button>
                        </div>
                        
                        <div class="flex items-center gap10 justify-end mt-5 pt-4" style="border-top: 1px solid #f1f5f9;">
                            <a href="{{ route('admin.category-list') }}" class="tf-button style-1 w180" style="border-radius: 10px; background: #f1f5f9; color: #475569; text-align: center;">Cancel</a>
                            <button class="tf-button w180" type="submit" style="border-radius: 10px;">Update Category</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        
        <div class="bottom-page">
            <div class="body-text">Copyright © 2026 Annoghor. All rights reserved. Designed and Developed </div>
            <div class="body-text">by <a href="https://innovatechbd.net/" target="_blank" style="color: #6366f1; font-weight: 600;">Innovatech</a></div>
        </div>
        </div>
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
                
                // HTML for newly added subcategory (Updated with modern classes)
                newSubcategory.innerHTML = `
                    <input type="text" name="new_subcategories[]" class="custom-input" placeholder="New subcategory name" required>
                    <button type="button" class="btn-remove-sub remove-subcategory" title="Remove Subcategory">
                        <i class="icon-trash-2"></i>
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

        // Image Preview Function
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
            } else {
                container.style.display = 'none';
            }
        }
    </script>
@endsection