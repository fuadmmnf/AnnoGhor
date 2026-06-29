@extends('layouts.admin')

@section('title', 'Add Category')

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
            padding: 40px 20px;
            text-align: center;
            background-color: #f8fafc;
            transition: all 0.3s ease;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
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
            font-size: 32px;
            color: #94a3b8;
            margin-bottom: 12px;
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
            margin-top: 12px;
            align-items: center;
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
        .btn-remove-sub:hover { background: #fecaca; }
        
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
            margin-top: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .btn-add-outline:hover { background: #eff6ff; }
    </style>

    <div class="main-content">
        <div class="main-content-inner">
            <div class="main-content-wrap">
                
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3 class="fw-bold" style="color: #0f172a;">Category Information</h3>
                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                        <li><a href="{{ route('admin.dashboard') }}"><div class="text-tiny text-muted">Dashboard</div></a></li>
                        <li><i class="icon-chevron-right text-muted"></i></li>
                        <li><a href="{{ route('admin.category-list') }}"><div class="text-tiny text-muted">Category</div></a></li>
                        <li><i class="icon-chevron-right text-muted"></i></li>
                        <li><div class="text-tiny fw-bold" style="color: #6366f1;">New Category</div></li>
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
                    <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-group">
                            <label class="custom-label">Category Name <span style="color: #ef4444;">*</span></label>
                            <input type="text" name="category_name" class="custom-input" required value="{{ old('category_name') }}" placeholder="Enter category name">
                        </div>

                        <div class="form-group">
                            <label class="custom-label">Category Icon / Image <span style="color: #ef4444;">*</span></label>
                            <div class="file-upload-wrapper">
                                
                                <div id="img-preview-container" style="display:none; margin-bottom: 15px; position: relative; z-index: 20;">
                                    <img id="img-preview" src="#" alt="preview" style="width: 120px; height: 120px; object-fit: cover; border-radius: 12px; border: 2px solid #e2e8f0; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
                                </div>
                                
                                <div id="upload-text-indicator">
                                    <i class="fas fa-cloud-upload-alt upload-icon"></i>
                                    <h6 class="mb-2 text-dark">Click or drag image here to upload</h6>
                                    <p class="text-tiny text-muted mb-0">Upload transparent PNG for better animation (Max: 2MB)</p>
                                </div>
                                
                                <input type="file" name="category_image" id="category_image" accept="image/*" onchange="previewImage(this)" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="custom-label">Subcategories <span style="color: #ef4444;">*</span></label>
                            
                            <div id="subcategory-wrapper">
                                <div class="subcategory-item">
                                    <input type="text" name="subcategories[]" class="custom-input" placeholder="Subcategory name" required>
                                </div>
                            </div>

                            <button type="button" class="btn-add-outline" onclick="addSubcategory()">
                                <i class="icon-plus"></i> Add another subcategory
                            </button>
                        </div>
                        
                        <hr style="border-color: #f1f5f9; margin: 30px 0;">

                        <div class="bot text-end">
                            <button class="tf-button style-1 w208" type="submit" style="border-radius: 10px; font-weight: 600; letter-spacing: 0.5px;">
                                <i class="fas fa-save me-2"></i> Save Category
                            </button>
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
        function addSubcategory() {
            const wrapper = document.getElementById('subcategory-wrapper');
            
            // Create container for input and remove button
            const row = document.createElement('div');
            row.className = 'subcategory-item';

            // Create input field
            const input = document.createElement('input');
            input.type = 'text';
            input.name = 'subcategories[]';
            input.className = 'custom-input';
            input.placeholder = 'Subcategory name';
            input.required = true;

            // Create remove button
            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.className = 'btn-remove-sub';
            removeBtn.innerHTML = '<i class="icon-trash-2"></i>'; // থিমের নিজস্ব আইকন
            removeBtn.title = "Remove Subcategory";
            removeBtn.onclick = function() {
                row.remove();
            };

            row.appendChild(input);
            row.appendChild(removeBtn);
            wrapper.appendChild(row);
        }

        function previewImage(input) {
            const preview = document.getElementById('img-preview');
            const container = document.getElementById('img-preview-container');
            const textIndicator = document.getElementById('upload-text-indicator');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    container.style.display = 'block';
                    // Hide text to make it look clean after upload
                    if(textIndicator) textIndicator.style.display = 'none';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection