@extends('layouts.app')

@section('title', $product->name . ' - Product Details')

@section('content')

    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">

    <style>
        /* 🌐 কোর লেআউট টাইপোগ্রাফি */
        .shop-details-section, .breadcrumb-wrapper, .releted-product-section {
            font-family: 'DM Sans', 'Hind Siliguri', sans-serif;
            background-color: #fcfcfc;
        }

        /* 📋 ডাইনামিক বাংলা ফন্ট ট্রিগার জোন (টাইটেল এবং ব্রেডক্রাম্ব) */
        .custom-breadcrumb, .product-title-luxury, .summernote-content {
            font-family: 'Hind Siliguri', 'DM Sans', sans-serif;
        }

        /* 🍞 মডার্ন ব্রেডক্রাম্ব ডিজাইন */
        .custom-breadcrumb {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 8px;
            font-size: 14px;
            color: #64748b;
        }
        .custom-breadcrumb li+li:before {
            content: "›";
            padding: 0 4px;
            color: #cbd5e1;
            font-size: 18px;
            line-height: 1;
        }
        .custom-breadcrumb .active {
            color: #0f172a;
            font-weight: 600;
        }

        /* 🎯 ইমেজ গ্যালারি প্রিমিয়াম প্যানেল (স্লিক ফ্রেন্ডলি লেআউট) */
        .product-big-slider {
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid #f1f5f9;
            background: #ffffff;
        }
        .product-big-slider .product-img img {
            width: 100%;
            height: 500px;
            object-fit: cover;
        }
        
        /* 🛠️ স্লাইডার থাম্বনেইল লেআউট ফিক্স (কোনো জর্বদস্তিমূলক ফ্লেক্স ছাড়া) */
        .product-thumb-slider {
            margin-top: 15px;
            padding: 0 10px;
        }
        .product-thumb-slider .product-img {
            cursor: pointer;
            outline: none;
            padding: 0 6px; 
        }
        .product-thumb-slider .product-img img {
            width: 100% !important;
            height: 85px !important; 
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }

        /* বর্তমানে সিলেক্টেড থাকা ইমেজের বর্ডার হাইলাইট */
        .product-thumb-slider .slick-current img {
            border-color: #f15922 !important;
        }

        /* 🏷️ সেল এবং স্টক স্ট্যাটাস ব্যাজ */
        .sale-badge-luxury {
            background: #fef2f2;
            color: #ef4444;
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 16px;
            border: 1px solid #fee2e2;
        }
        .stock-badge-custom {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            color: #334155;
            padding: 5px 12px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
        }

        /* 📝 প্রোডাক্ট কন্টেন্ট এরিয়া */
        .product-title-luxury {
            font-size: 28px;
            font-weight: 700;
            color: #0f172a;
            line-height: 1.3;
            margin-bottom: 15px;
        }
        .price-luxury-box {
            margin-bottom: 20px;
        }
        .price-luxury-box .new-price {
            font-size: 26px;
            font-weight: 700;
            color: #f15922;
        }
        .price-luxury-box .old-price {
            font-size: 18px;
            color: #94a3b8;
            text-decoration: line-through;
            margin-right: 10px;
        }

        /* 🔢 কোয়ান্টিটি সিলেক্টর উইজেট */
        .custom-qty-wrapper {
            display: inline-flex !important;
            align-items: center;
            border: 1px solid #e2e8f0 !important;
            border-radius: 10px !important;
            overflow: hidden;
            background: #ffffff !important;
            height: 48px !important;
        }
        .custom-qty-wrapper .qty-btn {
            background: #f8fafc !important;
            width: 44px !important;
            height: 100% !important;
            border: none !important;
            font-size: 16px !important;
            transition: background 0.2s;
        }
        .custom-qty-wrapper .qty-btn:hover { background: #f1f5f9 !important; }
        .custom-qty-wrapper .qty-input {
            width: 50px !important;
            height: 100% !important;
            border: none !important;
            font-size: 16px !important;
            font-weight: 700 !important;
            color: #0f172a !important;
        }

        /* ⚡ অ্যাকশন গ্রিড বাটন প্যানেল */
        .action-buttons-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 14px;
            margin-top: 25px;
        }
        .custom-grid-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            height: 50px;
            font-size: 15px;
            font-weight: 700;
            border-radius: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
            text-decoration: none !important;
            border: none;
            width: 100%;
        }
        .add-cart-btn { background-color: #f15922; color: #ffffff !important; }
        .add-cart-btn:hover { background-color: #d44816; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(241, 89, 34, 0.2); }
        .buy-now-btn { background-color: #0f172a; color: #ffffff !important; }
        .buy-now-btn:hover { background-color: #000000; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(15, 23, 42, 0.2); }
        .whatsapp-btn { background-color: #25D366; color: #ffffff !important; text-transform: none; }
        .whatsapp-btn:hover { background-color: #1ebc59; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(37, 211, 102, 0.2); }
        .call-btn { background-color: #2563eb; color: #ffffff !important; text-transform: none; }
        .call-btn:hover { background-color: #1d4ed8; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(37, 99, 235, 0.2); }

        /* 🗂️ মডার্ন ট্যাব সিস্টেম */
        .pesco-tabs .nav-tabs {
            border-bottom: 2px solid #f1f5f9;
            gap: 20px;
        }
        .pesco-tabs .nav-link {
            border: none !important;
            color: #64748b !important;
            font-weight: 600;
            font-size: 16px;
            padding: 12px 10px !important;
            position: relative;
            background: transparent !important;
        }
        .pesco-tabs .nav-link.active {
            color: #f15922 !important;
        }
        .pesco-tabs .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 2.5px;
            background: #f15922;
            border-radius: 3px;
        }

        .additional-info-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .additional-info-list li {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #f1f5f9;
            font-size: 14px;
            color: #475569;
        }
        .additional-info-list li span {
            font-weight: 600;
            color: #0f172a;
        }

        .special-features mt-4 {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .special-features span {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 14px;
            color: #475569;
            font-weight: 600;
            margin-right: 12px;
            margin-top: 15px;
            background: #fff8e1;
            padding: 8px 16px;
            border-radius: 8px;
            border: 1px solid #ffe082;
        }
        .special-features i { color: #ffb300; }

        .pesco-reviews-item {
            background: #ffffff;
            border: 1px solid #edf2f7;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 16px;
        }
        .author-thumb img {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
        }

        .custom-toast {
            position: fixed; top: 25px; right: 25px; background: #ffffff;
            padding: 16px 28px; border-radius: 12px; font-weight: 600;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            z-index: 99999; opacity: 0; transform: translateX(400px); transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
        }
        .custom-toast.show { opacity: 1; transform: translateX(0); }
        .custom-toast-success { border-left: 4px solid #10b981; }
        .custom-toast-info { border-left: 4px solid #3b82f6; }
        .custom-toast-warning { border-left: 4px solid #ef4444; }
        .custom-toast-warning-text { color: #ef4444; font-weight: 700; }

        /* ⚡ রিলেটেড প্রোডাক্ট বাটন স্টাইল (মোবাইল এবং ডেস্কটপ সবখানে পাওয়ার জন্য বাইরে আনা হয়েছে) */
        .grid-action-btns { display: flex; gap: 8px; margin-top: auto; }
        .btn-grid-cart { background: transparent; border: 1px solid #f15922; color: #f15922; font-weight: 600; font-size: 13px; padding: 8px 10px; border-radius: 8px; transition: all 0.2s ease; display: flex; align-items: center; justify-content: center; }
        .btn-grid-cart:hover { background: #f15922; color: #ffffff; }
        .btn-grid-cart:disabled { opacity: 0.6; cursor: not-allowed; }
        
        .btn-grid-buy { background: #f15922; border: none; color: #ffffff; font-weight: 600; font-size: 13px; padding: 8px 10px; border-radius: 8px; transition: all 0.2s ease; display: flex; align-items: center; justify-content: center; }
        .btn-grid-buy:hover { background: #d44816; color: #ffffff !important; }

        /* 📱 মোবাইল ডিভাইস অপ্টিমাইজেশন মিডিয়া কুয়েরি */
        @media (max-width: 768px) {
            .product-big-slider .product-img img {
                height: 340px !important; 
            }
            .product-thumb-slider .product-img img {
                height: 70px !important;
            }
            /* ⚡ বাটনগুলোকে মোবাইলে এক লাইনে ১টি করে সাজানো হলো */
            .action-buttons-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }
            .custom-grid-btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 6px;
                height: 35px;
                font-size: 10px;
                font-weight: 700;
                border-radius: 10px;
                text-transform: uppercase;
                letter-spacing: 0.1px;
                transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
                text-decoration: none !important;
                border: none;
                width: 100%;
            }
        }
        
        @media (max-width: 575.98px) { 
            .btn-grid-cart, .btn-grid-buy { font-size: 12px; padding: 6px 4px; } 
        }
    </style>

    <div class="container mt-4">
        <div class="breadcrumb-wrapper">
            <ul class="custom-breadcrumb">
                <li>Home</li>
                @if ($product->category)
                    <li>{{ $product->category->name }}</li>
                @endif
                @if ($product->subcategory)
                    <li>{{ $product->subcategory->name }}</li>
                @endif
                <li class="active">{{ $product->name }}</li>
            </ul>
        </div>
    </div>

    <section class="shop-details-section pt-40 pb-80">
        <div class="container">
            <div class="shop-details-wrapper">
                <div class="row g-5">
                    
                    <div class="col-xl-6">
                        <div class="product-gallery-area mb-lg-20 mb-0" data-aos="fade-up" data-aos-duration="1200">
                            <div class="product-big-slider mb-3">
                                <div class="product-img">
                                    @if ($product->thumbnail)
                                        <a href="{{ asset('storage/' . $product->thumbnail) }}" class="img-popup">
                                            <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}">
                                        </a>
                                    @else
                                        <a href="{{ asset('assets/images/products/product-big-1.jpg') }}" class="img-popup">
                                            <img src="{{ asset('assets/images/products/product-big-1.jpg') }}" alt="{{ $product->name }}">
                                        </a>
                                    @endif
                                </div>
                                @foreach ($product->images as $image)
                                    <div class="product-img">
                                        <a href="{{ asset('storage/' . $image->image) }}" class="img-popup">
                                            <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $product->name }}">
                                        </a>
                                    </div>
                                @endforeach
                            </div>

                            @if ($product->images->isNotEmpty())
                                <div class="product-thumb-slider">
                                    <div class="product-img">
                                        @if ($product->thumbnail)
                                            <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}">
                                        @else
                                            <img src="{{ asset('assets/images/products/product-thumb-1.jpg') }}" alt="{{ $product->name }}">
                                        @endif
                                    </div>
                                    @foreach ($product->images as $image)
                                        <div class="product-img">
                                            <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $product->name }}">
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="product-info mb-50" data-aos="fade-up" data-aos-duration="1400">
                            @if ($product->discount_price)
                                @php
                                    $discountPercentage = round((($product->regular_price - $product->discount_price) / $product->regular_price) * 100);
                                @endphp
                                <span class="sale-badge-luxury"><i class="fas fa-bolt"></i> SALE {{ $discountPercentage }}% OFF</span>
                            @endif

                            <h4 class="product-title-luxury">{{ $product->name }}</h4>

                            <div class="price-luxury-box">
                                @if ($product->discount_price)
                                    <span class="old-price">{{ \App\Helpers\CurrencyHelper::formatPrice($product->regular_price) }}</span>
                                    <span class="new-price">{{ \App\Helpers\CurrencyHelper::formatPrice($product->discount_price) }} <small style="font-size:14px; color:#64748b; font-weight:400;">/ KG</small></span>
                                @else
                                    <span class="new-price">{{ \App\Helpers\CurrencyHelper::formatPrice($product->regular_price) }} <small style="font-size:14px; color:#64748b; font-weight:400;">/ KG</small></span>
                                @endif
                            </div>

                            <div class="d-flex align-items-center gap-2 mb-4">
                                @if ($product->stock_quantity == 0)
                                    <span class="stock-badge-custom style-out" style="color: #ef4444; background: #fef2f2; border-color: #fee2e2;">Out of Stock</span>
                                @elseif($product->stock_quantity < 10)
                                    <span class="stock-badge-custom style-low" style="color: #b45309; background: #fffbeb; border-color: #fef3c7;">Low Stock ({{ $product->stock_quantity }} KG left)</span>
                                @else
                                    <span class="stock-badge-custom" style="color: #10b981; background: #f0fdf4; border-color: #dcfce7;">In Stock</span>
                                @endif
                                
                                @if ($product->delivery_days)
                                    <span class="stock-badge-custom"><i class="far fa-clock me-1"></i> Delivery in {{ $product->delivery_days }} days</span>
                                @endif
                            </div>

                            <div class="product-cart-variation mt-4 pt-2">
                                <div class="d-flex align-items-center mb-4 flex-wrap gap-3">
                                    <span class="fw-bold text-dark" style="font-size:15px;">Quantity:</span>
                                    <div class="custom-qty-wrapper">
                                        <button type="button" class="qty-btn quantity-down"><i class="fas fa-minus"></i></button>
                                        <input class="qty-input quantity" id="quantity" type="number" value="1" name="quantity" min="1" form="add-to-cart-form">
                                        <button type="button" class="qty-btn quantity-up"><i class="fas fa-plus"></i></button>
                                    </div>
                                    <a href="javascript:void(0)" class="icon-btn toggle-wishlist add-to-wishlist ms-sm-3" data-product-id="{{ $product->id }}" style="font-size:22px; color:#64748b; transition: color 0.2s;">
                                        <i class="far fa-heart"></i>
                                    </a>
                                </div>

                                <form action="{{ route('cart.add.item', $product->id) }}" method="POST" id="add-to-cart-form">
                                    @csrf
                                    <div class="action-buttons-grid">
                                        <button type="submit" name="action" value="add_to_cart" class="custom-grid-btn add-cart-btn">
                                            <i class="fas fa-shopping-basket"></i> Add To Cart
                                        </button>
                                        <button type="submit" name="action" value="buy_now" class="custom-grid-btn buy-now-btn">
                                            Buy Now
                                        </button>
                                        @php
                                            $whatsapp_number = "8801700900059";
                                            $message = "আসসালামু আলাইকুম, আমি আপনার ওয়েবসাইট থেকে এই প্রোডাক্টটি অর্ডার করতে চাই: " . $product->name . " (লিংক: " . request()->url() . ")";
                                        @endphp
                                        <a href="https://api.whatsapp.com/send?phone={{ $whatsapp_number }}&text={{ urlencode($message) }}" target="_blank" class="custom-grid-btn whatsapp-btn">
                                            <i class="fab fa-whatsapp" style="font-size: 18px;"></i> Order On WhatsApp
                                        </a>
                                        <a href="tel:+8801700900059" class="custom-grid-btn call-btn">
                                            <i class="fas fa-phone-alt"></i> Call For Order
                                        </a>
                                    </div>
                                </form>
                            </div>

                            <div class="special-features mt-4">
                                <span><i class="fas fa-certificate"></i> 100% Premium Quality</span>
                                <span><i class="fas fa-leaf"></i> Organic Guaranteed</span>
                                <span><i class="fas fa-truck"></i> Cash On Delivery</span>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="additional-information-wrapper mt-0 pt-0" data-aos="fade-up" data-aos-delay="30" data-aos-duration="1000">
                    <div class="row g-5">
                        <div class="col-lg-5">
                            <div class="sidebar-card">
                                <h4 class="widget-title-modern">Technical Specifications</h4>
                                <ul class="additional-info-list">
                                    <li>Product Code <span>{{ $product->product_code }}</span></li>
                                    <li>Category <span>{{ $product->category->name ?? 'N/A' }}</span></li>
                                    <li>Subcategory <span>{{ $product->subcategory->name ?? 'N/A' }}</span></li>
                                    @if ($product->height)
                                        <li>Height <span>{{ $product->height }} cm</span></li>
                                    @endif
                                    @if ($product->width)
                                        <li>Width <span>{{ $product->width }} cm</span></li>
                                    @endif
                                    @if ($product->length)
                                        <li>Length <span>{{ $product->length }} cm</span></li>
                                    @endif
                                    <li>Added On <span>{{ $product->created_at->format('d M, Y') }}</span></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-7">
                            <div class="description-wrapper">
                                <div class="pesco-tabs mb-4">
                                    <ul class="nav nav-tabs border-0">
                                        <li>
                                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#description">Description</button>
                                        </li>
                                        <li>
                                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#reviews">Reviews</button>
                                        </li>
                                    </ul>
                                </div>

                                <div class="tab-content bg-white p-4 rounded-4 border" style="border-color: #edf2f7 !important;">
                                    <div class="tab-pane fade active show" id="description">
                                        <div class="summernote-content text-muted">
                                            {!! $product->description ?? '<p>No description available.</p>' !!}
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="reviews">
                                        <div class="pesco-comment-area">
                                            <h5 class="fw-bold text-dark mb-4">Customer Reviews ({{ $productsReviews->count() }})</h5>
                                            
                                            <ul class="list-unstyled p-0 m-0">
                                                @forelse ($productsReviews as $review)
                                                    <li class="comment mb-3">
                                                        <div class="pesco-reviews-item">
                                                            <div class="d-flex align-items-center gap-3 mb-3" style="display: flex; align-items: center;">
                                                                
                                                                <div class="author-thumb" style="width: 48px; height: 48px; border-radius: 50%; overflow: hidden; margin-right: 15px;">
                                                                    @if($review->reviewer_image)
                                                                        <img src="{{ asset('storage/' . $review->reviewer_image) }}" alt="Author" style="width: 100%; height: 100%; object-fit: cover;">
                                                                    @else
                                                                        <img src="https://placehold.co/48x48?text={{ substr($review->reviewer_name, 0, 1) }}" alt="Author" style="width: 100%; height: 100%; object-fit: cover;">
                                                                    @endif
                                                                </div>

                                                                <div class="author-info">
                                                                    <h6 class="fw-bold text-dark mb-1" style="margin: 0 0 5px 0;">
                                                                        {{ $review->reviewer_name }} 
                                                                        @if($review->order_id)
                                                                            <small class="text-success" style="font-size: 11px; font-weight: 600; margin-left: 5px;"><i class="fas fa-check-circle"></i> Verified Buyer</small>
                                                                        @endif
                                                                    </h6>
                                                                    
                                                                    <div class="d-flex align-items-center gap-2" style="display: flex; align-items: center;">
                                                                        <div class="text-warning small" style="color: #ffb703; margin-right: 10px;">
                                                                            @for ($j = 1; $j <= 5; $j++)
                                                                                @if($j <= $review->rating)
                                                                                    <i class="fas fa-star"></i>
                                                                                @else
                                                                                    <i class="far fa-star"></i>
                                                                                @endif
                                                                            @endfor
                                                                        </div>
                                                                        <small class="text-muted" style="font-size: 12px;">{{ $review->created_at->diffForHumans() }}</small>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="author-review-content text-muted small" style="margin-top: 10px; font-size: 14px; line-height: 1.6;">
                                                                <p class="mb-0" style="color: #444;">{{ $review->review_text }}</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @empty
                                                    <li class="text-center py-4" style="list-style: none;">
                                                        <p class="text-muted" style="font-style: italic;">No reviews yet for this product. Be the first to share your experience!</p>
                                                    </li>
                                                @endforelse
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

   @if ($relatedProducts->count() > 0)
        <section class="releted-product-section pb-80">
            <div class="container">
                <div class="row align-items-end mb-4">
                    <div class="col-md-8">
                        <div class="section-title">
                            <span class="text-uppercase small fw-bold text-brand" style="color: #f15922; letter-spacing: 0.5px;">Related Collections</span>
                            <h3 class="fw-bold text-dark mt-1">Customers also purchased</h3>
                        </div>
                    </div>
                    <div class="col-md-4 text-md-end d-none d-md-block">
                        <div class="releted-product-arrows style-one"></div>
                    </div>
                </div>

                <div class="releted-product-slider row g-4">
                    @foreach ($relatedProducts as $relatedProduct)
                        <div class="col-xl-3">
                            <div class="product-item style-one mb-4 border rounded-4 bg-white overflow-hidden d-flex flex-column h-100" style="border-color: #edf2f7 !important;">
                                <div class="product-thumbnail position-relative" style="height: 280px; overflow: hidden; flex-shrink: 0;">
                                    @if ($relatedProduct->thumbnail)
                                        <img src="{{ asset('storage/' . $relatedProduct->thumbnail) }}" alt="{{ $relatedProduct->name }}" style="width:100%; height:100%; object-fit:cover;">
                                    @else
                                        <img src="{{ asset('assets/images/products/feature-product-' . (($loop->index % 4) + 1) . '.png') }}" alt="{{ $relatedProduct->name }}" style="width:100%; height:100%; object-fit:cover;">
                                    @endif

                                    <div class="hover-content">
                                        <a href="javascript:void(0)" class="icon-btn add-to-wishlist" data-product-id="{{ $relatedProduct->id }}"><i class="far fa-heart"></i></a>
                                        <a href="{{ $relatedProduct->details_url }}" class="icon-btn"><i class="fa fa-eye"></i></a>
                                    </div>
                                </div>
                                
                                <div class="p-3 text-center d-flex flex-column flex-grow-1">
                                    <h6 class="mb-2">
                                        <a href="{{ $relatedProduct->details_url }}" class="text-dark fw-bold text-decoration-none" style="font-family: 'Hind Siliguri', sans-serif; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; height: 40px;">
                                            {{ Str::limit($relatedProduct->name, 45) }}
                                        </a>
                                    </h6>
                                    
                                    <div class="fw-bold text-brand mb-3" style="color: #f15922; font-size: 16px;">
                                        @if ($relatedProduct->discount_price)
                                            <span class="text-muted small text-decoration-line-through me-2 fw-normal">{{ \App\Helpers\CurrencyHelper::formatPrice($relatedProduct->regular_price) }}</span>
                                            <span>{{ \App\Helpers\CurrencyHelper::formatPrice($relatedProduct->discount_price) }}</span>
                                        @else
                                            <span>{{ \App\Helpers\CurrencyHelper::formatPrice($relatedProduct->regular_price) }}</span>
                                        @endif
                                    </div>

                                    <div class="grid-action-btns d-flex gap-2 mt-auto">
                                        <button type="button" 
                                            class="btn btn-grid-cart flex-grow-1 related-action-btn related-add-cart-btn" 
                                            data-id="{{ $relatedProduct->id }}"
                                            data-name="{{ $relatedProduct->name }}"
                                            data-price="{{ $relatedProduct->discount_price ?? $relatedProduct->regular_price }}"
                                            data-stock="{{ $relatedProduct->stock_quantity ?? 0 }}"
                                            data-incart="{{ $relatedProduct->already_in_cart ?? 0 }}" 
                                            data-url="{{ url('cart/ajax/' . $relatedProduct->id) }}">
                                            <i class="fas fa-shopping-cart me-1"></i> Cart
                                        </button>

                                        <form action="{{ route('cart.add.item', $relatedProduct->id) }}" method="POST" class="d-inline flex-grow-1 m-0 p-0">
                                            @csrf
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" name="action" value="buy_now" 
                                                class="btn btn-grid-buy w-100 h-100 related-action-btn related-buy-now-btn"
                                                data-id="{{ $relatedProduct->id }}"
                                                data-name="{{ $relatedProduct->name }}"
                                                data-price="{{ $relatedProduct->discount_price ?? $relatedProduct->regular_price }}"
                                                data-stock="{{ $relatedProduct->stock_quantity ?? 0 }}"
                                                data-incart="{{ $relatedProduct->already_in_cart ?? 0 }}">
                                                Buy now
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <div class="custom-toast custom-toast-success" id="wishlistToast">Added to wishlist!</div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            
            // ✅ গ্লোবাল টোস্ট ফাংশন
            window.triggerLocalToast = function(msg, mode = 'success') {
                const toast = document.getElementById('wishlistToast');
                if(toast) {
                    toast.className = `custom-toast custom-toast-${mode} show`;
                    toast.innerText = msg;
                    setTimeout(() => { toast.classList.remove('show'); }, 2500);
                }
            };

            // ✅ গ্লোবাল addToCart ফাংশন (যেটা মিসিং ছিলো)
            window.addToCart = function(url, buttonElement) {
                // CSRF টোকেন কালেক্ট করা
                const metaToken = document.querySelector('meta[name="csrf-token"]');
                const csrfToken = metaToken ? metaToken.content : '';
                
                // বাটন লোডিং স্টেট (অপশনাল, কিন্তু ভালো প্র্যাকটিস)
                const originalText = buttonElement.innerHTML;
                buttonElement.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Adding...';
                buttonElement.disabled = true;

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ quantity: 1 }) // রিলেটেড প্রোডাক্ট থেকে ডিফল্ট ১টি যাবে
                })
                .then(response => response.json())
                .then(data => {
                    buttonElement.innerHTML = originalText;
                    buttonElement.disabled = false;
                    
                    if (data.status === 'success' || data.success === true) {
                        window.triggerLocalToast('প্রোডাক্টটি সফলভাবে কার্টে যুক্ত হয়েছে!', 'success');
                        
                        // যদি কার্ট কাউন্টার আইডি/ক্লাস থাকে, সেটি আপডেট করা
                        if(data.cart_count !== undefined) {
                            document.querySelectorAll('.cart-count, .cart-item-count').forEach(el => el.innerText = data.cart_count);
                        }
                    } else {
                        window.triggerLocalToast(data.message || 'কার্টে যুক্ত করতে সমস্যা হয়েছে!', 'warning');
                    }
                })
                .catch(error => {
                    console.error('Error adding to cart:', error);
                    buttonElement.innerHTML = originalText;
                    buttonElement.disabled = false;
                    window.triggerLocalToast('সার্ভার এরর! দয়া করে আবার চেষ্টা করুন।', 'warning');
                });
            };

            // ✅ PHP থেকে stock এবং কার্টে আগে থেকে থাকা পরিমাণ নেওয়া
            const currentStock = parseInt('{{ $product->stock_quantity ?? 0 }}', 10);
            const alreadyInCart = parseInt('{{ $alreadyInCart ?? 0 }}', 10);
            const availableStock = currentStock - alreadyInCart; 

            // 🌟 Meta Pixel: AddToCart Tracking
            const addToCartBtn = document.querySelector('.add-cart-btn');
            if(addToCartBtn) {
                addToCartBtn.addEventListener('click', function(e) {
                    const qty = parseInt(document.getElementById('quantity').value, 10) || 1;
                    
                    if (currentStock <= 0) {
                        e.preventDefault();
                        window.triggerLocalToast('দুঃখিত! প্রোডাক্টটি বর্তমানে স্টকে নেই।', 'warning');
                        return;
                    }

                    if (qty > availableStock) {
                        e.preventDefault();
                        if (alreadyInCart > 0) {
                            window.triggerLocalToast('স্টকে আর মাত্র ' + availableStock + ' KG অর্ডার করা যাবে। আপনার কার্টে ইতিমধ্যে ' + alreadyInCart + ' KG আছে।', 'warning');
                        } else {
                            window.triggerLocalToast('দুঃখিত! স্টকে মাত্র ' + currentStock + ' KG আছে।', 'warning');
                        }
                        return;
                    }

                    if (typeof fbq === 'function') {
                        fbq('track', 'AddToCart', {
                            content_name: '{!! addslashes($product->name) !!}', 
                            content_ids: ['{{ $product->id }}'],
                            value: {{ $product->discount_price ? $product->discount_price : $product->regular_price }}, 
                            currency: 'BDT'
                        });
                    }
                });
            }

            // 🌟 Meta Pixel: Buy Now Tracking 
            const buyNowBtn = document.querySelector('.buy-now-btn');
            if(buyNowBtn) {
                buyNowBtn.addEventListener('click', function(e) {
                    const qty = parseInt(document.getElementById('quantity').value, 10) || 1;
                    
                    if (currentStock <= 0) {
                        e.preventDefault();
                        window.triggerLocalToast('দুঃখিত! প্রোডাক্টটি বর্তমানে স্টকে নেই।', 'warning');
                        return;
                    }

                    if (qty > availableStock) {
                        e.preventDefault();
                        if (alreadyInCart > 0) {
                            window.triggerLocalToast('স্টকে আর মাত্র ' + availableStock + ' KG অর্ডার করা যাবে। আপনার কার্টে ইতিমধ্যে ' + alreadyInCart + ' KG আছে।', 'warning');
                        } else {
                            window.triggerLocalToast('দুঃখিত! স্টকে মাত্র ' + currentStock + ' KG আছে।', 'warning');
                        }
                        return;
                    }

                    if (typeof fbq === 'function') {
                        fbq('track', 'AddToCart', { 
                            content_name: '{!! addslashes($product->name) !!}', 
                            content_ids: ['{{ $product->id }}'],
                            value: {{ $product->discount_price ? $product->discount_price : $product->regular_price }}, 
                            currency: 'BDT'
                        });
                    }
                });
            }

            // 🔢 Quantity +/- button
            const quantityInput = document.getElementById('quantity');
            const minusBtn = document.querySelector('.quantity-down');
            const plusBtn = document.querySelector('.quantity-up');

            if (minusBtn && plusBtn && quantityInput) {
                minusBtn.addEventListener('click', function () {
                    let v = parseInt(quantityInput.value, 10);
                    if (v > 1) quantityInput.value = v - 1;
                });
                
                plusBtn.addEventListener('click', function () {
                    let v = parseInt(quantityInput.value, 10);
                    if (v >= availableStock) {
                        if (alreadyInCart > 0) {
                            window.triggerLocalToast('আপনি সর্বোচ্চ ' + availableStock + ' KG সিলেক্ট করতে পারবেন (কার্টে ' + alreadyInCart + ' KG আছে)।', 'warning');
                        } else {
                            window.triggerLocalToast('সর্বোচ্চ ' + currentStock + ' KG অর্ডার করা যাবে।', 'warning');
                        }
                        return;
                    }
                    quantityInput.value = v + 1;
                });
            }

            // ❤️ Wishlist system
            document.querySelectorAll('.add-to-wishlist').forEach(button => {
                const productId = button.dataset.productId;
                if(productId) {
                    fetch(`/wishlist/check/${productId}`)
                        .then(res => res.json())
                        .then(data => {
                            if (data.in_wishlist) {
                                button.classList.add('active');
                                const icon = button.querySelector('i');
                                if(icon) icon.className = 'fas fa-heart';
                            }
                        }).catch(() => {});
                }

                button.addEventListener('click', function (e) {
                    e.preventDefault();
                    const pId = this.dataset.productId || "{{ $product->id }}";
                    fetch(`/wishlist/toggle/${pId}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            const icon = this.querySelector('i');
                            if (data.action === 'added') {
                                this.classList.add('active');
                                if(icon) icon.className = 'fas fa-heart';
                                window.triggerLocalToast('Added to wishlist!', 'success');
                            } else {
                                this.classList.remove('active');
                                if(icon) icon.className = 'far fa-heart';
                                window.triggerLocalToast('Removed from wishlist!', 'info');
                            }
                            fetch('/wishlist/count').then(r => r.json()).then(d => {
                                document.querySelectorAll('.wishlist-count').forEach(el => el.textContent = d.count);
                            });
                        } else if (data.redirect) {
                            window.triggerLocalToast(data.message, 'warning');
                            setTimeout(() => location.href = data.redirect, 1500);
                        }
                    });
                });
            });

            // 🌟 Related Products: Add to Cart & Buy Now Tracking and Stock Validation
            document.querySelectorAll('.related-action-btn').forEach(button => {
                button.addEventListener('click', function (e) {
                    const isBuyNow = this.classList.contains('related-buy-now-btn');
                    const pId = this.dataset.id;
                    const pName = this.dataset.name;
                    const pPrice = parseFloat(this.dataset.price);
                    const rStock = parseInt(this.dataset.stock, 10);
                    const rInCart = parseInt(this.dataset.incart, 10);
                    const rAvailable = rStock - rInCart;
                    const qty = 1; 
                    
                    if (rStock <= 0) {
                        e.preventDefault();
                        e.stopPropagation();
                        window.triggerLocalToast('দুঃখিত! প্রোডাক্টটি বর্তমানে স্টকে নেই।', 'warning');
                        return;
                    }

                    if (qty > rAvailable) {
                        e.preventDefault();
                        e.stopPropagation();
                        if (rInCart > 0) {
                            window.triggerLocalToast('স্টকে আর মাত্র ' + rAvailable + ' টি অর্ডার করা যাবে। কার্টে ইতিমধ্যে ' + rInCart + ' টি আছে।', 'warning');
                        } else {
                            window.triggerLocalToast('দুঃখিত! স্টকে মাত্র ' + rStock + ' টি আছে।', 'warning');
                        }
                        return;
                    }

                    if (typeof fbq === 'function') {
                        fbq('track', 'AddToCart', {
                            content_name: pName,
                            content_ids: [pId],
                            value: pPrice,
                            currency: 'BDT'
                        });
                    }

                    if (!isBuyNow) {
                        e.preventDefault();
                        e.stopPropagation();
                        const ajaxUrl = this.dataset.url;
                        
                        if (typeof window.addToCart === 'function') {
                            window.addToCart(ajaxUrl, this);
                        } else {
                            console.error("addToCart function is not defined globally.");
                        }
                    }
                });
            });

            // 🔗 Slick slider
            if (typeof $ !== 'undefined' && $.fn.slick) {
                $('.product-big-slider').slick({
                    slidesToShow: 1, 
                    slidesToScroll: 1, 
                    arrows: false, 
                    fade: true, 
                    infinite: true,
                    asNavFor: '.product-thumb-slider'
                });
                $('.product-thumb-slider').slick({
                    slidesToShow: 4, 
                    slidesToScroll: 1, 
                    asNavFor: '.product-big-slider', 
                    dots: false, 
                    arrows: false, 
                    focusOnSelect: true,
                    infinite: true,
                    swipeToSlide: true,
                    responsive: [
                        { breakpoint: 576, settings: { slidesToShow: 3 } }
                    ]
                });
                $('.releted-product-slider').slick({
                    slidesToShow: 4, slidesToScroll: 1, autoplay: true, autoplaySpeed: 3000, arrows: true, dots: false,
                    prevArrow: '.releted-product-arrows',
                    responsive: [
                        { breakpoint: 1200, settings: { slidesToShow: 3 } },
                        { breakpoint: 992,  settings: { slidesToShow: 2 } },
                        { breakpoint: 576,  settings: { slidesToShow: 1 } }
                    ]
                });
            }
        });
    </script>
@endpush