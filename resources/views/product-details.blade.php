@extends('layouts.app')

@section('title', $product->name . ' - Product Details')

@section('content')

    <div class="breadcrumb-wrapper ml-130 mt-40">
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

    <!--====== Start Shop Details Section ======-->
    <section class="shop-details-section pt-70 pb-80">
        <div class="container">
            <div class="shop-details-wrapper">
                <div class="row">
                    <div class="col-xl-6">
                        <!--=== Product Gallery ===-->
                        <div class="product-gallery-area mb-50" data-aos="fade-up" data-aos-duration="1200">
                            <div class="product-big-slider mb-30">
                                <!-- Main thumbnail -->
                                @if ($product->thumbnail)
                                    <div class="product-img">
                                        <a href="{{ asset('storage/' . $product->thumbnail) }}" class="img-popup">
                                            <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                                alt="{{ $product->name }}"
                                                style="width: 100%; height: 500px; object-fit: cover;">
                                        </a>
                                    </div>
                                @else
                                    <div class="product-img">
                                        <a href="{{ asset('assets/images/products/product-big-1.jpg') }}" class="img-popup">
                                            <img src="{{ asset('assets/images/products/product-big-1.jpg') }}"
                                                alt="{{ $product->name }}"
                                                style="width: 100%; height: 500px; object-fit: cover;">
                                        </a>
                                    </div>
                                @endif

                                <!-- Gallery images -->
                                @foreach ($product->images as $image)
                                    <div class="product-img">
                                        <a href="{{ asset('storage/' . $image->image) }}" class="img-popup">
                                            <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $product->name }}"
                                                style="width: 100%; height: 500px; object-fit: cover;">
                                        </a>
                                    </div>
                                @endforeach

                                <!-- Fallback images if no gallery -->
                                @if ($product->images->isEmpty())
                                    @for ($i = 2; $i <= 5; $i++)
                                        <div class="product-img">
                                            <a href="{{ asset('assets/images/products/product-big-' . $i . '.jpg') }}"
                                                class="img-popup">
                                                <img src="{{ asset('assets/images/products/product-big-' . $i . '.jpg') }}"
                                                    alt="{{ $product->name }}"
                                                    style="width: 100%; height: 500px; object-fit: cover;">
                                            </a>
                                        </div>
                                    @endfor
                                @endif
                            </div>

                            <div class="product-thumb-slider">
                                <!-- Thumbnail -->
                                @if ($product->thumbnail)
                                    <div class="product-img">
                                        <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                            alt="{{ $product->name }}"
                                            style="width: 100px; height: 100px; object-fit: cover;">
                                    </div>
                                @else
                                    <div class="product-img">
                                        <img src="{{ asset('assets/images/products/product-thumb-1.jpg') }}"
                                            alt="{{ $product->name }}"
                                            style="width: 100px; height: 100px; object-fit: cover;">
                                    </div>
                                @endif

                                <!-- Gallery thumbnails -->
                                @foreach ($product->images as $image)
                                    <div class="product-img">
                                        <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $product->name }}"
                                            style="width: 100px; height: 100px; object-fit: cover;">
                                    </div>
                                @endforeach

                                <!-- Fallback thumbnails -->
                                @if ($product->images->isEmpty())
                                    @for ($i = 2; $i <= 5; $i++)
                                        <div class="product-img">
                                            <img src="{{ asset('assets/images/products/product-thumb-' . $i . '.jpg') }}"
                                                alt="{{ $product->name }}"
                                                style="width: 100px; height: 100px; object-fit: cover;">
                                        </div>
                                    @endfor
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="product-info mb-50" data-aos="fade-up" data-aos-duration="1400">
                            @if ($product->discount_price)
                                @php
                                    $discountPercentage = round(
                                        (($product->regular_price - $product->discount_price) /
                                            $product->regular_price) *
                                            100,
                                    );
                                @endphp
                                <span class="sale  bg-white text-dark "><i class="fas fa-tags"></i>SALE {{ $discountPercentage }}% OFF</span>
                            @endif

                            <h4 class="title">{{ $product->name }}</h4>
                            <div class="product-price">
                                @if ($product->discount_price)
                                    <span class="old-price" style="color:black;">
                                        {{ \App\Helpers\CurrencyHelper::formatPrice($product->regular_price) }}
                                    </span>
                                    <span class="new-price" style="color:black;">
                                        {{ \App\Helpers\CurrencyHelper::formatPrice($product->discount_price) }}
                                    </span>
                                @else
                                    <span class="new-price" style="color:black;">
                                        {{ \App\Helpers\CurrencyHelper::formatPrice($product->regular_price) }}
                                    </span>
                                @endif
                            </div>
                            <div class="d-flex align-items-center gap-2 mb-2">

                                @if ($product->stock_quantity == 0)
                                    <span class="badge  bg-white text-dark ">Out of Stock</span>
                                @elseif($product->stock_quantity < 10)
                                    <span class="badge bg-white text-dark ">
                                        Low Stock ({{ $product->stock_quantity }} left)
                                    </span>
                                @else
                                    <span class="badge  bg-white text-dark  ">In Stock</span>
                                @endif

                                @if ($product->delivery_days)
                                    <span class="badge  bg-white text-dark  ">
                                        Delivery in {{ $product->delivery_days }} days
                                    </span>
                                @endif

                            </div>

                            <p>{{ $product->description ?? 'A type of casual shorts, typically for men, with multiple pockets for function. Sundress with drawstring: A loose-fitting, sleeveless dress, often for women, with a drawstring at the waist for adjustability and a relaxed silhouette.' }}
                            </p>


                            <!-- Dimensions (if available) -->
                            @if ($product->height || $product->width || $product->length)
                                <div class="product-dimensions mb-20">
                                    <h4 class="mb-10">Dimensions</h4>
                                    <div class="row">
                                        @if ($product->height)
                                            <div class="col-4">
                                                <div class="dimension-box text-center p-2 bg-light rounded">
                                                    <div class="body-text">Height</div>
                                                    <div class="body-title">{{ $product->height }} cm</div>
                                                </div>
                                            </div>
                                        @endif
                                        @if ($product->width)
                                            <div class="col-4">
                                                <div class="dimension-box text-center p-2 bg-light rounded">
                                                    <div class="body-text">Width</div>
                                                    <div class="body-title">{{ $product->width }} cm</div>
                                                </div>
                                            </div>
                                        @endif
                                        @if ($product->length)
                                            <div class="col-4">
                                                <div class="dimension-box text-center p-2 bg-light rounded">
                                                    <div class="body-text">Length</div>
                                                    <div class="body-title">{{ $product->length }} cm</div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            <div class="product-cart-variation">
                                <form action="{{ route('cart.add.item', $product->id) }}" method="POST"
                                    class="d-inline-flex align-items-center">
                                    @csrf

                                    <div class="quantity-input me-3">
                                        <button type="button" class="quantity-down"><i class="far fa-minus"></i></button>
                                        <input class="quantity" type="number" value="1" name="quantity" min="1"
                                            style="width: 60px; text-align: center;">
                                        <button type="button" class="quantity-up"><i class="far fa-plus"></i></button>
                                    </div>

                                    <button type="submit" class="style-one" style="background:white; color:black; padding:12px 24px; margin:0 4px 12px 4px; border:0.1px solid #94938f; border-radius:30px; font-weight:800;">
                                        Add To Cart
                                    </button>
                                </form>

                                <div class="d-inline-flex ms-3">
                                    <a href="javascript:void(0)" class="icon-btn toggle-wishlist"
                                        data-product-id="{{ $product->id }}">
                                        <i class="fa fa-heart"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="special-features">
                                <span><i class="fas fa-certificate"></i> Quality Guarantee</span>
                                <span><i class="far fa-box-open"></i>Easy Returns</span>
                                <span><i class="far fa-shield-check"></i>Secure Payment</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="additional-information-wrapper" data-aos="fade-up" data-aos-delay="30"
                    data-aos-duration="1000">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="additional-info-box mb-40">
                                <h3>Additional Information:</h3>
                                <ul>
                                    <li>Product Code <span>{{ $product->product_code }}</span></li>
                                    <li>Category<span>{{ $product->category->name ?? 'N/A' }}</span></li>
                                    <li>Subcategory<span>{{ $product->subcategory->name ?? 'N/A' }}</span></li>
                                    @if ($product->height)
                                        <li>Height<span>{{ $product->height }} cm</span></li>
                                    @endif
                                    @if ($product->width)
                                        <li>Width<span>{{ $product->width }} cm</span></li>
                                    @endif
                                    @if ($product->length)
                                        <li>Length<span>{{ $product->length }} cm</span></li>
                                    @endif
                                    <li>Added On<span>{{ $product->created_at->format('d M, Y') }}</span></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-7">
                            <div class="description-wrapper mb-40">
                                <div class="pesco-tabs style-two mb-50">
                                    <ul class="nav nav-tabs">
                                        <li>
                                            <button class="nav-link active" data-bs-toggle="tab"
                                                data-bs-target="#description">Description</button>
                                        </li>
                                        <li>
                                            <button class="nav-link" data-bs-toggle="tab"
                                                data-bs-target="#reviews">Reviews</button>
                                        </li>
                                    </ul>
                                </div>

                                <div class="tab-content">
                                    <div class="tab-pane fade active show" id="description">
                                        <h4>Description</h4>
                                        <p>{{ $product->description ?? 'Cargo shorts: Rugged, casual shorts with multiple pockets for utility, often in khaki or olive green. Sundress with drawstring: A breezy, summery dress with a flowy skirt, often made from light, patterned fabric. It has a drawstring waist for a comfortable, adjustable fit. Designed for practicality, cargo shorts boast numerous pockets on the legs and hips. everyday wear for someone who needs to carry a lot.' }}
                                        </p>

                                        @if ($product->height || $product->width || $product->length)
                                            <h4>Product Dimensions</h4>
                                            <ul class="list">
                                                @if ($product->height)
                                                    <li>Height: {{ $product->height }} cm</li>
                                                @endif
                                                @if ($product->width)
                                                    <li>Width: {{ $product->width }} cm</li>
                                                @endif
                                                @if ($product->length)
                                                    <li>Length: {{ $product->length }} cm</li>
                                                @endif
                                            </ul>
                                        @endif
                                    </div>

                                    <div class="tab-pane fade" id="reviews">
                                        <div class="pesco-comment-area mb-80">
                                            <h4>Total Reviews ({{ rand(20, 100) }})</h4>
                                            <ul>
                                                @for ($i = 1; $i <= 2; $i++)
                                                    <li class="comment">
                                                        <div class="pesco-reviews-item">
                                                            <div class="author-thumb-info">
                                                                <div class="author-thumb">
                                                                    <img src="{{ asset('assets/images/products/review-' . $i . '.jpg') }}"
                                                                        alt="Author">
                                                                </div>
                                                                <div class="author-info">
                                                                    <h5>Customer {{ $i }}</h5>
                                                                    <div class="author-meta">
                                                                        <ul class="ratings">
                                                                            @for ($j = 1; $j <= 5; $j++)
                                                                                <li><i class="fas fa-star"></i></li>
                                                                            @endfor
                                                                        </ul>
                                                                        <span>{{ now()->subDays(rand(1, 30))->format('d M Y') }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="author-review-content">
                                                                <p>Excellent product with great quality. Perfect fit and
                                                                    comfortable to wear. Would definitely recommend to
                                                                    others.</p>
                                                            </div>
                                                            <a href="javascript:void(0)" class="reply">
                                                                <i class="fas fa-reply-all"></i>Reply
                                                            </a>
                                                        </div>
                                                    </li>
                                                @endfor
                                            </ul>
                                        </div>

                                        <div class="reviews-contact-area">
                                            <h4>Write Comment</h4>
                                            <ul class="ratings rating5 mb-40">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <li><i class="fas fa-star" data-rating="{{ $i }}"></i>
                                                    </li>
                                                @endfor
                                                <li><a href="javascript:void(0)">(10)</a></li>
                                            </ul>
                                            <form class="pesco-contact-form" id="reviewForm">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <input type="hidden" name="rating" id="rating" value="5">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <input type="text" placeholder="Name" class="form_control"
                                                                name="name" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <input type="email" placeholder="Email"
                                                                class="form_control" name="email" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <textarea class="form_control" placeholder="Write Reviews" name="review" cols="5" rows="10" required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <button type="submit" class="theme-btn style-one">Submit
                                                                Review</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--====== End Shop Details Section ======-->

    <!--====== Related Product Section ======-->
    @if ($relatedProducts->count() > 0)
        <section class="releted-product-section pb-90">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <!--=== Section Title ===-->
                        <div class="section-title mb-50" data-aos="fade-right" data-aos-delay="50"
                            data-aos-duration="1000">
                            <div class="sub-heading d-inline-flex align-items-center">
                                <i class="flaticon-sparkler"></i>
                                <span class="sub-title">Related Products</span>
                            </div>
                            <h2>Customers also purchased</h2>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="releted-product-arrows style-one mb-50" data-aos="fade-left" data-aos-delay="70"
                            data-aos-duration="1300"></div>
                    </div>
                </div>

                <div class="releted-product-slider">
                    @foreach ($relatedProducts as $relatedProduct)
                        <div class="product-item style-one mb-40" data-aos="fade-up"
                            data-aos-delay="{{ $loop->index * 20 + 90 }}"
                            data-aos-duration="{{ 1500 + $loop->index * 200 }}">
                            <div class="product-thumbnail">
                                @if ($relatedProduct->thumbnail)
                                    <img src="{{ asset('storage/' . $relatedProduct->thumbnail) }}"
                                        alt="{{ $relatedProduct->name }}"
                                        style="width: 100%; height: 300px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('assets/images/products/feature-product-' . (($loop->index % 4) + 1) . '.png') }}"
                                        alt="{{ $relatedProduct->name }}"
                                        style="width: 100%; height: 300px; object-fit: cover;">
                                @endif

                                @if ($relatedProduct->discount_price)
                                    @php
                                        $relatedDiscount = round(
                                            (($relatedProduct->regular_price - $relatedProduct->discount_price) /
                                                $relatedProduct->regular_price) *
                                                100,
                                        );
                                    @endphp
                                    <div class="discount">{{ $relatedDiscount }}% Off</div>
                                @endif

                                <div class="hover-content">
                                    <a href="javascript:void(0)" class="icon-btn add-to-wishlist"
                                        data-product-id="{{ $relatedProduct->id }}">
                                        <i class="fa fa-heart"></i>
                                    </a>
                                    <a href="{{ asset($relatedProduct->thumbnail ? 'storage/' . $relatedProduct->thumbnail : 'assets/images/products/feature-product-' . (($loop->index % 4) + 1) . '.png') }}"
                                        class="img-popup icon-btn">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </div>
                                <div class="cart-button">
    <a href="{{ $relatedProduct->details_url }}" class="cart-btn">
        <i class="far fa-eye"></i>
        <span class="text">View Details</span>
    </a>
</div>
                            </div>
                            <div class="product-info-wrap">
                                <div class="product-info">
                                    <h4 class="title">
                                        <a href="{{ $relatedProduct->details_url }}">
                                            {{ Str::limit($relatedProduct->name, 30) }}
                                        </a>
                                    </h4>
                                </div>

                                <div class="product-price">
                                    @if ($relatedProduct->discount_price)
                                        <span class="old-price">
                                            {{ \App\Helpers\CurrencyHelper::formatPrice($relatedProduct->regular_price) }}
                                        </span>
                                        <span class="new-price">
                                            {{ \App\Helpers\CurrencyHelper::formatPrice($relatedProduct->discount_price) }}
                                        </span>
                                    @else
                                        <span class="new-price">
                                            {{ \App\Helpers\CurrencyHelper::formatPrice($relatedProduct->regular_price) }}
                                        </span>
                                    @endif
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Quantity counter
            const quantityInput = document.getElementById('quantity');
            const minusBtn = document.querySelector('.quantity-down');
            const plusBtn = document.querySelector('.quantity-up');

            if (minusBtn && plusBtn && quantityInput) {
                minusBtn.addEventListener('click', function() {
                    let currentValue = parseInt(quantityInput.value);
                    if (currentValue > 1) {
                        quantityInput.value = currentValue - 1;
                    }
                });

                plusBtn.addEventListener('click', function() {
                    let currentValue = parseInt(quantityInput.value);
                    quantityInput.value = currentValue + 1;
                });
            }

            // Add to cart functionality
            document.querySelectorAll('.add-to-cart').forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.dataset.productId;
                    const quantity = document.getElementById('quantity')?.value || 1;

                    fetch(`/cart/add-item/${productId}`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').content,
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                quantity
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                alert(data.message);

                                // Update cart count in header
                                fetch('/cart/count')
                                    .then(res => res.json())
                                    .then(countData => {
                                        const cartCountElement = document.querySelector(
                                            '.pro-count');
                                        if (cartCountElement) {
                                            cartCountElement.textContent = countData
                                                .count;
                                        }
                                    });
                            } else {
                                alert(data.message);
                                if (data.redirect) window.location.href = data.redirect;
                            }
                        })
                        .catch(err => console.error(err));
                });
            });

            document.querySelectorAll('.add-to-wishlist').forEach(button => {
                const productId = button.dataset.productId;

                // Check initial wishlist state
                fetch(`/wishlist/check/${productId}`)
                    .then(res => res.json())
                    .then(data => {
                        if (data.in_wishlist) {
                            button.classList.add('active');
                            button.innerHTML = '<i class="fas fa-heart"></i>';
                        }
                    });

                // Toggle wishlist
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    fetch(`/wishlist/toggle/${productId}`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').content,
                                'Content-Type': 'application/json'
                            }
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                if (data.action === 'added') {
                                    button.classList.add('active');
                                    button.innerHTML = '<i class="fas fa-heart"></i>';
                                    showToast('Added to wishlist!', 'success');
                                } else {
                                    button.classList.remove('active');
                                    button.innerHTML = '<i class="far fa-heart"></i>';
                                    showToast('Removed from wishlist!', 'info');
                                }
                                updateWishlistCount();
                            } else {
                                if (data.redirect) {
                                    showToast(data.message, 'warning');
                                    setTimeout(() => location.href = data.redirect, 1500);
                                }
                            }
                        });
                });
            });

            function updateWishlistCount() {
                fetch('/wishlist/count')
                    .then(res => res.json())
                    .then(data => {
                        document.querySelectorAll('.wishlist-count').forEach(el => {
                            el.textContent = data.count;
                        });
                    });
            }


            // Rating stars
            const stars = document.querySelectorAll('.stars i');
            const ratingInput = document.getElementById('rating');

            if (stars.length && ratingInput) {
                stars.forEach(star => {
                    star.addEventListener('click', function() {
                        const rating = this.getAttribute('data-rating');
                        ratingInput.value = rating;

                        stars.forEach(s => {
                            if (parseInt(s.getAttribute('data-rating')) <= rating) {
                                s.classList.remove('far');
                                s.classList.add('fas');
                                s.classList.add('text-warning');
                            } else {
                                s.classList.remove('fas');
                                s.classList.remove('text-warning');
                                s.classList.add('far');
                            }
                        });
                    });
                });
            }

            // Review form submission
            const reviewForm = document.getElementById('reviewForm');
            if (reviewForm) {
                reviewForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    // Get form data
                    const formData = new FormData(this);

                    alert('Thank you for your review! It will be published after moderation.');
                    this.reset();

                    // Reset stars if exists
                    if (stars.length && ratingInput) {
                        stars.forEach(star => {
                            star.classList.remove('fas');
                            star.classList.remove('text-warning');
                            star.classList.add('far');
                        });
                        ratingInput.value = '5';
                    }
                });
            }

            // Newsletter form
            const newsletterForm = document.getElementById('newsletterForm');
            if (newsletterForm) {
                newsletterForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const email = this.querySelector('input[name="email"]').value;

                    alert('Thank you for subscribing to our newsletter!');
                    this.reset();
                });
            }

            function updateCartCount() {
                fetch('/cart/count')
                    .then(res => res.json())
                    .then(data => {
                        if (data.authenticated && data.count !== undefined) {
                            document.querySelectorAll('.cart-count, .pro-count, .cart-count-badge').forEach(
                                el => {
                                    el.textContent = data.count;
                                    el.style.display = data.count > 0 ? 'inline' : 'none';
                                });
                        }
                    })
                    .catch(err => console.error('Error fetching cart count:', err));
            }

            updateCartCount();

            if (typeof $ !== 'undefined' && $.fn.slick) {
                $('.product-big-slider').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    fade: true,
                    asNavFor: '.product-thumb-slider'
                });

                $('.product-thumb-slider').slick({
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    asNavFor: '.product-big-slider',
                    dots: false,
                    arrows: false,
                    focusOnSelect: true
                });

                // Related products slider
                $('.releted-product-slider').slick({
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 3000,
                    arrows: true,
                    dots: false,
                    prevArrow: '.releted-product-arrows .slick-prev',
                    nextArrow: '.releted-product-arrows .slick-next',
                    responsive: [{
                            breakpoint: 1200,
                            settings: {
                                slidesToShow: 3
                            }
                        },
                        {
                            breakpoint: 992,
                            settings: {
                                slidesToShow: 2
                            }
                        },
                        {
                            breakpoint: 576,
                            settings: {
                                slidesToShow: 1
                            }
                        }
                    ]
                });
            }
        });
    </script>

    <style>
        .color0 {
            background-color: #000;
        }

        .color1 {
            background-color: #dc3545;
        }

        .color2 {
            background-color: #007bff;
        }

        .color3 {
            background-color: #28a745;
        }

        .color0,
        .color1,
        .color2,
        .color3 {
            display: inline-block;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            border: 2px solid #ddd;
            cursor: pointer;
        }

        .dimension-box {
            border: 1px solid #eee;
        }

        .sale {
            background: #dc3545;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            display: inline-block;
            margin-bottom: 15px;
            font-size: 14px;
            font-weight: 600;
        }

        .stars i {
            cursor: pointer;
            transition: all 0.3s;
        }

        .stars i.text-warning {
            color: #ffc107 !important;
        }

        .releted-product-slider .slick-slide {
            padding: 0 15px;
        }

        /* Wishlist button active state */
        .wishlist-btn.active i {
            color: #ff0000 !important;
        }

        .add-to-wishlist.active i {
            color: #ff0000;
        }


        /* Toast notification styles */
        .custom-toast {
            position: fixed;
            top: 20px;
            right: 20px;
            background: white;
            padding: 15px 25px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            z-index: 9999;
            opacity: 0;
            transform: translateX(400px);
            transition: all 0.3s ease;
        }

        .custom-toast.show {
            opacity: 1;
            transform: translateX(0);
        }

        .custom-toast-success {
            border-left: 4px solid #10b981;
        }

        .custom-toast-error {
            border-left: 4px solid #ef4444;
        }

        .custom-toast-warning {
            border-left: 4px solid #f59e0b;
        }

        .custom-toast-info {
            border-left: 4px solid #3b82f6;
        }

        .toast-content {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            font-weight: 500;
        }

        .toast-content i {
            font-size: 18px;
        }

        .custom-toast-success .toast-content i {
            color: #10b981;
        }

        .custom-toast-error .toast-content i {
            color: #ef4444;
        }

        .custom-toast-warning .toast-content i {
            color: #f59e0b;
        }

        .custom-toast-info .toast-content i {
            color: #3b82f6;
        }

        .product-tag {
            padding: 18px 16px;
            font-size: 18px;
            border-radius: 25px;
        }
    </style>
@endpush
