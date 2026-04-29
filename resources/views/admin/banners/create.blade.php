@extends('layouts.admin')

@section('title', 'Add New Banner')

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3>Add New Banner</h3>
                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                        <li><a href="{{ route('admin.dashboard') }}"><div class="text-tiny">Dashboard</div></a></li>
                        <li><i class="icon-chevron-right"></i></li>
                        <li><a href="{{ route('admin.banners.index') }}"><div class="text-tiny">Banners</div></a></li>
                        <li><i class="icon-chevron-right"></i></li>
                        <li><div class="text-tiny">Add New</div></li>
                    </ul>
                </div>

                <div class="wg-box">
                    <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data" class="form-new-product">
                        @csrf
                        <div class="flex gap20 flex-wrap">
                            <fieldset class="name w-full">
                                <div class="body-title mb-10">Upload Banner Image <span class="tf-color-1">*</span></div>
                                <input type="file" name="image" required>
                                <div class="text-tiny mt-2">Recommended size: Slider (800x450), Static (400x450)</div>
                            </fieldset>

                            <fieldset class="name w-full">
                                <div class="body-title mb-10">Banner Type <span class="tf-color-1">*</span></div>
                                <select name="type" required>
                                    <option value="slider">Main Slider (Left Side)</option>
                                    <option value="static_side">Static Banner (Right Side)</option>
                                </select>
                            </fieldset>

                            <fieldset class="name w-full">
                                <div class="body-title mb-10">Link to Category (Optional)</div>
                                <select name="category_id">
                                    <option value="">None (Select if you want to link to a category)</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </fieldset>

                            <fieldset class="name w-full">
                                <div class="body-title mb-10">Custom Link (Optional)</div>
                                <input type="text" name="link" placeholder="Enter URL (e.g., https://...)">
                            </fieldset>
                        </div>
                        
                        <div class="bot">
                            <button class="tf-button style-1 w208" type="submit">Save Banner</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection