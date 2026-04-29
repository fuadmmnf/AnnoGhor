@extends('layouts.app')

@section('title', 'Shop - AnnoGhor')

@section('content')

    <!--====== Start Shop page Section ======-->
    <section class="shop-page-section pt-40 pb-80">
        <div class="container">
            <div class="row">
                <div class="col-xl-9">
                    <!--=== Shop Page Wrapper ===-->
                    <div class="shop-page-wrapper">
                        <!--=== Shop Filter ===-->
                        <div class="shop-filter mb-60" data-aos="fade-up" data-aos-delay="20" data-aos-duration="1000">
                            <form method="GET" action="{{ route('shops') }}" id="sortForm">
                                <div class="row align-items-center">
                                    <div class="col-sm-5 col-12">
                                        <div class="show-text">
                                            <p>
                                                <span>Showing</span>
                                                {{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }}
                                                of {{ $products->total() }} Results
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 col-4">
                                        <div class="filter-grid-list text-center">
                                            <a href="#"><i class="far fa-th"></i></a>
                                            <a href="#"><i class="far fa-list"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-sm-5 col-8">
                                        <div class="filter-product-category d-flex align-items-center">
                                            <select name="sort" class="wide" onchange="this.form.submit()">
                                                <option value="latest"
                                                    {{ request('sort') == 'latest' || !request('sort') ? 'selected' : '' }}>
                                                    Default (Latest)</option>
                                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>
                                                    Sort by Newness</option>
                                                <option value="price_high"
                                                    {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to
                                                    Low</option>
                                                <option value="price_low"
                                                    {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to
                                                    High</option>
                                                <option value="name_asc"
                                                    {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name: A-Z</option>
                                                <option value="name_desc"
                                                    {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name: Z-A
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!--=== Products Grid ===-->
                        <div class="row">
                            @forelse($products as $product)
                                <div class="col-xl-4 col-md-6 col-sm-12">
                                    <!--=== Product Item ===-->
                                    <div class="product-item style-one mb-40" data-aos="fade-up"
                                        data-aos-delay="{{ $loop->index * 5 + 25 }}"
                                        data-aos-duration="{{ 400 + $loop->index * 200 }}">

                                        <div class="product-thumbnail">
                                            <a
                                                href="{{ route('product-details', [
                                                    'cat_slug' => optional($product->category)->slug ?? 'no-category',
                                                    'subcat_slug' => optional($product->subcategory)->slug ?? 'no-subcategory',
                                                    'prod_slug' => $product->slug ?? 'no-slug',
                                                ]) }}">
                                                {{ \Illuminate\Support\Str::limit($product->name, 40) }}

                                                @if ($product->thumbnail)
                                                    <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                                        alt="{{ $product->name }}"
                                                        style="width: 100%; height: 400px; object-fit: cover;">
                                                @else
                                                    <img src="{{ asset('assets/images/products/feature-product-' . (($loop->index % 5) + 1) . '.png') }}"
                                                        alt="{{ $product->name }}"
                                                        style="width: 100%; height: 400px; object-fit: cover;">
                                                @endif
                                            </a>


                                            @if ($product->discount_price)
                                                @php
                                                    $discountPercentage = round(
                                                        (($product->regular_price - $product->discount_price) /
                                                            $product->regular_price) *
                                                            100,
                                                    );
                                                @endphp
                                                <div class="discount">{{ $discountPercentage }}% Off</div>
                                            @endif

                                            <div class="hover-content">
                                                <a href="{{ route('product-details', [
                                                    'cat_slug' => optional($product->category)->slug ?? 'no-category',
                                                    'subcat_slug' => optional($product->subcategory)->slug ?? 'no-subcategory',
                                                    'prod_slug' => $product->slug ?? 'no-slug',
                                                ]) }}"
                                                    class=" icon-btn mt-3">
                                                    <i class="fa fa-eye"></i>
                                                </a>

                                                <a href="javascript:void(0)" class="icon-btn toggle-wishlist"
                                                    data-product-id="{{ $product->id }}">
                                                    <i class="fa fa-heart"></i>
                                                </a>
                                            </div>
                                            <div class="cart-button">
                                            </div>
                                        </div>
                                        <div class="product-info-wrap text-center">
                                            <h6 class="product-title ">
                                                <a
                                                    href="{{ route('product-details', [
                                                        'cat_slug' => optional($product->category)->slug ?? 'no-category',
                                                        'subcat_slug' => optional($product->subcategory)->slug ?? 'no-subcategory',
                                                        'prod_slug' => $product->slug ?? 'no-slug',
                                                    ]) }}">
                                                    {{ \Illuminate\Support\Str::limit($product->name, 40) }}
                                                </a>
                                            </h6>


                                            <div class="product-price">
                                                @if ($product->discount_price)
                                                    <span class="old-price" style="color:#000; font-size:16px;">
                                                        {{ \App\Helpers\CurrencyHelper::formatPrice($product->regular_price) }}
                                                    </span>
                                                    <span class="new-price"
                                                        style="color:#000; font-size:16px; font-weight:600;">
                                                        {{ \App\Helpers\CurrencyHelper::formatPrice($product->discount_price) }}
                                                    </span>
                                                @else
                                                    <span class="new-price"
                                                        style="color:#000; font-size:16px; font-weight:500;">
                                                        {{ \App\Helpers\CurrencyHelper::formatPrice($product->regular_price) }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="alert alert-info text-center">
                                        <h4>No products found</h4>
                                        <p>Please check back later or add products from admin panel.</p>
                                        <a href="{{ route('shops') }}" class="theme-btn style-one">Refresh</a>
                                    </div>
                                </div>
                            @endforelse
                        </div>

                        <!--=== Pagination ===-->
                        @if ($products->hasPages())
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="pesco-pagination mb-40" data-aos="fade-up" data-aos-delay="70"
                                        data-aos-duration="2200">
                                        <ul>
                                            {{-- Previous Page Link --}}
                                            @if ($products->onFirstPage())
                                                <li class="disabled"><span><i class="far fa-angle-left"></i></span></li>
                                            @else
                                                <li><a href="{{ $products->previousPageUrl() }}"><i
                                                            class="far fa-angle-left"></i></a>
                                                </li>
                                            @endif

                                            {{-- Pagination Elements --}}
                                            @php
                                                $current = $products->currentPage();
                                                $last = $products->lastPage();
                                                $start = max(1, $current - 2);
                                                $end = min($last, $current + 2);
                                            @endphp

                                            @if ($start > 1)
                                                <li><a href="{{ $products->url(1) }}">01</a></li>
                                                @if ($start > 2)
                                                    <li><span>....</span></li>
                                                @endif
                                            @endif

                                            @for ($page = $start; $page <= $end; $page++)
                                                @if ($page == $current)
                                                    <li class="active">
                                                        <span>{{ str_pad($page, 2, '0', STR_PAD_LEFT) }}</span>
                                                    </li>
                                                @else
                                                    <li><a
                                                            href="{{ $products->url($page) }}">{{ str_pad($page, 2, '0', STR_PAD_LEFT) }}</a>
                                                    </li>
                                                @endif
                                            @endfor

                                            @if ($end < $last)
                                                @if ($end < $last - 1)
                                                    <li><span>....</span></li>
                                                @endif
                                                <li><a
                                                        href="{{ $products->url($last) }}">{{ str_pad($last, 2, '0', STR_PAD_LEFT) }}</a>
                                                </li>
                                            @endif

                                            {{-- Next Page Link --}}
                                            @if ($products->hasMorePages())
                                                <li><a href="{{ $products->nextPageUrl() }}"><i
                                                            class="far fa-angle-right"></i></a>
                                                </li>
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

                <!--=== Sidebar Area ===-->
                
                <div class="col-xl-3">
                    <div class="shop-sidebar-area">
                        <div class="product-widget product-categories-widget mb-40" data-aos="fade-up"
                            data-aos-delay="20" data-aos-duration="1000">
                            <div class="widget-content">
                                <h4 class="widget-title">Product Categories</h4>
                                <ul class="categories-list">
                                    @php
                                        $selectedCategories = explode(',', request('category_id', ''));
                                    @endphp

                                    @forelse($categories as $category)
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input category-filter" type="checkbox"
                                                    value="{{ $category->id }}" id="category_{{ $category->id }}"
                                                    {{ in_array($category->id, $selectedCategories) ? 'checked' : '' }}>

                                                <label class="form-check-label" for="category_{{ $category->id }}">
                                                    {{ $category->name }}
                                                    <span>({{ $category->products_count }})</span>
                                                </label>
                                            </div>
                                        </li>
                                    @empty
                                        <li class="text-muted">No categories found</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                        @if (isset($activeSubcategories) && $activeSubcategories->count() > 0)
                            <div class="product-widget product-categories-widget mb-40" data-aos="fade-up"
                                data-aos-delay="30" data-aos-duration="1000">
                                <div class="widget-content">
                                    <h4 class="widget-title">Filter by Sub Category</h4>
                                    <ul class="categories-list">
                                        @foreach ($activeSubcategories as $sub)
                                            <li>
                                                <div class="form-check">
                                                    {{-- সাব-ক্যাটাগরির জন্য আলাদা কুয়েরি প্যারামিটার --}}
                                                    <a href="{{ request()->fullUrlWithQuery(['subcategory' => $sub->id]) }}"
                                                        style="{{ request('subcategory') == $sub->id ? 'color: #ff8b13; font-weight: bold;' : 'color: #666;' }}">
                                                        <i class="fa fa-angle-right mr-2"></i> {{ $sub->name }}
                                                    </a>
                                                </div>
                                            </li>
                                        @endforeach

                                        @if (request()->has('subcategory'))
                                            <li class="mt-10">
                                                <a href="{{ request()->fullUrlWithQuery(['subcategory' => null]) }}"
                                                    class="text-danger" style="font-size: 13px;">
                                                    <i class="fa fa-times-circle"></i> Clear Sub-filter
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        @endif

                        <div class="sidebar-banner-widget mb-40" data-aos="fade-up" data-aos-delay="50"
                            data-aos-duration="1200">
                            {{-- আপনার ব্যানারের কোড... --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--====== End Shop page Section ======-->

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            function updateURLAndRedirect(key, value) {
                const url = new URL(window.location.href);
                const params = new URLSearchParams(url.search);

                if (value) {
                    params.set(key, value);
                } else {
                    params.delete(key);
                }

                // ফিল্টার চেঞ্জ হলে পেজ নম্বর ১ এ নিয়ে যাওয়া স্ট্যান্ডার্ড
                params.delete('page');

                // ব্রাউজার রিফ্রেশ এবং নতুন ডাটা লোড
                window.location.href = url.pathname + '?' + params.toString();
            }

            $(document).on('change', '.category-filter', function() {
                // যদি ইউজার নতুন একটি বক্স চেক করে
                if ($(this).is(':checked')) {
                    // বাকি সব বক্স থেকে টিক চিহ্ন সরিয়ে দেওয়া (UI level)
                    $('.category-filter').not(this).prop('checked', false);

                    // শুধুমাত্র বর্তমান বক্সের আইডি নিয়ে URL আপডেট করা
                    const selectedId = $(this).val();
                    updateURLAndRedirect('category_id', selectedId);
                } else {
                    // যদি ইউজার টিক চিহ্ন তুলে দেয় (Uncheck), তবে ফিল্টার ক্লিয়ার করা
                    updateURLAndRedirect('category_id', null);
                }
            });

            $(document).on('change', '#sortProducts', function() {
                updateURLAndRedirect('sort', $(this).val());
            });

            if ($('#slider-range').length && $.fn.slider) {
                $("#slider-range").slider({
                    range: true,
                    min: 0,
                    max: 1000,
                    values: [0, 1000],
                    stop: function(event, ui) {
                        const range = ui.values[0] + '-' + ui.values[1];
                        updateURLAndRedirect('price_range', range);
                    },
                    slide: function(event, ui) {
                        $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
                    }
                });
            }

            $(document).on('click', '.add-to-cart', function(e) {
                e.preventDefault();
                const $this = $(this);
                const product = {
                    id: $this.data('product-id'),
                    name: $this.data('product-name'),
                    price: $this.data('product-price'),
                    image: $this.data('product-image'),
                    quantity: 1
                };

                let cart = JSON.parse(localStorage.getItem('cart')) || [];
                const existingItem = cart.find(item => item.id === product.id);

                if (existingItem) {
                    existingItem.quantity += 1;
                } else {
                    cart.push(product);
                }

                localStorage.setItem('cart', JSON.stringify(cart));

                if (typeof showNotification === "function") {
                    showNotification(`${product.name} added to cart!`, 'success');
                } else {
                    alert(`${product.name} has been added to cart!`);
                }

                updateCartCount();
            });

        });
    </script>



    <style>
        .product-title {
            font-size: 16px;
        }

        .color1 {
            background-color: #000;
        }

        .color2 {
            background-color: #dc3545;
        }

        .color3 {
            background-color: #007bff;
        }

        .color4 {
            background-color: #28a745;
        }

        .color5 {
            background-color: #ffc107;
        }

        .color6 {
            background-color: #6f42c1;
        }

        .color7 {
            background-color: #e83e8c;
        }

        .color8 {
            background-color: #6c757d;
        }

        .color1,
        .color2,
        .color3,
        .color4,
        .color5,
        .color6,
        .color7,
        .color8 {
            display: inline-block;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            border: 2px solid #ddd;
            cursor: pointer;
        }

        .form-check-label span {
            float: right;
            color: #666;
        }

        .product-category {
            font-size: 12px;
            opacity: 0.8;
        }

        .discount {
            background: #dc3545;
            color: white;
            padding: 5px 10px;
            border-radius: 3px;
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 12px;
            font-weight: bold;
        }

        .hover-content .icon-btn.active i {
            color: #dc3545;
        }
    </style>
@endpush
