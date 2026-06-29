@extends('layouts.admin')

@section('title', 'Add New Banner')

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
        }

        .upload-icon {
            font-size: 32px;
            color: #94a3b8;
            margin-bottom: 12px;
        }

        /* 📱 Grid Layout System */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
        }

        @media (min-width: 768px) {
            .form-grid.two-cols {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>

    <div class="main-content">
        <div class="main-content-inner">
            <div class="main-content-wrap">
                
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3 class="fw-bold" style="color: #0f172a;">Add New Banner</h3>
                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                        <li><a href="{{ route('admin.dashboard') }}"><div class="text-tiny text-muted">Dashboard</div></a></li>
                        <li><i class="icon-chevron-right text-muted"></i></li>
                        <li><a href="{{ route('admin.banners.index') }}"><div class="text-tiny text-muted">Banners</div></a></li>
                        <li><i class="icon-chevron-right text-muted"></i></li>
                        <li><div class="text-tiny fw-bold" style="color: #6366f1;">Add New</div></li>
                    </ul>
                </div>

                <div class="modern-admin-card wg-box">
                    <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-group">
                            <label class="custom-label">Upload Banner Image <span style="color: #ef4444;">*</span></label>
                            <div class="file-upload-wrapper">
                                <i class="fas fa-cloud-upload-alt upload-icon"></i>
                                <h6 class="mb-2 text-dark">Click or drag image here to upload</h6>
                                <p class="text-tiny text-muted mb-0">Recommended size: Slider (800x450), Static (400x450)</p>
                                <input type="file" name="image" required accept="image/*">
                            </div>
                        </div>

                        <div class="form-grid two-cols">
                            <div class="form-group mb-0">
                                <label class="custom-label">Banner Type <span style="color: #ef4444;">*</span></label>
                                <select name="type" class="custom-input" required>
                                    <option value="slider">Main Slider (Left Side)</option>
                                    <option value="static_side">Static Banner (Right Side)</option>
                                </select>
                            </div>

                            <div class="form-group mb-0">
                                <label class="custom-label">Link to Category <span class="text-muted fw-normal">(Optional)</span></label>
                                <select name="category_id" class="custom-input">
                                    <option value="">-- None (Select to link a category) --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <label class="custom-label">Custom Link <span class="text-muted fw-normal">(Optional)</span></label>
                            <input type="url" name="link" class="custom-input" placeholder="Enter URL (e.g., https://example.com/promotion)">
                        </div>
                        
                        <hr style="border-color: #f1f5f9; margin: 30px 0;">

                        <div class="bot text-end">
                            <button class="tf-button style-1 w208" type="submit" style="border-radius: 10px; font-weight: 600; letter-spacing: 0.5px;">
                                <i class="fas fa-save me-2"></i> Save Banner
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection