<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

<head>
    <meta charset="utf-8">
    <title>Ecommerce Dashboard</title>
    <meta name="author" content="themesflat.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Theme Style -->
    <link rel="stylesheet" href="{{ asset('assets2/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets2/css/animation.css') }}">
    <link rel="stylesheet" href="{{ asset('assets2/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets2/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets2/css/style.css') }}">

    <!-- Font -->
    <link rel="stylesheet" href="{{ asset('assets2/font/fonts.css') }}">

    <!-- Icon -->
    <link rel="stylesheet" href="{{ asset('assets2/icon/style.css') }}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets2/images/favicon.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('assets2/images/favicon.png') }}">

    <style>
        .unread-count {
            display: none;
        }

        .icon-message-circle {
            font-size: 1.2rem;
        }

        .noti-item.active {
            background-color: #f8f9fa;
            border-left: 3px solid #0d6efd;
        }

        .noti-item:hover {
            background-color: #e9ecef;
        }
    </style>
</head>


<body class="body">

    <!-- #wrapper -->
    <div id="wrapper">
        <!-- #page -->
        <div id="page" class="">
            <!-- layout-wrap -->
            <div class="layout-wrap">
                <!-- preload -->
                <div id="preload" class="preload-container">
                    <div class="preloading">
                        <span></span>
                    </div>
                </div>
                <!-- /preload -->
                <!-- section-menu-left -->
                <div class="section-menu-left">
                    <div class="box-logo">
                        <a href="{{ url('/') }}" id="site-logo-inner">
                            <img src="{{ asset('assets2/images/logo/new-logo.jpeg') }}" alt="Site Logo"
                                style="height:70px; width:auto;">
                        </a>

                        <div class="button-show-hide">
                            <i class="icon-menu-left"></i>
                        </div>
                    </div>
                    <div class="center">
                        <div class="center-item">
                            <div class="center-heading">Main Home</div>
                            <ul class="menu-list">
                                <li class="menu-item active">
                                    <a href="{{ route('admin.dashboard') }}">
                                        <div class="icon"><i class="icon-grid"></i></div>
                                        <div class="text">Dashboard</div>
                                    </a>
                                </li>
                            </ul>

                        </div>
                        <div class="center-item">
                            <div class="center-heading">All page</div>
                           <ul class="menu-list">

    <!-- Product -->
    <li class="menu-item has-children">
        <a href="javascript:void(0);" class="menu-item-button">
            <div class="icon"><i class="icon-shopping-bag"></i></div>
            <div class="text">Product</div>
        </a>
        <ul class="sub-menu">
            <li class="sub-menu-item">
                <a href="{{ route('admin.add-product') }}">
                    <div class="text">Add Product</div>
                </a>
            </li>
            <li class="sub-menu-item">
                <a href="{{ route('admin.product-list') }}">
                    <div class="text">Product List</div>
                </a>
            </li>
        </ul>
    </li>

    <!-- Category -->
    <li class="menu-item has-children">
        <a href="javascript:void(0);" class="menu-item-button">
            <div class="icon"><i class="icon-grid"></i></div>
            <div class="text">Category</div>
        </a>
        <ul class="sub-menu">
            <li class="sub-menu-item">
                <a href="{{ route('admin.add-category') }}">
                    <div class="text">Add category</div>
                </a>
            </li>
            <li class="sub-menu-item">
                <a href="{{ route('admin.category-list') }}">
                    <div class="text">Category list</div>
                </a>
            </li>
        </ul>
    </li>

    <!-- Stock -->
    <li class="menu-item has-children">
        <a href="javascript:void(0);" class="menu-item-button">
            <div class="icon"><i class="icon-archive"></i></div>
            <div class="text">Stock</div>
        </a>
        <ul class="sub-menu">
            <li class="sub-menu-item">
                <a href="{{ route('admin.add-stock') }}" class="{{ Route::is('admin.add-stock') ? 'active' : '' }}">
                    <div class="text">Add Stock</div>
                </a>
            </li>
            <li class="sub-menu-item">
                <a href="{{ route('admin.stock-list') }}" class="{{ Route::is('admin.stock-list') ? 'active' : '' }}">
                    <div class="text">Stock List</div>
                </a>
            </li>
        </ul>
    </li>

    <!-- Orders -->
    <li class="menu-item has-children">
        <a href="javascript:void(0);" class="menu-item-button">
            <div class="icon"><i class="icon-package"></i></div>
            <div class="text">Orders</div>
        </a>
        <ul class="sub-menu">
            <li class="sub-menu-item"><a href="{{ route('admin.order-list') }}"><div class="text">All Orders</div></a></li>
            <li class="sub-menu-item"><a href="{{ route('admin.orders.pending') }}"><div class="text">Pending Orders</div></a></li>
            <li class="sub-menu-item"><a href="{{ route('admin.orders.processing') }}"><div class="text">Processing Orders</div></a></li>
            <li class="sub-menu-item"><a href="{{ route('admin.orders.shipped') }}"><div class="text">Shipped Orders</div></a></li>
            <li class="sub-menu-item"><a href="{{ route('admin.orders.delivered') }}"><div class="text">Delivered Orders</div></a></li>
            <li class="sub-menu-item"><a href="{{ route('admin.orders.cancelled') }}"><div class="text">Cancelled Orders</div></a></li>
        </ul>
    </li>

    <li class="menu-item has-children">
    <a href="javascript:void(0);" class="menu-item-button">
        <div class="icon"><i class="icon-image"></i></div>
        <div class="text">Banners</div>
    </a>
    <ul class="sub-menu">
        <li class="sub-menu-item">
            <a href="{{ route('admin.banners.index') }}">
                <div class="text">All Banners</div>
            </a>
        </li>
        <li class="sub-menu-item">
            <a href="{{ route('admin.banners.create') }}">
                <div class="text">Add New Banner</div>
            </a>
        </li>
    </ul>
</li>

    <!-- Users -->
    <li class="menu-item">
        <a href="{{ route('admin.all-user') }}" class="menu-item-button">
            <div class="icon"><i class="icon-users"></i></div>
            <div class="text">Users</div>
        </a>
    </li>

    <!-- Messages -->
    <li class="menu-item">
        <a href="{{ route('admin.messages.index') }}"
           class="{{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
            <div class="icon"><i class="icon-mail"></i></div>
            <div class="text">Messages</div>
            @php
                $unreadCount = \App\Models\ContactMessage::getUnreadCount();
            @endphp
            @if ($unreadCount > 0)
                <span class="badge bg-danger ms-auto">{{ $unreadCount }}</span>
            @endif
        </a>
    </li>

    <!-- Content Label (optional visual separator) -->

    <!-- Headlines -->
    <li class="menu-item">
        <a href="{{ route('admin.headlines.index') }}"
           class="{{ request()->routeIs('admin.headlines.*') ? 'active' : '' }}">
            <div class="icon"><i class="icon-type"></i></div>
            <div class="text">Headlines</div>
        </a>
    </li>

    <!-- Review -->
    <li class="menu-item has-children">
        <a href="javascript:void(0);" class="menu-item-button">
            <div class="icon"><i class="icon-star"></i></div>
            <div class="text">Review</div>
        </a>
        <ul class="sub-menu">
            <li class="sub-menu-item">
                <a href="{{ route('admin.review-list') }}">
                    <div class="text">Review list</div>
                </a>
            </li>
            <li class="sub-menu-item">
                <a href="{{ route('admin.add-review') }}">
                    <div class="text">Add Review</div>
                </a>
            </li>
        </ul>
    </li>

    <!-- FAQs -->
    <li class="menu-item has-children">
        <a href="javascript:void(0);" class="menu-item-button">
            <div class="icon"><i class="icon-help-circle"></i></div>
            <div class="text">FAQs</div>
        </a>
        <ul class="sub-menu">
            <li class="sub-menu-item">
                <a href="{{ route('admin.faqs.index') }}">
                    <div class="text">FAQ list</div>
                </a>
            </li>
            <li class="sub-menu-item">
                <a href="{{ route('admin.faqs.add-faq') }}">
                    <div class="text">Add FAQ</div>
                </a>
            </li>
        </ul>
    </li>

    <!-- Reports -->
    <li class="menu-item">
        <a href="{{ route('admin.report') }}">
            <div class="icon"><i class="icon-bar-chart-2"></i></div>
            <div class="text">Reports</div>
        </a>
    </li>

    <!-- Currency -->
    <li class="menu-item">
        <a href="{{ route('admin.currency-settings.index') }}">
            <div class="icon"><i class="icon-dollar-sign"></i></div>
            <div class="text">Currency</div>
        </a>
    </li>

    <!-- Store Settings -->
    <li class="menu-item has-children">
        <a href="javascript:void(0);" class="menu-item-button">
            <div class="icon"><i class="icon-settings"></i></div>
            <div class="text">Store Settings</div>
        </a>
        <ul class="sub-menu">
            <li class="sub-menu-item">
                <a href="{{ route('admin.settings.index') }}">
                    <div class="text">General Settings</div>
                </a>
            </li>
            <li class="sub-menu-item">
                <a href="{{ route('admin.social-links.index') }}">
                    <div class="text">Social Media Links</div>
                </a>
            </li>
        </ul>
    </li>

                        </div>
                        <div class="center-item">
                            <div class="center-heading">Support</div>
                            <ul class="menu-list">
                                <li class="menu-item">
                                    <a href="#" class="">
                                        <div class="icon"><i class="icon-help-circle"></i></div>
                                        <div class="text">Help center</div>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="#" class="">
                                        <div class="icon">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_604_18468)">
                                                    <path
                                                        d="M4.71875 7V1H15.5561L18.9991 4.44801V19H4.71875C4.71875 19 4.71875 16.2 4.71875 13.5"
                                                        stroke="#111111" stroke-width="1.2" stroke-miterlimit="10"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M19.0015 4.44801H15.5586V1L19.0015 4.44801Z"
                                                        stroke="#111111" stroke-width="1.2" stroke-miterlimit="10"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <path
                                                        d="M7.53469 14.5507C9.89243 14.5507 11.8037 12.6366 11.8037 10.2754C11.8037 7.91415 9.89243 6 7.53469 6C5.17695 6 3.26562 7.91415 3.26562 10.2754C3.26562 12.6366 5.17695 14.5507 7.53469 14.5507Z"
                                                        stroke="#111111" stroke-width="1.2" stroke-miterlimit="10"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <path
                                                        d="M5.41029 13.9852L2.90967 16.4895C2.47263 16.9272 1.76451 16.9272 1.3275 16.4895C0.890833 16.0522 0.890833 15.3427 1.3275 14.9054L3.82812 12.4011M6.14799 10.2051L7.11794 11.175L8.91794 9.375"
                                                        stroke="#111111" stroke-width="1.2" stroke-miterlimit="10"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_604_18468">
                                                        <rect width="20" height="20" fill="white" />
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </div>
                                        <div class="text">Privacy policy</div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="center-item">
                            <div class="center-heading">Connect us</div>
                            <ul class="wg-social">
                                <li>
                                    <a href="#"><i class="icon-facebook"></i></a>
                                </li>
                                <li class="active">
                                    <a href="#"><i class="icon-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="icon-linkedin"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="icon-instagram"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /section-menu-left -->
                <!-- section-content-right -->
                <div class="section-content-right">
                    <!-- header-dashboard -->
                    <div class="header-dashboard">
                        <div class="wrap">
                            <div class="header-left">
                                <a href="{{ url('/') }}" id="site-logo-inner">
                                    <img id="logo_header_mobile"
                                        src="{{ asset('assets2/images/logo/new-logo.jpeg') }}" alt="Site Logo"
                                        style="height:70px; width:auto;">
                                </a>

                                <div class="button-show-hide">
                                    <i class="icon-menu-left"></i>
                                </div>
                                <form class="form-search flex-grow">
                                    <fieldset class="name">
                                        <input type="text" placeholder="Search here..." class="show-search"
                                            name="name" tabindex="2" value="" aria-required="true"
                                            required="">
                                    </fieldset>
                                    <div class="button-submit">
                                        <button class="" type="submit"><i class="icon-search"></i></button>
                                    </div>
                                    <div class="box-content-search" id="box-content-search">
                                        <ul class="mb-24">
                                            <li class="mb-14">
                                                <div class="body-title">Top selling product</div>
                                            </li>
                                            <li class="mb-14">
                                                <div class="divider"></div>
                                            </li>
                                            <li>
                                                <ul>
                                                    <li class="product-item gap14 mb-10">
                                                        <div class="image no-bg">
                                                            <img src="images/products/17.png" alt="">
                                                        </div>
                                                        <div class="flex items-center justify-between gap20 flex-grow">
                                                            <div class="name">
                                                                <a href="product-list.html" class="body-text">Dog Food
                                                                    Rachael Ray Nutrish®</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="mb-10">
                                                        <div class="divider"></div>
                                                    </li>
                                                    <li class="product-item gap14 mb-10">
                                                        <div class="image no-bg">
                                                            <img src="images/products/18.png" alt="">
                                                        </div>
                                                        <div class="flex items-center justify-between gap20 flex-grow">
                                                            <div class="name">
                                                                <a href="product-list.html" class="body-text">Natural
                                                                    Dog Food Healthy Dog Food</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="mb-10">
                                                        <div class="divider"></div>
                                                    </li>
                                                    <li class="product-item gap14">
                                                        <div class="image no-bg">
                                                            <img src="images/products/19.png" alt="">
                                                        </div>
                                                        <div class="flex items-center justify-between gap20 flex-grow">
                                                            <div class="name">
                                                                <a href="product-list.html" class="body-text">Freshpet
                                                                    Healthy Dog Food and Cat</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                        <ul class="">
                                            <li class="mb-14">
                                                <div class="body-title">Order product</div>
                                            </li>
                                            <li class="mb-14">
                                                <div class="divider"></div>
                                            </li>
                                            <li>
                                                <ul>
                                                    <li class="product-item gap14 mb-10">
                                                        <div class="image no-bg">
                                                            <img src="images/products/20.png" alt="">
                                                        </div>
                                                        <div class="flex items-center justify-between gap20 flex-grow">
                                                            <div class="name">
                                                                <a href="product-list.html" class="body-text">Sojos
                                                                    Crunchy Natural Grain Free...</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="mb-10">
                                                        <div class="divider"></div>
                                                    </li>
                                                    <li class="product-item gap14 mb-10">
                                                        <div class="image no-bg">
                                                            <img src="images/products/21.png" alt="">
                                                        </div>
                                                        <div class="flex items-center justify-between gap20 flex-grow">
                                                            <div class="name">
                                                                <a href="product-list.html" class="body-text">Kristin
                                                                    Watson</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="mb-10">
                                                        <div class="divider"></div>
                                                    </li>
                                                    <li class="product-item gap14 mb-10">
                                                        <div class="image no-bg">
                                                            <img src="images/products/22.png" alt="">
                                                        </div>
                                                        <div class="flex items-center justify-between gap20 flex-grow">
                                                            <div class="name">
                                                                <a href="product-list.html" class="body-text">Mega
                                                                    Pumpkin Bone</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="mb-10">
                                                        <div class="divider"></div>
                                                    </li>
                                                    <li class="product-item gap14">
                                                        <div class="image no-bg">
                                                            <img src="images/products/23.png" alt="">
                                                        </div>
                                                        <div class="flex items-center justify-between gap20 flex-grow">
                                                            <div class="name">
                                                                <a href="product-list.html" class="body-text">Mega
                                                                    Pumpkin Bone</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </form>
                            </div>
                            <div class="header-grid">

                                <div class="popup-wrap noti type-header">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="header-item">
                                                <span class="text-tiny">1</span>
                                                <i class="icon-bell"></i>
                                            </span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end has-content"
                                            aria-labelledby="dropdownMenuButton1">
                                            <li>
                                                <h6>Notifications</h6>
                                            </li>

                                            <li>
                                                <div class="message-item item-1">
                                                    <div class="image">
                                                        <i class="icon-noti-1"></i>
                                                    </div>
                                                    <div>
                                                        <div class="body-title-2">Discount available</div>
                                                        <div class="text-tiny">Morbi sapien massa, ultricies at rhoncus
                                                            at, ullamcorper nec diam</div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="message-item item-2">
                                                    <div class="image">
                                                        <i class="icon-noti-2"></i>
                                                    </div>
                                                    <div>
                                                        <div class="body-title-2">Account has been verified</div>
                                                        <div class="text-tiny">Mauris libero ex, iaculis vitae rhoncus
                                                            et</div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="message-item item-3">
                                                    <div class="image">
                                                        <i class="icon-noti-3"></i>
                                                    </div>
                                                    <div>
                                                        <div class="body-title-2">Order shipped successfully</div>
                                                        <div class="text-tiny">Integer aliquam eros nec sollicitudin
                                                            sollicitudin</div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="message-item item-4">
                                                    <div class="image">
                                                        <i class="icon-noti-4"></i>
                                                    </div>
                                                    <div>
                                                        <div class="body-title-2">Order pending: <span>ID 305830</span>
                                                        </div>
                                                        <div class="text-tiny">Ultricies at rhoncus at ullamcorper
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li><a href="#" class="tf-button w-full">View all</a></li>
                                        </ul>
                                    </div>
                                </div>


                                <!-- Messages Notification Dropdown -->
                                <div class="popup-wrap message type-header">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="header-item">
                                                <span class="text-tiny unread-count">0</span>
                                                <i class="icon-message-square"></i>
                                            </span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end has-content"
                                            aria-labelledby="dropdownMenuButton2">
                                            <li>
                                                <h6>Contact Messages</h6>
                                            </li>
                                            <div id="notificationList">
                                                <li class="text-center py-3">
                                                    <span class="text-muted">Loading...</span>
                                                </li>
                                            </div>
                                            <li>
                                                <a href="{{ route('admin.messages.index') }}"
                                                    class="tf-button w-full">View all</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="header-item button-zoom-maximize">
                                    <div class="">
                                        <i class="icon-maximize"></i>
                                    </div>
                                </div>
                                <div class="popup-wrap user type-header">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="header-user wg-user">
                                                <span class="image">
                                                    <img src="{{ asset('assets2/images/avatar/user-1.png') }}"
                                                        alt="avatar">
                                                </span>
                                                <span class="flex flex-column">
                                                    <span class="body-title mb-2">{{ auth()->user()->name }}</span>
                                                    <span class="text-tiny">{{ auth()->user()->email }}</span>
                                                </span>
                                            </span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end has-content"
                                            aria-labelledby="dropdownMenuButton3">
                                            <li>
                                                <a href="#" class="user-item">
                                                    <div class="icon">
                                                        <i class="icon-user"></i>
                                                    </div>
                                                    <div class="body-title-2">Account</div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="user-item">
                                                    <div class="icon">
                                                        <i class="icon-mail"></i>
                                                    </div>
                                                    <div class="body-title-2">Inbox</div>
                                                    <div class="number">27</div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="user-item">
                                                    <div class="icon">
                                                        <i class="icon-file-text"></i>
                                                    </div>
                                                    <div class="body-title-2">Taskboard</div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('admin.settings.index') }}" class="user-item">
                                                    <div class="icon">
                                                        <i class="icon-settings"></i>
                                                    </div>
                                                    <div class="body-title-2">Settings</div>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="#" class="user-item">
                                                    <div class="icon">
                                                        <i class="icon-headphones"></i>
                                                    </div>
                                                    <div class="body-title-2">Support</div>
                                                </a>
                                            </li>
                                            <li>
                                                <form method="POST" action="{{ route('admin.logout') }}">
                                                    @csrf
                                                    <button type="submit" class="user-item"
                                                        style="background: none; border: none; padding: 0; width: 100%; text-align: left;">
                                                        <div class="icon">
                                                            <i class="icon-log-out"></i>
                                                        </div>
                                                        <div class="body-title-2">Log out</div>
                                                    </button>
                                                </form>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /header-dashboard -->
                    <main>
                        @yield('content')
                    </main>
                </div>
                <!-- /section-content-right -->

            </div>
            <!-- /layout-wrap -->
        </div>
        <!-- /#page -->
    </div>
    <!-- /#wrapper -->

    <!-- Javascriassets2/pt -->
    <script src="{{ asset('assets2/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets2/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets2/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets2/js/zoom.js') }}"></script>

    <script src="{{ asset('assets2/js/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ asset('assets2/js/apexcharts/line-chart-1.js') }}"></script>
    <script src="{{ asset('assets2/js/apexcharts/line-chart-2.js') }}"></script>
    <script src="{{ asset('assets2/js/apexcharts/line-chart-3.js') }}"></script>
    <script src="{{ asset('assets2/js/apexcharts/line-chart-4.js') }}"></script>
    <script src="{{ asset('assets2/js/apexcharts/line-chart-5.js') }}"></script>
    <script src="{{ asset('assets2/js/apexcharts/line-chart-6.js') }}"></script>

    {{-- <script src="{{ asset('assets2/js/switcher.js') }}"></script> --}}
    <script src="{{ asset('assets2/js/theme-settings.js') }}"></script>
    <script src="{{ asset('assets2/js/main.js') }}"></script>
    <!-- Notification Script -->
    <script>
        // Function to load unread messages
        function loadUnreadMessages() {
            $.ajax({
                url: '{{ route('notifications.unread-messages') }}',
                method: 'GET',
                success: function(response) {
                    // Update unread count
                    if (response.unreadCount > 0) {
                        $('.unread-count').text(response.unreadCount).show();
                    } else {
                        $('.unread-count').text('0').hide();
                    }

                    // Update notification list
                    let notificationHtml = '';

                    if (response.messages.length > 0) {
                        response.messages.forEach(function(message) {
                            notificationHtml += `
                            <li>
                                <div class="noti-item w-full wg-user active">
                                    <div class="image">
                                        <div class="icon-message-circle bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                            <i class="icon-user"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow">
                                        <div class="flex items-center justify-between">
                                            <a href="{{ url('admin/messages') }}/${message.id}" class="body-title">
                                                ${message.name}
                                            </a>
                                            <div class="time">${formatTime(message.created_at)}</div>
                                        </div>
                                        <div class="text-tiny">${truncateText(message.message, 50)}</div>
                                    </div>
                                </div>
                            </li>
                        `;
                        });
                    } else {
                        notificationHtml = `
                        <li class="text-center py-3">
                            <span class="text-muted">No new messages</span>
                        </li>
                    `;
                    }

                    $('#notificationList').html(notificationHtml);
                },
                error: function(xhr) {
                    console.log('Error loading notifications:', xhr);
                }
            });
        }

        // Helper function to format time
        function formatTime(dateString) {
            const date = new Date(dateString);
            const now = new Date();
            const diffInSeconds = Math.floor((now - date) / 1000);

            if (diffInSeconds < 60) {
                return 'Just now';
            } else if (diffInSeconds < 3600) {
                const minutes = Math.floor(diffInSeconds / 60);
                return minutes + ' min ago';
            } else if (diffInSeconds < 86400) {
                const hours = Math.floor(diffInSeconds / 3600);
                return hours + ' hour' + (hours > 1 ? 's' : '') + ' ago';
            } else {
                return date.toLocaleDateString('en-US', {
                    month: 'short',
                    day: 'numeric'
                });
            }
        }

        // Helper function to truncate text
        function truncateText(text, length) {
            if (text.length > length) {
                return text.substring(0, length) + '...';
            }
            return text;
        }

        // Load notifications on page load
        $(document).ready(function() {
            loadUnreadMessages();

            // Reload notifications every 30 seconds
            setInterval(function() {
                loadUnreadMessages();
            }, 30000); // 30 seconds
        });

        // Reload notifications when dropdown is opened
        $(document).on('click', '#dropdownMenuButton2', function() {
            loadUnreadMessages();
        });
    </script>



</body>

</html>
