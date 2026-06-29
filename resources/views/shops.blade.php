@extends('layouts.app')

@section('title', 'Shop - AnnoGhor')

@section('content')

    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    
    <style>
        /* 🌐 গ্লোবাল টাইপোগ্রাফি ও লেআউট থিম */
        .shop-page-section {
            font-family: 'DM Sans', 'Hind Siliguri', sans-serif;
            background-color: #f8fafc;
        }

        /* 📋 ফিল্টার টপ বার স্টাইল */
        .shop-filter {
            background: #ffffff;
            padding: 16px 24px;
            border-radius: 16px;
            border: 1px solid #edf2f7;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.01);
        }

        .show-text p {
            font-size: 15px;
            color: #64748b;
            margin: 0;
        }

        .show-text p span {
            color: #0f172a;
            font-weight: 500;
        }

        /* 🎯 প্রিমিয়াম প্রোডাক্ট কার্ড ডিজাইন */
        .product-card-modern {
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid #edf2f7;
            overflow: hidden;
            transition: all 0.35s cubic-bezier(0.165, 0.84, 0.44, 1);
            position: relative;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .product-card-modern:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.04);
            border-color: #e2e8f0;
        }

        .thumbnail-container {
            position: relative;
            overflow: hidden;
            background-color: #f8fafc;
            width: 100%;
            height: 250px;
        }

        .thumbnail-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .product-card-modern:hover .thumbnail-container img {
            transform: scale(1.04);
        }

        /* 🏷️ অফার ও ট্রেন্ডিং ডিসকাউন্ট ব্যাজ */
        .discount-badge {
            background: #ef4444;
            color: #ffffff;
            padding: 4px 10px;
            border-radius: 30px;
            position: absolute;
            top: 14px;
            left: 14px;
            font-size: 12px;
            font-weight: 700;
            z-index: 2;
            box-shadow: 0 4px 10px rgba(239, 68, 68, 0.2);
        }

        /* ⚡ হোভার অ্যাকশন বাটন প্যানেল */
        .action-overlay {
            position: absolute;
            top: 14px;
            right: -50px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
            z-index: 3;
        }

        .product-card-modern:hover .action-overlay {
            right: 14px;
        }

        .action-btn-custom {
            width: 38px;
            height: 38px;
            background: #ffffff;
            color: #475569;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: all 0.2s ease;
        }

        .action-btn-custom:hover {
            background: #f15922;
            color: #ffffff !important;
        }

        /* 📝 Produkt Content Area */
        .info-container {
            padding: 18px 16px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .product-title-link {
            font-family: 'Hind Siliguri', 'DM Sans', sans-serif;
            font-size: 15px;
            font-weight: 600;
            color: #1e293b;
            text-decoration: none;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            height: 42px;
            margin-bottom: 8px;
            transition: color 0.2s ease;
        }

        .product-title-link:hover {
            color: #f15922;
        }

        .price-container {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 15px;
        }

        .price-new {
            font-size: 17px;
            font-weight: 700;
            color: #0f172a;
        }

        .price-old {
            font-size: 14px;
            color: #94a3b8;
            text-decoration: line-through;
        }

        /* ⚡ শপ পেজের বাটন স্টাইল */
        .grid-action-btns { 
            display: flex; 
            gap: 8px; 
            margin-top: auto; 
        }
        .btn-grid-cart { 
            background: transparent; 
            border: 1px solid #dd6b20; 
            color: #dd6b20; 
            font-weight: 600; 
            font-size: 13px; 
            padding: 8px 10px; 
            border-radius: 8px; 
            transition: all 0.2s ease; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
        }
        .btn-grid-cart:hover { 
            background: #dd6b20; 
            color: #ffffff; 
        }
        .btn-grid-cart:disabled { 
            opacity: 0.6; 
            cursor: not-allowed; 
        }

        .btn-grid-buy { 
            background: #dd6b20; 
            border: none; 
            color: #ffffff; 
            font-weight: 600; 
            font-size: 13px; 
            padding: 8px 10px; 
            border-radius: 8px; 
            transition: all 0.2s ease; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
        }
        .btn-grid-buy:hover { 
            background: #b75616; 
            color: #ffffff !important; 
        }

        @media (max-width: 575.98px) { 
            .btn-grid-cart, .btn-grid-buy { 
                font-size: 12px; 
                padding: 6px 4px; 
            } 
            .thumbnail-container {
                height: 180px;
            }
        }

        /* 🗂️ সাইডবার উইজেট ডিজাইন */
        .sidebar-card {
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid #edf2f7;
            padding: 24px;
        }

        .widget-title-modern {
            font-size: 16px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 18px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f1f5f9;
            position: relative;
        }

        .widget-title-modern::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 35px;
            height: 2px;
            background: #f15922;
        }

        .filter-list-item {
            padding: 6px 0;
        }

        .filter-checkbox-label {
            font-family: 'Hind Siliguri', 'DM Sans', sans-serif;
            font-size: 14px;
            color: #475569;
            cursor: pointer;
            width: 100%;
        }

        .filter-checkbox-label span {
            font-family: 'DM Sans', sans-serif;
            float: right;
            color: #94a3b8;
            font-weight: 500;
            font-size: 13px;
        }

        /* 🔢 প্রিমিয়াম পেজিনেটর */
        .custom-pagination-wrap {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .custom-pagination-wrap ul {
            display: flex;
            gap: 6px;
            list-style: none;
            padding: 0;
        }

        .custom-pagination-wrap ul li a,
        .custom-pagination-wrap ul li span {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            color: #475569;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .custom-pagination-wrap ul li.active span {
            background: #f15922;
            color: #ffffff;
            border-color: #f15922;
        }

        .custom-pagination-wrap ul li a:hover {
            background: #0f172a;
            color: #ffffff;
            border-color: #0f172a;
        }

        .custom-toast {
            position: fixed; top: 25px; right: 25px; background: #ffffff;
            padding: 16px 28px; border-radius: 12px; font-weight: 600;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            z-index: 99999; opacity: 0; transform: translateX(400px); transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
        }
        .custom-toast.show { opacity: 1; transform: translateX(0); }
        .custom-toast-success { border-left: 4px solid #10b981; }
    </style>

    <section class="shop-page-section pt-40 pb-80">
        <div class="container">
            <div class="row">
                <div class="col-xl-9">
                    <div class="shop-page-wrapper">
                        
                        <div class="shop-filter mb-40" data-aos="fade-up" data-aos-delay="20" data-aos-duration="1000">
                            <form method="GET" action="{{ route('shops') }}" id="sortForm">
                                <div class="row align-items-center">
                                    <div class="col-sm-5 col-12 mb-3 mb-sm-0">
                                        <div class="show-text">
                                            <p>
                                                <span>Showing</span>
                                                {{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }}
                                                of {{ $products->total() }} Results
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 col-4 d-none d-sm-block">
                                        <div class="filter-grid-list text-center">
                                            <a href="#" class="me-2 text-dark"><i class="far fa-th-large"></i></a>
                                            <a href="#" class="text-muted"><i class="far fa-list"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-sm-5 col-12">
                                        <div class="filter-product-category d-flex align-items-center justify-content-sm-end">
                                            <select id="sortProducts" name="sort" class="wide">
                                                <option value="latest" {{ request('sort') == 'latest' || !request('sort') ? 'selected' : '' }}>Default Sorting (Latest)</option>
                                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Sort by Newness</option>
                                                <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                                                <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                                                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name: A to Z</option>
                                                <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name: Z to A</option>
                                            </select>
                                            @foreach (request()->except(['sort', 'page']) as $name => $value)
                                                @if (is_array($value))
                                                    @foreach ($value as $singleValue)
                                                        <input type="hidden" name="{{ $name }}[]" value="{{ $singleValue }}">
                                                    @endforeach
                                                @else
                                                    <input type="hidden" name="{{ $name }}" value="{{ $value }}">
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="row g-4">
                            @forelse($products as $product)
                                <div class="col-xl-4 col-md-6 col-sm-6">
                                    <div class="product-card-modern">
                                        
                                        @if ($product->discount_price)
                                            @php
                                                $discountPercentage = round((($product->regular_price - $product->discount_price) / $product->regular_price) * 100);
                                            @endphp
                                            <div class="discount-badge">{{ $discountPercentage }}% Off</div>
                                        @endif

                                        <div class="action-overlay">
                                            <a href="{{ $product->details_url }}" class="action-btn-custom" title="View Product">
                                                <i class="far fa-eye"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="action-btn-custom toggle-wishlist" data-product-id="{{ $product->id }}" title="Wishlist">
                                                <i class="far fa-heart"></i>
                                            </a>
                                        </div>

                                        <div class="thumbnail-container">
                                            <a href="{{ $product->details_url }}">
                                                @if ($product->thumbnail)
                                                    <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}">
                                                @else
                                                    <img src="{{ asset('assets/images/products/feature-product-' . (($loop->index % 5) + 1) . '.png') }}" alt="{{ $product->name }}">
                                                @endif
                                            </a>
                                        </div>

                                        <div class="info-container">
                                            <h6>
                                                <a href="{{ $product->details_url }}" class="product-title-link">
                                                    {{ \Illuminate\Support\Str::limit($product->name, 45) }}
                                                </a>
                                            </h6>

                                            <div class="price-container">
                                                @if ($product->discount_price)
                                                    <span class="price-new">
                                                        {{ \App\Helpers\CurrencyHelper::formatPrice($product->discount_price) }}
                                                    </span>
                                                    <span class="price-old">
                                                        {{ \App\Helpers\CurrencyHelper::formatPrice($product->regular_price) }}
                                                    </span>
                                                @else
                                                    <span class="price-new">
                                                        {{ \App\Helpers\CurrencyHelper::formatPrice($product->regular_price) }}
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="grid-action-btns d-flex gap-2 mt-3">
                                                <button type="button" 
                                                    class="btn btn-grid-cart flex-grow-1" 
                                                    onclick="event.stopPropagation(); addToCart('{{ url('cart/ajax/' . $product->id) }}', this)">
                                                    <i class="fas fa-shopping-cart me-1"></i> Cart
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
                                <div class="col-12">
                                    <div class="alert alert-custom text-center py-5" style="background: #fff; border-radius: 16px; border: 1px dashed #cbd5e1;">
                                        <h4 class="fw-bold text-dark mb-2">No products found</h4>
                                        <p class="text-muted mb-4">Please check back later or modify your filters.</p>
                                        <a href="{{ route('shops') }}" class="btn btn-primary px-4 rounded-pill" style="background: #f15922; border: none;">Reload Shop</a>
                                    </div>
                                </div>
                            @endforelse
                        </div>

                        @if ($products->hasPages())
                            <div class="row mt-5">
                                <div class="col-lg-12">
                                    <div class="custom-pagination-wrap">
                                        <ul>
                                            @if ($products->onFirstPage())
                                                <li class="disabled"><span><i class="far fa-angle-left"></i></span></li>
                                            @else
                                                <li><a href="{{ $products->previousPageUrl() }}"><i class="far fa-angle-left"></i></a></li>
                                            @endif

                                            @php
                                                $current = $products->currentPage();
                                                $last = $products->lastPage();
                                                $start = max(1, $current - 2);
                                                $end = min($last, $current + 2);
                                            @endphp

                                            @if ($start > 1)
                                                <li><a href="{{ $products->url(1) }}">01</a></li>
                                                @if ($start > 2)
                                                    <li><span class="border-0">...</span></li>
                                                @endif
                                            @endif

                                            @for ($page = $start; $page <= $end; $page++)
                                                @if ($page == $current)
                                                    <li class="active"><span>{{ str_pad($page, 2, '0', STR_PAD_LEFT) }}</span></li>
                                                @else
                                                    <li><a href="{{ $products->url($page) }}">{{ str_pad($page, 2, '0', STR_PAD_LEFT) }}</a></li>
                                                @endif
                                            @endfor

                                            @if ($end < $last)
                                                @if ($end < $last - 1)
                                                    <li><span class="border-0">...</span></li>
                                                @endif
                                                <li><a href="{{ $products->url($last) }}">{{ str_pad($last, 2, '0', STR_PAD_LEFT) }}</a></li>
                                            @endif

                                            @if ($products->hasMorePages())
                                                <li><a href="{{ $products->nextPageUrl() }}"><i class="far fa-angle-right"></i></a></li>
                                            @else
                                                <li class="disabled"><span><i class="far fa-angle-right"></i></span></li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>

                <div class="col-xl-3 mt-5 mt-xl-0">
                    <div class="shop-sidebar-area d-flex flex-column gap-4">
                        
                        <div class="sidebar-card">
                            <h4 class="widget-title-modern">Product Categories</h4>
                            <ul class="categories-list list-unstyled mb-0 d-flex flex-column gap-2">
                                @php
                                    $selectedCategories = explode(',', request('category', request('category_id', '')));
                                @endphp

                                @forelse($categories as $category)
                                    <div class="filter-list-item">
                                        <div class="form-check mb-0">
                                            <input class="form-check-input category-filter" type="checkbox"
                                                value="{{ $category->id }}" id="category_{{ $category->id }}"
                                                {{ in_array((string) $category->id, $selectedCategories, true) ? 'checked' : '' }}
                                                style="cursor: pointer; accent-color: #f15922;">
                                            <label class="form-check-label filter-checkbox-label" for="category_{{ $category->id }}">
                                                {{ $category->name }}
                                                <span>({{ $category->products_count }})</span>
                                            </label>
                                        </div>
                                    </div>
                                @empty
                                    <li class="text-muted small">No categories found</li>
                                @endforelse
                            </ul>
                        </div>

                        @if (isset($activeSubcategories) && $activeSubcategories->count() > 0)
                            <div class="sidebar-card">
                                <h4 class="widget-title-modern">Sub Categories</h4>
                                <ul class="categories-list list-unstyled mb-0 d-flex flex-column gap-2">
                                    @foreach ($activeSubcategories as $sub)
                                        <li class="filter-list-item">
                                            <a href="{{ request()->fullUrlWithQuery(['subcategory' => $sub->id]) }}"
                                               style="text-decoration: none; font-size: 14px; transition: all 0.2s; {{ request('subcategory') == $sub->id ? 'color: #f15922; font-weight: 700;' : 'color: #475569;' }}">
                                                <i class="far fa-angle-right me-2" style="font-size: 12px;"></i>{{ $sub->name }}
                                            </a>
                                        </li>
                                    @endforeach

                                    @if (request()->has('subcategory'))
                                        <li class="mt-3 pt-2 border-top">
                                            <a href="{{ request()->fullUrlWithQuery(['subcategory' => null]) }}"
                                               class="text-danger fw-bold small style-none text-decoration: none;" style="text-decoration: none;">
                                                <i class="far fa-times-circle me-1"></i> Clear Sub-filter
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </section>

    <div class="custom-toast custom-toast-success" id="shopCartToast">Added to cart!</div>
@endsection

@push('scripts')
    <script>
        // 🎯 কাস্টম টোস্ট ফায়ারার ফাংশন (Global scope-এ রাখা হলো)
        window.triggerShopToast = function(msg) {
            const toast = document.getElementById('shopCartToast');
            if(toast) {
                toast.className = "custom-toast custom-toast-success show";
                toast.innerText = msg;
                setTimeout(() => { toast.classList.remove('show'); }, 2500);
            }
        };

        // 🛒 Add to Cart Function (Global scope-এ রাখা হলো)
        window.addToCart = function(url, btn) {
            var $btn = $(btn);
            $btn.prop('disabled', true); // বাটনটি ডিজেবল করে দেওয়া হলো যাতে ডাবল ক্লিক না পড়ে
            
            // বাটন ক্লিক করার পর একটু লোডিং ইফেক্ট দেখানোর জন্য
            var originalHtml = $btn.html();
            $btn.html('<i class="fas fa-spinner fa-spin me-1"></i> Adding...');

            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    quantity: 1
                },
                success: function(response) {
                    if (response.success) {
                        // ১. কার্টের আইটেম সংখ্যা আপডেট করবে
                        $('.cart-count, .pro-count, .cart-count-badge').text(response.cart_count);
                        
                        // ২. ফ্লোটিং কার্টের টোটাল প্রাইস আপডেট করবে
                        if (response.total !== undefined) {
                            $('.pro-total-amount').text(response.total);
                        }

                        // ৩. সাকসেস মেসেজ দেখাবে
                        triggerShopToast(response.message || 'Cart এ যোগ হয়েছে!');
                    } else {
                        triggerShopToast(response.message || 'Failed to add to cart.');
                    }
                },
                error: function(xhr) {
                    triggerShopToast('কিছু একটা সমস্যা হয়েছে। পেজ রিলোড করুন।');
                },
                complete: function() {
                    $btn.prop('disabled', false);
                    $btn.html(originalHtml); // কাজ শেষ হলে বাটন আগের অবস্থায় ফিরে আসবে
                }
            });
        };

        $(document).ready(function() {
            function updateURLAndRedirect(key, value) {
                const url = new URL(window.location.href);
                const params = new URLSearchParams(url.search);

                if (value) {
                    params.set(key, value);
                } else {
                    params.delete(key);
                }
                params.delete('page');
                window.location.href = url.pathname + '?' + params.toString();
            }

            $(document).on('change', '.category-filter', function() {
                const selectedIds = $('.category-filter:checked').map(function() {
                    return $(this).val();
                }).get();
                const url = new URL(window.location.href);
                const params = new URLSearchParams(url.search);

                if (selectedIds.length) {
                    params.set('category', selectedIds.join(','));
                } else {
                    params.delete('category');
                }

                params.delete('subcategory');
                params.delete('page');

                window.location.href = url.pathname + (params.toString() ? '?' + params.toString() : '');
            });

            $(document).on('change', '#sortProducts', function() {
                updateURLAndRedirect('sort', $(this).val());
            });
        });
    </script>
@endpush