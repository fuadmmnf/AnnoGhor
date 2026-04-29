@extends('layouts.admin')

@section('title', 'Review List')

@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="main-content-wrap">

            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Review List</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li><a href="{{ route('admin.dashboard') }}"><div class="text-tiny">Dashboard</div></a></li>
                    <li><i class="icon-chevron-right"></i></li>
                    <li><div class="text-tiny">Reviews</div></li>
                </ul>
            </div>

            @if(session('success'))
                <div class="alert alert-success mb-4">{{ session('success') }}</div>
            @endif

            <div class="wg-box">
                <div class="flex justify-between flex-wrap items-center gap10 mb-4">
                    <div class="body-title">All Customer Reviews</div>
                    <a class="tf-button style-1" href="{{ route('admin.add-review') }}">
                        <i class="icon-plus"></i> Add New Review
                    </a>
                </div>

                @if($reviews->isEmpty())
                    <div class="text-center py-8">
                        <div class="body-title mb-3">No reviews found</div>
                        <a class="tf-button style-1" href="{{ route('admin.add-review') }}">
                            <i class="icon-plus"></i> Add New Review
                        </a>
                    </div>
                @else
                    <div class="text-tiny mb-2 d-md-none" style="color: #888; font-style: italic;">
                        <i class="icon-arrow-left"></i> Scroll horizontally to view full table <i class="icon-arrow-right"></i>
                    </div>

                    <div class="product-table-wrapper">
                        <table class="product-table">
                            <thead>
                                <tr>
                                    <th style="width: 80px;">Image</th>
                                    <th>Name</th>
                                    <th style="width:30%;">Review</th>
                                    <th style="width:10%;">Rating</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reviews as $review)
                                    <tr>
                                        <td>
                                            @if($review->reviewer_image)
                                                <img src="{{ asset('assets/images/testimonial/' . $review->reviewer_image) }}" 
                                                     alt="{{ $review->reviewer_name }}" 
                                                     class="product-image">
                                            @else
                                                <div class="no-image"><i class="icon-user"></i></div>
                                            @endif
                                        </td>
                                        <td class="font-weight-600">{{ $review->reviewer_name }}</td>
                                        <td class="text-wrap-300" style="width:30%;">{{ Str::limit($review->review_text, 100) }}</td>
                                        <td style="width:10%;"><span class="rating-badge"><i class="icon-star text-warning"></i> {{ $review->rating }}</span></td>
                                        <td>
                                            <div class="flex justify-center">
                                                <form action="{{ route('admin.review.toggle-status', $review) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn-status {{ $review->is_active ? 'active' : 'inactive' }}">
                                                        {{ $review->is_active ? 'Active' : 'Inactive' }}
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="action-buttons">
                                                <a href="{{ route('admin.edit-review', $review) }}" class="tf-button btn-sm" title="Edit">
                                                    <i class="icon-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.review.delete', $review) }}" method="POST" style="display: inline;">
                                                    @csrf @method('DELETE')
                                                    <button type="button" class="tf-button style-2 btn-sm bg-danger" 
                                                            onclick="if(confirm('Delete this review?')) this.form.submit();">
                                                        <i class="icon-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="flex items-center justify-between flex-wrap gap10 mt-3">
                        <div class="text-tiny">
                            Showing {{ $reviews->firstItem() }} to {{ $reviews->lastItem() }} of {{ $reviews->total() }} entries
                        </div>
                        {{ $reviews->links('pagination::bootstrap-4') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
/* Table Responsive Wrapper */
.product-table-wrapper {
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    border: 1px solid #f1f1f1;
    border-radius: 10px;
    margin-bottom: 20px;
}

.product-table {
    width: 100%;
    min-width: 850px; /* Force minimum width to prevent squeezing */
    border-collapse: collapse;
}

.product-table th, .product-table td {
    padding: 15px 12px;
    vertical-align: middle; /* Vertical Center Fix */
    text-align: left;
    font-size:16px;
    border-bottom: 1px solid #f1f1f1;
}

.product-table thead {
    background: #f8f9fa;
}

/* Vertical & Horizontal Center for specific columns */
.text-center { text-align: center !important; }
.justify-center { justify-content: center !important; }

/* Image & UI Elements */
.product-image, .no-image {
    width: 50px;
    height: 50px;
    object-fit: cover;
    border-radius: 50%; /* Rounded circle better for reviewer images */
    border: 1px solid #ddd;
}

.text-wrap-300 {
    min-width: 250px;
    white-space: normal;
    color: #666;
}

/* Status Buttons */
.btn-status {
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    border: none;
    cursor: pointer;
    text-transform: uppercase;
}
.btn-status.active { background: #e8f5e9; color: #2e7d32; }
.btn-status.inactive { background: #ffebee; color: #c62828; }

/* Action Buttons Group */
.action-buttons {
    display: flex;
    gap: 8px;
    justify-content: center;
    align-items: center;
}

.bg-danger { background-color: #ef4444 !important; color: white !important; }

/* Mobile Specific Optimizations */
@media (max-width: 576px) {
    .flex.justify-between.items-center {
        flex-direction: column;
        align-items: flex-start !important;
    }
    .tf-button { width: 100%; justify-content: center; }
}

/* Helper for scroll hint */
@media (min-width: 768px) {
    .d-md-none { display: none !important; }
}
</style>
@endsection