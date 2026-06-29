@extends('layouts.app')

@section('title', 'Cart - Ecommerce')

@section('content')

    <!--====== Start Cart Section ======-->
    <section class="cart-page-section pt-50 pb-80">
        <div class="container">
            @if (session('success'))
                <span id="flash-success" data-msg="{{ session('success') }}" style="display:none;"></span>
            @endif
            @if (session('error'))
                <span id="flash-error" data-msg="{{ session('error') }}" style="display:none;"></span>
            @endif

            <div class="row">
                <div class="col-xl-12">
                    <div class="cart-wrapper mb-40" data-aos="fade-up" data-aos-duration="1200">

                        <div class="cart-header-bar mb-30">
                            <h3 class="cart-title">
                                <i class="fas fa-shopping-cart me-2"></i>
                                My Cart
                                <span class="cart-badge">{{ $cartItems->count() }}</span>
                            </h3>
                        </div>

                        @if ($cartItems->count() > 0)
                            <!-- Desktop Table View -->
                            <div class="cart-list table-responsive d-none d-md-block">
                                <table class="table cart-table">
                                    <thead>
                                        <tr>
                                            <th><i class="fas fa-box me-1"></i> Product</th>
                                            <th><i class="fas fa-tag me-1"></i> Price</th>
                                            <th class="text-center"><i class="fas fa-sort-numeric-up me-1"></i> Quantity</th>
                                            <th class="text-end"><i class="fas fa-receipt me-1"></i> Total</th>
                                            <th class="text-center"><i class="fas fa-trash me-1"></i> Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cartItems as $item)
                                            <tr id="cart-item-{{ $item->id }}">
                                                <td>
                                                    <div class="product-thumb-item">
                                                        <div class="product-img">
                                                            @if ($item->product->thumbnail)
                                                                <img src="{{ asset('storage/' . $item->product->thumbnail) }}"
                                                                    alt="{{ $item->product->name }}">
                                                            @else
                                                                <img src="{{ asset('assets/images/products/cart-1.jpg') }}"
                                                                    alt="{{ $item->product->name }}">
                                                            @endif
                                                        </div>
                                                        <div class="product-info">
                                                            <h4 class="title">
                                                                <a href="{{ $item->product->details_url }}">
    {{ $item->product->name }}
</a>
                                                            </h4>
                                                            <div class="product-meta">
                                                                <span>Code: {{ $item->product->product_code }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="price">
                                                        {{ \App\Helpers\CurrencyHelper::formatPrice($item->price) }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="quantity-wrap">
                                                        <div class="quantity-input">
                                                            <button class="quantity-down" type="button"
                                                                data-cart-id="{{ $item->id }}" data-action="decrease">
                                                                <i class="far fa-minus"></i>
                                                            </button>
                                                            <input class="quantity" type="number" min="1"
                                                                value="{{ $item->quantity }}"
                                                                id="quantity-{{ $item->id }}"
                                                                data-cart-id="{{ $item->id }}">
                                                            <button class="quantity-up" type="button"
                                                                data-cart-id="{{ $item->id }}" data-action="increase">
                                                                <i class="far fa-plus"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-end">
                                                    <div class="total-price" data-item-total="{{ $item->id }}">
                                                        {{ \App\Helpers\CurrencyHelper::formatPrice($item->total_price) }}
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <button class="cart-remove" type="button"
                                                        data-cart-id="{{ $item->id }}">
                                                        <i class="far fa-times"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Mobile Card View -->
                            <div class="mobile-cart-list d-md-none">
                                @foreach ($cartItems as $item)
                                    <div class="mobile-cart-item" id="cart-item-{{ $item->id }}">
                                        <div class="mobile-item-top">
                                            <div class="mobile-product-img">
                                                @if ($item->product->thumbnail)
                                                    <img src="{{ asset('storage/' . $item->product->thumbnail) }}"
                                                        alt="{{ $item->product->name }}">
                                                @else
                                                    <img src="{{ asset('assets/images/products/cart-1.jpg') }}"
                                                        alt="{{ $item->product->name }}">
                                                @endif
                                            </div>
                                            <div class="mobile-item-info">
                                                <h4 class="mobile-item-name">
                                                    <a href="{{ $item->product->details_url }}">
    {{ $item->product->name }}
</a>
                                                </h4>
                                                <span class="mobile-item-code">Code: {{ $item->product->product_code }}</span>
                                                <div class="mobile-item-price">
                                                    {{ \App\Helpers\CurrencyHelper::formatPrice($item->price) }}
                                                </div>
                                            </div>
                                            <button class="cart-remove mobile-remove" type="button"
                                                data-cart-id="{{ $item->id }}">
                                                <i class="far fa-times"></i>
                                            </button>
                                        </div>
                                        <div class="mobile-item-bottom">
                                            <div class="quantity-input">
                                                <button class="quantity-down" type="button"
                                                    data-cart-id="{{ $item->id }}" data-action="decrease">
                                                    <i class="far fa-minus"></i>
                                                </button>
                                                <input class="quantity" type="number" min="1"
                                                    value="{{ $item->quantity }}"
                                                    id="quantity-mob-{{ $item->id }}"
                                                    data-cart-id="{{ $item->id }}">
                                                <button class="quantity-up" type="button"
                                                    data-cart-id="{{ $item->id }}" data-action="increase">
                                                    <i class="far fa-plus"></i>
                                                </button>
                                            </div>
                                            <div class="mobile-item-total">
                                                Total: <strong data-item-total="{{ $item->id }}">{{ \App\Helpers\CurrencyHelper::formatPrice($item->total_price) }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Cart Summary -->
                            <div class="cart-summary-box mt-30">
                                <div class="row justify-content-end">
                                    <div class="col-12 col-sm-6 col-md-4">
                                        <div class="cart-totals">
                                            <div class="totals-row">
                                                <span>Subtotal</span>
                                                <span id="cart-subtotal">{{ \App\Helpers\CurrencyHelper::formatPrice($cartItems->sum('total_price')) }}</span>
                                            </div>
                                            <div class="totals-row totals-final">
                                                <span>Total</span>
                                                <span id="cart-total">{{ \App\Helpers\CurrencyHelper::formatPrice($cartItems->sum('total_price')) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Cart Bottom Actions -->
                            <div class="cart-bottom mt-40">
                                <div class="cart-actions-row">
                                    <a href="{{ route('shops') }}" class="cart-btn btn-outline-gold">
                                        <i class="fas fa-arrow-left me-2"></i> Continue Shopping
                                    </a>
                                    <div class="cart-actions-right">
                                        <button class="cart-btn btn-danger-custom" type="button" id="clear-cart-btn">
                                            <i class="fas fa-trash me-2"></i> Clear Cart
                                        </button>
                                        <a href="{{ route('checkout') }}" class="cart-btn btn-gold">
                                            Checkout <i class="fas fa-arrow-right ms-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        @else
                            <div class="empty-cart text-center py-5">
                                <div class="empty-icon-wrap">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <h4 class="empty-title">Your cart is empty</h4>
                                <p class="empty-sub">Looks like you haven't added any items to your cart yet.</p>
                                <a href="{{ route('shops') }}" class="cart-btn btn-gold mt-3">
                                    Start Shopping
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== End Cart Section ======-->

    <style>
        /* ===== VARIABLES ===== */
        :root {
            --gold: #E2B718;
            --gold-dark: #c9a215;
            --gold-light: #f5d44e;
            --danger: #e53e3e;
            --danger-dark: #c53030;
            --text-primary: #1a202c;
            --text-secondary: #718096;
            --border: #e2e8f0;
            --bg-light: #f7fafc;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.08);
            --shadow-md: 0 4px 12px rgba(0,0,0,0.1);
            --radius: 12px;
            --radius-sm: 8px;
        }

        /* ===== CART HEADER ===== */
        .cart-header-bar {
            display: flex;
            align-items: center;
        }

        .cart-title {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0;
        }

        .cart-badge {
            background: var(--gold);
            color: #fff;
            font-size: 0.85rem;
            font-weight: 700;
            padding: 3px 12px;
            border-radius: 20px;
            line-height: 1.5;
        }

        /* ===== DESKTOP TABLE ===== */
        .cart-table {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
        }

        .cart-table thead tr th {
            background: var(--gold);
            color: #1a202c;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 14px 16px;
            border: none;
        }

        .cart-table thead tr th:first-child { border-radius: var(--radius-sm) 0 0 0; }
        .cart-table thead tr th:last-child { border-radius: 0 var(--radius-sm) 0 0; }

        .cart-table tbody tr {
            transition: background 0.2s;
        }

        .cart-table tbody tr:hover {
            background: #fffbf0;
        }

        .cart-table tbody tr td {
            padding: 16px;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
            font-size: 0.95rem;
            color: var(--text-primary);
        }

        /* ===== PRODUCT THUMB ===== */
        .product-thumb-item {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .product-img img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: var(--radius-sm);
            border: 1px solid var(--border);
            flex-shrink: 0;
        }

        .product-info .title {
            font-size: 0.95rem;
            font-weight: 600;
            margin-bottom: 4px;
            line-height: 1.3;
        }

        .product-info .title a {
            color: var(--text-primary);
            text-decoration: none;
            transition: color 0.2s;
        }

        .product-info .title a:hover {
            color: var(--gold);
        }

        .product-meta span {
            font-size: 0.8rem;
            color: var(--text-secondary);
        }

        /* ===== PRICE ===== */
        .price {
            font-weight: 600;
            color: var(--text-primary);
            font-size: 0.95rem;
            white-space: nowrap;
        }

        .total-price {
            font-weight: 700;
            color: var(--gold-dark);
            font-size: 1rem;
            white-space: nowrap;
        }

        /* ===== QUANTITY INPUT ===== */
        .quantity-wrap {
            display: flex;
            justify-content: center;
        }

        .quantity-input {
            display: flex;
            align-items: center;
            border: 1.5px solid var(--border);
            border-radius: var(--radius-sm);
            overflow: hidden;
            background: #fff;
        }

        .quantity-input button {
            background: var(--bg-light);
            border: none;
            width: 34px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--text-secondary);
            transition: background 0.2s, color 0.2s;
            flex-shrink: 0;
            font-size: 0.75rem;
        }

        .quantity-input button:hover {
            background: var(--gold);
            color: #fff;
        }

        .quantity-input input {
            width: 52px;
            text-align: center;
            border: none;
            border-left: 1px solid var(--border);
            border-right: 1px solid var(--border);
            padding: 8px 4px;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-primary);
            background: #fff;
            -moz-appearance: textfield;
        }

        .quantity-input input::-webkit-outer-spin-button,
        .quantity-input input::-webkit-inner-spin-button {
            -webkit-appearance: none;
        }

        .quantity-input input:focus {
            outline: none;
        }

        /* ===== REMOVE BUTTON ===== */
        .cart-remove {
            background: none;
            border: 2px solid #fed7d7;
            color: var(--danger);
            cursor: pointer;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            transition: all 0.2s;
        }

        .cart-remove:hover {
            background: var(--danger);
            border-color: var(--danger);
            color: #fff;
            transform: scale(1.1);
        }

        /* ===== CART SUMMARY ===== */
        .cart-totals {
            background: var(--bg-light);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 20px 24px;
        }

        .totals-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            font-size: 0.95rem;
            color: var(--text-secondary);
            border-bottom: 1px dashed var(--border);
        }

        .totals-row:last-child {
            border-bottom: none;
        }

        .totals-final {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-primary);
            padding-top: 12px;
        }

        .totals-final span:last-child {
            color: var(--gold-dark);
        }

        /* ===== ACTION BUTTONS ===== */
        .cart-actions-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }

        .cart-actions-right {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .cart-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 11px 24px;
            border-radius: var(--radius-sm);
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.25s;
            border: 2px solid transparent;
            white-space: nowrap;
        }

        .btn-gold {
            background: var(--gold);
            color: #fff;
            border-color: var(--gold);
        }

        .btn-gold:hover {
            background: var(--gold-dark);
            border-color: var(--gold-dark);
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(226, 183, 24, 0.4);
        }

        .btn-outline-gold {
            background: transparent;
            color: var(--gold-dark);
            border-color: var(--gold);
        }

        .btn-outline-gold:hover {
            background: var(--gold);
            color: #fff;
            transform: translateY(-1px);
        }

        .btn-danger-custom {
            background: transparent;
            color: var(--danger);
            border-color: #fed7d7;
        }

        .btn-danger-custom:hover {
            background: var(--danger);
            color: #fff;
            border-color: var(--danger);
            transform: translateY(-1px);
        }

        /* ===== MOBILE CARD VIEW ===== */
        .mobile-cart-list {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .mobile-cart-item {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 16px;
            box-shadow: var(--shadow-sm);
        }

        .mobile-item-top {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 14px;
        }

        .mobile-product-img img {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: var(--radius-sm);
            border: 1px solid var(--border);
            flex-shrink: 0;
        }

        .mobile-item-info {
            flex: 1;
            min-width: 0;
        }

        .mobile-item-name {
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 4px;
            line-height: 1.3;
        }

        .mobile-item-name a {
            color: var(--text-primary);
            text-decoration: none;
        }

        .mobile-item-name a:hover {
            color: var(--gold);
        }

        .mobile-item-code {
            font-size: 0.75rem;
            color: var(--text-secondary);
            display: block;
            margin-bottom: 6px;
        }

        .mobile-item-price {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .mobile-remove {
            flex-shrink: 0;
        }

        .mobile-item-bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 12px;
            border-top: 1px dashed var(--border);
            flex-wrap: wrap;
            gap: 10px;
        }

        .mobile-item-total {
            font-size: 0.9rem;
            color: var(--text-secondary);
        }

        .mobile-item-total strong {
            color: var(--gold-dark);
            font-weight: 700;
        }

        /* ===== EMPTY CART ===== */
        .empty-cart {
            padding: 60px 20px;
            background: var(--bg-light);
            border-radius: var(--radius);
            border: 1px dashed var(--border);
        }

        .empty-icon-wrap {
            width: 100px;
            height: 100px;
            background: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: var(--shadow-md);
        }

        .empty-icon-wrap i {
            font-size: 2.5rem;
            color: var(--gold);
        }

        .empty-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 8px;
        }

        .empty-sub {
            color: var(--text-secondary);
            font-size: 0.95rem;
            margin-bottom: 20px;
        }

        /* ===== RESPONSIVE BREAKPOINTS ===== */
        @media (max-width: 767px) {
            .cart-title {
                font-size: 1.3rem;
            }

            .cart-actions-row {
                flex-direction: column;
                align-items: stretch;
            }

            .cart-actions-right {
                flex-direction: column;
            }

            .cart-btn {
                width: 100%;
                justify-content: center;
            }

            .cart-totals {
                margin-top: 10px;
            }
        }

        @media (max-width: 575px) {
            .cart-title {
                font-size: 1.15rem;
            }

            .mobile-item-top {
                gap: 10px;
            }

            .mobile-product-img img {
                width: 60px;
                height: 60px;
            }
        }

        @media (min-width: 768px) and (max-width: 991px) {
            .product-img img {
                width: 65px;
                height: 65px;
            }

            .cart-table tbody tr td {
                padding: 12px 10px;
            }

            .cart-btn {
                padding: 10px 18px;
                font-size: 0.85rem;
            }
        }

        /* ===== FLOATING TOAST ===== */
        .cart-toast {
            position: fixed;
            bottom: 28px;
            right: 24px;
            z-index: 99999;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 13px 20px;
            border-radius: 10px;
            font-size: 0.9rem;
            font-weight: 600;
            box-shadow: 0 8px 24px rgba(0,0,0,0.15);
            opacity: 0;
            transform: translateY(16px);
            transition: opacity 0.35s ease, transform 0.35s ease;
            max-width: 320px;
            pointer-events: none;
        }

        .cart-toast--show {
            opacity: 1;
            transform: translateY(0);
        }

        .cart-toast--success {
            background: #1a202c;
            color: #fff;
            border-left: 4px solid var(--gold);
        }

        .cart-toast--danger {
            background: #1a202c;
            color: #fff;
            border-left: 4px solid var(--danger);
        }

        .cart-toast__icon {
            font-size: 1rem;
            flex-shrink: 0;
        }

        .cart-toast--success .cart-toast__icon { color: var(--gold); }
        .cart-toast--danger  .cart-toast__icon { color: #fc8181; }

        @media (max-width: 575px) {
            .cart-toast {
                bottom: 16px;
                right: 12px;
                left: 12px;
                max-width: 100%;
            }
        }

        /* ===== CUSTOM CONFIRM MODAL ===== */
        .cart-confirm-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.45);
            z-index: 99998;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px;
            opacity: 0;
            transition: opacity 0.25s ease;
        }

        .cart-confirm-overlay--show {
            opacity: 1;
        }

        .cart-confirm-box {
            background: #fff;
            border-radius: 14px;
            padding: 32px 28px 24px;
            max-width: 360px;
            width: 100%;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
            transform: scale(0.93);
            transition: transform 0.25s ease;
        }

        .cart-confirm-overlay--show .cart-confirm-box {
            transform: scale(1);
        }

        .cart-confirm-icon {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: #fff8e1;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
        }

        .cart-confirm-icon i {
            font-size: 1.4rem;
            color: var(--gold);
        }

        .cart-confirm-msg {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 24px;
            line-height: 1.4;
        }

        .cart-confirm-actions {
            display: flex;
            gap: 12px;
            justify-content: center;
        }

        .cart-confirm-btn {
            flex: 1;
            padding: 10px 16px;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            border: 2px solid transparent;
            transition: all 0.2s;
        }

        .cart-confirm-cancel {
            background: var(--bg-light);
            color: var(--text-secondary);
            border-color: var(--border);
        }

        .cart-confirm-cancel:hover {
            background: var(--border);
            color: var(--text-primary);
        }

        .cart-confirm-ok {
            background: var(--danger);
            color: #fff;
            border-color: var(--danger);
        }

        .cart-confirm-ok:hover {
            background: var(--danger-dark);
            border-color: var(--danger-dark);
        }
    </style>

    <script>
        (function() {
            'use strict';

            console.log('Cart script loaded');

            // CSRF Token
            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            if (!csrfToken) {
                console.error('CSRF token not found!');
                return;
            }
            const token = csrfToken.getAttribute('content');
            console.log('CSRF Token:', token);

            // Floating toast notification (takes no space in layout)
            function showNotification(message, type = 'success') {
                const icon = type === 'success' ? '\u2713' : '\u2715';
                const toast = document.createElement('div');
                toast.className = 'cart-toast cart-toast--' + type;
                toast.innerHTML = '<span class="cart-toast__icon">' + icon + '</span><span class="cart-toast__msg">' + message + '</span>';
                document.body.appendChild(toast);
                requestAnimationFrame(() => {
                    requestAnimationFrame(() => toast.classList.add('cart-toast--show'));
                });
                setTimeout(() => {
                    toast.classList.remove('cart-toast--show');
                    setTimeout(() => { if (toast.parentNode) toast.remove(); }, 400);
                }, 3500);
            }

            // Custom confirm modal (no browser dialog, no localhost shown)
            function showConfirm(message, label, onConfirm) {
                const overlay = document.createElement('div');
                overlay.className = 'cart-confirm-overlay';
                overlay.innerHTML =
                    '<div class="cart-confirm-box">' +
                        '<div class="cart-confirm-icon"><i class="fas fa-exclamation-triangle"></i></div>' +
                        '<p class="cart-confirm-msg">' + message + '</p>' +
                        '<div class="cart-confirm-actions">' +
                            '<button class="cart-confirm-btn cart-confirm-cancel">Cancel</button>' +
                            '<button class="cart-confirm-btn cart-confirm-ok">' + label + '</button>' +
                        '</div>' +
                    '</div>';
                document.body.appendChild(overlay);
                requestAnimationFrame(() => {
                    requestAnimationFrame(() => overlay.classList.add('cart-confirm-overlay--show'));
                });
                function closeModal() {
                    overlay.classList.remove('cart-confirm-overlay--show');
                    setTimeout(() => { if (overlay.parentNode) overlay.remove(); }, 300);
                }
                overlay.querySelector('.cart-confirm-cancel').addEventListener('click', closeModal);
                overlay.querySelector('.cart-confirm-ok').addEventListener('click', () => { closeModal(); onConfirm(); });
                overlay.addEventListener('click', (e) => { if (e.target === overlay) closeModal(); });
            }

            // Update cart item via AJAX
            function updateCartItem(cartId, quantity) {
                console.log('Updating cart item:', cartId, 'Quantity:', quantity);

                fetch(`/cart/update/${cartId}`, {
                        method: 'PUT',
                        headers: {
                            'X-CSRF-TOKEN': token,
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            quantity: quantity
                        })
                    })
                    .then(response => {
                        console.log('Response status:', response.status);
                        return response.json();
                    })
                    .then(data => {
                        console.log('Response data:', data);

                        if (data.success) {
                            // Update item total for BOTH desktop & mobile using data-item-total attribute
                            document.querySelectorAll(`[data-item-total="${cartId}"]`).forEach(el => {
                                el.textContent = data.item_total;
                            });

                            // Update cart subtotal & total
                            const cartSubtotal = document.getElementById('cart-subtotal');
                            const cartTotal = document.getElementById('cart-total');

                            if (cartSubtotal) cartSubtotal.textContent = data.subtotal;
                            if (cartTotal) cartTotal.textContent = data.total;
                            document.querySelectorAll('.pro-total-amount').forEach(el => el.textContent = data.total);
                            

                            updateHeaderCartCount(data.cart_count);
                            showNotification('Cart updated successfully', 'success');
                        } else {
                            showNotification(data.message || 'Error updating cart', 'danger');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showNotification('Error updating cart', 'danger');
                    });
            }

            // Remove item from cart
            function removeFromCart(cartId) {
                console.log('Removing cart item:', cartId);

                showConfirm('Remove this item from cart?', 'Yes, Remove', () => {
                    doRemoveFromCart(cartId);
                });
            }

            function doRemoveFromCart(cartId) {
                fetch(`/cart/remove/${cartId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': token,
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => {
                        console.log('Delete response status:', response.status);
                        return response.json();
                    })
                    .then(data => {
                        console.log('Delete response data:', data);

                        if (data.success) {
                            // Remove ALL elements with this cart-item id (desktop tr + mobile div)
                            document.querySelectorAll(`[id="cart-item-${cartId}"]`).forEach(el => el.remove());

                            const cartSubtotal = document.getElementById('cart-subtotal');
                            const cartTotal = document.getElementById('cart-total');

                            if (cartSubtotal) cartSubtotal.textContent = data.subtotal;
                            if (cartTotal) cartTotal.textContent = data.total;
                            document.querySelectorAll('.pro-total-amount').forEach(el => el.textContent = data.total);
                            

                            updateHeaderCartCount(data.cart_count);

                            const remainingRows = document.querySelectorAll('tbody tr, .mobile-cart-item');
                            const headingElement = document.querySelector('.cart-title');
                            if (headingElement) {
                                const badge = headingElement.querySelector('.cart-badge');
                                if (badge) badge.textContent = remainingRows.length;
                            }

                            if (remainingRows.length === 0) {
                                showEmptyCartMessage();
                            }

                            showNotification(data.message, 'success');
                        } else {
                            showNotification(data.message || 'Error removing item', 'danger');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showNotification('Error removing item from cart', 'danger');
                    });
            }

            // Clear entire cart
            function clearCart() {
                console.log('Clearing cart');

                showConfirm('Clear your entire cart?', 'Yes, Clear All', () => {
                    window.location.href = '/cart/clear';
                });
            }

            // Update cart count in header
            function updateHeaderCartCount(count) {
                console.log('Updating header cart count:', count);
                const cartCountElements = document.querySelectorAll('.cart-count-badge, .pro-count, .cart-count');
                
                cartCountElements.forEach(element => {
                    element.textContent = count;
                });
            }

            // Show empty cart message
            function showEmptyCartMessage() {
                const cartWrapper = document.querySelector('.cart-wrapper');
                if (cartWrapper) {
                    cartWrapper.innerHTML = `
                        <div class="empty-cart text-center py-5">
                            <div class="empty-icon-wrap">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <h4 class="empty-title">Your cart is empty</h4>
                            <p class="empty-sub">Looks like you haven't added any items to your cart yet.</p>
                            <a href="{{ route('shops') }}" class="cart-btn btn-gold mt-3">
                                Start Shopping
                            </a>
                        </div>
                    `;
                }
            }

            // Wait for DOM to load
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initCart);
            } else {
                initCart();
            }

            function initCart() {
                console.log('Initializing cart...');

                // Show session flash messages as floating toasts
                const flashSuccess = document.getElementById('flash-success');
                const flashError = document.getElementById('flash-error');
                if (flashSuccess) showNotification(flashSuccess.dataset.msg, 'success');
                if (flashError)   showNotification(flashError.dataset.msg, 'danger');

                // Quantity increase/decrease buttons
                const quantityButtons = document.querySelectorAll('.quantity-down, .quantity-up');
                console.log('Found quantity buttons:', quantityButtons.length);

                quantityButtons.forEach(button => {
                    const newButton = button.cloneNode(true);
                    button.parentNode.replaceChild(newButton, button);

                    newButton.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopImmediatePropagation();
                        console.log('Quantity button clicked');

                        const cartId = this.getAttribute('data-cart-id');
                        const action = this.getAttribute('data-action');

                        // Find the input WITHIN the same quantity-input container as this button
                        // This avoids picking the wrong input when both desktop & mobile inputs exist in DOM
                        const container = this.closest('.quantity-input');
                        const input = container
                            ? container.querySelector(`input[data-cart-id="${cartId}"]`)
                            : document.querySelector(`input[data-cart-id="${cartId}"]`);

                        let newQuantity = parseInt(input.value);

                        console.log('Cart ID:', cartId, 'Action:', action, 'Current quantity:', newQuantity);

                        if (action === 'decrease') {
                            newQuantity--;
                            if (newQuantity < 1) {
                                removeFromCart(cartId);
                                return;
                            }
                        } else {
                            newQuantity++;
                        }

                        // Update ALL inputs with this cartId so desktop & mobile stay in sync
                        document.querySelectorAll(`input[data-cart-id="${cartId}"]`).forEach(el => el.value = newQuantity);
                        updateCartItem(cartId, newQuantity);
                    });
                });

                // Quantity input change
                const quantityInputs = document.querySelectorAll('.quantity');
                console.log('Found quantity inputs:', quantityInputs.length);

                quantityInputs.forEach(input => {
                    const newInput = input.cloneNode(true);
                    input.parentNode.replaceChild(newInput, input);

                    newInput.addEventListener('change', function(e) {
                        e.stopImmediatePropagation();
                        console.log('Quantity input changed');

                        const cartId = this.getAttribute('data-cart-id');
                        let newQuantity = parseInt(this.value);

                        console.log('Cart ID:', cartId, 'New quantity:', newQuantity);

                        if (isNaN(newQuantity) || newQuantity < 1) {
                            newQuantity = 1;
                            this.value = 1;
                        }

                        updateCartItem(cartId, newQuantity);
                    });
                });

                // Delete buttons
                const deleteButtons = document.querySelectorAll('.cart-remove');
                console.log('Found delete buttons:', deleteButtons.length);

                deleteButtons.forEach(button => {
                    const newButton = button.cloneNode(true);
                    button.parentNode.replaceChild(newButton, button);

                    newButton.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopImmediatePropagation();
                        console.log('Delete button clicked');

                        const cartId = this.getAttribute('data-cart-id');
                        console.log('Cart ID:', cartId);

                        removeFromCart(cartId);
                    });
                });

                // Clear cart button
                const clearCartBtn = document.getElementById('clear-cart-btn');
                if (clearCartBtn) {
                    console.log('Clear cart button found');
                    clearCartBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        console.log('Clear cart button clicked');
                        clearCart();
                    });
                } else {
                    console.log('Clear cart button NOT found');
                }

                // Update header cart count on load
                fetch('/cart/count')
                    .then(response => response.json())
                    .then(data => {
                        console.log('Cart count data:', data);
                        if (data.count !== undefined) {
                            updateHeaderCartCount(data.count);
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching cart count:', error);
                    });

                console.log('Cart initialized successfully');
            }
        })();
    </script>
@endsection
