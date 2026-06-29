@extends('layouts.app')

@section('title', 'AnnoGhor')

@section('content')

<section class="hero-banner py-0 py-lg-0" style="background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);">
    <div class="banner-section mt-10">
        <div class="container">
            <div class="row align-items-stretch">

                <div class="col-12 col-lg-8">
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
                                        <img src="{{ asset('storage/' . $banner->image) }}" alt="Slider Image" class="slider-responsive-img">
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

                <div class="col-lg-4 d-none d-lg-block">
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

<section class="featured-categories py-3 py-lg-0">
    <div class="container" style="position: relative;">
        <div class="section-title text-center mb-3 mb-lg-2">
            <h4 class="fw-bold">Featured Categories</h4>
           
        </div>

        <div class="category-slider-wrapper" style="position: relative; padding: 0 40px;">
            <div class="category-slider">
                @foreach ($categories as $category)
                    <div class="category-slide-item">
                        <a href="{{ route('shops', ['category' => $category->id]) }}" class="category-card-link d-block">
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

            <button type="button" class="category-arrow category-prev">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button type="button" class="category-arrow category-next">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>
</section>

<section class="trending-products pt-20 pt-lg-50 pb-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title mb-0 mb-lg-4 text-center">
                    <h2 class="fw-bold" style="color: #1e293b; font-size: 28px;">Top Selling Products</h2>
                </div>
            </div>
        </div>

        <div class="row g-3 g-md-4 row-cols-2 row-cols-lg-4">
            @forelse($trendingProducts as $product)
                @if($loop->iteration > 4)
                    @break
                @endif
                <div class="col">
                    <div class="modern-grid-card h-100 d-flex flex-column"
                         style="cursor:pointer;"
                         onclick="window.location.href='{{ $product->details_url }}'">

                        <div class="grid-image-wrap position-relative">
                            @if ($product->thumbnail)
                                <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}" class="grid-img">
                            @else
                                <img src="{{ asset('assets/images/products/feature-product-1.png') }}" alt="{{ $product->name }}" class="grid-img">
                            @endif
                            @if($product->discount_price)
                                <span class="badge-best-selling bg-success">
                                    Save {{ round((($product->regular_price - $product->discount_price) / $product->regular_price) * 100) }}%
                                </span>
                            @endif
                        </div>

                        <div class="grid-content-wrap d-flex flex-column flex-grow-1 mt-2">
                            <h4 class="grid-product-title mb-lg-1 mb-0">
                                <a href="{{ $product->details_url }}">{{ $product->name }}</a>
                            </h4>

                            <div class="grid-price-box d-flex flex-wrap align-items-center gap-2 mb-0 mb-lg-2">
                                @if ($product->discount_price)
                                    <span class="price-current">{{ \App\Helpers\CurrencyHelper::formatPrice($product->discount_price) }}</span>
                                    <span class="price-previous text-decoration-line-through">{{ \App\Helpers\CurrencyHelper::formatPrice($product->regular_price) }}</span>
                                @else
                                    <span class="price-current">{{ \App\Helpers\CurrencyHelper::formatPrice($product->regular_price) }}</span>
                                @endif
                            </div>

                            @if ($product->discount_price && ($product->regular_price - $product->discount_price) > 0)
                                <div class="mb-1 mb-lg-3">
                                    <span class="discount-save-badge">Save ৳{{ number_format($product->regular_price - $product->discount_price) }}</span>
                                </div>
                            @endif

                            <div class="grid-action-btns d-flex gap-2 mt-auto">
                                <button type="button"
                                    class="btn btn-grid-cart flex-grow-1"
                                    onclick="event.stopPropagation(); addToCart('{{ url('cart/ajax/' . $product->id) }}', this)">
                                    <i class="fas fa-shopping-cart"></i> <span class="d-none d-sm-inline">Add To</span> Cart
                                </button>

                                <form action="{{ route('cart.add.item', $product->id) }}" method="POST"
                                      class="d-inline flex-grow-1 m-0 p-0"
                                      onclick="event.stopPropagation();">
                                    @csrf
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" name="action" value="buy_now"
                                            class="btn btn-grid-buy w-100 h-100">Buy now</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">No top selling products available yet.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

@foreach ($categoryProducts as $category)
    @if ($category->products->count() > 0)
        <section class="category-products-section pt-0 pb-0 pt-lg-2 pb-pb-2">
            <div class="container">
                <div class="row align-items-center mb-0">
                    <div class="col-12 d-flex justify-content-between align-items-center">
                        <h2 class="fw-bold" style="font-size: 24px; color: #1e293b; margin: 0;">{{ $category->name }}</h2>
                        <a href="{{ route('shops', ['category' => $category->id]) }}" class="btn btn-sm btn-view-all">
                            View All Items →
                        </a>
                    </div>
                </div>

                <div class="category-products-slider dots-navigation-style">
                    @foreach ($category->products as $product)
                        <div class="category-product-slide-item">
                            <div class="modern-grid-card h-100 d-flex flex-column mx-2"
                                 style="cursor:pointer;"
                                 onclick="window.location.href='{{ $product->details_url }}'">

                                <div class="grid-image-wrap position-relative">
                                    <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}" class="grid-img">
                                    @if($product->discount_price)
                                        <span class="badge-best-selling bg-success">
                                            Save {{ round((($product->regular_price - $product->discount_price) / $product->regular_price) * 100) }}%
                                        </span>
                                    @endif
                                </div>

                                <div class="grid-content-wrap d-flex flex-column flex-grow-1 mt-3">
                                    <h4 class="grid-product-title mb-2">
                                        <a href="{{ $product->details_url }}">{{ $product->name }}</a>
                                    </h4>

                                    <div class="grid-price-box d-flex flex-wrap align-items-center gap-0 mb-0 mb-lg-2">
                                        @if ($product->discount_price)
                                            <span class="price-current">{{ \App\Helpers\CurrencyHelper::formatPrice($product->discount_price) }}</span>
                                            <span class="price-previous text-decoration-line-through">{{ \App\Helpers\CurrencyHelper::formatPrice($product->regular_price) }}</span>
                                        @else
                                            <span class="price-current">{{ \App\Helpers\CurrencyHelper::formatPrice($product->regular_price) }}</span>
                                        @endif
                                    </div>

                                    @if ($product->discount_price && ($product->regular_price - $product->discount_price) > 0)
                                        <div class="mb-3">
                                            <span class="discount-save-badge">Save ৳{{ number_format($product->regular_price - $product->discount_price) }}</span>
                                        </div>
                                    @endif

                                    <div class="grid-action-btns d-flex gap-2 mt-auto">
                                        <button type="button"
                                            class="btn btn-grid-cart flex-grow-1"
                                            onclick="event.stopPropagation(); addToCart('{{ url('cart/ajax/' . $product->id) }}', this)">
                                            <i class="fas fa-shopping-cart"></i> Cart
                                        </button>

                                        <form action="{{ route('cart.add.item', $product->id) }}" method="POST"
                                              class="d-inline flex-grow-1 m-0 p-0"
                                              onclick="event.stopPropagation();">
                                            @csrf
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" name="action" value="buy_now"
                                                    class="btn btn-grid-buy w-100 h-100">Buy now</button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <hr style="border-top: 1px solid #f1f5f9; margin: 0;">
    @endif
@endforeach

<section class="testimonial-section mb-70">
    <div class="testimonial-wrapper overflow-x-hidden pt-20 pt-lg-50 pb-90 white-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="section-content-box mb-40" >
                        <div class="section-title mb-50">
                            <h2>What Our Clients Say About Us</h2>
                        </div>
                        <div class="testimonial-arrows style-one"></div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="testimonial-slider-one" >
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
    /* =============================================
       Hero Banner & Sliders
       ============================================= */
    .hero-slider-wrap:hover .hero-slider-arrow { opacity: 1 !important; visibility: visible !important; }
    .hero-slider-wrap:hover .hero-slider-prev { left: 20px !important; }
    .hero-slider-wrap:hover .hero-slider-next { right: 20px !important; }
    .hero-slider-arrow:hover { background: #f15922 !important; color: #ffffff !important; }
    
    .hero-banner { background: linear-gradient(135deg, #f5f7fa 0%, #ffffff 100%); padding: 15px 0 20px 0; }
    
    .slider-responsive-img { 
        width: 100%; 
        height: 350px; 
        object-fit: fill; /* ছবি ফাঁকা না রেখে পুরো বক্স কভার করবে */
        border-radius: 8px !important; 
    }
    
    /* 🌟 Static Side Banner Image - Fixed Size, No Empty Space */
    .static-side-banner img { 
        width: 100%; 
        height: 350px !important; 
        object-fit: fill; 
        border-radius: 8px !important; 
    }

    /* 📱 মোবাইল ডিভাইসের জন্য সাইজ */
    @media (max-width: 575.98px) { 
        .slider-responsive-img { height: 180px !important; } 
        .static-side-banner img { height: 180px !important; } 
    }

    /* =============================================
       Notifications
       ============================================= */
    .custom-notification { position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 300px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); animation: slideInRight 0.3s ease-out; }
    @keyframes slideInRight { from { transform: translateX(100%); opacity: 0; } to { transform: translateX(0); opacity: 1; } }

    /* =============================================
       Categories Section
       ============================================= */
    .featured-categories { background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%); padding-bottom: 20px !important; }
    .title-line { height: 3px; width: 60px; background: #f15922; margin: 0 auto 1px; border-radius: 2px; }
    .category-icon-box { width: 100px; height: 100px; background: #ffffff; border-radius: 20px; display: flex; align-items: center; justify-content: center; padding: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); border: 1px solid rgba(0,0,0,0.05); margin: 0 auto; }
    .category-name { color: #333; font-size: 0.95rem; font-weight: 600; margin-top: 2px; }
    .category-slide-item { padding: 0 10px; }
    .category-arrow { position: absolute; top: 50%; transform: translateY(-50%); background: #ffffff; border: 1px solid #e2e8f0; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #333; cursor: pointer; box-shadow: 0 4px 6px rgba(0,0,0,0.05); z-index: 10; }
    .category-arrow:hover { background: #f15922; color: #ffffff; border-color: #f15922; }
    .category-prev { left: -5px; }
    .category-next { right: -5px; }

    /* =============================================
       Product Cards (Grid)
       ============================================= */
    .modern-grid-card { background: #ffffff; border: 1px solid #f1f5f9; border-radius: 16px; padding: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.015); transition: transform 0.2s ease, box-shadow 0.2s ease; }
    .modern-grid-card:hover { transform: translateY(-4px); box-shadow: 0 12px 24px rgba(0,0,0,0.06); }
    .grid-image-wrap { width: 100%; height: 200px; background-color: #f8fafc; border-radius: 12px; overflow: hidden; display: flex; align-items: center; justify-content: center; }
    .grid-img { width: 100%; height: 100%; object-fit: cover; }
    .badge-best-selling { position: absolute; top: 10px; left: 10px; background: #ef4444; color: #ffffff; font-size: 11px; font-weight: 600; padding: 4px 10px; border-radius: 8px; z-index: 2; }
    .grid-product-title a { color: #1e293b; font-size: 15px; font-weight: 600; text-decoration: none; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; height: 42px; }
    .price-current { color: #dd6b20; font-size: 17px; font-weight: 700; }
    .price-previous { color: #94a3b8; font-size: 13px; }
    .discount-save-badge { background-color: #dcfce7; color: #15803d; font-size: 12px; font-weight: 600; padding: 3px 8px; border-radius: 6px; }
    .grid-action-btns { display: flex; gap: 8px; margin-top: auto; }
    
    /* Product Card Buttons */
    .btn-grid-cart { background: transparent; border: 1px solid #dd6b20; color: #dd6b20; font-weight: 600; font-size: 13px; padding: 8px 10px; border-radius: 8px; transition: all 0.2s ease; display: flex; align-items: center; justify-content: center; }
    .btn-grid-cart:hover { background: #dd6b20; color: #ffffff; }
    .btn-grid-cart:disabled { opacity: 0.6; cursor: not-allowed; }
    .btn-grid-buy { background: #dd6b20; border: none; color: #ffffff; font-weight: 600; font-size: 13px; padding: 8px 10px; border-radius: 8px; transition: all 0.2s ease; display: flex; align-items: center; justify-content: center; }
    .btn-grid-buy:hover { background: #b75616; color: #ffffff !important; }
    .btn-view-all { border: 1px solid #e2e8f0; border-radius: 20px; padding: 5px 15px; font-weight: 500; color: #475569; }

    /* Slick Dots Navigation */
    .dots-navigation-style .slick-dots { position: relative; bottom: 0; margin-top: 15px; list-style: none; display: flex !important; justify-content: center; padding: 0; gap: 8px; }
    .dots-navigation-style .slick-dots li { margin: 0; width: auto; height: auto; }
    .dots-navigation-style .slick-dots li button { width: 10px; height: 10px; padding: 0; border-radius: 50%; background: #cbd5e1; border: none; transition: all 0.3s ease; }
    .dots-navigation-style .slick-dots li button:before { display: none; }
    .dots-navigation-style .slick-dots li.slick-active button { background: #f15922; transform: scale(1.2); }

    /* =============================================
       Media Queries (Responsive)
       ============================================= */
    @media (max-width: 767.98px) { 
        .grid-image-wrap { height: 150px; } 
        .price-current { font-size: 13px; } 
        .price-previous { font-size: 11px; } 
        .discount-save-badge { font-size: 9px; padding: 3px 2px; } 
    }
    
    @media (max-width: 575.98px) { 
        /* 📱 মোবাইলে ব্যানার সাইজ ১৮০ পিক্সেল ফিক্সড */
       
        
        .grid-image-wrap { height: 135px; } 
        .grid-product-title a { font-size: 14px; height: 20px; } 
        .price-current { font-size: 12px; } 
        .btn-grid-cart, .btn-grid-buy { font-size: 12px; padding: 6px 4px; } 
    }
</style>

<script>

    // =============================================
    // Global Functions — $(document).ready এর বাইরে
    // =============================================

    function addToCart(url, btn) {
        var $btn = $(btn);
        $btn.prop('disabled', true);

        $.ajax({
            url: url,
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                quantity: 1
            },
            success: function(response) {
                if (response.success) {
                    $('.cart-count, .pro-count').text(response.cart_count);
                    if (response.total !== undefined) {
                        $('.pro-total-amount').text(response.total);
                    }
                    showCartNotification(response.message || 'Cart এ যোগ হয়েছে!', 'success');
                } else {
                    showCartNotification(response.message || 'Failed to add to cart.', 'danger');
                }
            },
            error: function(xhr) {
                var msg = 'কিছু একটা সমস্যা হয়েছে।';
                if (xhr.status === 419) {
                    msg = 'Session শেষ হয়ে গেছে। Page refresh করুন।';
                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                    msg = xhr.responseJSON.message;
                }
                showCartNotification(msg, 'danger');
            },
            complete: function() {
                $btn.prop('disabled', false);
            }
        });
    }

    function showCartNotification(message, type) {
        type = type || 'success';
        $('.custom-notification').remove();
        var n = $('<div>', {
            class: 'custom-notification alert alert-' + type + ' alert-dismissible fade show',
            html: message + '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>'
        });
        $('body').prepend(n);
        setTimeout(function() {
            n.fadeOut(300, function() { $(this).remove(); });
        }, 3000);
    }

    // =============================================
    // DOM Ready
    // =============================================
    $(document).ready(function () {

        @auth loadWishlistStatus(); @endauth

        // =============================================
        // Wishlist Toggle
        // =============================================
        $(document).on('click', '.toggle-wishlist', function (e) {
            e.preventDefault();
            e.stopPropagation();
            var productId = $(this).attr('data-product-id');
            var $btn = $(this);
            var $icon = $btn.find('i');
            $btn.css('pointer-events', 'none');
            $.ajax({
                url: '{{ route("wishlist.toggle") }}',
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    product_id: productId
                },
                success: function (response) {
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
                        showCartNotification(response.message, 'success');
                    } else if (response.redirect) {
                        window.location.href = response.redirect;
                    }
                    $btn.css('pointer-events', '');
                },
                error: function () {
                    $btn.css('pointer-events', '');
                }
            });
        });

        // =============================================
        // Wishlist Status Loader (Auth Users Only)
        // =============================================
        function loadWishlistStatus() {
            $.ajax({
                url: '{{ route("wishlist.product-ids") }}',
                method: 'GET',
                success: function (response) {
                    if (response.success && response.product_ids) {
                        response.product_ids.forEach(function (productId) {
                            $('.toggle-wishlist[data-product-id="' + productId + '"]')
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

        // =============================================
        // Slick Sliders
        // =============================================
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

            $('.category-slider').slick({
                dots: false,
                infinite: true,
                speed: 500,
                slidesToShow: 6,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2500,
                arrows: true,
                prevArrow: $('.category-prev'),
                nextArrow: $('.category-next'),
                responsive: [
                    { breakpoint: 1200, settings: { slidesToShow: 4 } },
                    { breakpoint: 768,  settings: { slidesToShow: 3 } },
                    { breakpoint: 480,  settings: { slidesToShow: 2 } }
                ]
            });

            $('.category-products-slider').slick({
                dots: true,
                infinite: false,
                autoplay: false,
                arrows: false,
                slidesToShow: 4,
                slidesToScroll: 4,
                responsive: [
                    { breakpoint: 1200, settings: { slidesToShow: 3, slidesToScroll: 3 } },
                    { breakpoint: 992,  settings: { slidesToShow: 2, slidesToScroll: 2 } },
                    { breakpoint: 576,  settings: { slidesToShow: 2, slidesToScroll: 2 } }
                ]
            });
        }

    });
</script>
@endpush