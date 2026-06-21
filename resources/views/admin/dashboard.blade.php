@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
    <style>
        /* 🌟 Custom Responsive & Premium Dashboard UI Styling */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 24px;
            margin-bottom: 30px;
        }
        .premium-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            text-decoration: none !important;
            color: inherit !important;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(0, 0, 0, 0.03);
        }
        .premium-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
        }
        .card-icon-wrap {
            width: 54px;
            height: 54px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }
        /* section layout adjustments for responsiveness */
        .content-split-layout {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 24px;
            margin-bottom: 30px;
        }
        @media (max-width: 1024px) {
            .content-split-layout {
                grid-template-columns: 1fr;
            }
        }
        .responsive-table-wrapper {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
    </style>

    <div class="main-content">
        <div class="main-content-inner">
            <div class="main-content-wrap">
                
                {{-- 🌟 ১. টপ CARD সেকশন (রেসপনসিভ গ্রিড) --}}
                <div class="dashboard-grid">
                    
                    {{-- Total Sales --}}
                    <a href="{{ route('admin.orders.delivered') }}" class="premium-card">
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center gap-3">
                                <div class="card-icon-wrap" style="background: rgba(34, 197, 94, 0.1); color: #22c55e;">
                                    <i class="icon-shopping-bag"></i>
                                </div>
                                <div>
                                    <div class="body-text text-muted mb-1" style="font-size: 14px; color: #64748b;">Total Sales</div>
                                    <h3 style="font-weight: 700; margin: 0; color: #1e293b;">{{ number_format($totalSales) }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="wrap-chart mt-2">
                            <div id="line-chart-1"></div>
                        </div>
                    </a>

                    {{-- Total Income --}}
                    <a href="{{ route('admin.report') }}" class="premium-card">
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center gap-3">
                                <div class="card-icon-wrap" style="background: rgba(255, 82, 0, 0.1); color: #FF5200;">
                                    <i class="icon-dollar-sign"></i>
                                </div>
                                <div>
                                    <div class="body-text text-muted mb-1" style="font-size: 14px; color: #64748b;">Total Income</div>
                                    <h3 style="font-weight: 700; margin: 0; color: #1e293b;">৳{{ number_format($totalIncome, 2) }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="wrap-chart mt-2">
                            <div id="line-chart-2"></div>
                        </div>
                    </a>

                    {{-- Orders Paid --}}
                    <a href="{{ route('admin.orders.delivered') }}" class="premium-card">
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center gap-3">
                                <div class="card-icon-wrap" style="background: rgba(148, 163, 184, 0.1); color: #475569;">
                                    <i class="icon-file"></i>
                                </div>
                                <div>
                                    <div class="body-text text-muted mb-1" style="font-size: 14px; color: #64748b;">Orders Paid</div>
                                    <h3 style="font-weight: 700; margin: 0; color: #1e293b;">{{ number_format($paidOrders) }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="wrap-chart mt-2">
                            <div id="line-chart-3"></div>
                        </div>
                    </a>

                    {{-- Total Visitor --}}
                    <a href="{{ route('admin.all-user') }}" class="premium-card">
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center gap-3">
                                <div class="card-icon-wrap" style="background: rgba(35, 119, 252, 0.1); color: #2377FC;">
                                    <i class="icon-users"></i>
                                </div>
                                <div>
                                    <div class="body-text text-muted mb-1" style="font-size: 14px; color: #64748b;">Total Visitor</div>
                                    <h3 style="font-weight: 700; margin: 0; color: #1e293b;">{{ number_format($totalVisitors) }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="wrap-chart mt-2">
                            <div id="line-chart-4"></div>
                        </div>
                    </a>

                    {{-- Steadfast Courier Balance --}}
                    <a href="{{ route('admin.orders.processing') }}" class="premium-card" style="border: 1px solid rgba(16, 185, 129, 0.3); background: linear-gradient(145deg, #f0fdf4, #ecfdf5);">
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center gap-3">
                                <div class="card-icon-wrap" style="background: #10b981; color: #ffffff;">
                                    <i class="icon-truck"></i>
                                </div>
                                <div>
                                    <div class="body-text mb-1" style="font-size: 14px; color: #047857; font-weight: 600;">Steadfast Balance</div>
                                    <h3 style="font-weight: 700; margin: 0; color: #065f46;">৳{{ number_format($steadfastBalance ?? 0, 2) }}</h3>
                                </div>
                            </div>
                            <div class="box-icon-trending" style="color: #10b981;">
                                <i class="icon-check-circle" style="font-size: 20px;"></i>
                            </div>
                        </div>
                    </a>

                </div>

                {{-- 🌟 ২. মিডল সেকশন (রিসেন্ট অর্ডার চার্ট এবং টেবিল লেআউট) --}}
                <div class="content-split-layout">
                    
                    {{-- চার্ট মডিউল --}}
                    <div class="wg-box" style="background: #fff; border-radius: 16px; padding: 24px; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
                        <div class="flex items-center justify-between mb-4">
                            <h5 style="font-weight: 600; color: #1e293b;">Recent Order Analytics</h5>
                        </div>
                        <div id="line-chart-5"></div>
                    </div>

                    {{-- রিসেন্ট অর্ডার টেবিল --}}
                    <div class="wg-box" style="background: #fff; border-radius: 16px; padding: 24px; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
                        <div class="flex items-center justify-between mb-4">
                            <h5 style="font-weight: 600; color: #1e293b;">Latest Orders</h5>
                        </div>
                        
                        <div class="responsive-table-wrapper">
                            <div class="wg-table table-orders">
                                <ul class="table-title flex justify-between gap10 mb-14 pb-2" style="border-bottom: 1px solid #f1f5f9;">
                                    <li style="width: 50%;"><div class="body-title" style="font-weight: 600; color: #475569;">Product</div></li>
                                    <li style="width: 25%; text-align: right;"><div class="body-title" style="font-weight: 600; color: #475569;">Price</div></li>
                                    <li style="width: 25%; text-align: right;"><div class="body-title" style="font-weight: 600; color: #475569;">Date</div></li>
                                </ul>
                                <ul class="flex flex-column gap18">
                                    @forelse($recentOrders as $order)
                                        @foreach ($order->orderItems as $item)
                                            <li class="product-item flex items-center justify-between gap14 py-1">
                                                <div class="flex items-center gap-3" style="width: 50%;">
                                                    <div class="image small" style="border-radius: 8px; overflow: hidden; border: 1px solid #e2e8f0; flex-shrink: 0; width: 40px; height: 40px;">
                                                        <img src="{{ asset('storage/' . $item->product->thumbnail) }}" alt="" style="width:100%; height:100%; object-fit:cover;">
                                                    </div>
                                                    <div class="name">
                                                        <a href="#" class="body-text" style="font-weight: 500; color: #334155; text-decoration: none;">
                                                            {{ \Illuminate\Support\Str::limit($item->product->name, 20) }}
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="body-text" style="width: 25%; text-align: right; font-weight: 600; color: #1e293b;">
                                                    ৳{{ number_format($item->product->final_price, 2) }}
                                                </div>
                                                <div class="body-text text-muted" style="width: 25%; text-align: right; font-size: 13px; color: #64748b;">
                                                    {{-- 🌟 [FIXED] এখানে নিরাপদভাবে কার্বন ডেট ফরম্যাট করা হয়েছে --}}
                                                    {{ $order->expected_delivery_date ? \Carbon\Carbon::parse($order->expected_delivery_date)->format('d M') : $order->created_at->format('d M') }}
                                                </div>
                                            </li>
                                        @endforeach
                                    @empty
                                        <li class="text-center body-text py-4" style="color: #94a3b8;">No recent orders found</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 🌟 ৩. আর্নিংস ও প্রফিট সেকশন --}}
                <div class="wg-box mb-30" style="background: #fff; border-radius: 16px; padding: 24px; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
                    <div class="flex items-center justify-between mb-4">
                        <h5 style="font-weight: 600; color: #1e293b;">Earnings Statement</h5>
                    </div>
                    
                    <div class="flex flex-wrap gap40 mb-4" style="gap: 30px;">
                        <div style="min-width: 150px;">
                            <div class="mb-2">
                                <div class="block-legend flex items-center gap-2">
                                    <div class="dot t1" style="width: 10px; height: 10px; background: #22c55e; border-radius: 50%;"></div>
                                    <div class="text-tiny" style="color: #64748b; font-size: 13px;">Revenue</div>
                                </div>
                            </div>
                            <div class="flex items-center gap10">
                                <h3 style="font-weight: 700; margin: 0; color: #1e293b;">৳{{ number_format($revenue, 2) }}</h3>
                            </div>
                        </div>
                        <div style="min-width: 150px;">
                            <div class="mb-2">
                                <div class="block-legend flex items-center gap-2">
                                    <div class="dot t2" style="width: 10px; height: 10px; background: #2377FC; border-radius: 50%;"></div>
                                    <div class="text-tiny" style="color: #64748b; font-size: 13px;">Profit</div>
                                </div>
                            </div>
                            <div class="flex items-center gap10">
                                <h3 style="font-weight: 700; margin: 0; color: #1e293b;">৳{{ number_format($profit, 2) }}</h3>
                            </div>
                        </div>
                    </div>
                    <div id="line-chart-6"></div>
                </div>

            </div>
        </div>
        
        {{-- Footer --}}
        <div class="bottom-page" style="border-top: 1px solid #f1f5f9; padding: 20px 0; display: flex; justify-content: space-between; flex-wrap: wrap; gap: 10px; font-size: 13px; color: #64748b;">
            <div class="body-text">Copyright © 2026 Annoghor. All rights reserved. Designed and Developed</div>
            <div class="body-text">by <a href="https://innovatechbd.net/" style="color: #2377FC; font-weight: 600; text-decoration: none;">Innovatech</a></div>
        </div>
    </div>
@endsection