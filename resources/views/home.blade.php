@extends('layouts.app')

@section('title', 'AnnoGhor')

@section('content')

<section class="hero-banner py-4" style="background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);">
    <div class="banner-section mt-30">
        <div class="container">
            <div class="row align-items-stretch">
                
                <div class="col-lg-8">
                    <div class="hero-slider-wrap" style="position: relative; overflow: hidden; height: 100%; display: flex; flex-direction: column;">
                        
                        <div class="home-slider" style="flex: 1; height: 100%;">
                            @foreach ($sliderBanners as $banner)
                                @php
                                    $sliderUrl = isset($banner->category_id) && $banner->category_id
                                        ? route('shops', ['category' => $banner->category_id])
                                        : $banner->link ?? '#';
                                @endphp
                                <div class="slide-item" style="height: 100%;">
                                    <a href="{{ $sliderUrl }}" style="display: block; height: 100%;">
                                        <img src="{{ asset('storage/' . $banner->image) }}" alt="Slider Image" class="w-100 h-100" style="object-fit: cover; height: 350px;">
                                    </a>
                                </div>
                            @endforeach
                        </div>

                        <button type="button" class="hero-slider-arrow hero-slider-prev" style="position: absolute; top: 50%; left: 15px; transform: translateY(-50%); z-index: 10; background: rgba(255,255,255,0.9); border: none; width: 45px; height: 45px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #333; cursor: pointer; box-shadow: 0 4px 10px rgba(0,0,0,0.15); opacity: 0; visibility: hidden; transition: all 0.3s ease;">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button type="button" class="hero-slider-arrow hero-slider-next" style="position: absolute; top: 50%; right: 15px; transform: translateY(-50%); z-index: 10; background: rgba(255,255,255,0.9); border: none; width: 45px; height: 45px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #333; cursor: pointer; box-shadow: 0 4px 10px rgba(0,0,0,0.15); opacity: 0; visibility: hidden; transition: all 0.3s ease;">
                            <i class="fas fa-chevron-right"></i>
                        </button>

                    </div>
                </div>

                <div class="col-lg-4">
                    @if ($staticBanner)
                        @php
                            $staticUrl = $staticBanner->category_id
                                ? route('shops', ['category' => $staticBanner->category_id])
                                : $staticBanner->link ?? '#';
                        @endphp
                        <div class="static-side-banner" style="height: 100%; display: flex;">
                            <a href="{{ $staticUrl }}" style="display: block; width: 100%; height: 100%;">
                                <img src="{{ asset('storage/' . $staticBanner->image) }}" alt="Static Image"
                                    class="img-fluid rounded w-100 h-100" style="height: 350px; object-fit: cover; width: 100%;">
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
                    <div class="product-item style-one mb-40" onclick="window.location.href='{{ $product->details_url }}'" style="cursor: pointer; padding-bottom: 5px; overflow: hidden;">
                        
                        <div class="product-thumbnail" style="margin-bottom: 0 !important; overflow: hidden;">
                            <a href="{{ $product->details_url }}">
                                @if ($product->thumbnail)
                                    <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}"
                                        style="width: 100%; height: 350px; object-fit: cover; display: block;">
                                @else
                                    <img src="{{ asset('assets/images/products/feature-product-1.png') }}"
                                        alt="{{ $product->name }}" style="width: 100%; height: 350px; object-fit: cover; display: block;">
                                @endif
                            </a>

                            <div class="discount">Trending</div>

                            <div class="hover-content">
                                <a href="{{ $product->details_url }}" class="icon-btn">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="javascript:void(0)" class="icon-btn toggle-wishlist" data-product-id="{{ $product->id }}">
                                    <i class="far fa-heart"></i>
                                </a>
                            </div>
                        </div>
                        
                        <div class="product-info-wrap" style="padding: 15px 12px 12px 12px; margin: 0 auto; max-width: 90%;">
                            <div class="product-info" style="display: flex; flex-direction: column; align-items: flex-start; justify-content: center; width: 100%;">
                                <h2 class="product-title" style="margin: 0 0 6px 0; font-size: 15px; font-weight: 500; text-align: left; width: 100%; word-break: break-word;">
                                    <a href="{{ $product->details_url }}" style="color: #333; text-decoration: none; line-height: 1.3; display: block;">
                                        {{ $product->name }}
                                    </a>
                                </h2>

                                <div class="product-price" style="display: flex; align-items: center; justify-content: flex-start; gap: 8px; margin: 0; padding: 0; width: 100%;">
                                    @if ($product->discount_price)
                                        <span class="new-price" style="color: #000; font-size: 16px; font-weight: 600;">
                                            {{ \App\Helpers\CurrencyHelper::formatPrice($product->discount_price) }}
                                        </span>
                                        <span class="old-price" style="color: #94a3b8; text-decoration: line-through; font-size: 14px;">
                                            {{ \App\Helpers\CurrencyHelper::formatPrice($product->regular_price) }}
                                        </span>
                                    @else
                                        <span class="new-price" style="color: #000; font-size: 16px; font-weight: 600;">
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

@foreach ($categoryProducts as $category)
    @if ($category->products->count() > 0)
        <section class="category-products-section pt-50 pb-50">
            <div class="container">
                <div class="row align-items-center mb-40">
                    <div class="col-md-12 d-flex justify-content-between align-items-center">
                        <div class="section-title">
                            <h2 style="margin-bottom: 0; font-size: 24px; font-weight: 700;">{{ $category->name }}</h2>
                        </div>
                        <div class="view-all-btn">
                            <a href="{{ route('shops', ['category' => $category->id]) }}" class="btn btn-sm btn-primary" style="border-radius: 20px; padding: 6px 15px;">
                                View All Items →
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @foreach ($category->products as $product)
                        <div class="col-xl-3 col-lg-4 col-sm-6">
                            <div class="product-item style-one mb-40" onclick="window.location.href='{{ $product->details_url }}'" style="cursor: pointer; padding-bottom: 5px; overflow: hidden; border: 1px solid #f1f5f9; border-radius: 12px; background: #fff;">
                                <div class="product-thumbnail" style="margin-bottom: 0 !important; overflow: hidden;">
                                    <a href="{{ $product->details_url }}">
                                        <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}"
                                            style="width: 100%; height: 260px; object-fit: cover; border-radius: 12px 12px 0 0;">
                                    </a>
                                    <div class="hover-content">
                                        <a href="{{ $product->details_url }}" class="icon-btn">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="javascript:void(0)" class="icon-btn toggle-wishlist" data-product-id="{{ $product->id }}">
                                            <i class="far fa-heart"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="product-info-wrap" style="padding: 15px 12px 12px 12px; margin: 0 auto; max-width: 90%;">
                                    <div class="product-info" style="display: flex; flex-direction: column; align-items: flex-start; justify-content: center; width: 100%;">
                                        <h2 class="product-title" style="margin: 0 0 6px 0; font-size: 15px; font-weight: 500; text-align: left; width: 100%; word-break: break-word;">
                                            <a href="{{ $product->details_url }}" style="color: #333; text-decoration: none; line-height: 1.3; display: block;">
                                                {{ $product->name }}
                                            </a>
                                        </h2>
                                        <div class="product-price" style="display: flex; align-items: center; justify-content: flex-start; gap: 8px; margin: 0; padding: 0; width: 100%;">
                                            @if ($product->discount_price)
                                                <span class="new-price" style="color: #ff4d4d; font-size: 16px; font-weight: 600;">
                                                    {{ \App\Helpers\CurrencyHelper::formatPrice($product->discount_price) }}
                                                </span>
                                                <span class="old-price" style="color: #94a3b8; text-decoration: line-through; font-size: 13px;">
                                                    {{ \App\Helpers\CurrencyHelper::formatPrice($product->regular_price) }}
                                                </span>
                                            @else
                                                <span class="new-price" style="color: #ff4d4d; font-size: 16px; font-weight: 600;">
                                                    {{ \App\Helpers\CurrencyHelper::formatPrice($product->regular_price) }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <hr style="border-top: 1px solid #e2e8f0; margin: 0;">
    @endif
@endforeach

<section class="testimonial-section mb-70">
    <div class="testimonial-wrapper overflow-x-hidden pt-190 pb-90 white-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="section-content-box mb-40" data-aos="fade-right" data-aos-delay="30" data-aos-duration="800">
                        <div class="section-title mb-50">
                            <h2>What Our Clients Say About Us</h2>
                        </div>
                        <div class="testimonial-arrows style-one"></div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="testimonial-slider-one" data-aos="fade-left" data-aos-delay="50" data-aos-duration="1000">
                        @forelse($reviews as $review)
                            <div class="testimonial-item style-one mb-40">
                                <div class="testimonial-content">
                                    <p>{{ $review->review_text }}</p>
                                    <div class="author-quote-item d-flex justify-content-between align-items-center">
                                        <div class="author-item">
                                            <div class="author-thumb">
                                                @if ($review->reviewer_image)
                                                    <img src="{{ asset('assets/images/testimonial/' . $review->reviewer_image) }}" alt="{{ $review->reviewer_name }}">
                                                @else
                                                    <img src="{{ asset('assets/images/testimonial/default-avatar.png') }}" alt="{{ $review->reviewer_name }}">
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

@push('scripts')
<style>
    /* স্লাইডারের ওপর মাউস রাখলে অ্যারো বাটনগুলো নিখুঁতভাবে শো করবে */
    .hero-slider-wrap:hover .hero-slider-arrow {
        opacity: 1 !important;
        visibility: visible !important;
    }

    .hero-slider-wrap:hover .hero-slider-prev {
        left: 20px !important;
    }
    .hero-slider-wrap:hover .hero-slider-next {
        right: 20px !important;
    }

    .hero-slider-arrow:hover {
        background: #f15922 !important; 
        color: #ffffff !important;
    }
    
    .hover-content .icon-btn.active i {
        color: #dc3545 !important;
    }

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
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }

    .hero-banner {
        background: linear-gradient(135deg, #f5f7fa 0%, #ffffff 100%);
        padding: 15px 0 20px 0;
    }

    /* ⚡ কন্টেইনার ফিক্স: দুটি ব্যানারের উচ্চতা এখন ৩৫০ পিক্সেল ফিক্সড থাকবে */
    .home-slider .slide-item img,
    .static-side-banner img {
        width: 100%;
        height: 350px !important;
        object-fit: cover;
        border-radius: 8px !important; /* হালকা রাউন্ডেড শেপ */
        transition: transform 0.3s ease;
    }

    .home-slider .slide-item:hover img,
    .static-side-banner:hover img {
        transform: scale(1.01);
    }

    .slick-dots {
        bottom: 15px;
    }

    .slick-dots li button:before {
        font-size: 10px;
        color: #ffffff;
    }

    .featured-categories {
        background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
        padding: 30px 0 !important;
    }

    .section-title h3 {
        font-size: 1.6rem !important;
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

    .category-icon-box {
        width: 120px;
        height: 120px;
        background: #ffffff;
        border-radius: 20px;
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

    @media (max-width: 991px) {
        .home-slider .slide-item img,
        .static-side-banner img {
            height: 280px !important;
        }
        .static-side-banner {
            margin-top: 20px;
        }
    }
</style>

<script>
    $(document).ready(function() {
        @auth
            loadWishlistStatus();
        @endauth

        // Wishlist Toggle
        $(document).on('click', '.toggle-wishlist', function(e) {
            e.preventDefault();
            e.stopPropagation();

            const productId = $(this).data('product-id');
            const $btn = $(this);
            const $icon = $btn.find('i');

            $btn.css('pointer-events', 'none');

            $.ajax({
                url: '{{ route("wishlist.toggle") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: productId
                },
                success: function(response) {
                    if (response.success) {
                        if (response.in_wishlist) {
                            $icon.addClass('fas').removeClass('far').css('color', '#dc3545');
                            $btn.addClass('active');
                        } else {
                            $icon.addClass('far').removeClass('fas').css('color', '');
                            $btn.removeClass('active');
                        }

                        if (response.wishlist_count !== undefined) {
                            $('.wishlist-count, .pro-count.wishlist-count').text(response.wishlist_count);
                        }

                        showNotification(response.message, 'success');
                    } else if (response.redirect) {
                        window.location.href = response.redirect;
                    }
                    $btn.css('pointer-events', '');
                },
                error: function(xhr) {
                    if (xhr.status === 401) {
                        window.location.href = '{{ route("login") }}';
                    }
                    $btn.css('pointer-events', '');
                }
            });
        });

        function loadWishlistStatus() {
            $.ajax({
                url: '{{ route("wishlist.product-ids") }}',
                method: 'GET',
                success: function(response) {
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
                }
            });
        }

        function showNotification(message, type = 'success') {
            $('.custom-notification').remove();
            const notification = $('<div>', {
                class: `custom-notification alert alert-${type} alert-dismissible fade show`,
                html: `${message}<button type="button" class="btn-close" data-bs-dismiss="alert"></button>`
            });

            $('body').prepend(notification);

            setTimeout(function() {
                notification.fadeOut(300, function() { $(this).remove(); });
            }, 3000);
        }

        // 🔗 স্লাইডার সিঙ্গেল ইনিশিয়ালাইজেশন জোন (কাস্টম অ্যারো সহ)
        if ($.fn.slick) {
            $('.home-slider').slick({
                dots: true,
                infinite: true,
                speed: 600,
                slidesToShow: 1,
                autoplay: true,
                autoplaySpeed: 3000,
                arrows: true, 
                prevArrow: $('.hero-slider-prev'), 
                nextArrow: $('.hero-slider-next'), 
                cssEase: 'cubic-bezier(0.645, 0.045, 0.355, 1)',
                fade: false
            });
        }
    });
</script>
@endpush