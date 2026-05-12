@extends('layouts.app')

@section('title', 'New Arrivals')

@section('content')

<section class="trending-products pt-60">
    <div class="container">
        <div class="row">
            @forelse($trendingProducts as $product)
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="product-item style-one mb-40">
                        <div class="product-thumbnail">
    <a href="{{ $product->details_url }}">
        <img src="{{ $product->thumbnail
            ? asset('storage/' . $product->thumbnail)
            : asset('assets/images/products/feature-product-1.png') }}"
            style="width:100%; height:400px; object-fit:cover;"
            alt="{{ $product->name }}">
    </a>

    <div class="discount">Trending</div>

    <div class="hover-content">
        <a href="{{ $product->details_url }}" class="icon-btn">
            <i class="fa fa-eye"></i>
        </a>

        <a href="javascript:void(0)"
           class="icon-btn toggle-wishlist"
           data-product-id="{{ $product->id }}">
            <i class="fa fa-heart"></i>
        </a>
    </div>
</div>

                        <div class="product-info-wrap text-center">
                            <h4 class="product-title">
                                <a href="{{ $product->details_url }}">
                                    {{ Str::limit($product->name, 40) }}
                                </a>
                            </h4>

                            <div class="product-meta">
                                {{ strtoupper($product->category->name ?? 'UNCATEGORIZED') }}
                                @if($product->subcategory)
                                    , {{ $product->subcategory->name }}
                                @endif
                            </div>

                            {{-- <div class="product-price">
                                @if($product->discount_price)
                                    <span class="old-price">৳{{ number_format($product->regular_price, 2) }}</span>
                                    <span class="new-price">৳{{ number_format($product->discount_price, 2) }}</span>
                                @else
                                    <span class="new-price">৳{{ number_format($product->regular_price, 2) }}</span>
                                @endif
                            </div> --}}
                              <div class="product-price">
    @if($product->discount_price)
        <span class="old-price">
            {{ \App\Helpers\CurrencyHelper::formatPrice($product->regular_price) }}
        </span>
        <span class="new-price">
            {{ \App\Helpers\CurrencyHelper::formatPrice($product->discount_price) }}
        </span>
    @else
        <span class="new-price">
            {{ \App\Helpers\CurrencyHelper::formatPrice($product->regular_price) }}
        </span>
    @endif
</div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center">No new arrivals found.</p>
            @endforelse
        </div>
    </div>
</section>

@endsection
