@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
    <!-- main-content -->
    <div class="main-content">
        <!-- main-content-wrap -->
        <div class="main-content-inner">
            <!-- main-content-wrap -->
            <div class="main-content-wrap">
                <div class="tf-section-4 mb-30">
                    <!-- chart-default -->
                    <div class="wg-chart-default">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap14">
                                <div class="image type-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="52" viewBox="0 0 48 52"
                                        fill="none">
                                        <path
                                            d="M19.1094 2.12943C22.2034 0.343099 26.0154 0.343099 29.1094 2.12943L42.4921 9.85592C45.5861 11.6423 47.4921 14.9435 47.4921 18.5162V33.9692C47.4921 37.5418 45.5861 40.8431 42.4921 42.6294L29.1094 50.3559C26.0154 52.1423 22.2034 52.1423 19.1094 50.3559L5.72669 42.6294C2.63268 40.8431 0.726688 37.5418 0.726688 33.9692V18.5162C0.726688 14.9435 2.63268 11.6423 5.72669 9.85592L19.1094 2.12943Z"
                                            fill="#22C55E" />
                                    </svg>
                                    <i class="icon-shopping-bag"></i>
                                </div>
                                <div>
                                    <div class="body-text mb-2">Total Sales</div>
                                    <h4>{{ number_format($totalSales) }}</h4>

                                </div>
                            </div>
                            <div class="box-icon-trending up">
                                <i class="icon-trending-up"></i>
                                <div class="body-title number">1.56%</div>
                            </div>
                        </div>
                        <div class="wrap-chart">
                            <div id="line-chart-1"></div>
                        </div>
                    </div>
                    <!-- /chart-default -->
                    <!-- chart-default -->
                    <div class="wg-chart-default">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap14">
                                <div class="image type-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="52"
                                        viewBox="0 0 48 52" fill="none">
                                        <path
                                            d="M19.1094 2.12943C22.2034 0.343099 26.0154 0.343099 29.1094 2.12943L42.4921 9.85592C45.5861 11.6423 47.4921 14.9435 47.4921 18.5162V33.9692C47.4921 37.5418 45.5861 40.8431 42.4921 42.6294L29.1094 50.3559C26.0154 52.1423 22.2034 52.1423 19.1094 50.3559L5.72669 42.6294C2.63268 40.8431 0.726688 37.5418 0.726688 33.9692V18.5162C0.726688 14.9435 2.63268 11.6423 5.72669 9.85592L19.1094 2.12943Z"
                                            fill="#FF5200" />
                                    </svg>
                                    <i class="icon-dollar-sign"></i>
                                </div>
                                <div>
                                    <div class="body-text mb-2">Total Income</div>
                                    <h4>৳{{ number_format($totalIncome, 2) }}</h4>
                                </div>
                            </div>
                            <div class="box-icon-trending down">
                                <i class="icon-trending-down"></i>
                                <div class="body-title number">1.56%</div>
                            </div>
                        </div>
                        <div class="wrap-chart">
                            <div id="line-chart-2"></div>
                        </div>
                    </div>
                    <!-- /chart-default -->
                    <!-- chart-default -->
                    <div class="wg-chart-default">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap14">
                                <div class="image type-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="52"
                                        viewBox="0 0 48 52" fill="none">
                                        <path
                                            d="M19.1094 2.12943C22.2034 0.343099 26.0154 0.343099 29.1094 2.12943L42.4921 9.85592C45.5861 11.6423 47.4921 14.9435 47.4921 18.5162V33.9692C47.4921 37.5418 45.5861 40.8431 42.4921 42.6294L29.1094 50.3559C26.0154 52.1423 22.2034 52.1423 19.1094 50.3559L5.72669 42.6294C2.63268 40.8431 0.726688 37.5418 0.726688 33.9692V18.5162C0.726688 14.9435 2.63268 11.6423 5.72669 9.85592L19.1094 2.12943Z"
                                            fill="#CBD5E1" />
                                    </svg>
                                    <i class="icon-file"></i>
                                </div>
                                <div>
                                    <div class="body-text mb-2">Orders Paid</div>
                                    <h4>{{ number_format($paidOrders) }}</h4>

                                </div>
                            </div>
                            <div class="box-icon-trending">
                                <i class="icon-trending-up"></i>
                                <div class="body-title number">0.00%</div>
                            </div>
                        </div>
                        <div class="wrap-chart">
                            <div id="line-chart-3"></div>
                        </div>
                    </div>
                    <!-- /chart-default -->
                    <!-- chart-default -->
                    <div class="wg-chart-default">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap14">
                                <div class="image type-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="52"
                                        viewBox="0 0 48 52" fill="none">
                                        <path
                                            d="M19.1094 2.12943C22.2034 0.343099 26.0154 0.343099 29.1094 2.12943L42.4921 9.85592C45.5861 11.6423 47.4921 14.9435 47.4921 18.5162V33.9692C47.4921 37.5418 45.5861 40.8431 42.4921 42.6294L29.1094 50.3559C26.0154 52.1423 22.2034 52.1423 19.1094 50.3559L5.72669 42.6294C2.63268 40.8431 0.726688 37.5418 0.726688 33.9692V18.5162C0.726688 14.9435 2.63268 11.6423 5.72669 9.85592L19.1094 2.12943Z"
                                            fill="#2377FC" />
                                    </svg>
                                    <i class="icon-users"></i>
                                </div>
                                <div>
                                    <div class="body-text mb-2">Total Visitor</div>
                                    <h4>{{ number_format($totalVisitors) }}</h4>
                                </div>
                            </div>
                            <div class="box-icon-trending up">
                                <i class="icon-trending-up"></i>
                                <div class="body-title number">1.56%</div>
                            </div>
                        </div>
                        <div class="wrap-chart">
                            <div id="line-chart-4"></div>
                        </div>
                    </div>
                    <!-- /chart-default -->
                </div>
                <div class="tf-section-5 mb-30">
                    <!-- chart -->
                    <div class="wg-box">
                        <div class="flex items-center justify-between">
                            <h5>Recent Order</h5>
                            <div class="dropdown default">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <span class="icon-more"><i class="icon-more-horizontal"></i></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a href="javascript:void(0);">This Week</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Last Week</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div id="line-chart-5"></div>
                    </div>
                    <!-- /chart -->

                    <div class="wg-box">
                        <div class="flex items-center justify-between">
                            <h5>Orders</h5>
                            <div class="dropdown default">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <span class="icon-more"><i class="icon-more-horizontal"></i></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a href="javascript:void(0);">This Week</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Last Week</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="wg-table table-orders">
                            <ul class="table-title flex gap10 mb-14">
                                <li>
                                    <div class="body-title">Product</div>
                                </li>
                                <li>
                                    <div class="body-title">Price</div>
                                </li>
                                <li>
                                    <div class="body-title">Delivery date</div>
                                </li>
                            </ul>
                            <ul class="flex flex-column gap18">
                                @forelse($recentOrders as $order)
                                    @foreach ($order->orderItems as $item)
                                        <li class="product-item gap14">
                                            <div class="image small">
                                                <img src="{{ asset('storage/' . $item->product->thumbnail) }}"
                                                    alt="">
                                            </div>

                                            <div class="flex items-center justify-between flex-grow gap10">
                                                <div class="name">
                                                    <a href="#" class="body-text">
                                                        {{ Str::limit($item->product->name, 25) }}
                                                    </a>
                                                </div>

                                                <div class="body-text">
                                                    ৳{{ number_format($item->product->final_price, 2) }}
                                                </div>

                                                <div class="body-text">
                                                    {{ $order->expected_delivery_date
                                                        ? $order->expected_delivery_date->format('d M Y')
                                                        : $order->created_at->format('d M Y') }}
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                @empty
                                    <li class="text-center body-text">No recent orders found</li>
                                @endforelse
                            </ul>

                        </div>
                    </div>
                </div>
                <div class="tf-section-3">
                    <!-- earnings -->
                    <div class="wg-box">
                        <div class="flex items-center justify-between">
                            <h5>Earnings</h5>
                            <div class="dropdown default">
                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="icon-more"><i class="icon-more-horizontal"></i></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a href="javascript:void(0);">This Week</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Last Week</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap40">
                            <div>
                                <div class="mb-2">
                                    <div class="block-legend">
                                        <div class="dot t1"></div>
                                        <div class="text-tiny">Revenue</div>
                                    </div>
                                </div>
                                <div class="flex items-center gap10">
                                    <h4>৳{{ number_format($revenue, 2) }}</h4>

                                    <div class="box-icon-trending up">
                                        <i class="icon-trending-up"></i>
                                        <div class="body-title number">0.56%</div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="mb-2">
                                    <div class="block-legend">
                                        <div class="dot t2"></div>
                                        <div class="text-tiny">Profit</div>
                                    </div>
                                </div>
                                <div class="flex items-center gap10">
                                    <h4>৳{{ number_format($profit, 2) }}</h4>

                                    <div class="box-icon-trending up">
                                        <i class="icon-trending-up"></i>
                                        <div class="body-title number">0.56%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="line-chart-6"></div>
                    </div>
                    <!-- /earnings -->
                </div>
            </div>
            <!-- /main-content-wrap -->
        </div>
        <!-- /main-content-wrap -->
        <!-- bottom-page -->
        <div class="bottom-page">
            <div class="body-text">Copyright © 2026 Earth Craft. All
                rights
                reserved. Designed and Developed </div>
            {{-- <i class="icon-heart"></i> --}}
            <div class="body-text">by <a href="https://innovatechbd.net/">Innovatech</a></div>
        </div>
        <!-- /bottom-page -->
    </div>
    <!-- /main-content -->
@endsection
