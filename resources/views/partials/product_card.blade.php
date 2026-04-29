<div class="product-item style-one mb-40">
    <div class="product-thumbnail">
        <a href="{{ route('product-details', [
            'cat_slug' => optional($product->category)->slug ?? 'no-category',
            'subcat_slug' => optional($product->subcategory)->slug ?? 'no-subcategory',
            'prod_slug' => $product->slug ?? 'no-slug',
        ]) }}">
            @if ($product->thumbnail)
                <img src="{{ asset('storage/' . $product->thumbnail) }}"
                    alt="{{ $product->name }}"
                    style="width: 100%; height: 400px; object-fit: cover;">
            @else
                <img src="{{ asset('assets/images/products/feature-product-1.png') }}"
                    alt="{{ $product->name }}"
                    style="width: 100%; height: 400px; object-fit: cover;">
            @endif
        </a>

        @if ($product->discount_price)
            @php
                $discountPercentage = round(
                    (($product->regular_price - $product->discount_price) /
                        $product->regular_price) * 100,
                );
            @endphp
            <div class="discount">{{ $discountPercentage }}% Off</div>
        @endif

        <div class="hover-content">
            {{-- Eye Button --}}
            <a href="{{ route('product-details', [
                'cat_slug' => optional($product->category)->slug ?? 'no-category',
                'subcat_slug' => optional($product->subcategory)->slug ?? 'no-subcategory',
                'prod_slug' => $product->slug ?? 'no-slug',
            ]) }}" class="icon-btn">
                <i class="fa fa-eye"></i>
            </a>

            {{-- Heart Button --}}
            <a href="javascript:void(0)" class="icon-btn toggle-wishlist"
                data-product-id="{{ $product->id }}">
                <i class="fa fa-heart"></i>
            </a>
        </div>
    </div>
    <div class="product-info-wrap text-center">
        <div class="product-info">
            <h2 class="product-title">
                <a href="{{ route('product-details', [
                    'cat_slug' => optional($product->category)->slug ?? 'no-category',
                    'subcat_slug' => optional($product->subcategory)->slug ?? 'no-subcategory',
                    'prod_slug' => $product->slug ?? 'no-slug'
                ]) }}">
                    {{ \Illuminate\Support\Str::limit($product->name, 40) }}
                </a>
            </h2>

            <div class="product-price">
                @if ($product->discount_price)
                    <span class="old-price" style="color:#000; font-size:16px;">
                        {{ \App\Helpers\CurrencyHelper::formatPrice($product->regular_price) }}
                    </span>
                    <span class="new-price" style="color:#000; font-size:16px; font-weight:600;">
                        {{ \App\Helpers\CurrencyHelper::formatPrice($product->discount_price) }}
                    </span>
                @else
                    <span class="new-price" style="color:#000; font-size:16px; font-weight:500;">
                        {{ \App\Helpers\CurrencyHelper::formatPrice($product->regular_price) }}
                    </span>
                @endif
            </div>
        </div>
    </div>
</div>