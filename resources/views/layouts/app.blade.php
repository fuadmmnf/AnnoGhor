<!DOCTYPE html>
<html lang="zxx">

<head>
    <!--====== Required meta tags ======-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="eCommerce,shop,fashion">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--====== Title ======-->
    <title>@yield('title', 'Ecommerce App')</title>
    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/png">
    <!--====== Google Fonts ======-->
    <link
        href="https://fonts.googleapis.com/css2?family=Aoboshi+One&family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
        rel="stylesheet">
    <!--====== Flaticon css ======-->
    <link rel="stylesheet" href="{{ asset('assets/fonts/flaticon/flaticon_pesco.css') }}">
    <!--====== FontAwesome css ======-->
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome/css/all.min.css') }}">
    <!--====== Bootstrap css ======-->
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!--====== Slick-popup css ======-->
    <link rel="stylesheet" href="{{ asset('assets/vendor/slick/slick.css') }}">
    <!--====== Nice Select css ======-->
    <link rel="stylesheet" href="{{ asset('assets/vendor/nice-select/css/nice-select.css') }}">
    <!--====== Magnific-popup css ======-->
    <link rel="stylesheet" href="{{ asset('assets/vendor/magnific-popup/dist/magnific-popup.css') }}">
    <!--====== Jquery UI css ======-->
    <link rel="stylesheet" href="{{ asset('assets/vendor/jquery-ui/jquery-ui.min.css') }}">
    <!--====== Animate css ======-->
    <link rel="stylesheet" href="{{ asset('assets/vendor/aos/aos.css') }}">
    <!--====== Default css ======-->
    <link rel="stylesheet" href="{{ asset('assets/css/default.css') }}">
    <!--====== Style css ======-->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <!-- User Account Custom CSS -->
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

              

        /* =========================================
        PROFESSIONAL SHOP MEGA MENU (DESKTOP)
        ========================================= */
        .custom-shop-wrapper {
            position: relative;
        }

        /* ১ম ধাপ: "Shop" এ মাউস রাখলে যে বক্স নামবে */
        .shop-mega-dropdown {
            position: absolute;
            top: 100%;
            left: -20px; /* আপনার কথামতো বাম থেকে একটু মার্জিন দেওয়া হয়েছে */
            width: 260px; /* ক্যাটাগরি লিস্টের চওড়া */
            background: #fff;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            border-top: 2px solid #3BB77E; /* আপনার ওয়েবসাইটের থিম কালার */
            visibility: hidden;
            opacity: 0;
            transition: all 0.3s ease;
            z-index: 999;
            border-radius: 0 0 8px 8px;
        }

        .custom-shop-wrapper:hover .shop-mega-dropdown {
            visibility: visible;
            opacity: 1;
            transform: translateY(5px); /* স্মুথভাবে নিচে নামবে */
        }

        .shop-cat-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .shop-cat-item {
            position: relative; /* সাব-ক্যাটাগরি প্যানেলের জন্য জরুরি */
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

        /* ২য় ধাপ: ক্যাটাগরিতে মাউস রাখলে ডান পাশের বড় প্যানেল */
        .shop-subcat-panel {
            position: absolute;
            left: 100%; /* ঠিক ডান পাশ থেকে শুরু হবে */
            top: 0;
            width: 600px; /* Aarong এর মতো বড় প্যানেল */
            min-height: 100%;
            background: #fff;
            box-shadow: 5px 5px 20px rgba(0,0,0,0.08);
            border-left: 1px solid #eee;
            padding: 30px;
            visibility: hidden;
            opacity: 0;
            transform: translateX(10px); /* এনিমেশনের জন্য */
            transition: all 0.3s ease;
            z-index: 1000;
            border-radius: 0 8px 8px 0;
        }

        .shop-cat-item:hover .shop-subcat-panel {
            visibility: visible;
            opacity: 1;
            transform: translateX(0);
        }

        /* প্যানেলের ভেতরের ডিজাইন */
        .panel-title {
            font-size: 18px;
            font-weight: 700;
            color: #222;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f1f1f1;
            text-transform: uppercase;
        }

        /* সাব-ক্যাটাগরিগুলোকে গ্রিড (কলাম) আকারে সাজানো */
        .panel-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* ৩টি কলামে ভাগ করা হয়েছে */
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
            padding-left: 8px !important; /* হোভার করলে হালকা ডানে সরবে */
            font-weight: 500;
        }

        /* =========================================
        AARONG STYLE HORIZONTAL MEGA MENU
        ========================================= */

        /* মেনুর প্যারেন্ট ক্লাস */
        .aarong-shop-wrapper {
            position: relative;
        }

        /* বড় সাদা বক্সটি (Mega Menu Panel) */
        .aarong-mega-menu {
            position: absolute;
            top: 100%;
            left: -250px; 
            width: 850px; 
            background-color: #ffffff;
            box-shadow: 0 15px 40px rgba(0,0,0,0.08);
            
            /* border-top: 2px solid #222; <--- এই লাইনটি মুছে দেওয়া হয়েছে */
            
            padding: 35px 40px;
            visibility: hidden;
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            z-index: 9999;
            border-radius: 6px; /* এখন সবদিকে সমান সুন্দর রাউন্ড হবে */
        }

        /* Hover করলে বক্স নামবে */
        .aarong-shop-wrapper:hover .aarong-mega-menu {
            visibility: visible;
            opacity: 1;
            transform: translateY(0);
        }

        /* ক্যাটাগরিগুলোকে পাশাপাশি সাজানোর গ্রিড */
        .aarong-mega-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr); /* ৫টি সমান কলাম */
            gap: 20px; /* কলামগুলোর মাঝখানের ফাঁকা জায়গা */
        }

        /* ক্যাটাগরি হেডিং (Horizontal Items) */
        .aarong-cat-heading {
            display: block;
            font-family: 'DM Sans', sans-serif !important; /* মডার্ন ফন্ট */
            font-size: 14px;
            font-weight: 700;
            color: #111 !important;
            text-transform: uppercase; /* সব বড় হাতের অক্ষর */
            letter-spacing: 0.5px;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eaeaea; /* নিচে হালকা দাগ */
            text-decoration: none;
            transition: color 0.2s;
        }

        .aarong-cat-heading:hover {
            color: #3BB77E !important; /* থিম কালার */
        }

        /* সাব-ক্যাটাগরি লিস্ট (Vertical Items) */
        .aarong-subcat-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .aarong-subcat-list li {
            margin-bottom: 0; /* প্রতিটি লাইনের মাঝে ফাঁকা */
            padding: 0 !important;
        }

        .aarong-subcat-list li a {
            display: block;
            font-family: 'DM Sans', sans-serif !important;
            font-size: 14px;
            color: #555 !important;
            text-decoration: none;
            transition: all 0.2s ease;
            text-transform: capitalize;
            padding: 5px 0 !important; /* লেখার প্যাডিংও কমিয়ে দিলাম যাতে আরও কাছাকাছি থাকে */
        }

        /* সাব-ক্যাটাগরিতে Hover ইফেক্ট */
        .aarong-subcat-list li a:hover {
            color: #3BB77E !important;
            padding-left: 5px; /* মাউস নিলে হালকা ডানে সরবে */
            font-weight: 500;
        }

        /* ফুটার বাটন (View All) */
        .aarong-mega-footer {
            margin-top: 30px;
            padding-top: 20px;
            text-align: center;
            border-top: 1px solid #f0f0f0;
        }

        .aarong-mega-footer a {
            font-family: 'DM Sans', sans-serif !important;
            font-size: 13px;
            font-weight: 700;
            color: #222 !important;
            text-transform: uppercase;
            text-decoration: none;
            letter-spacing: 1px;
            transition: color 0.2s;
        }

        .aarong-mega-footer a:hover {
            color: #3BB77E !important;
            text-decoration: underline;
        }

        /* --- থিমের ডিফল্ট ডিজাইন ওভাররাইড করার জন্য ফিক্স --- */

        /* ১. সাব-ক্যাটাগরিগুলোকে জোর করে নিচে নিচে (Vertical) আনা */
        .aarong-mega-menu .aarong-subcat-list li {
            display: block !important;
            width: 100% !important;
            float: none !important; 
            clear: both !important;
            margin-bottom: 4px !important;
        }

        .aarong-mega-menu .aarong-subcat-list li a {
            display: block !important;
            width: 100% !important;
            padding: 2px 0 !important;
        }

        /* ২. ক্যাটাগরি হেডিংয়ের পাশের অপ্রয়োজনীয় অ্যারো (v) লুকানো */
        .aarong-mega-column .aarong-cat-heading i,
        .aarong-mega-column .aarong-cat-heading::after,
        .aarong-mega-column .aarong-cat-heading::before {
            display: none !important;
            content: none !important;
        }

        /* ৩. ক্যাটাগরি হেডিং এর ডিজাইন ফিক্স (যাতে লম্বা শব্দ না ভাঙে) */
        .aarong-mega-column .aarong-cat-heading {
            display: block !important;
            word-break: break-word !important; 
            white-space: normal !important;
            padding-right: 0 !important; /* থিমের ডিফল্ট প্যাডিং বাতিল */
        }

        /* সাব-ক্যাটাগরি লিস্টের ডিফল্ট স্পেসিং জিরো করা */
        .aarong-subcat-list {
            list-style: none !important;
            padding-left: 0 !important; /* থিমের বাম পাশের প্যাডিং মুছতে */
            margin-left: 0 !important;  /* থিমের বাম পাশের মার্জিন মুছতে */
        }

        .aarong-subcat-list li {
            padding-left: 0 !important;
            margin-left: 0 !important;
        }

        /* সাব-ক্যাটাগরির লিংকের এলাইনমেন্ট ঠিক করা */
        .aarong-mega-menu .aarong-subcat-list li a {
            display: block !important;
            width: 100% !important;
            padding: 2px 0 !important; /* বামে এবং ডানে 0 প্যাডিং */
            margin-left: 0 !important;
            text-align: left !important; /* লেখা একদম বাম থেকে শুরু হবে */
        }

        /* Hover ইফেক্টে যদি ডানে সরাতে না চান, তাহলে নিচের কোডটিও আপডেট করে দিন */
        .aarong-subcat-list li a:hover {
            color: #3BB77E !important;
            padding-left: 0 !important; /* আগের কোডে 5px ছিল, সেটা 0 করে দিলাম যাতে না নড়ে */
            font-weight: 500;
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

        /* Cart Count Badge Animation */
        .cart-count {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
            }
        }

        /* Mega Menu Styling */
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

        /* Subcategory Panel*/
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

        /* Mobile view styling */
        @media (max-width: 991px) {
            .subcategory-panel {
                display: none !important;
            }

            /* Desktop panel bondho */
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
        /* Category name er sathe thaka extra dropdown icon remove korar jonno */
.categori-dropdown-item ul li .category-header a::after, 
.categori-dropdown-item ul li .category-header a::before {
    display: none !important;
}

/* Jodi anchor tag er bhetorei icon thake */
.category-header a i {
    display: none !important;
}

/* hotline support er nicher contact number er jonno */
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
    </style>
</head>

<body>
    <!--====== Preloader ======-->
    <div class="preloader">
        <div class="loader">
            <img src="{{ asset('assets/images/loader.gif') }}" alt="Loader">
        </div>
    </div>

    <!--====== Start Header Section ======-->
    <header class="header-area">
        <!--===  Search Header Main  ===-->
        <div class="search-header-main">
            <div class="container">
                <!--===  Search Header Inner  ===-->
                <div class="search-header-inner">
                    <!--=== Site Branding  ===-->
                    <div class="site-branding">
                        <a href="{{ route('home') }}" class="brand-logo">
                            <img src="{{ isset($siteSettings->site_logo) ? asset('uploads/settings/' . $siteSettings->site_logo) : asset('assets/images/logo/logo-main.png') }}"
                                alt="Logo" style="height: 100px; object-fit: contain;">
                        </a>
                    </div>
                    <!--===  Product Search Category  ===-->
                    <div class="product-search-category">
                        <form action="{{ route('shops') }}" method="GET">
                            <select class="wide" name="category">
                                <option value="">All Categories</option>
                                @foreach ($categories as $category)
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
                    <!--===  Hotline Support  ===-->
                    <div class="hotline-support item-rtl">
                        <div class="icon">
                            <i class="flaticon-support"></i>
                        </div>
                        <div class="info">
    <span>24/7 Support</span>
    <h5>
        {{-- style add kora hoyeche jeno '+' sign shurute thake --}}
        <a href="tel:{{ $siteSettings->site_phone ?? '+941234567894' }}" style="direction: ltr; display: inline-block;">
            {{ $siteSettings->site_phone ?? '+94 123 4567 894' }}
        </a>
    </h5>
</div>
                    </div>
                </div>
            </div>
        </div>
        <!--===  Header Navigation  ===-->
        <div class="header-navigation style-one">
            <div class="container">
                <!--=== Primary Menu ===-->
                <div class="primary-menu">
                    <div class="site-branding d-lg-none d-block">
                        <a href="{{ route('home') }}" class="brand-logo">
                            <img src="{{ isset($siteSettings->site_logo) ? asset('uploads/settings/' . $siteSettings->site_logo) : asset('assets/images/logo/logo-main.png') }}"
                                alt="Logo" style="height: 70px; object-fit: contain;">
                        </a>
                    </div>
                    <!--=== Nav Inner Menu ===-->
                    <div class="nav-inner-menu">
                        <!--=== Main Category ===-->
                        <div class="main-categories-wrap d-none d-lg-block">
                            <a class="categories-btn-active" href="#">
                                <span class="fas fa-list"></span><span class="text">Products Category<i
                                        class="fas fa-angle-down"></i></span>
                            </a>
                            <div class="categories-dropdown-wrap categories-dropdown-active">
                                <div class="categori-dropdown-item">
                                    <ul class="d-none d-lg-block">
                                        @foreach ($categories->take(5) as $category)
                                            <li class="desktop-category-item">
                                                <a href="{{ route('shops', ['category' => $category->id]) }}">
                                                    <span>{{ $category->name }}</span>
                                                    <i class="fas fa-chevron-right"></i>
                                                </a>

                                                @if ($category->subcategories->count() > 0)
                                                    <div class="subcategory-panel">
                                                        <ul class="subcategory-list">
                                                            @foreach ($category->subcategories as $sub)
                                                                <li>
                                                                    <a
                                                                        href="{{ route('shops', ['subcategory' => $sub->id]) }}">{{ $sub->name }}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>

                                    <ul class="d-lg-none">
                                        @foreach ($categories->take(5) as $category)
                                            <li>
                                                <div
                                                    class="category-header d-flex justify-content-between align-items-center">
                                                    <a
                                                        href="{{ route('shops', ['category' => $category->id]) }}">{{ $category->name }}</a>
                                                    @if ($category->subcategories->count() > 0)
                                                        <span class="menu-expand"><i
                                                                class="fas fa-chevron-down"></i></span>
                                                    @endif
                                                </div>

                                                @if ($category->subcategories->count() > 0)
                                                    <ul class="subcategory-mobile-list"
                                                        style="display: none; padding-left: 20px; list-style: none;">
                                                        @foreach ($category->subcategories as $sub)
                                                            <li style="padding: 5px 0;">
                                                                <a href="{{ route('shops', ['subcategory' => $sub->id]) }}"
                                                                    style="font-size: 13px; color: #666;">
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

                                @if ($categories->count() > 5)
                                    <div class="more_slide_open">
                                        <div class="categori-dropdown-item">
                                            <ul>
                                                @foreach ($categories->skip(5) as $category)
                                                    <li>
                                                        <a href="{{ route('shops', ['category' => $category->id]) }}">
                                                            {{ $category->name }}
                                                            <i class="fas fa-angle-right float-end mt-1"
                                                                style="font-size: 12px; color: #ccc;"></i>
                                                        </a>
                                                        @if ($category->subcategories && $category->subcategories->count() > 0)
                                                            <div class="subcategory-panel">
                                                                <ul class="subcategory-list">
                                                                    @foreach ($category->subcategories as $sub)
                                                                        <li><a
                                                                                href="{{ route('shops', ['subcategory' => $sub->id]) }}">{{ $sub->name }}</a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="more_categories"><span class="icon"></span> <span>Show
                                            more...</span></div>
                                @endif
                            </div>
                        </div>
                        <!--=== Pesco Nav Main ===-->
                        <div class="pesco-nav-main">
                            <!--=== Pesco Nav Menu ===-->
                            <div class="pesco-nav-menu">
                                <!--=== Responsive Menu Search ===-->
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

                                <!--=== Responsive Menu Tab ===-->
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
                                                    <li class="menu-item has-children"><a
                                                            href={{ route('home') }}>Home</a></li>
                                                    <li class="menu-item has-children"><a href={{ route('shops') }}>Shop</a>
                                                        <ul class="sub-menu">
                                                            <li><a href={{ route('shops') }}>Products List</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="menu-item"><a href={{ route('about') }}>About Us</a>
                                                    </li>
                                                    <li class="menu-item"><a href={{ route('faq') }}>FAQs</a>
                                                    </li>
                                                    <li class="menu-item"><a href={{ route('contact') }}>Contact</a>
                                                    </li>
                                                    <!-- Add this in navbar before user account section -->
                                                    @php
                                                        $primarySymbol = \App\Models\CurrencySetting::getCurrencySymbol(
                                                            $currencySettings->primary_currency,
                                                        );
                                                        $secondarySymbol = \App\Models\CurrencySetting::getCurrencySymbol(
                                                            $currencySettings->secondary_currency,
                                                        );
                                                    @endphp

                                                    <!-- Currency Switcher (Add before user account section) -->
                                                    @if ($currencySettings->currency_mode === 'double')
                                                        <li class="menu-item has-children">
                                                            <a href="#">


                                                                {{-- Selected currency symbol --}}
                                                                {{ $selectedCurrency === $currencySettings->primary_currency ? $primarySymbol : $secondarySymbol }}

                                                                {{ $selectedCurrency }}
                                                            </a>

                                                            <ul class="sub-menu">
                                                                <li>
                                                                    <a href="{{ route('currency.switch', $currencySettings->primary_currency) }}"
                                                                        class="{{ $selectedCurrency === $currencySettings->primary_currency ? 'active' : '' }}">
                                                                        <i
                                                                            class="fas fa-check me-2 {{ $selectedCurrency === $currencySettings->primary_currency ? '' : 'invisible' }}"></i>
                                                                        {{ $primarySymbol }}
                                                                        {{ $currencySettings->primary_currency }}
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a href="{{ route('currency.switch', $currencySettings->secondary_currency) }}"
                                                                        class="{{ $selectedCurrency === $currencySettings->secondary_currency ? 'active' : '' }}">
                                                                        <i
                                                                            class="fas fa-check me-2 {{ $selectedCurrency === $currencySettings->secondary_currency ? '' : 'invisible' }}"></i>
                                                                        {{ $secondarySymbol }}
                                                                        {{ $currencySettings->secondary_currency }}
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                    @endif

                                                </ul>
                                            </nav>
                                        </div>
                                        <div class="tab-pane fade" id="nav2">
                                            <div class="categori-dropdown-item">
                                                <ul class="d-lg-none">
                                                    @foreach ($categories->take(5) as $category)
                                                        <li>
                                                            <div
                                                                class="category-header d-flex justify-content-between align-items-center">
                                                                <a
                                                                    href="{{ route('shops', ['category' => $category->id]) }}">{{ $category->name }}</a>
                                                                @if ($category->subcategories->count() > 0)
                                                                    <span class="menu-expand"><i
                                                                            class="fas fa-chevron-down"></i></span>
                                                                @endif
                                                            </div>

                                                            @if ($category->subcategories->count() > 0)
                                                                <ul class="subcategory-mobile-list"
                                                                    style="display: none;">
                                                                    @foreach ($category->subcategories as $sub)
                                                                        <li>
                                                                            <a
                                                                                href="{{ route('shops', ['subcategory' => $sub->id]) }}">
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

                                <!--===  Hotline Support  ===-->
                                <div class="hotline-support d-flex d-lg-none mt-30">
    <div class="icon">
        <i class="flaticon-support"></i>
    </div>
    <div class="info">
        <span>24/7 Support</span>
        <h5>
            {{-- Mobile view-er jonnoo eki fix --}}
            <a href="tel:{{ $siteSettings->site_phone ?? '+941234567894' }}" style="direction: ltr; display: inline-block;">
                {{ $siteSettings->site_phone ?? '+94 123 4567 894' }}
            </a>
        </h5>
    </div>
</div>

                                <nav class="main-menu d-none d-lg-block">
                                    <ul>
                                        <li class="menu-item has-children"><a href="{{ route('home') }}">Home</a>
                                        </li>

                                        <!-- Shop Menu with Mega Menu -->
                                        <!-- Shop Menu with Mega Menu -->
                                        <li class="menu-item has-children aarong-shop-wrapper">
                                            <a href="{{ route('shops') }}" class="shop-main-link">Shop </a>

                                            <div class="aarong-mega-menu">
                                                <div class="aarong-mega-grid">
                                                    
                                                    @foreach ($categories->take(5) as $category)
                                                        <div class="aarong-mega-column arong-col">
                                                            <a href="{{ route('shops', ['category' => $category->id]) }}" class="aarong-cat-heading">
                                                                {{ $category->name }}
                                                            </a>
                                                            
                                                            @if ($category->subcategories->count() > 0)
                                                                <ul class="aarong-subcat-list">
                                                                    @foreach ($category->subcategories as $sub)
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



                                        <li>
                                            <a href="{{ route('about') }}">About Us</a>
                                        </li>

                                         <li>
                                            <a href="{{ route('faq') }}">FAQs</a>
                                        </li>

                                        <li class="menu-item"><a href="{{ route('contact') }}">Contact</a></li>
                                        <!-- Add this in navbar before user account section -->
                                        @php
                                            $primarySymbol = \App\Models\CurrencySetting::getCurrencySymbol(
                                                $currencySettings->primary_currency,
                                            );
                                            $secondarySymbol = \App\Models\CurrencySetting::getCurrencySymbol(
                                                $currencySettings->secondary_currency,
                                            );
                                        @endphp

                                        <!-- Currency Switcher (Add before user account section) -->
                                        @if ($currencySettings->currency_mode === 'double')
                                            <li class="menu-item has-children">
                                                <a href="#">


                                                    {{-- Selected currency symbol --}}
                                                    @if ($selectedCurrency === $currencySettings->primary_currency)
                                                        {{ $primarySymbol }}
                                                    @else
                                                        {{ $secondarySymbol }}
                                                    @endif

                                                    {{ $selectedCurrency }}
                                                </a>

                                                <ul class="sub-menu">
                                                    <li>
                                                        <a href="{{ route('currency.switch', $currencySettings->primary_currency) }}"
                                                            class="{{ $selectedCurrency == $currencySettings->primary_currency ? 'active' : '' }}">
                                                            <i
                                                                class="fas fa-check me-2 {{ $selectedCurrency == $currencySettings->primary_currency ? '' : 'invisible' }}"></i>
                                                            {{ $primarySymbol }}
                                                            {{ $currencySettings->primary_currency }}
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="{{ route('currency.switch', $currencySettings->secondary_currency) }}"
                                                            class="{{ $selectedCurrency == $currencySettings->secondary_currency ? 'active' : '' }}">
                                                            <i
                                                                class="fas fa-check me-2 {{ $selectedCurrency == $currencySettings->secondary_currency ? '' : 'invisible' }}"></i>
                                                            {{ $secondarySymbol }}
                                                            {{ $currencySettings->secondary_currency }}
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
                    <!--=== Nav Right Item ===-->
                    <div class="nav-right-item style-one">
                        <ul>
                            <li>
                                <div class="cart-button d-flex align-items-center">
                                    <div class="icon">
                                        <a href="{{ route('cart') }}">
                                            <i class="fas fa-shopping-bag"></i>
                                            <span class="pro-count cart-count"> {{ $cartCount }}</span>
                                        </a>
                                    </div>
                                </div>
                            </li>

                            <!-- User Account Section -->
                            <li>
                                @auth
                                    <div class="user-account dropdown">
                                        <a href="#" class="dropdown-toggle d-flex align-items-center"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <div class="user-avatar">
                                                {{ substr($currentUser->name, 0, 1) }}
                                            </div>
                                            <div class="user-name d-none d-lg-block">
                                                {{ $currentUser->name }}
                                            </div>
                                            {{-- <i class="fas fa-angle-down ms-1 d-none d-lg-block"></i> --}}
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <div class="px-3 py-2 mb-2 text-center border-bottom">
                                                <div class="user-avatar mx-auto mb-2"
                                                    style="width: 40px; height: 40px; font-size: 16px;">
                                                    {{ substr($currentUser->name, 0, 1) }}
                                                </div>
                                                <h6 class="mb-0">{{ $currentUser->name }}</h6>
                                                <small class="text-muted">{{ $currentUser->email }}</small>
                                            </div>
                                            <a class="dropdown-item" href="{{ route('profile') }}">
                                                <i class="fas fa-user me-2"></i>My Profile
                                            </a>
                                            <a class="dropdown-item" href="{{ route('cart') }}">
                                                <i class="fas fa-shopping-bag me-2"></i>My Cart
                                            </a>
                                            <a class="dropdown-item" href="{{ route('wishlist') }}">
                                                <i class="fas fa-heart" me-2"></i>My Wishlist
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
    </header><!--====== End Header Section ======-->
    <!--====== Main Bg  ======-->
    <main class="main-bg">
        @yield('content')
    </main>
    <!--====== Start Footer Main  ======-->
    <footer class="footer-main">
        <!--=== Footer Bg Wrapper  ===-->
        <div class="footer-bg-wrapper gray-bg">
            <div class="footer-shape shape-one"><span><img src="assets/images/footer/shape-1.png"
                        alt="shape"></span></div>
            <svg id="footer-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1920 75" fill="none">
                <path
                    d="M1888.99 40.9061C1901.65 33.5506 1917.87 10.0999 1920 0.000160217L2.48878 0.110695C-18.5686 5.37782 100.829 31.8098 104.136 32.5745C126.908 37.8407 182.163 45.7157 196.02 59.5798C199.049 62.6106 214.802 72.2205 222.15 72.2205C228.696 72.2205 237.893 62.3777 241.388 59.5798C254.985 48.6964 317.621 62.748 338.154 55.5577C378.089 41.5729 396.6 21.3246 452.148 27.4033C469.55 29.3076 497.787 39.4201 516.467 36.022C529.695 33.6155 539.612 26.7953 554.369 23.9558C576.978 19.6057 584.786 12.6555 612.371 13.0388C629.18 13.2724 648.084 27.6499 658.6 33.8673C672.059 41.8242 673.268 47.0554 692.77 41.4805C711.954 35.9964 746.756 38.27 766.852 40.0441C779.483 41.1593 819.866 52.3111 831.458 47.8009C837.236 45.5528 840.64 43.5162 847.537 41.3369C869.486 34.402 905.397 34.0022 929.946 38.6077C947.224 41.8489 987.666 45.9365 999.721 52.9722C1005.16 56.1489 1004.78 60.6539 1010.35 63.6019C1018.09 67.7037 1021.56 68.3083 1029.01 67.4803C1042.77 65.9505 1045.29 61.7272 1056.86 58.1434C1090.94 47.59 1121.71 32.7536 1160.52 26.5415C1182.98 22.9457 1193.92 36.1401 1209.04 41.4806C1240.16 52.468 1262.92 57.9972 1299.78 49.2374C1331.73 41.6466 1369.13 23.3813 1405.73 23.3813C1419.55 23.3813 1427.96 32.734 1435.31 37.4585C1451.38 47.7919 1467 56.9943 1493.89 56.9943C1532.36 56.9943 1544.2 49.9853 1574.29 39.0386C1588.58 33.8384 1616.86 22.826 1635.73 23.3813C1651.4 23.8424 1656.97 43.603 1667.89 48.6629C1683.26 55.7835 1710.61 49.5903 1723.88 43.7789C1736.22 38.3771 1758.43 20.6985 1777.29 30.1327C1788.48 35.7274 1794.71 53.9926 1801.12 61.5909C1815.62 78.7687 1819.96 77.5598 1843.05 68.4859C1861.58 61.2028 1873.63 49.8315 1888.99 40.9061Z"
                    fill="#FFFAF3" />
            </svg>
            <!--=== Footer Widget Area  ===-->
            <div class="footer-widget-area pb-80">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-3 col-sm-6">
                            <!--=== Footer Widget  ===-->
                            <div class="footer-widget about-company-widget mb-40" data-aos="fade-up"
                                data-aos-delay="10" data-aos-duration="1000">
                                <div class="widget-content">
                                    <img src="{{ isset($siteSettings->site_logo) ? asset('uploads/settings/' . $siteSettings->site_logo) : asset('assets/images/logo/logo-main.png') }}"
                                        alt="{{ $siteSettings->site_name ?? config('app.name') }} Logo"
                                        style="height: 100px; object-fit: contain;">
                                    <p>AnnoGhor is an exciting International brand we provide high quality cloths</p>
                                    <ul class="ct-info-list mb-30">
                                        <li>
                                            <i class="fas fa-envelope"></i>
                                            <a href="mailto:info@mydomain.com">info@mydomain.com</a>
                                        </li>
                                        <li>
                                            <i class="fas fa-phone-alt"></i>
                                            <a href="mailto:info@mydomain.com">info@mydomain.com</a>
                                        </li>
                                    </ul>
                                    <ul class="social-link">
                                        <li><span>Find Us:</span></li>

                                        @if ($siteSettings->facebook_url)
                                            <li><a href="{{ $siteSettings->facebook_url }}" target="_blank"><i
                                                        class="fab fa-facebook-f"></i></a></li>
                                        @endif

                                        @if ($siteSettings->instagram_url)
                                            <li><a href="{{ $siteSettings->instagram_url }}" target="_blank"><i
                                                        class="fab fa-instagram"></i></a></li>
                                        @endif

                                        @if ($siteSettings->linkedin_url)
                                            <li><a href="{{ $siteSettings->linkedin_url }}" target="_blank"><i
                                                        class="fab fa-linkedin-in"></i></a></li>
                                        @endif

                                        @if ($siteSettings->twitter_url)
                                            <li><a href="{{ $siteSettings->twitter_url }}" target="_blank"><i
                                                        class="fab fa-twitter"></i></a></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-sm-6">
                            <!--=== Footer Widget ===-->
                            <div class="footer-widget footer-nav-widget mb-40" data-aos="fade-up" data-aos-delay="15"
                                data-aos-duration="1200">
                                <div class="widget-content">
                                    <h4 class="widget-title">Customer Services</h4>
                                    <ul class="widget-menu">
                                        <li><img src="assets/images/icon/star-3.svg" alt="star icon"><a
                                                href="#">Collections & Delivery</a></li>
                                        <li><img src="assets/images/icon/star-3.svg" alt="star icon"><a
                                                href="#">Returns & Refunds</a></li>
                                        <li><img src="assets/images/icon/star-3.svg" alt="star icon"><a
                                                href="#">Terms & Conditions</a></li>
                                        <li><img src="assets/images/icon/star-3.svg" alt="star icon"><a
                                                href="#">Delivery Return</a></li>
                                        <li><img src="assets/images/icon/star-3.svg" alt="star icon"><a
                                                href="#">Store Locations</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-sm-6">
                            <!--=== Footer Widget ===-->
                            <div class="footer-widget footer-nav-widget mb-40" data-aos="fade-up" data-aos-delay="20"
                                data-aos-duration="1400">
                                <div class="widget-content">
                                    <h4 class="widget-title">Quick Link</h4>
                                    <ul class="widget-menu">
                                        <li><img src="assets/images/icon/star-3.svg" alt="star icon"><a
                                                href="#">Privacy Policy</a></li>
                                        <li><img src="assets/images/icon/star-3.svg" alt="star icon"><a
                                                href="#">Terms Of Use</a></li>
                                        <li><img src="assets/images/icon/star-3.svg" alt="star icon"><a
                                                href="#">FAQ</a></li>
                                        <li><img src="assets/images/icon/star-3.svg" alt="star icon"><a
                                                href="#">Contact</a></li>
                                        <li><img src="assets/images/icon/star-3.svg" alt="star icon"><a
                                                href="#">Login / Register</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6">
                            <!--=== Footer Widget  ===-->
                            <div class="footer-widget footer-recent-post-widget" data-aos="fade-up"
                                data-aos-delay="25" data-aos-duration="1600">
                                <h4 class="widget-title">Working Hours</h4>
                                <div class="widget-content working-hours">
                                    <div class="hour-item">
                                        <span class="day">Monday – Friday</span>
                                        <span class="time">9:00 AM – 8:00 PM</span>
                                    </div>

                                    <div class="hour-item">
                                        <span class="day">Saturday</span>
                                        <span class="time">10:00 AM – 6:00 PM</span>
                                    </div>

                                    <div class="hour-item closed">
                                        <span class="day">Sunday</span>
                                        <span class="time">Closed</span>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--=== Footer Copyright  ===-->
            <div class="copyright-area">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="copyright-text">
                                <p>&copy; 2025. All rights reserved by <span>Innova Tech Bangladesh</span></p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="payment-method text-lg-end">
                                <a href="#"><img src="assets/images/footer/payment-method.png"
                                        alt="payment-method"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer><!--====== End Footer Main  ======-->
    <!--====== Back To Top  ======-->
    <div class="back-to-top"><i class="far fa-angle-up"></i></div>

    <!--====== Jquery js ======-->
    <script src="{{ asset('assets/vendor/jquery-3.7.1.min.js') }}"></script>

    <!--====== Popper js ======-->
    <script src="{{ asset('assets/vendor/popper/popper.min.js') }}"></script>

    <!--====== Bootstrap js ======-->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>

    <!--====== Slick js ======-->
    <script src="{{ asset('assets/vendor/slick/slick.min.js') }}"></script>

    <!--====== Magnific js ======-->
    <script src="{{ asset('assets/vendor/magnific-popup/dist/jquery.magnific-popup.min.js') }}"></script>

    <!--====== Nice-select js ======-->
    <script src="{{ asset('assets/vendor/nice-select/js/jquery.nice-select.min.js') }}"></script>

    <!--====== Jquery Ui js ======-->
    <script src="{{ asset('assets/vendor/jquery-ui/jquery-ui.min.js') }}"></script>

    <!--====== SimplyCountdown js ======-->
    <script src="{{ asset('assets/vendor/simplyCountdown.min.js') }}"></script>

    <!--====== Aos js ======-->
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>

    <!--====== Main js ======-->
    <script src="{{ asset('assets/js/theme.js') }}"></script>

    <!-- ✅ User Account JavaScript -->
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

            // User greeting based on time
            function getUserGreeting() {
                const hour = new Date().getHours();
                if (hour < 12) return 'Good Morning';
                if (hour < 18) return 'Good Afternoon';
                return 'Good Evening';
            }

            // You can display greeting if needed
            // $('.user-greeting').text(getUserGreeting());

            // Mobile menu user section
            $('.navbar-toggler').on('click', function() {
                $('.user-account').toggleClass('mobile-visible');
            });
        });
    </script>
    <script>
        // No need to load jQuery again if already loaded above
        $(document).ready(function() {
            // Mobile Category Toggle Logic
            // '.menu-expand' ba puru 'category-header' e click korle jeno toggle hoy
            $('.menu-expand, .category-header a').on('click', function(e) {

                // Jodi arrow-te click hoy tobe toggle hobe
                if ($(e.target).closest('.menu-expand').length > 0) {
                    e.preventDefault();
                    var $header = $(this).closest('.category-header');
                    var $submenu = $header.next('.subcategory-mobile-list');

                    $submenu.slideToggle(300);
                    $header.find('.menu-expand i').toggleClass('fa-chevron-down fa-chevron-up');
                }
                // Jodi name-e click hoy tobe route onujayi page-e niye jabe (default behavior)
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
                            $icon.addClass('fas').removeClass('far').css('color', '#dc3545');
                            $btn.addClass('active');
                        } else {
                            $icon.addClass('far').removeClass('fas').css('color', '');
                            $btn.removeClass('active');
                        }

                        // Update wishlist count
                        if (response.wishlist_count !== undefined) {
                            $('.wishlist-count, .pro-count.wishlist-count').text(response
                                .wishlist_count);
                        }

                        showNotification(response.message, 'success');
                    } else if (response.redirect) {
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
                        window.location.href = '{{ route('login') }}';
                    } else {
                        showNotification('Error updating wishlist', 'danger');
                    }

                    // Re-enable button
                    $btn.css('pointer-events', '');
                }
            });
        });

        // ✅ Load wishlist status (শুধু authenticated users এর জন্য)
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

        // ✅ Update wishlist count
        function updateWishlistCount() {
            $.ajax({
                url: '{{ route('wishlist.count') }}',
                method: 'GET',
                success: function(response) {
                    console.log('Wishlist count:', response);

                    if (response.count !== undefined) {
                        $('.wishlist-count, .pro-count.wishlist-count').text(response.count);
                    }
                },
                error: function(xhr) {
                    console.error('Error fetching wishlist count:', xhr);
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