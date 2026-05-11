@extends('layouts.app')

@section('title', 'My Wishlist - Pesco eCommerce')

@section('content')

<!--====== Start Wishlist Section ======-->
<section class="wishlist-section pt-50 pb-80">
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="section-title mb-40 text-center">
                    <h2>My Wishlist</h2>
                    <p>{{ $wishlistItems->count() }} item(s) in your wishlist</p>
                </div>
            </div>
        </div>

        @if ($wishlistItems->count() > 0)
            <div class="row">
                @foreach ($wishlistItems as $item)
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12" id="wishlist-item-{{ $item->product->id }}">
                        <div class="product-item style-one mb-40">
                            <div class="product-thumbnail">
                                @if($item->product->thumbnail)
                                    <img src="{{ asset('storage/' . $item->product->thumbnail) }}"
                                         alt="{{ $item->product->name }}"
                                         style="width: 100%; height: 400px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('assets/images/products/feature-product-1.png') }}"
                                         alt="{{ $item->product->name }}"
                                         style="width: 100%; height: 400px; object-fit: cover;">
                                @endif

                                @if($item->product->discount_price)
                                    @php
                                        $discountPercentage = round((($item->product->regular_price - $item->product->discount_price) / $item->product->regular_price) * 100);
                                    @endphp
                                    <div class="discount">{{ $discountPercentage }}% Off</div>
                                @endif

                                <!-- Remove Button -->
                                <div class="remove-wishlist-btn">
                                    <button class="btn btn-danger btn-sm remove-from-wishlist"
                                            data-product-id="{{ $item->product->id }}">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>

                                <div class="hover-content">
                                    <a href="{{ $item->product->details_url }}" class="icon-btn">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </div>

                                {{-- <div class="cart-button">
                                    <a href="javascript:void(0)" class="cart-btn add-to-cart"
                                       data-product-id="{{ $item->product->id }}"
                                       data-product-name="{{ $item->product->name }}"
                                       data-product-price="{{ $item->product->discount_price ?? $item->product->regular_price }}">
                                        <i class="far fa-shopping-basket"></i>
                                        <span class="text">Add To Cart</span>
                                    </a>
                                </div> --}}
                            </div>

                            <div class="product-info-wrap text-center">
                                <h4 class="product-title">
                                    <a href="{{ $item->product->details_url }}">
                                        {{ \Illuminate\Support\Str::limit($item->product->name, 40) }}
                                    </a>
                                </h4>

                                <div class="product-meta">
                                    {{ strtoupper($item->product->category->name ?? 'UNCATEGORIZED') }}
                                    @if($item->product->subcategory)
                                        , {{ $item->product->subcategory->name }}
                                    @endif
                                </div>

                                {{-- <div class="product-price">
                                    @if($item->product->discount_price)
                                        <span class="old-price">
                                            ${{ number_format($item->product->regular_price, 2) }}
                                        </span>
                                        <span class="new-price">
                                            ${{ number_format($item->product->discount_price, 2) }}
                                        </span>
                                    @else
                                        <span class="new-price">
                                            ${{ number_format($item->product->regular_price, 2) }}
                                        </span>
                                    @endif
                                </div> --}}
     <div class="product-price">
    @if($item->product->discount_price)
        <span class="old-price">
            {{ \App\Helpers\CurrencyHelper::formatPrice($item->product->regular_price) }}
        </span>
        <span class="new-price">
            {{ \App\Helpers\CurrencyHelper::formatPrice($item->product->discount_price) }}
        </span>
    @else
        <span class="new-price">
            {{ \App\Helpers\CurrencyHelper::formatPrice($item->product->regular_price) }}
        </span>
    @endif
</div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="row">
                <div class="col-12">
                    <div class="empty-wishlist text-center py-5">
                        <i class="fas fa-heart fa-4x text-muted mb-3"></i>
                        <h4>Your wishlist is empty</h4>
                        <p>Add products you love to your wishlist!</p>
                        <a href="{{ route('shops') }}" class="theme-btn style-one mt-3">
                            Start Shopping
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
<!--====== End Wishlist Section ======-->

<script>
document.addEventListener('DOMContentLoaded', function () {

    // Remove from wishlist
    $('.remove-from-wishlist').click(function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();

        const productId = $(this).data('product-id');
        const $btn = $(this);
        const $productCard = $(`#wishlist-item-${productId}`);

        if (!confirm('Remove this product from wishlist?')) {
            return;
        }

        // Disable button during request
        $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');

        $.ajax({
            url: '{{ route("wishlist.remove") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                product_id: productId
            },
            success: function(response) {
                console.log('Remove response:', response);

                if (response.success) {
                    // Remove product card with animation
                    $productCard.fadeOut(300, function() {
                        $(this).remove();

                        // Check if wishlist is empty
                        if ($('.product-item').length === 0) {
                            location.reload();
                        } else {
                            // Update count in heading
                            const remainingItems = $('.product-item').length;
                            $('.section-title p').text(remainingItems + ' item(s) in your wishlist');
                        }
                    });

                    // Update wishlist count in header
                    if (response.wishlist_count !== undefined) {
                        $('.wishlist-count, .pro-count.wishlist-count').text(response.wishlist_count);
                    }

                    showNotification(response.message, 'success');
                } else {
                    showNotification(response.message || 'Failed to remove item', 'danger');
                    $btn.prop('disabled', false).html('<i class="fas fa-times"></i>');
                }
            },
            error: function(xhr) {
                console.error('Remove error:', xhr);
                let errorMsg = 'Error removing from wishlist';

                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMsg = xhr.responseJSON.message;
                }

                showNotification(errorMsg, 'danger');
                $btn.prop('disabled', false).html('<i class="fas fa-times"></i>');
            }
        });
    });

    function showNotification(message, type = 'success') {
        // Remove existing notifications
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

<style>
/* Notification Styling */
.custom-notification {
    position: fixed;
    top: 80px;
    right: 20px;
    z-index: 9999;
    min-width: 300px;
    max-width: 400px;
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

.empty-wishlist {
    padding: 50px 20px;
    background: #f9f9f9;
    border-radius: 10px;
}

.empty-wishlist i {
    font-size: 80px;
    margin-bottom: 20px;
    opacity: 0.5;
}

/* বাটন দুইটিকে একটি কলামে রাখার জন্য কন্টেইনার স্টাইল */
.product-thumbnail {
    position: relative;
}

/* Remove Button styling */
.remove-wishlist-btn {
    position: absolute;
    top: 15px;         /* একদম উপরে */
    right: 15px;
    z-index: 15;
}

.remove-wishlist-btn .btn {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Eye Button (Hover Content) styling */
.product-thumbnail .hover-content {
    position: absolute;
    top: 55px !important;    /* রিমুভ বাটনের ঠিক নিচে (১৫ + ৩২ + ৮ পিক্সেল গ্যাপ) */
    right: 15px !important;  /* ডান দিক থেকে একই সমান দূরত্ব */
    left: auto !important;   /* মাঝখানে থাকলে সেটা ক্যানসেল করবে */
    transform: none !important; /* সেন্টারিং ক্যানসেল করবে */
    margin: 0 !important;
    padding: 0 !important;
    z-index: 14;
    opacity: 1 !important;    /* যদি মাউস না নিলে লুকিয়ে থাকে তবে এটি দরকার */
    visibility: visible !important;
}

.product-thumbnail .hover-content .icon-btn {
    width: 32px;             /* রিমুভ বাটনের সমান সাইজ */
    height: 32px;
    border-radius: 50%;
    background: #fff;
    color: #333;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    transition: all 0.3s ease;
}

.product-thumbnail .hover-content .icon-btn:hover {
    background: #333;
    color: #fff;
}

.remove-wishlist-btn .btn {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.remove-wishlist-btn .btn:hover {
    transform: scale(1.1);
    box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
}

.remove-wishlist-btn .btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}



</style>
@endsection
