<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="eCommerce,shop,fashion">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Ecommerce App')</title>
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/png">
    <link
        href="https://fonts.googleapis.com/css2?family=Aoboshi+One&family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/fonts/flaticon/flaticon_pesco.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/vendor/slick/slick.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    <link rel="stylesheet" href="{{ asset('assets/vendor/nice-select/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/magnific-popup/dist/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/jquery-ui/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/aos/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <style>
        /* User Account Dropdown Styles */
        .user-account {
            position: relative;
            margin-left: 10px;
        }

        .user-account .dropdown-toggle {
            display: flex;
            align-items: center;
            color: #333;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 8px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
        }

        .user-account .dropdown-toggle:hover {
            background: linear-gradient(135deg, #dcb415 0% 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .user-account .dropdown-menu {
            min-width: 220px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
            border-radius: 12px;
            margin-top: 10px;
            padding: 10px;
        }

        .user-account .dropdown-item {
            padding: 10px 15px;
            font-size: 14px;
            border-radius: 8px;
            margin: 2px 0;
            transition: all 0.3s ease;
            color: #333;
            display: flex;
            align-items: center;
        }

        .user-account .dropdown-item:hover {
            background: linear-gradient(135deg, #b89610 0% 100%);
            color: white;
            transform: translateX(5px);
        }

        .user-account .dropdown-item i {
            width: 20px;
            text-align: center;
            margin-right: 10px;
            font-size: 16px;
        }

        .user-account .dropdown-divider {
            margin: 8px 0;
            opacity: 0.2;
        }

        .user-account .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, #b89610 0% 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 8px;
            font-weight: bold;
            font-size: 14px;
        }

        .user-account .user-name {
            font-weight: 600;
            font-size: 14px;
            max-width: 120px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .login-btn {
            font-size: 18px;
            font-weight: 600;
            display: flex;
            align-items: center;
            color: #333;
            text-decoration: none;
            padding: 8px 20px;
            border-radius: 8px;
            transition: all 0.3s ease;
            background: #b896103e;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .login-btn:hover {
            background: linear-gradient(135deg, #b89610 0% 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .login-btn i {
            margin-right: 8px;
        }

        .working-hours .hour-item {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px dashed #e5e5e5;
            font-size: 14px;
        }

        .working-hours .hour-item:last-child {
            border-bottom: none;
        }

        .working-hours .day {
            color: #333;
            font-weight: 500;
        }

        .working-hours .time {
            color: #777;
        }

        .working-hours .closed .time {
            color: #e63946;
            font-weight: 600;
        }

        /* PROFESSIONAL SHOP MEGA MENU (DESKTOP) */
        .custom-shop-wrapper {
            position: relative;
        }

        .shop-mega-dropdown {
            position: absolute;
            top: 100%;
            left: -20px;
            width: 260px;
            background: #fff;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            border-top: 2px solid #3BB77E;
            visibility: hidden;
            opacity: 0;
            transition: all 0.3s ease;
            z-index: 999;
            border-radius: 0 0 8px 8px;
        }

        .custom-shop-wrapper:hover .shop-mega-dropdown {
            visibility: visible;
            opacity: 1;
            transform: translateY(5px);
        }

        .shop-cat-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .shop-cat-item {
            position: relative;
            border-bottom: 1px solid #f5f5f5;
        }
        .shop-cat-item:last-child {
            border-bottom: none;
        }

        .shop-cat-link {
            display: flex !important;
            justify-content: space-between;
            align-items: center;
            padding: 15px 25px !important;
            color: #444 !important;
            font-weight: 500;
            font-size: 15px;
            transition: all 0.2s ease;
        }

        .shop-cat-item:hover > .shop-cat-link {
            color: #3BB77E !important;
            background: #fcfcfc;
        }

        .shop-cat-link .arrow-icon {
            font-size: 12px;
            color: #bbb;
            transition: color 0.2s;
        }
        .shop-cat-item:hover > .shop-cat-link .arrow-icon {
            color: #3BB77E;
        }

        .shop-subcat-panel {
            position: absolute;
            left: 100%;
            top: 0;
            width: 600px;
            min-height: 100%;
            background: #fff;
            box-shadow: 5px 5px 20px rgba(0,0,0,0.08);
            border-left: 1px solid #eee;
            padding: 30px;
            visibility: hidden;
            opacity: 0;
            transform: translateX(10px);
            transition: all 0.3s ease;
            z-index: 1000;
            border-radius: 0 8px 8px 0;
        }

        .shop-cat-item:hover .shop-subcat-panel {
            visibility: visible;
            opacity: 1;
            transform: translateX(0);
        }

        .panel-title {
            font-size: 18px;
            font-weight: 700;
            color: #222;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f1f1f1;
            text-transform: uppercase;
        }

        .panel-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }

        .panel-list li a {
            color: #666 !important;
            font-size: 14px;
            padding: 5px 0 !important;
            display: block;
            transition: all 0.2s ease;
        }

        .panel-list li a:hover {
            color: #3BB77E !important;
            padding-left: 8px !important;
            font-weight: 500;
        }

        /* AARONG STYLE HORIZONTAL MEGA MENU */
        /* ========================================================
   AARONG MEGA MENU (MODERN DESIGN)
   ======================================================== */
.aarong-shop-wrapper {
    position: relative;
}

.aarong-mega-menu {
    position: absolute;
    top: 100%;
    left: -250px;
    width: 900px; /* একটু চওড়া করা হলো */
    background-color: #ffffff;
    box-shadow: 0 10px 40px rgba(0,0,0,0.06); /* আরও সফট শ্যাডো */
    padding: 40px;
    visibility: hidden;
    opacity: 0;
    transform: translateY(15px);
    transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    z-index: 9999;
    border-radius: 8px; /* একটু বেশি রাউন্ডেড */
    border-top: 3px solid #f15922; /* আপনার থিম কালার (অরেঞ্জ/ব্রাউন) দিন */
}

.aarong-shop-wrapper:hover .aarong-mega-menu {
    visibility: visible;
    opacity: 1;
    transform: translateY(0);
}

.aarong-mega-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 30px; /* কলামগুলোর মাঝে গ্যাপ বাড়ানো হলো */
}

.aarong-mega-column {
    display: flex;
    flex-direction: column;
}

.aarong-cat-heading {
    display: block;
    font-family: 'DM Sans', sans-serif !important;
    font-size: 15px; /* একটু বড় */
    font-weight: 700;
    color: #111 !important;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 20px; /* নিচের গ্যাপ বাড়ানো হলো */
    padding-bottom: 10px;
    border-bottom: 1px solid #eaeaea;
    text-decoration: none;
    transition: color 0.2s;
    position: relative; /* আফটার ইফেক্টের জন্য */
}

/* ক্যাটাগরি হেডারের নিচে হোভার করলে ছোট লাইন আসবে */
.aarong-cat-heading::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -1px;
    width: 0;
    height: 1px;
    background-color: #f15922; /* থিম কালার */
    transition: width 0.3s ease;
}

.aarong-cat-heading:hover {
    color: #f15922 !important; /* থিম কালার */
}

.aarong-cat-heading:hover::after {
    width: 30px;
}

/* সাবক্যাটাগরি লিস্ট */
.aarong-subcat-list {
    list-style: none !important;
    padding-left: 0 !important;
    margin-left: 0 !important; 
    display: flex;
    flex-direction: column;
    gap: 12px; /* এখানে গ্যাপ দেওয়া হলো (আগের মার্জিনের বদলে) */
}

.aarong-subcat-list li {
    padding-left: 0 !important;
    margin-left: 0 !important;
}

.aarong-subcat-list li a {
    display: flex !important; /* আইকন সহজে অ্যাড করার জন্য flex */
    align-items: center;
    font-family: 'DM Sans', sans-serif !important;
    font-size: 14px;
    color: #666 !important; /* একটু সফট গ্রে */
    text-decoration: none;
    transition: all 0.2s ease;
    text-transform: capitalize;
    padding: 0 !important;
    margin-left: 0 !important;
    text-align: left !important;
}

/* সাবক্যাটাগরি লিংকে হোভার ইফেক্ট */
.aarong-subcat-list li a:hover {
    color: #f15922 !important; /* থিম কালার */
    transform: translateX(5px); /* ডানে একটু সরে যাবে */
}

/* ফুটার সেকশন (View All Button) */
.aarong-mega-footer {
    margin-top: 35px;
    padding-top: 25px;
    text-align: center;
    border-top: 1px solid #f0f0f0;
}

.aarong-mega-footer a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-family: 'DM Sans', sans-serif !important;
    font-size: 13px;
    font-weight: 700;
    color: #222 !important;
    text-transform: uppercase;
    text-decoration: none;
    letter-spacing: 1px;
    padding: 10px 25px;
    background: #f9f9f9;
    border-radius: 4px;
    transition: all 0.3s ease;
}

.aarong-mega-footer a:hover {
    color: #fff !important;
    background: #f15922; /* থিম কালার */
    box-shadow: 0 4px 10px rgba(241, 89, 34, 0.2);
}

.aarong-mega-footer a i {
    transition: transform 0.3s;
}

.aarong-mega-footer a:hover i {
    transform: translateX(5px);
}

        @media (max-width: 991px) {

            .user-account .dropdown-menu {
                position: static;
                float: none;
                width: 100%;
                margin-top: 10px;
                box-shadow: none;
                border: none;
                background: rgba(255, 255, 255, 0.9);
            }

            .user-account {
                margin-left: 0;
                margin-top: 10px;
            }

            .user-account .dropdown-toggle,
            .login-btn {
                justify-content: center;
                padding: 12px 15px;
            }

            .user-account .user-name {
                max-width: 200px;
            }

            .user-account .dropdown-toggle:hover {
                background: rgba(255, 255, 255, 0.1) !important;
                color: #333 !important;
                transform: none !important;
                box-shadow: none !important;
            }
        }

        .cart-count {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        .categori-dropdown-item ul li {
            position: relative;
        }

        .categori-dropdown-item ul li>a {
            display: flex !important;
            justify-content: space-around;
            align-items: center;
            transition: all 0.3s ease;
        }

        .categori-dropdown-item ul li>a i {
            font-size: 12px;
            color: #666;
            margin-left: 8px;
        }

        .subcategory-panel {
            visibility: hidden;
            opacity: 0;
            position: absolute;
            left: 100%;
            top: 0;
            width: 200px;
            background: #ffffff;
            border: 1px solid #eee;
            z-index: 1000;
            transition: all 0.2s ease-in-out;
            box-shadow: 5px 0 15px rgba(0, 0, 0, 0.05);
        }

        .categori-dropdown-item ul li:hover>.subcategory-panel {
            visibility: visible;
            opacity: 1;
        }

        .subcategory-list li a {
            font-size: 13px !important;
            color: #444 !important;
            display: block;
        }

        .subcategory-list li a:hover {
            color: #000000 !important;
        }

        .category-header {
            border-bottom: 1px solid #f1f1f1;
        }

        .menu-expand {
            cursor: pointer;
        }

        .subcategory-mobile-list li a {
            padding: 8px 0 !important;
            font-size: 13px !important;
            display: block;
            color: #666 !important;
        }

        @media (min-width: 992px) {
            .subcategory-mobile-list {
                display: none !important;
            }
            .subcategory-panel {
                display: block;
            }
        }

        @media (max-width: 991px) {
            .subcategory-panel {
                display: none !important;
            }
            .menu-expand {
                display: inline-block !important;
                color: #000000;
            }
            .subcategory-mobile-list {
                list-style: none;
                padding-left: 20px;
                background: #f9f9f9;
                margin: 5px 0;
            }
        }

        .categori-dropdown-item ul li .category-header a::after,
        .categori-dropdown-item ul li .category-header a::before {
            display: none !important;
        }

        .category-header a i {
            display: none !important;
        }

        .info h5 a {
            direction: ltr !important;
            unicode-bidi: embed;
        }

        .search-header-main {
            padding: 2px 0 !important;
        }

        .search-header-inner {
            padding: 0 !important;
            min-height: auto !important;
        }

        /* ============================================= */
        /* MOBILE STICKY COMPONENTS DESIGN TYPES */
        /* ============================================= */
        
        /* 💡 ডিফল্টভাবে সব ডিভাইসের জন্য সম্পূর্ণ হাইড (লুকানো) থাকবে */
        .mobile-floating-cart, 
        .mobile-bottom-nav {
            display: none !important;
        }

        /* 📱 শুধুমাত্র ৯৯১ পিক্সেল বা তার নিচের মোবাইল/ট্যাবলেট স্ক্রিনে এটি একটিভ হবে */
        @media (max-width: 991.98px) {
            
            /* ১. ভাসমান কার্ট বোতাম */
            .mobile-floating-cart {
                display: flex !important; /* মোবাইলে শো করবে */
                position: fixed;
                right: 0;
                top: 45%;
                transform: translateY(-50%);
                background: #ffffff;
                border: 1px solid #e2e8f0;
                border-right: none;
                border-top-left-radius: 8px;
                border-bottom-left-radius: 8px;
                box-shadow: -4px 4px 12px rgba(0,0,0,0.12);
                z-index: 999;
                flex-direction: column;
                align-items: center;
                width: 75px;
                padding: 8px 0;
                text-decoration: none !important;
                transition: all 0.2s ease;
            }
            .mobile-floating-cart .cart-icon-wrap {
                position: relative;
                background: #f15922;
                width: 36px;
                height: 36px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #fff;
                font-size: 16px;
                margin-bottom: 4px;
            }
            .mobile-floating-cart .cart-icon-wrap .badge {
                position: absolute;
                top: -6px;
                right: -6px;
                font-size: 10px;
                padding: 3px 6px;
                border-radius: 50%;
            }
            .mobile-floating-cart .cart-info-wrap {
                display: flex;
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
            .mobile-floating-cart .cart-info-wrap .item-text {
                font-size: 11px;
                color: #475569;
                font-weight: 500;
            }
            .mobile-floating-cart .cart-info-wrap .price-text {
                font-size: 13px;
                color: #f15922;
                font-weight: 700;
                margin-top: 1px;
            }

            /* ২. মোবাইল বটম নেভিগেশন বার */
            .mobile-bottom-nav {
                display: flex !important; /* মোবাইলে শো করবে */
                position: fixed;
                bottom: 0;
                left: 0;
                width: 100%;
                background: #ffffff;
                border-top: 1px solid #e2e8f0;
                height: 60px;
                z-index: 9998;
                box-shadow: 0 -4px 10px rgba(0,0,0,0.06);
            }
            .nav-item-box {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                color: #64748b;
                text-decoration: none !important;
                font-size: 11px;
                font-weight: 600;
                flex: 1;
                height: 100%;
                transition: all 0.2s ease;
            }
            .nav-item-box i {
                font-size: 18px;
                margin-bottom: 3px;
            }
            .nav-item-box.active {
                color: #f15922;
            }
            .nav-cart-count {
                position: absolute;
                top: 6px;
                right: 36%;
                font-size: 9px;
                padding: 2px 5px;
                border-radius: 50%;
                color: #fff;
            }
            
            body {
                padding-bottom: 60px !important;
            }
        }
    </style>

    <!-- Meta Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '1312696587708176');
    fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=1312696587708176&ev=PageView&noscript=1"
    /></noscript>
<!-- End Meta Pixel Code -->
</head>

<body>
    <div class="preloader">
        <div class="loader">
            <img src="{{ asset('assets/images/loader.gif') }}" alt="Loader">
        </div>
    </div>

    <header class="header-area">
        <div class="search-header-main">
            <div class="container">
                <div class="search-header-inner">
                    <div class="site-branding">
                        <a href="{{ route('home') }}" class="brand-logo">
                            <img src="{{ isset($siteSettings->site_logo) ? asset('uploads/settings/' . $siteSettings->site_logo) : asset('assets/images/logo/logo-main.png') }}"
                                alt="Logo" style="height: 100px; object-fit: contain;">
                        </a>
                    </div>
                    <div class="product-search-category">
                        <form action="{{ route('shops') }}" method="GET">
                            <select class="wide" name="category">
                                <option value="">All Categories</option>
                                {{-- 1. এখানে লুপ ক্র্যাশ প্রোটেকশন দেওয়া হয়েছে --}}
                                @foreach ($categories ?? [] as $category)
                                    <option value="{{ $category->id }}"
                                        {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }} ({{ $category->products_count }})
                                    </option>
                                @endforeach
                            </select>

                            <div class="form-group">
                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Enter Search Products">
                                <button class="search-btn">
                                    <i class="far fa-search"></i>
                                </button>
                            </div>
                        </form>

                    </div>
                    <div class="hotline-support item-rtl">
                        <div class="icon">
                            <i class="flaticon-support"></i>
                        </div>
                        <div class="info">
                            <span>24/7 Support</span>
                            <h5>
                                <a href="tel:{{ $siteSettings->site_phone ?? '+941234567894' }}" style="direction: ltr; display: inline-block;">
                                    {{ $siteSettings->site_phone ?? '+94 123 4567 894' }}
                                </a>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-navigation style-one">
            <div class="container">
                <div class="primary-menu">
                    <div class="site-branding d-lg-none d-block">
                        <a href="{{ route('home') }}" class="brand-logo">
                            <img src="{{ isset($siteSettings->site_logo) ? asset('uploads/settings/' . $siteSettings->site_logo) : asset('assets/images/logo/logo-main.png') }}"
                                alt="Logo" style="height: 70px; object-fit: contain;">
                        </a>
                    </div>
                    <div class="nav-inner-menu">
                        <div class="main-categories-wrap d-none d-lg-block">
                            <a class="categories-btn-active" href="#">
                                <span class="fas fa-list"></span><span class="text">Products Category<i
                                        class="fas fa-angle-down"></i></span>
                            </a>
                            <div class="categories-dropdown-wrap categories-dropdown-active">
                                <div class="categori-dropdown-item">
                                    <ul class="d-none d-lg-block">
                                        {{-- 2. এখানে লুপ ক্র্যাশ প্রোটেকশন দেওয়া হয়েছে --}}
                                        @foreach (collect($categories ?? [])->take(5) as $category)
                                            <li class="desktop-category-item">
                                                <a href="{{ route('shops', ['category' => $category->id]) }}">
                                                    <span>{{ $category->name }}</span>
                                                    <i class="fas fa-chevron-right"></i>
                                                </a>

                                                @if ($category->subcategories && $category->subcategories->count() > 0)
                                                    <div class="subcategory-panel">
                                                        <ul class="subcategory-list">
                                                            @foreach ($category->subcategories ?? [] as $sub)
                                                                <li>
                                                                    <a href="{{ route('shops', ['subcategory' => $sub->id]) }}">{{ $sub->name }}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>

                                    <ul class="d-lg-none">
                                        @foreach (collect($categories ?? [])->take(5) as $category)
                                            <li>
                                                <div class="category-header d-flex justify-content-between align-items-center">
                                                    <a href="{{ route('shops', ['category' => $category->id]) }}">{{ $category->name }}</a>
                                                    @if ($category->subcategories && $category->subcategories->count() > 0)
                                                        <span class="menu-expand"><i class="fas fa-chevron-down"></i></span>
                                                    @endif
                                                </div>

                                                @if ($category->subcategories && $category->subcategories->count() > 0)
                                                    <ul class="subcategory-mobile-list" style="display: none; padding-left: 20px; list-style: none;">
                                                        @foreach ($category->subcategories ?? [] as $sub)
                                                            <li style="padding: 5px 0;">
                                                                <a href="{{ route('shops', ['subcategory' => $sub->id]) }}" style="font-size: 13px; color: #666;">
                                                                    {{ $sub->name }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                                @if (isset($categories) && collect($categories)->count() > 5)
                                    <div class="more_slide_open">
                                        <div class="categori-dropdown-item">
                                            <ul>
                                                @foreach (collect($categories ?? [])->skip(5) as $category)
                                                    <li>
                                                        <a href="{{ route('shops', ['category' => $category->id]) }}">
                                                            {{ $category->name }}
                                                            <i class="fas fa-angle-right float-end mt-1" style="font-size: 12px; color: #ccc;"></i>
                                                        </a>
                                                        @if ($category->subcategories && $category->subcategories->count() > 0)
                                                            <div class="subcategory-panel">
                                                                <ul class="subcategory-list">
                                                                    @foreach ($category->subcategories ?? [] as $sub)
                                                                        <li><a href="{{ route('shops', ['subcategory' => $sub->id]) }}">{{ $sub->name }}</a></li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="more_categories"><span class="icon"></span> <span>Show more...</span></div>
                                @endif
                            </div>
                        </div>
                        <div class="pesco-nav-main">
                            <div class="pesco-nav-menu">
                                <div class="nav-search mb-40 d-block d-lg-none">
                                    <form action="{{ route('shops') }}" method="GET">
                                        <div class="form-group d-flex">
                                            <input type="search" class="form_control" placeholder="Search Here"
                                                name="search" value="{{ request('search') }}">
                                            <button class="search-btn" type="submit">
                                                <i class="far fa-search"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>

                                <div class="pesco-tabs style-three d-block d-lg-none">
                                    <ul class="nav nav-tabs mb-30" role="tablist">
                                        <li>
                                            <button class="nav-link active" data-bs-toggle="tab"
                                                data-bs-target="#nav1" role="tab">Menu</button>
                                        </li>
                                        <li>
                                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#nav2"
                                                role="tab">Category</button>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="nav1">
                                            <nav class="main-menu">
                                                <ul>
                                                    <li class="menu-item has-children"><a href="{{ route('home') }}">Home</a></li>
                                                    <li class="menu-item has-children"><a href="{{ route('shops') }}">Shop</a>
                                                        <ul class="sub-menu">
                                                            <li><a href="{{ route('shops') }}">Products List</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="menu-item"><a href="{{ route('about') }}">About Us</a></li>
                                                    <li class="menu-item"><a href="{{ route('faq') }}">FAQs</a></li>
                                                    <li class="menu-item"><a href="{{ route('contact') }}">Contact</a></li>
                                                </ul>
                                            </nav>
                                        </div>
                                        <div class="tab-pane fade" id="nav2">
                                            <div class="categori-dropdown-item">
                                                <ul class="d-lg-none">
                                                    @foreach (collect($categories ?? [])->take(5) as $category)
                                                        <li>
                                                            <div class="category-header d-flex justify-content-between align-items-center">
                                                                <a href="{{ route('shops', ['category' => $category->id]) }}">{{ $category->name }}</a>
                                                                @if ($category->subcategories && $category->subcategories->count() > 0)
                                                                    <span class="menu-expand"><i class="fas fa-chevron-down"></i></span>
                                                                @endif
                                                            </div>

                                                            @if ($category->subcategories && $category->subcategories->count() > 0)
                                                                <ul class="subcategory-mobile-list" style="display: none;">
                                                                    @foreach ($category->subcategories ?? [] as $sub)
                                                                        <li>
                                                                            <a href="{{ route('shops', ['subcategory' => $sub->id]) }}">
                                                                                {{ $sub->name }}
                                                                            </a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="hotline-support d-flex d-lg-none mt-30">
                                    <div class="icon">
                                        <i class="flaticon-support"></i>
                                    </div>
                                    <div class="info">
                                        <span>24/7 Support</span>
                                        <h5>
                                            <a href="tel:{{ $siteSettings->site_phone ?? '+941234567894' }}" style="direction: ltr; display: inline-block;">
                                                {{ $siteSettings->site_phone ?? '+94 123 4567 894' }}
                                            </a>
                                        </h5>
                                    </div>
                                </div>

                                <nav class="main-menu d-none d-lg-block">
                                    <ul>
                                        <li class="menu-item has-children"><a href="{{ route('home') }}">Home</a></li>

                                        <li class="menu-item has-children aarong-shop-wrapper">
                                            <a href="{{ route('shops') }}" class="shop-main-link">Shop </a>

                                            <div class="aarong-mega-menu">
                                                <div class="aarong-mega-grid">
                                                    @foreach (collect($categories ?? [])->take(5) as $category)
                                                        <div class="aarong-mega-column arong-col">
                                                            <a href="{{ route('shops', ['category' => $category->id]) }}" class="aarong-cat-heading">
                                                                {{ $category->name }}
                                                            </a>

                                                            @if ($category->subcategories && $category->subcategories->count() > 0)
                                                                <ul class="aarong-subcat-list">
                                                                    @foreach ($category->subcategories ?? [] as $sub)
                                                                        <li>
                                                                            <a href="{{ route('shops', ['subcategory' => $sub->id]) }}">
                                                                                {{ $sub->name }}
                                                                            </a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <div class="aarong-mega-footer">
                                                    <a href="{{ route('shops') }}">View All Collections <i class="fas fa-arrow-right ms-1"></i></a>
                                                </div>
                                            </div>
                                        </li>

                                        <li><a href="{{ route('about') }}">About Us</a></li>
                                        <li><a href="{{ route('faq') }}">FAQs</a></li>
                                        <li class="menu-item"><a href="{{ route('contact') }}">Contact</a></li>

                                        @if(isset($currencySettings) && $currencySettings->currency_mode === 'double')
                                            @php
                                                $primarySymbol = \App\Models\CurrencySetting::getCurrencySymbol($currencySettings->primary_currency);
                                                $secondarySymbol = \App\Models\CurrencySetting::getCurrencySymbol($currencySettings->secondary_currency);
                                            @endphp
                                            <li class="menu-item has-children">
                                                <a href="#">
                                                    {{ $selectedCurrency === $currencySettings->primary_currency ? $primarySymbol : $secondarySymbol }}
                                                    {{ $selectedCurrency }}
                                                </a>
                                                <ul class="sub-menu">
                                                    <li>
                                                        <a href="{{ route('currency.switch', $currencySettings->primary_currency) }}"
                                                            class="{{ $selectedCurrency == $currencySettings->primary_currency ? 'active' : '' }}">
                                                            <i class="fas fa-check me-2 {{ $selectedCurrency == $currencySettings->primary_currency ? '' : 'invisible' }}"></i>
                                                            {{ $primarySymbol }} {{ $currencySettings->primary_currency }}
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('currency.switch', $currencySettings->secondary_currency) }}"
                                                            class="{{ $selectedCurrency == $currencySettings->secondary_currency ? 'active' : '' }}">
                                                            <i class="fas fa-check me-2 {{ $selectedCurrency == $currencySettings->secondary_currency ? '' : 'invisible' }}"></i>
                                                            {{ $secondarySymbol }} {{ $currencySettings->secondary_currency }}
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                        @endif
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="nav-right-item style-one">
                        <ul>
                            <li>
                                <div class="cart-button d-flex align-items-center">
                                    <div class="icon">
                                        <a href="{{ route('cart') }}">
                                            <i class="fas fa-shopping-bag"></i>
                                            {{-- কার্ট ভেরিয়েবল মিসিং থাকলেও এরর খাবে না --}}
                                            <span class="pro-count cart-count"> {{ $cartCount ?? 0 }}</span>
                                        </a>
                                    </div>
                                </div>
                            </li>

                            <li>
                                @auth
                                    <div class="user-account dropdown">
                                        <a href="#" class="dropdown-toggle d-flex align-items-center"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <div class="user-avatar">
                                                {{ substr($currentUser->name ?? 'U', 0, 1) }}
                                            </div>
                                            <div class="user-name d-none d-lg-block">
                                                {{ $currentUser->name ?? 'User' }}
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <div class="px-3 py-2 mb-2 text-center border-bottom">
                                                <div class="user-avatar mx-auto mb-2"
                                                    style="width: 40px; height: 40px; font-size: 16px;">
                                                    {{ substr($currentUser->name ?? 'U', 0, 1) }}
                                                </div>
                                                <h6 class="mb-0">{{ $currentUser->name ?? '' }}</h6>
                                                <small class="text-muted">{{ $currentUser->email ?? '' }}</small>
                                            </div>
                                            <a class="dropdown-item" href="{{ route('profile') }}">
                                                <i class="fas fa-user me-2"></i>My Profile
                                            </a>
                                            <a class="dropdown-item" href="{{ route('cart') }}">
                                                <i class="fas fa-shopping-bag me-2"></i>My Cart
                                            </a>
                                            <a class="dropdown-item" href="{{ route('wishlist') }}">
                                                <i class="fas fa-heart me-2"></i>My Wishlist
                                            </a>
                                            <a class="dropdown-item" href="{{ route('user.orders') }}">
                                                <i class="fas fa-box me-2"></i>My Orders
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <form method="POST" action="{{ route('user.logout') }}">
                                                @csrf
                                                <button type="submit" class="dropdown-item text-danger">
                                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @else
                                    <a href="{{ route('login') }}" class="login-btn">
                                        <i class="far fa-user"></i>
                                        <span class="d-none d-lg-inline ms-1">Login</span>
                                    </a>
                                @endauth
                            </li>
                        </ul>
                        <div class="navbar-toggler d-block d-lg-none">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
   

    <a href="{{ route('cart') }}" class="mobile-floating-cart d-lg-none">
        <div class="cart-icon-wrap">
            <i class="fas fa-shopping-bag"></i>
            <span class="badge cart-count bg-danger text-white">
                {{ session()->has('cart') ? count(session()->get('cart')) : 0 }}
            </span>
        </div>
        <div class="cart-info-wrap">
            <span class="item-text"><span class="cart-count">{{ session()->has('cart') ? count(session()->get('cart')) : 0 }}</span> Items</span>
            <span class="price-text">৳<span class="pro-total-amount">{{ session()->has('cart') ? array_sum(array_column(session()->get('cart'), 'total_price')) : '0.00' }}</span></span>
        </div>
    </a>

    <div class="mobile-bottom-nav d-flex d-lg-none justify-content-around align-items-center">
        <a href="{{ url('/') }}" class="nav-item-box {{ Request::is('/') ? 'active' : '' }}">
            <i class="fas fa-home"></i>
            <span>HOME</span>
        </a>
        <a href="javascript:void(0)" class="nav-item-box mobile-menu-trigger-btn">
            <i class="fas fa-th-large"></i>
            <span>MENU</span>
        </a>
        <a href="{{ route('cart') }}" class="nav-item-box position-relative {{ Request::is('cart*') ? 'active' : '' }}">
            <i class="fas fa-shopping-cart"></i>
            <span class="badge nav-cart-count cart-count bg-danger">
                {{ session()->has('cart') ? count(session()->get('cart')) : 0 }}
            </span>
            <span>CART</span>
        </a>
        <a href="{{ route('shops') }}?search=1" class="nav-item-box">
            <i class="fas fa-search"></i>
            <span>SEARCH</span>
        </a>
        @auth
        <a href="{{ route('profile') }}" class="nav-item-box {{ Request::is('profile*') ? 'active' : '' }}">
            <i class="fas fa-user"></i>
            <span>ACCOUNT</span>
        </a>
        @else
            <a href="{{ route('login') }}" class="nav-item-box {{ Request::is('login*') ? 'active' : '' }}">
                <i class="fas fa-user"></i>
                <span>ACCOUNT</span>
            </a>
        @endauth
    </div>

    
    
    <main class="main-bg">
        @yield('content')
    </main>

    <footer class="footer-main">
        <div class="footer-bg-wrapper gray-bg">
            <div class="footer-shape shape-one"><span><img src="{{ url('assets/images/footer/shape-1.png') }}" alt="shape"></span></div>
            <svg id="footer-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1920 75" fill="none">
                <path d="M1888.99 40.9061C1901.65 33.5506 1917.87 10.0999 1920 0.000160217L2.48878 0.110695C-18.5686 5.37782 100.829 31.8098 104.136 32.5745C126.908 37.8407 182.163 45.7157 196.02 59.5798C199.049 62.6106 214.802 72.2205 222.15 72.2205C228.696 72.2205 237.893 62.3777 241.388 59.5798C254.985 48.6964 317.621 62.748 338.154 55.5577C378.089 41.5729 396.6 21.3246 452.148 27.4033C469.55 29.3076 497.787 39.4201 516.467 36.022C529.695 33.6155 539.612 26.7953 554.369 23.9558C576.978 19.6057 584.786 12.6555 612.371 13.0388C629.18 13.2724 648.084 27.6499 658.6 33.8673C672.059 41.8242 673.268 47.0554 692.77 41.4805C711.954 35.9964 746.756 38.27 766.852 40.0441C779.483 41.1593 819.866 52.3111 831.458 47.8009C837.236 45.5528 840.64 43.5162 847.537 41.3369C869.486 34.402 905.397 34.0022 929.946 38.6077C947.224 41.8489 987.666 45.9365 999.721 52.9722C1005.16 56.1489 1004.78 60.6539 1010.35 63.6019C1018.09 67.7037 1021.56 68.3083 1029.01 67.4803C1042.77 65.9505 1045.29 61.7272 1056.86 58.1434C1090.94 47.59 1121.71 32.7536 1160.52 26.5415C1182.98 22.9457 1193.92 36.1401 1209.04 41.4806C1240.16 52.468 1262.92 57.9972 1299.78 49.2374C1331.73 41.6466 1369.13 23.3813 1405.73 23.3813C1419.55 23.3813 1427.96 32.734 1435.31 37.4585C1451.38 47.7919 1467 56.9943 1493.89 56.9943C1532.36 56.9943 1544.2 49.9853 1574.29 39.0386C1588.58 33.8384 1616.86 22.826 1635.73 23.3813C1651.4 23.8424 1656.97 43.603 1667.89 48.6629C1683.26 55.7835 1710.61 49.5903 1723.88 43.7789C1736.22 38.3771 1758.43 20.6985 1777.29 30.1327C1788.48 35.7274 1794.71 53.9926 1801.12 61.5909C1815.62 78.7687 1819.96 77.5598 1843.05 68.4859C1861.58 61.2028 1873.63 49.8315 1888.99 40.9061Z" fill="#FFFAF3" />
            </svg>
            <div class="footer-widget-area pb-80">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-3 col-sm-6">
                            <div class="footer-widget about-company-widget mb-40" data-aos="fade-up" data-aos-delay="10" data-aos-duration="1000">
                                <div class="widget-content">
                                    <img src="{{ isset($siteSettings->site_logo) ? asset('uploads/settings/' . $siteSettings->site_logo) : asset('assets/images/logo/logo-main.png') }}"
                                        alt="{{ $siteSettings->site_name ?? config('app.name') }} Logo" style="height: 100px; object-fit: contain;">
                                    <p>100% organic products</p>
                                    <ul class="ct-info-list mb-30">
                                        <li>
                                            <i class="fas fa-envelope"></i>
                                            <a href="mailto:info@mydomain.com">annoghor@gmail.com</a>
                                        </li>
                                        <li>
                                            <i class="fas fa-phone-alt"></i>
                                            <a href="tel:+880170090059">0170090059</a>
                                        </li>
                                    </ul>
                                    <ul class="social-link">
                                        <li><span>Find Us:</span></li>
                                        @if (isset($siteSettings) && $siteSettings->facebook_url)
                                            <li><a href="{{ $siteSettings->facebook_url }}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                        @endif
                                        @if (isset($siteSettings) && $siteSettings->instagram_url)
                                            <li><a href="{{ $siteSettings->instagram_url }}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                        @endif
                                        @if (isset($siteSettings) && $siteSettings->linkedin_url)
                                            <li><a href="{{ $siteSettings->linkedin_url }}" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                                        @endif
                                        @if (isset($siteSettings) && $siteSettings->twitter_url)
                                            <li><a href="{{ $siteSettings->twitter_url }}" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-sm-6">
                            <div class="footer-widget footer-nav-widget mb-40" data-aos="fade-up" data-aos-delay="15" data-aos-duration="1200">
                                <div class="widget-content">
                                    <h4 class="widget-title">Customer Services</h4>
                                    <ul class="widget-menu">
                                        <li><img src="{{ url('assets/images/icon/star-3.svg') }}" alt="star icon"><a href="#">Collections & Delivery</a></li>
                                        <li><img src="{{ url('assets/images/icon/star-3.svg') }}" alt="star icon"><a href="{{ route("returns") }}">Returns & Refunds</a></li>
                                        <li><img src="{{ url('assets/images/icon/star-3.svg') }}" alt="star icon"><a href="{{ route('terms') }}">Terms & Conditions</a></li>
                                        <li><img src="{{ url('assets/images/icon/star-3.svg') }}" alt="star icon"><a href="{{ route('delivery.return') }}">Delivery Return</a></li>
                                        <li><img src="{{ url('assets/images/icon/star-3.svg') }}" alt="star icon"><a href="#">Store Locations</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-sm-6">
                            <div class="footer-widget footer-nav-widget mb-40" data-aos="fade-up" data-aos-delay="20" data-aos-duration="1400">
                                <div class="widget-content">
                                    <h4 class="widget-title">Quick Link</h4>
                                    <ul class="widget-menu">
                                        <li><img src="{{ url('assets/images/icon/star-3.svg') }}" alt="star icon"><a href="{{ route('privacy.policy') }}">Privacy Policy</a></li>
                                        <li><img src="{{ url('assets/images/icon/star-3.svg') }}" alt="star icon"><a href="{{ route('terms.of.use') }}">Terms Of Use</a></li>
                                        <li><img src="{{ url('assets/images/icon/star-3.svg') }}" alt="star icon"><a href="{{ route('faq') }}">FAQ</a></li>
                                        <li><img src="{{ url('assets/images/icon/star-3.svg') }}" alt="star icon"><a href="{{ route('contact') }}">Contact</a></li>
                                        <li><img src="{{ url('assets/images/icon/star-3.svg') }}" alt="star icon"><a href="{{ route('login') }}">Login / Register</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6">
                            <div class="footer-widget footer-recent-post-widget" data-aos="fade-up" data-aos-delay="25" data-aos-duration="1600">
                                <h4 class="widget-title">Working Hours</h4>
                                <div class="widget-content working-hours">
                                    <div class="hour-item">
                                        <span class="day">7 days</span>
                                        <span class="time">24 hours</span>
                                    </div>
                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copyright-area">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="copyright-text">
                                <p>&copy; 2026. All rights reserved by <span>AnnoGhor</span></p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="payment-method text-lg-end">
                                 <p>Design & Development by <span> <a ‍style="color: #5a3e2b;" href="https://www.innovatechbd.net/" target="_blank">InnovaTech</a></span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer><div class="back-to-top"><i class="far fa-angle-up"></i></div>

    <script src="{{ asset('assets/vendor/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/popper/popper.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/vendor/slick/slick.min.js') }}"></script> --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="{{ asset('assets/vendor/magnific-popup/dist/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/nice-select/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/simplyCountdown.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/js/theme.js') }}"></script>

    <script>
        $(document).ready(function() {
            // User dropdown animation
            $('.user-account .dropdown-toggle').on('click', function() {
                $(this).toggleClass('active');
            });

            function updateCartCount() {
                $.get('{{ route('cart.count') }}', function(data) {
                    if (data.count !== undefined) {
                        $('.pro-count.cart-count').text(data.count);
                    }
                });
            }

            // Initialize cart count
            updateCartCount();

            // Mobile menu user section
            $('.navbar-toggler').on('click', function() {
                $('.user-account').toggleClass('mobile-visible');
            });

            $('.mobile-menu-trigger-btn').on('click', function(e) {
                e.preventDefault();
                
                // থিমের মেইন মোবাইল নেভিগেশন টগলার বোতামটিকে অটো-ক্লিক (Trigger) করাবে
                $('.navbar-toggler').trigger('click'); 
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Mobile Category Toggle Logic
            $('.menu-expand, .category-header a').on('click', function(e) {
                if ($(e.target).closest('.menu-expand').length > 0) {
                    e.preventDefault();
                    var $header = $(this).closest('.category-header');
                    var $submenu = $header.next('.subcategory-mobile-list');

                    $submenu.slideToggle(300);
                    $header.find('.menu-expand i').toggleClass('fa-chevron-down fa-chevron-up');
                }
            });

            @auth
                loadWishlistStatus();
                updateWishlistCount();
            @endauth

            // ✅ Toggle Wishlist
            $(document).on('click', '.toggle-wishlist', function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();

                const productId = $(this).data('product-id');
                const $btn = $(this);
                const $icon = $btn.find('i');

                $btn.css('pointer-events', 'none');

                $.ajax({
                    url: '{{ route('wishlist.toggle') }}',
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
                        } else {
                            showNotification(response.message, 'warning');
                        }
                        $btn.css('pointer-events', '');
                    },
                    error: function(xhr) {
                        if (xhr.status === 401) {
                            window.location.href = '{{ route('login') }}';
                        } else {
                            showNotification('Error updating wishlist', 'danger');
                        }
                        $btn.css('pointer-events', '');
                    }
                });
            });

            // ✅ Load wishlist status
            function loadWishlistStatus() {
                $.ajax({
                    url: '{{ route('wishlist.product-ids') }}',
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

            // ✅ Update wishlist count
            function updateWishlistCount() {
                $.ajax({
                    url: '{{ route('wishlist.count') }}',
                    method: 'GET',
                    success: function(response) {
                        if (response.count !== undefined) {
                            $('.wishlist-count, .pro-count.wishlist-count').text(response.count);
                        }
                    }
                });
            }

            // ✅ Notification Function
            function showNotification(message, type = 'success') {
                $('.custom-notification').remove();

                const notification = $('<div>', {
                    class: `custom-notification alert alert-${type} alert-dismissible fade show`,
                    html: `
                        ${message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    `
                });

                $('body').prepend(notification);

                setTimeout(function() {
                    notification.fadeOut(300, function() {
                        $(this).remove();
                    });
                }, 3000);
            }
        });
    </script>
    @stack('scripts')
</body>

</html>