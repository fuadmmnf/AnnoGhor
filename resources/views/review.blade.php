@extends('layouts.app')

@section('title', 'Product Reviews - AnnoGhor')

@section('content')

    <!--====== Start Page Banner Section ======-->
    <section class="page-banner-section pt-120 pb-40" style="background: #fdfaf7; border-bottom: 1px solid #f3ece6;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h3 class="mb-10">Product Reviews</h3>
                    <p style="color: #666;">Feedback from our verified customers about AnnoGhor's premium organic items.</p>
                </div>
                <div class="col-md-6 text-md-right mt-3 mt-md-0">
                    <a href="{{ route('orders') }}" class="btn text-white" style="background: #5a3e2b; font-weight: 500; padding: 10px 20px; border-radius: 5px;">
                        <i class="fas fa-shopping-bag mr-2"></i> Write a New Review
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!--====== End Page Banner Section ======-->

    <!--====== Start Reviews Display Section ======-->
    <section class="reviews-section pt-60 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    
                    <!-- সেশন মেসেজ অ্যালার্ট (সফলভাবে সাবমিট বা এরর হলে দেখাবে) -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show border-0 mb-30 p-3" role="alert" style="border-left: 4px solid #28a745 !important;">
                            <strong><i class="fas fa-check-circle mr-2"></i> Success!</strong> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="background: transparent; border: 0; float: right; font-size: 20px;">&times;</button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show border-0 mb-30 p-3" role="alert" style="border-left: 4px solid #dc3545 !important;">
                            <strong><i class="fas fa-exclamation-circle mr-2"></i> Error!</strong> {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="background: transparent; border: 0; float: right; font-size: 20px;">&times;</button>
                        </div>
                    @endif

                    <!-- রিভিউ গ্রিড লেআউট -->
                    <div class="row">
                        @forelse($reviews as $review)
                            <div class="col-md-6 mb-30">
                                <div class="review-item-card p-4" style="background: #fff; border: 1px solid #eaeaea; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.02); height: 100%; display: flex; flex-direction: column; justify-content: space-between;">
                                    
                                    <div>
                                        <!-- রেটিং স্টার মেকানিজম -->
                                        <div class="review-stars mb-15" style="color: #ffb703; font-size: 14px;">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $review->rating)
                                                    <i class="fas fa-star"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif
                                            @endfor
                                            <span class="text-muted ml-2" style="font-size: 12px; font-weight: 500;">({{ $review->rating }}/5)</span>
                                        </div>

                                        <!-- প্রোডাক্টের নাম (যদি রিলেশনশিপ কল করা থাকে) -->
                                        @if($review->product)
                                            <h6 class="mb-10" style="font-size: 14px; color: #888; font-weight: 500;">
                                                Review for: <span style="color: #5a3e2b; font-weight: 600;">{{ $review->product->name }}</span>
                                            </h6>
                                        @endif

                                        <!-- রিভিউর মূল টেক্সট -->
                                        <p style="color: #444; line-height: 1.6; font-size: 15px; font-style: italic; margin-bottom: 20px;">
                                            "{{ $review->review_text }}"
                                        </p>
                                    </div>

                                    <!-- রিভিউ প্রদানকারীর প্রোফাইল মেটা -->
                                    <div class="reviewer-meta d-flex align-items-center justify-content-between pt-15" style="border-top: 1px solid #f7f7f7; margin-top: auto;">
                                        <div class="d-flex align-items-center" style="gap: 12px;">
                                            <div class="avatar-box" style="width: 40px; height: 40px; border-radius: 50%; overflow: hidden; background: #eee;">
                                                @if($review->reviewer_image)
                                                    <img src="{{ asset('storage/' . $review->reviewer_image) }}" alt="{{ $review->reviewer_name }}" style="width: 100%; height: 100%; object-fit: cover;">
                                                @else
                                                    <img src="{{ asset('assets/images/testimonial/default-avatar.png') }}" alt="{{ $review->reviewer_name }}" style="width: 100%; height: 100%; object-fit: cover;">
                                                @endif
                                            </div>
                                            <div>
                                                <h6 style="margin: 0; font-size: 14px; font-weight: 700; color: #222;">{{ $review->reviewer_name }}</h6>
                                                
                                                <!-- ভেরিফাইড পারচেজ ব্যাজ -->
                                                @if($review->order_id)
                                                    <span style="font-size: 11px; color: #28a745; font-weight: 600;"><i class="fas fa-check-circle"></i> Verified Purchase</span>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <!-- তারিখ -->
                                        <span class="text-muted" style="font-size: 12px;">
                                            {{ $review->created_at ? $review->created_at->diffForHumans() : '' }}
                                        </span>
                                    </div>

                                </div>
                            </div>
                        @empty
                            <!-- যদি কোনো রিভিউ না থাকে -->
                            <div class="col-lg-12">
                                <div class="alert text-center border-0 p-5" style="background: #fdfaf7; border-radius: 8px;">
                                    <i class="far fa-comment-dots mb-15" style="font-size: 40px; color: #5a3e2b;"></i>
                                    <p style="color: #5a3e2b; font-size: 16px; font-weight: 500; margin-bottom: 15px;">No reviews found matching your account.</p>
                                    <a href="{{ route('orders') }}" class="btn text-white" style="background: #5a3e2b; font-size: 14px; padding: 8px 20px;">Go to Order History</a>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <!-- পেজিনেশন (যদি কন্ট্রোলার থেকে পাজিনেট করে ডাটা পাঠানো হয়) -->
                    @if(method_exists($reviews, 'hasPages') && $reviews->hasPages())
                        <div class="pagination-wrapper mt-40 d-flex justify-content-center">
                            {{ $reviews->links() }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </section>
    <!--====== End Reviews Display Section ======-->

@endsection