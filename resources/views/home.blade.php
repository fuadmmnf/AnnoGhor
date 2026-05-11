@extends('layouts.app')

@section('title', 'AnnoGhor')

@section('content')

    <!--====== Start Hero Section ======-->
    {{-- <section class="hero-section">
        <!--=== Hero Wrapper ===-->
        <div class="hero-wrapper-one">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <!--=== Fixed Hero Content (Static - Never Changes) ===-->
                        <div class="hero-content style-one mb-30">
                            <h1 class="hero-title">Exclusive Collection <br>
                                in <span class="highlight">Our Online</span> Store</h1>
                            <p class="hero-description">
                                Discover our exclusive collection available only in our online store.
                                Shop now for unique and premium items that you won't find anywhere else.
                                Enjoy fast delivery, secure payment options, and exceptional customer support.
                            </p>

                            <!-- Only Shop Now Button -->
                            <a href="{{ route('shops') }}" class="theme-btn style-one">
                                Shop Now <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <!--=== Sliding Banner Images Only ===-->
                        <div class="hero-image-box">
                            <div class="hero-slider-one">
                                @forelse ($bannerProducts as $banner)
                                    <div class="hero-image">
                                        <img src="{{ asset('storage/' . $banner->thumbnail) }}" alt="Banner Image"
                                            class="hero-banner-img">
                                    </div>
                                @empty
                                    <div class="hero-image">
                                        <img src="{{ asset('assets/images/hero/default-banner.jpg') }}" alt="Default Banner"
                                            class="hero-banner-img">
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <!--=== Hero Dots (Slider Navigation) ===-->
                <div class="hero-dots"></div>
            </div>
        </div>
    </section><!--====== End Hero Section ======--> --}}

    <!--====== Start Animated-headline Section ======-->
    {{-- <section class="animated-headline-area primary-dark-bg pt-25 pb-25">
        <div class="headline-wrap style-one">
            <span class="marquee-wrap">
                @for ($i = 0; $i < 3; $i++)
                    <span class="marquee-inner left">
                        @foreach ($headlines as $headline)
                            <span class="marquee-item"><b>{{ $headline->title }}</b><i class="fas fa-bahai"></i></span>
                        @endforeach
                    </span>
                @endfor
            </span>
        </div>
    </section><!--====== End Animated-headline Section ======--> --}}

    <section class="hero-banner py-4" style="background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);">
        <div class="banner-section mt-30">
            <div class="container">
                <!-- এখানে 'align-items-stretch' যোগ করা হয়েছে -->
                <div class="row align-items-stretch">
                    <div class="col-lg-8">
                        <div class="home-slider">
                            @foreach ($sliderBanners as $banner)
                                <div class="slide-item">
                                    <a href="...">
                                        <img src="{{ asset('storage/' . $banner->image) }}" alt="Slider Image" class="w-100">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-lg-4">
                        @if ($staticBanner)
                            @php
                                $staticUrl = $staticBanner->category_id
                                    ? route('shops', ['category' => $staticBanner->category_id])
                                    : $staticBanner->link ?? '#';
                            @endphp
                            <div class="static-side-banner">
                                <a href="{{ $staticUrl }}">
                                    <img src="{{ asset('storage/' . $staticBanner->image) }}" alt="Static Image"
                                        class="img-fluid rounded w-100" style="height: 100%; object-fit: cover;">
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="featured-categories py-5">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h3 class="fw-bold">Featured Categories</h3>
                <div class="title-line mx-auto"></div>
            </div>

            <div class="row g-4 row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-6 justify-content-center">
                @foreach ($categories as $category)
                    <div class="col">
                        <a href="{{ route('shops', ['category' => $category->id]) }}" class="category-card-link">
                            <div class="category-card-inner text-center">
                                <div class="category-icon-box shadow-sm mx-auto">
                                    <img src="{{ asset('uploads/category/' . $category->image) }}" class="img-fluid"
                                        alt="{{ $category->name }}"
                                        onerror="this.onerror=null;this.src='https://placehold.co/120x120?text=No+Image';">
                                </div>
                                <h5 class="category-name mt-3">{{ $category->name }}</h5>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    {{-- <!--====== Start Features Section ======-->
    <section class="features-section pt-130">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!--=== Features Wrapper ===-->
                    <div class="features-wrapper" data-aos="fade-up" data-aos-delay="10" data-aos-duration="1000">

                        <!--=== Iconic Box Item ===-->
                        <div class="iconic-box-item icon-left-box mb-25">
                            <div class="icon">
                                <i class="fas fa-certificate"></i>
                            </div>
                            <div class="content">
                                <h5>Quality Guarantee</h5>
                                <p>We ensure top-notch quality for every product you purchase.</p>
                            </div>
                        </div>
                        <!--=== Divider ===-->
                        <div class="divider mb-25">
                            <img src="assets/images/divider.png" alt="divider">
                        </div>

                        <!--=== Iconic Box Item ===-->
                        <div class="iconic-box-item icon-left-box mb-25">
                            <div class="icon">
                                <i class="fas fa-microphone"></i>
                            </div>
                            <div class="content">
                                <h5>Great Support 24/7</h5>
                                <p>Our customer support team is available around the clock </p>
                            </div>
                        </div>
                        <!--=== Divider ===-->
                        <div class="divider mb-25">
                            <img src="assets/images/divider.png" alt="divider">
                        </div>
                        <!--=== Iconic Box Item ===-->
                        <div class="iconic-box-item icon-left-box mb-25">
                            <div class="icon">
                                <i class="far fa-handshake"></i>
                            </div>
                            <div class="content">
                                <h5>Return Available</h5>
                                <p>Making it easy to return any items if you're not satisfied.</p>
                            </div>
                        </div>
                        <!--=== Divider ===-->
                        <div class="divider mb-25">
                            <img src="assets/images/divider.png" alt="divider">
                        </div>
                        <!--=== Iconic Box Item ===-->
                        <div class="iconic-box-item icon-left-box mb-25">
                            <div class="icon">
                                <i class="fas fa-sack-dollar"></i>
                            </div>
                            <div class="content">
                                <h5>Secure Payment</h5>
                                <p>Shop with confidence knowing that our secure payment</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--====== End Features Section ======--> --}}

    {{-- Trending Collections --}}
    <section class="trending-products pt-90">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title mb-50 text-center" data-aos="fade-down">
                        <div class="sub-heading d-inline-flex align-items-center">
                            <i class="flaticon-sparkler"></i>
                            <span class="sub-title" style="color:#5a3e2b;">Trending collections</span>
                        </div>
                        <h2>What's New!</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                @forelse($trendingProducts as $product)
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="product-item style-one mb-40">
                            <div class="product-thumbnail">
                                @if ($product->thumbnail)
                                    <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}"
                                        style="width: 100%; height: 400px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('assets/images/products/feature-product-1.png') }}"
                                        alt="{{ $product->name }}">
                                @endif


                                <div class="discount">Trending</div>



                                <div class="hover-content">
                                    <a href="{{ $product->details_url }}"
                                        class="icon-btn">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    <a href="javascript:void(0)" class="icon-btn toggle-wishlist"
                                        data-product-id="{{ $product->id }}">
                                        <i class="fa fa-heart"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="product-info-wrap text-center">
                                <div class="product-info">
                                    <h2 class="product-title">
                                        <a href="{{ $product->details_url }}">
                                            {{ \Illuminate\Support\Str::limit($product->name, 40) }}
                                        </a>
                                    </h2>

                                    <div class="product-price">
                                        @if ($product->discount_price)
                                            <span class="old-price" style="color:#000; font-size:16px;">
                                                {{ \App\Helpers\CurrencyHelper::formatPrice($product->regular_price) }}
                                            </span>
                                            <span class="new-price" style="color:#000; font-size:16px; font-weight:600;">
                                                {{ \App\Helpers\CurrencyHelper::formatPrice($product->discount_price) }}
                                            </span>
                                        @else
                                            <span class="new-price" style="color:#000; font-size:16px; font-weight:500;">
                                                {{ \App\Helpers\CurrencyHelper::formatPrice($product->regular_price) }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p>No trending products marked yet.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- এখান থেকে নতুন ক্যাটাগরি ভিত্তিক সেকশন শুরু --}}
    @foreach ($categoryProducts as $category)
        @if ($category->products->count() > 0)
            <section class="category-products-section pt-50 pb-50">
                <div class="container">
                    {{-- এই অংশটি বাটনটিকে একদম ডান পাশে রাখবে --}}
                    <div class="row align-items-center mb-40">
                        <div class="col-md-12 d-flex justify-content-between align-items-center">
                            <div class="section-title">
                                <h2 style="margin-bottom: 0;">{{ $category->name }}</h2>
                            </div>
                            <div class="view-all-btn">
                                <a href="{{ route('shops', ['category' => $category->id]) }}"
                                    class="btn btn-sm btn-primary">
                                    View All Items →
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        @foreach ($category->products as $product)
                            <div class="col-xl-3 col-lg-4 col-sm-6">
                                <div class="product-item style-one mb-40"
                                    style="border: 1px solid #f0f0f0; padding: 10px; border-radius: 12px;">
                                    <div class="product-thumbnail">
                                        <a href="{{ $product->details_url }}">
                                            <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                                alt="{{ $product->name }}"
                                                style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px;">
                                        </a>
                                    </div>

                                    {{-- প্রোডাক্টের নাম এবং দাম --}}
                                    <div class="product-content mt-15">
                                        <h4 class="title" style="font-size: 16px; font-weight: 600;">
                                            <a href="{{ $product->details_url }}"
                                                style="color: #333; text-decoration: none;">
                                                {{ $product->name }}
                                            </a>
                                        </h4>
                                        <div class="price" style="color: #ff4d4d; font-weight: bold; font-size: 15px;">
                                            ৳ {{ $product->discount_price ?? $product->price }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
            <hr>
        @endif
    @endforeach

    {{-- Featured Products --}}
    {{-- <section class="features-products pt-90">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title mb-50 text-center" data-aos="fade-right">
                        <div class="sub-heading d-inline-flex align-items-center">
                            <i class="flaticon-sparkler"></i>
                            <span class="sub-title" style="color:#5a3e2b;">Feature Products</span>
                        </div>
                        <h2>Our Featured Collections</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @forelse($featuredProducts as $product)
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        @include('partials.product_card', ['product' => $product])
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <h4>No featured products available</h4>
                    </div>
                @endforelse
            </div>

            @if ($featuredProducts->count() > 0)
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-30 mb-30">
                            <a href="{{ route('shops') }}" class="theme-btn style-one">
                                Explore More Products <i class="far fa-long-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section> --}}

    <!--====== Start Testimonial Sections  ======-->
    <section class="testimonial-section mb-70">
        <div class="testimonial-wrapper overflow-x-hidden pt-190 pb-90 white-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="section-content-box mb-40" data-aos="fade-right" data-aos-delay="30"
                            data-aos-duration="800">
                            <div class="section-title mb-50">
                                <h2>What Our Clients Say About Us</h2>
                            </div>
                            <div class="testimonial-arrows style-one"></div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="testimonial-slider-one" data-aos="fade-left" data-aos-delay="50"
                            data-aos-duration="1000">
                            @forelse($reviews as $review)
                                <div class="testimonial-item style-one mb-40">
                                    <div class="testimonial-content">
                                        <p>{{ $review->review_text }}</p>
                                        <div class="author-quote-item d-flex justify-content-between align-items-center">
                                            <div class="author-item">
                                                <div class="author-thumb">
                                                    @if ($review->reviewer_image)
                                                        <img src="{{ asset('assets/images/testimonial/' . $review->reviewer_image) }}"
                                                            alt="{{ $review->reviewer_name }}">
                                                    @else
                                                        <img src="{{ asset('assets/images/testimonial/default-avatar.png') }}"
                                                            alt="{{ $review->reviewer_name }}">
                                                    @endif
                                                </div>
                                                <div class="author-info">
                                                    <h5>{{ $review->reviewer_name }}</h5>
                                                    <ul class="ratings rating{{ $review->rating }}">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= $review->rating)
                                                                <li><i class="fas fa-star"></i></li>
                                                            @else
                                                                <li><i class="far fa-star"></i></li>
                                                            @endif
                                                        @endfor
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="quote-icon">
                                                <i class="flaticon flaticon-right-quote"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="testimonial-item style-one mb-40">
                                    <div class="testimonial-content">
                                        <p>No reviews available yet.</p>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

{{-- Required Scripts - Add before closing body tag --}}
@push('scripts')
    {{-- <style>
        .product-title {
            font-size: 16px;
        }

        .product-price {
            font-size: 18px;
        }

        /* Wishlist Active State */
        .hover-content .icon-btn.active i {
            color: #dc3545 !important;
        }


        /* Custom Notification Styles */
        .custom-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            animation: slideInRight 0.3s ease-out;
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .featured-categories {
            background-color: #f9fafb !important;
        }

        .section-title h2 {
            color: #333;
            position: relative;
        }

        .title-line {
            height: 3px;
            width: 60px;
            background: #f15922;
            /* ঘোরের বাজার থিম কালার */
            margin-top: 10px;
        }

        .category-card-link {
            text-decoration: none;
            display: block;
            transition: transform 0.3s ease;
        }

        .category-card-link:hover {
            transform: translateY(-5px);
        }

        .category-icon-box {
            width: 120px;
            height: 120px;
            background: #ffffff;
            border-radius: 50%;
            /* রাউন্ডেড সার্কেল */
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }

        .category-card-link:hover .category-icon-box {
            border-color: #f15922;
            background: #fff;
        }

        .category-icon-box img {
            max-width: 100%;
            height: auto;
            object-fit: contain;
        }

        .category-name {
            color: #444;
            font-size: 16px;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .category-card-link:hover .category-name {
            color: #f15922;
        }

        /* মোবাইলের জন্য ছোট সাইজ */
        @media (max-width: 576px) {
            .category-icon-box {
                width: 90px;
                height: 90px;
                padding: 15px;
            }

            .category-name {
                font-size: 14px;
            }
        }

        /* স্লাইডার ও পাশের ব্যানারের উচ্চতা সমান রাখা */
        .hero-banner .home-slider img {
            width: 100%;
            height: 480px;
            /* আপনার ছবির উচ্চতা এখানে ফিক্স করে দিন */
            object-fit: cover;
            /* ছবি যাতে চ্যাপ্টা বা টেনে লম্বা না হয় */
            border-radius: 10px;
            /* কোনাগুলো একটু গোল করার জন্য */
        }

        /* ডান পাশের ব্যানারের উচ্চতাও স্লাইডারের সমান করা */
        .static-side-banner img {
            height: 480px;
            object-fit: cover;
            border-radius: 10px;
        }

        /* স্লাইডারের ডটগুলোর স্টাইল (ঐচ্ছিক) */
        .slick-dots {
            bottom: 20px;
        }

        .slick-dots li button:before {
            color: #fff;
            font-size: 12px;
        }
    </style> --}}
    <style>
        /* গ্লোবাল স্টাইল */
        .product-title {
            font-size: 16px;
        }

        .product-price {
            font-size: 18px;
        }

        /* হোভার কন্টেন্ট */
        .hover-content .icon-btn.active i {
            color: #dc3545 !important;
        }

        /* কাস্টম নোটিফিকেশন (পূর্বের মতো অপরিবর্তিত) */
        .custom-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            animation: slideInRight 0.3s ease-out;
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        /* হিরো ব্যানার সেকশন - মর্ডান লুক */
        /* হিরো ব্যানার সেকশন - গ্যাপ কমানো হয়েছে */
        .hero-banner {
            background: linear-gradient(135deg, #f5f7fa 0%, #ffffff 100%);
            padding: 15px 0 20px 0;
        }

        /* স্লাইডার এবং স্ট্যাটিক ইমেজ - শার্প কর্নার ও সমান উচ্চতা */
        .home-slider .slide-item img,
        .static-side-banner img {
            width: 100%;
            height: 250px; /* উচ্চতা ৩৫০ পিক্সেল করা হয়েছে */
            object-fit: cover;
            border-radius: 0px !important; /* গোল ভাব দূর করা হয়েছে */
            box-shadow: none !important;
            transition: transform 0.3s ease;
        }

        .home-slider .slide-item:hover img,
        .static-side-banner:hover img {
            transform: scale(1.02);
        }

        /* স্লাইডারের ডটস */
        .slick-dots {
            bottom: 15px;
        }

        .slick-dots li button:before {
            font-size: 10px;
            color: #ffffff;
        }

        /* ফিচার্ড ক্যাটাগরি সেকশন - গ্যাপ ও ফন্ট সাইজ কমানো */
        .featured-categories {
            background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
            padding: 30px 0 !important; /* সেকশনের উপরের গ্যাপ কমানো হয়েছে */
        }

        .section-title h3 {
            font-size: 1.6rem !important; /* টাইটেল ছোট করা হয়েছে */
            font-weight: 700;
            color: #333;
            margin-bottom: 5px !important;
        }

        .title-line {
            height: 3px;
            width: 60px;
            background: #f15922;
            margin: 0 auto 15px;
            border-radius: 2px;
        }

        /* ক্যাটাগরি আইকন বক্স */
        .category-icon-box {
            width: 120px;
            height: 120px;
            background: #ffffff;
            border-radius: 20px; /* ক্যাটাগরি আইকন হালকা গোল রাখা হয়েছে দেখতে সুন্দরের জন্য */
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            border: 1px solid rgba(0,0,0,0.05);
            margin: 0 auto;
        }

        .category-name {
            color: #333;
            font-size: 0.95rem;
            font-weight: 600;
            margin-top: 10px;
        }

        /* মোবাইল রেসপনসিভ */
        @media (max-width: 768px) {
            .home-slider .slide-item img,
            .static-side-banner img {
                height: 250px;
            }
            .section-title h3 {
                font-size: 1.3rem !important;
            }
        }
    </style>

    <script>
        $(document).ready(function() {
            @auth
            loadWishlistStatus();
        @endauth

        // Toggle Wishlist Function
        $(document).on('click', '.toggle-wishlist', function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();

            const productId = $(this).data('product-id');
            const $btn = $(this);
            const $icon = $btn.find('i');

            // Disable button during request
            $btn.css('pointer-events', 'none');

            $.ajax({
                url: '{{ route('wishlist.toggle') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: productId
                },
                success: function(response) {
                    console.log('Wishlist toggle response:', response);

                    if (response.success) {
                        if (response.in_wishlist) {
                            // Added to wishlist
                            $icon.addClass('fas').removeClass('far').css('color', '#dc3545');
                            $btn.addClass('active');
                        } else {
                            // Removed from wishlist
                            $icon.addClass('far').removeClass('fas').css('color', '');
                            $btn.removeClass('active');
                        }

                        // Update wishlist count in header
                        if (response.wishlist_count !== undefined) {
                            $('.wishlist-count, .pro-count.wishlist-count').text(response
                                .wishlist_count);
                        }

                        showNotification(response.message, 'success');
                    } else if (response.redirect) {
                        // User not logged in - redirect to login
                        window.location.href = response.redirect;
                    } else {
                        showNotification(response.message, 'warning');
                    }

                    // Re-enable button
                    $btn.css('pointer-events', '');
                },
                error: function(xhr) {
                    console.error('Wishlist error:', xhr);

                    if (xhr.status === 401) {
                        // Unauthorized - redirect to login
                        window.location.href = '{{ route('login') }}';
                    } else {
                        showNotification('Error updating wishlist', 'danger');
                    }

                    // Re-enable button
                    $btn.css('pointer-events', '');
                }
            });
        });

        // Load wishlist status for all products
        function loadWishlistStatus() {
            $.ajax({
                url: '{{ route('wishlist.product-ids') }}',
                method: 'GET',
                success: function(response) {
                    console.log('Wishlist product IDs:', response);

                    if (response.success && response.product_ids) {
                        response.product_ids.forEach(function(productId) {
                            $(`.toggle-wishlist[data-product-id="${productId}"]`)
                                .addClass('active')
                                .find('i')
                                .addClass('fas')
                                .removeClass('far')
                                .css('color', '#dc3545');
                        });
                    }
                },
                error: function(xhr) {
                    console.error('Error loading wishlist status:', xhr);
                }
            });
        }

        // Show notification function
        function showNotification(message, type = 'success') {
            // Remove existing notifications
            $('.custom-notification').remove();

            // Create new notification
            const notification = $('<div>', {
                class: `custom-notification alert alert-${type} alert-dismissible fade show`,
                html: `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `
            });

            // Append to body
            $('body').prepend(notification);

            // Auto remove after 3 seconds
            setTimeout(function() {
                notification.fadeOut(300, function() {
                    $(this).remove();
                });
            }, 3000);
        }

        // Add to Cart functionality
        $(document).on('click', '.add-to-cart', function(e) {
            e.preventDefault();

            const productId = $(this).data('product-id');
            const productName = $(this).data('product-name');
            const productPrice = $(this).data('product-price');

            // You can implement add to cart logic here
            showNotification(`${productName} added to cart!`, 'success');
        });
        });

        $(document).ready(function() {
            $('.home-slider').slick({
                dots: true,
                infinite: true,
                speed: 600, // ৩০০ থেকে বাড়িয়ে ৬০০ করলে স্লাইড ট্রানজিশন আরও স্মুথ হয়
                slidesToShow: 1,
                autoplay: true,
                autoplaySpeed: 1000, // ৩ সেকেন্ড পর পর পরিবর্তন (আগে ছিল ২০০০ = ২ সেকেন্ড)
                arrows: false,
                cssEase: 'cubic-bezier(0.645, 0.045, 0.355, 1)', // মসৃণ ইজিং ফাংশন
                fade: false, // ফেড ইফেক্ট চাইলে true করে দিবেন
            });
        });
    </script>
@endpush
