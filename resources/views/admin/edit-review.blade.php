@extends('layouts.admin')

@section('title', 'Edit Review')

@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center justify-between flex-wrap gap-6 mb-27">
                <h3>Edit Review</h3>
                <ul class="breadcrumbs flex items-center flex-wrap gap-3">
                    <li><a href="{{ route('admin.dashboard') }}"><div class="text-tiny">Dashboard</div></a></li>
                    <li><i class="icon-chevron-right"></i></li>
                    <li><a href="{{ route('admin.review-list') }}"><div class="text-tiny">Reviews</div></a></li>
                    <li><i class="icon-chevron-right"></i></li>
                    <li><div class="text-tiny">Edit Review</div></li>
                </ul>
            </div>

            @if(session('success'))
                <div class="alert alert-success mb-4">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger mb-4">{{ session('error') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger mb-4">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.review.update', $review) }}" method="POST" enctype="multipart/form-data" class="tf-section-2 form-add-product">
                @csrf
                @method('PUT')

                <div class="wg-box">
                    <!-- Reviewer Name -->
                    <fieldset class="name">
                        <div class="body-title mb-10">Reviewer Name <span class="tf-color-1">*</span></div>
                        <input type="text" name="reviewer_name" placeholder="Enter reviewer name"
                               value="{{ old('reviewer_name', $review->reviewer_name) }}" required class="mb-10">
                    </fieldset>

                    <!-- Review Text -->
                    <fieldset class="description">
                        <div class="body-title mb-10">Review Text <span class="tf-color-1">*</span></div>
                        <textarea name="review_text" placeholder="Enter review text" rows="4" required class="mb-10">{{ old('review_text', $review->review_text) }}</textarea>
                    </fieldset>

                    {{-- <!-- Rating -->
                    <fieldset class="rating">
                        <div class="body-title mb-10">Rating <span class="tf-color-1">*</span></div>
                        <select name="rating" required class="mb-10">
                            <option value="">Select Rating</option>
                            @for($i=1; $i<=5; $i++)
                                <option value="{{ $i }}" {{ old('rating', $review->rating)==$i ? 'selected' : '' }}>
                                    @for($j=0;$j<$i;$j++)⭐@endfor ({{ $i }} Star{{ $i>1?'s':'' }})
                                </option>
                            @endfor
                        </select>
                    </fieldset>

                    <!-- Reviewer Image -->
                    <fieldset class="image">
                        <div class="body-title mb-10">Reviewer Image (Optional, 80x80 recommended)</div>
                        @if($review->reviewer_image)
                            <div class="mb-2">
                                <img src="{{ asset('assets/images/testimonial/' . $review->reviewer_image) }}" 
                                     alt="{{ $review->reviewer_name }}" 
                                     class="img-thumbnail" 
                                     style="width:80px; height:80px; object-fit:cover;">
                                <p class="text-muted">Current Image</p>
                            </div>
                        @endif
                        <input type="file" name="reviewer_image" id="reviewer_image" accept="image/*" class="mb-10">
                        <small class="text-tiny">Leave empty to keep current image (Max: 2MB, JPG/PNG/GIF)</small>
                        <div id="image-preview" style="display:none; margin-top:10px;">
                            <img id="preview-img" src="" alt="Preview" style="width:80px; height:80px; object-fit:cover; border-radius:5px;">
                        </div>
                    </fieldset>

                    <!-- Status -->
                    <fieldset class="status">
                        <div class="body-title mb-10">Status</div>
                        <select name="is_active" class="mb-10">
                            <option value="1" {{ old('is_active', $review->is_active)==1?'selected':'' }}>Active</option>
                            <option value="0" {{ old('is_active', $review->is_active)==0?'selected':'' }}>Inactive</option>
                        </select>
                    </fieldset> --}}
                </div>

                <div class="wg-box mt-4">
                     <!-- Rating -->
                    <fieldset class="rating">
                        <div class="body-title mb-10">Rating <span class="tf-color-1">*</span></div>
                        <select name="rating" required class="mb-10">
                            <option value="">Select Rating</option>
                            @for($i=1; $i<=5; $i++)
                                <option value="{{ $i }}" {{ old('rating', $review->rating)==$i ? 'selected' : '' }}>
                                    @for($j=0;$j<$i;$j++)⭐@endfor ({{ $i }} Star{{ $i>1?'s':'' }})
                                </option>
                            @endfor
                        </select>
                    </fieldset>

                    <!-- Reviewer Image -->
                    <fieldset class="image">
                        <div class="body-title mb-10">Reviewer Image (Optional, 80x80 recommended)</div>
                        @if($review->reviewer_image)
                            <div class="mb-2">
                                <img src="{{ asset('assets/images/testimonial/' . $review->reviewer_image) }}" 
                                     alt="{{ $review->reviewer_name }}" 
                                     class="img-thumbnail" 
                                     style="width:80px; height:80px; object-fit:cover;">
                                <p class="text-muted">Current Image</p>
                            </div>
                        @endif
                        <input type="file" name="reviewer_image" id="reviewer_image" accept="image/*" class="mb-10">
                        <small class="text-tiny">Leave empty to keep current image (Max: 5MB, JPG/PNG/GIF)</small>
                        <div id="image-preview" style="display:none; margin-top:10px;">
                            <img id="preview-img" src="" alt="Preview" style="width:80px; height:80px; object-fit:cover; border-radius:5px;">
                        </div>
                    </fieldset>

                    <!-- Status -->
                    <fieldset class="status">
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" 
                                       class="custom-control-input" 
                                       id="is_active" 
                                       name="is_active" 
                                       value="1"
                                       {{ old('is_active', $review->is_active) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_active">
                                    Active (Show on website)
                                </label>
                            </div>
                            <small class="form-text text-muted">Check this to display the review on your website</small>
                        </div>
                    </fieldset>
                    <button type="submit" class="tf-button w-full">Update Review</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('reviewer_image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if(file){
        const reader = new FileReader();
        reader.onload = function(e){
            document.getElementById('preview-img').src = e.target.result;
            document.getElementById('image-preview').style.display = 'block';
        }
        reader.readAsDataURL(file);
    }
});
</script>
@endsection
