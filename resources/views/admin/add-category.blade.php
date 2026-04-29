@extends('layouts.admin')

@section('title', 'Add Category')

@section('content')
    <!-- main-content -->
    <div class="main-content">
        <!-- main-content-wrap -->
        <div class="main-content-inner">
            <!-- main-content-wrap -->
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3>Category information</h3>
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
                            <div class="text-tiny">New category</div>
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

                <!-- new-category -->
                <div class="wg-box">
                    

                    <form action="{{ route('admin.category.store') }}" method="POST" class="form-new-product form-style-1" enctype="multipart/form-data">
    @csrf

    {{-- Category --}}
    <fieldset>
        <div class="body-title">Category name <span class="tf-color-1">*</span></div>
        <input type="text" name="category_name" required value="{{ old('category_name') }}">
    </fieldset>

    {{-- Category Image (Ghorerbazar Style Icon) --}}
<fieldset>
    <div class="body-title">Category Icon/Image <span class="tf-color-1">*</span></div>
    <div class="upload-image flex-grow">
        <div class="item" id="img-preview-container" style="display:none; margin-bottom: 10px;">
            <img id="img-preview" src="#" alt="preview" style="width: 100px; height: 100px; object-fit: cover; border-radius: 10px; border: 1px solid #ddd;">
        </div>
        <div class="upload-prepare">
            <input type="file" name="category_image" id="category_image" accept="image/*" onchange="previewImage(this)">
        </div>
    </div>
    <div class="text-tiny mt-1">Upload transparent PNG for better animation (Max: 2MB)</div>
</fieldset>

    {{-- Subcategories --}}
    <fieldset>
        <div class="body-title">Subcategories <span class="tf-color-1">*</span></div>

        <div id="subcategory-wrapper">
            <input type="text" name="subcategories[]" placeholder="Subcategory name" required>
        </div>

        <button type="button" onclick="addSubcategory()" style="margin-top:10px;">
            + Add another subcategory
        </button>
    </fieldset>

    <div class="bot">
        <button class="tf-button w208" type="submit">Save</button>
    </div>
</form>

                </div>
                <!-- /new-category -->
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
@endsection

<script>
function addSubcategory() {
    const wrapper = document.getElementById('subcategory-wrapper');
    const input = document.createElement('input');
    input.type = 'text';
    input.name = 'subcategories[]';
    input.placeholder = 'Subcategory name';
    input.style.marginTop = '8px';
    input.required = true;
    wrapper.appendChild(input);
}
function previewImage(input) {
    const preview = document.getElementById('img-preview');
    const container = document.getElementById('img-preview-container');
    
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
