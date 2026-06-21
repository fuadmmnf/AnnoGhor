@extends('layouts.admin')

@section('title', 'Order Detail')

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3>Order {{ $order->order_number }}</h3>
                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                        <li><a href="{{ route('admin.dashboard') }}"><div class="text-tiny">Dashboard</div></a></li>
                        <li><i class="icon-chevron-right"></i></li>
                        <li><a href="{{ route('admin.order-list') }}"><div class="text-tiny">Order</div></a></li>
                        <li><i class="icon-chevron-right"></i></li>
                        <li><div class="text-tiny">Order {{ $order->order_number }}</div></li>
                    </ul>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <div class="wg-order-detail">
                    <div class="left flex-grow">
                        <div class="wg-box mb-20">
                            <div class="wg-table table-order-detail">
                                <ul class="table-title flex items-center justify-between gap20 mb-24">
                                    <li><div class="body-title">All items</div></li>
                                </ul>

                                <ul class="flex flex-column">
                                    @foreach($order->orderItems as $item)
                                        <li class="product-item gap14">
                                            <div class="image no-bg">
                                                <img src="{{ asset('storage/' . $item->product_image) }}" alt="{{ $item->product_name }}">
                                            </div>
                                            <div class="flex items-center justify-between gap40 flex-grow">
                                                <div class="name">
                                                    <div class="text-tiny mb-1">Product name</div>
                                                    <div class="body-title-2">{{ $item->product_name }}</div>
                                                </div>
                                                <div class="name">
                                                    <div class="text-tiny mb-1">Quantity</div>
                                                    <div class="body-title-2">{{ $item->quantity }}</div>
                                                </div>
                                                <div class="name">
                                                    <div class="text-tiny mb-1">Price</div>
                                                    <div class="body-title-2">৳{{ number_format($item->total_price, 2) }}</div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="wg-box">
                            <div class="wg-table table-cart-totals">
                                <ul class="table-title flex mb-24">
                                    <li><div class="body-title">Cart Totals</div></li>
                                    <li><div class="body-title">Price</div></li>
                                </ul>
                                <ul class="flex flex-column gap14">
                                    <li class="cart-totals-item">
                                        <span class="body-text">Subtotal:</span>
                                        <span class="body-title-2">৳{{ number_format($order->subtotal, 2) }}</span>
                                    </li >
                                    <li class="divider"></li>
                                    <li class="cart-totals-item">
                                        <span class="body-text">Shipping:</span>
                                        <span class="body-title-2">৳{{ number_format($order->shipping_cost, 2) }}</span>
                                    </li>
                                    <li class="divider"></li>
                                    <li class="cart-totals-item">
                                        <span class="body-text">Tax:</span>
                                        <span class="body-title-2">৳{{ number_format($order->tax, 2) }}</span>
                                    </li>
                                    <li class="divider"></li>
                                    <li class="cart-totals-item">
                                        <span class="body-title">Total price:</span>
                                        <span class="body-title tf-color-1">৳{{ number_format($order->total_amount, 2) }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="right">
                        <div class="wg-box mb-20 gap10">
                            <div class="body-title">Summary</div>
                            <div class="summary-item">
                                <div class="body-text">Order ID</div>
                                <div class="body-title-2">{{ $order->order_number }}</div>
                            </div>
                            <div class="summary-item">
                                <div class="body-text">Customer</div>
                                <div class="body-title-2">{{ $order->user->name ?? $order->guest_name ?? 'Guest User' }}</div>
                            </div>
                            <div class="summary-item">
                                <div class="body-text">Date</div>
                                <div class="body-title-2">{{ $order->created_at->format('d M Y') }}</div>
                            </div>
                            <div class="summary-item">
                                <div class="body-text">Total</div>
                                <div class="body-title-2 tf-color-1">৳{{ number_format($order->total_amount, 2) }}</div>
                            </div>
                        </div>

                        <div class="wg-box mb-20 gap10">
                            <div class="body-title">Shipping Address</div>
                            <div class="body-text">{{ $order->address ?? $order->full_address }}</div>
                            <div class="body-text mt-2">
                                <strong>Phone:</strong> {{ $order->phone }}<br>
                                <strong>Email:</strong> {{ $order->email }}
                            </div>
                        </div>

                        <div class="wg-box mb-20 gap10">
                            <div class="body-title">Payment Method</div>
                            <div class="body-text">{{ $order->payment_method }}</div>
                            <div class="body-text mt-2">
                                Payment Status:
                                @if($order->payment_status === 'Success')
                                    <span class="badge bg-success">Success</span>
                                @elseif($order->payment_status === 'Pending')
                                    <span class="badge bg-warning">Pending</span>
                                @else
                                    <span class="badge bg-danger">Failed</span>
                                @endif
                            </div>
                        </div>

                        {{-- 📦 🚚 STEADFAST COURIER CONTROL BOX --}}
                        <div class="wg-box mb-20 gap10" style="border: 1px solid #e1e8ed; background-color: #f8fafc;">
                            <div class="body-title flex items-center gap10">
                                <i class="icon-truck" style="color: #2563eb;"></i> Steadfast Courier 
                            </div>

                            @if($order->tracking_code)
                                <div class="body-text mt-2">
                                    <strong>Tracking Code:</strong> <span class="text-primary font-bold">{{ $order->tracking_code }}</span>
                                </div>
                                <div class="mt-2 flex flex-column gap10">
                                    {{-- ১. লাইভ স্ট্যাটাস সিঙ্ক বাটন --}}
                                    <a href="{{ route('admin.orders.syncStatus', $order->id) }}" class="tf-button style-1 w-full" style="background-color: #0ea5e9; border-color: #0ea5e9;">
                                        <i class="icon-refresh"></i> Sync Live Status
                                    </a>

                                    {{-- 🌟 ২. [পুনরায় পাঠানোর ম্যাজিক বাটন]: যদি পার্সেলটি কোন কারণে Cancelled হয়ে থাকে --}}
                                    @if($order->order_status === 'Cancelled')
                                        <form action="{{ route('admin.orders.sendSingle', $order->id) }}" method="POST" class="w-full">
                                            @csrf
                                            <button type="submit" class="tf-button style-1 w-full" style="background-color: #f59e0b; border-color: #f59e0b;">
                                                <i class="icon-paper-plane"></i> Resend to Steadfast
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            @else
                                {{-- ৩. একদম প্রথমবার কুরিয়ারে পাঠানোর বাটন (যদি ট্র্যাকিং কোড জেনারেট না থাকে) --}}
                                @if($order->order_status === 'Pending')
                                    <div class="body-text text-warning mt-1" style="font-size: 13px;">
                                        ⚠️ অর্ডারটি এখনো স্টেডফাস্ট কুরিয়ারে পাঠানো হয়নি।
                                    </div>
                                    <div class="mt-2">
                                        <form action="{{ route('admin.orders.sendSingle', $order->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="tf-button style-1 w-full" style="background-color: #10b981; border-color: #10b981;">
                                                <i class="icon-paper-plane"></i> Send to Steadfast
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <div class="body-text text-muted mt-1" style="font-size: 13px;">
                                        অর্ডার স্ট্যাটাস 'Pending' না থাকায় ম্যানুয়ালি কুরিয়ারে পাঠানো লকড।
                                    </div>
                                @endif
                            @endif
                        </div>

                        <div class="wg-box gap10">
                            <div class="body-title">Order Status</div>
                            <form action="{{ route('admin.order.update-status', $order->id) }}" method="POST">
                                @csrf
                                
                                <div class="form-group mb-3">
                                    <label class="body-title mb-1" style="font-size: 14px; font-weight: bold;">Order Status</label>
                                    <select name="order_status" class="form-control" required>
                                        <option value="Pending" {{ $order->order_status === 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Processing" {{ $order->order_status === 'Processing' ? 'selected' : '' }}>Processing</option>
                                        <option value="Shipped" {{ $order->order_status === 'Shipped' ? 'selected' : '' }}>Shipped</option>
                                        <option value="Delivered" {{ $order->order_status === 'Delivered' ? 'selected' : '' }}>Delivered</option>
                                        <option value="Cancelled" {{ $order->order_status === 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="body-title mb-1" style="font-size: 14px; font-weight: bold;">Payment Status</label>
                                    <select name="payment_status" class="form-control" required>
                                        <option value="Pending" {{ $order->payment_status === 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Success" {{ $order->payment_status === 'Success' ? 'selected' : '' }}>Success</option>
                                        <option value="Failed" {{ $order->payment_status === 'Failed' ? 'selected' : '' }}>Failed</option>
                                    </select>
                                </div>

                                <button type="submit" class="tf-button style-1 w-full mb-2">Update Order & Payment</button>
                            </form>

                            @if($order->expected_delivery_date)
                                <div class="body-title-2 tf-color-2 mt-3">
                                    Expected Delivery: {{ \Carbon\Carbon::parse($order->expected_delivery_date)->format('d M Y') }}
                                </div>
                            @endif

                            <a class="tf-button style-1 w-full mt-2" href="{{ route('admin.order-tracking', $order->id) }}">
                                <i class="icon-truck"></i> Track order
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bottom-page">
            <div class="body-text">Copyright © 2026 Annoghor. All rights reserved. Designed and Developed </div>
            <div class="body-text">by <a href="https://innovatechbd.net/">Innovatech</a></div>
        </div>
    </div>
@endsection