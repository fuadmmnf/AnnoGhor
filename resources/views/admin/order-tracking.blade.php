@extends('layouts.admin')

@section('title', 'Order Tracking')

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3>Track Order</h3>
                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                        <li><a href="{{ route('admin.dashboard') }}"><div class="text-tiny">Dashboard</div></a></li>
                        <li><i class="icon-chevron-right"></i></li>
                        <li><a href="{{ route('admin.order-list') }}"><div class="text-tiny">Order</div></a></li>
                        <li><i class="icon-chevron-right"></i></li>
                        <li><div class="text-tiny">Track Order</div></li>
                    </ul>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <!-- Order Track Summary -->
                <div class="wg-box mb-20">
                    <div class="order-track">
                        @if($order->orderItems->first())
                            <div class="image">
                                <img src="{{ asset('storage/' . $order->orderItems->first()->product_image) }}" 
                                     alt="{{ $order->orderItems->first()->product_name }}">
                            </div>
                        @endif
                        <div class="content">
                            <h5 class="mb-20">Order {{ $order->order_number }}</h5>
                            <div class="infor mb-10">
                                <div class="body-text">Order ID</div>
                                <div class="body-title-2">{{ $order->order_number }}</div>
                            </div>
                            <div class="infor mb-10">
                                <div class="body-text">Customer:</div>
                                <div class="body-title-2">{{ $order->user->name ?? $order->guest_name ?? 'Guest User' }}</div>
                            </div>
                            <div class="infor mb-10">
                                <div class="body-text">Order Placed:</div>
                                <div class="body-title-2">{{ $order->created_at->format('d M Y') }}</div>
                            </div>
                            <div class="infor mb-20">
                                <div class="body-text">Total Items:</div>
                                <div class="body-title-2">{{ $order->orderItems->count() }}</div>
                            </div>
                            <div class="flex gap10 flex-wrap">
                                <a class="tf-button style-1 w230" href="{{ route('admin.order-detail', $order->id) }}">View Details</a>
                                <a class="tf-button w230" href="{{ route('admin.order-list') }}">Back to Orders</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Status Detail -->
                <div class="wg-box mb-20">
                    <div>
                        <h6 class="mb-10">Current Status: {{ $order->order_status }}</h6>
                        <div class="body-text">
                            @if($order->order_status === 'Pending')
                                Your order is pending confirmation.
                            @elseif($order->order_status === 'Processing')
                                Your order is being processed. It will be shipped soon.
                            @elseif($order->order_status === 'Shipped')
                                Your order has been shipped and is on the way.
                            @elseif($order->order_status === 'Delivered')
                                Your order has been delivered successfully!
                            @elseif($order->order_status === 'Cancelled')
                                This order has been cancelled.
                            @endif
                        </div>
                    </div>

                    <!-- Road Map -->
                    <div class="road-map">
                        <div class="road-map-item {{ in_array($order->order_status, ['Pending', 'Processing', 'Shipped', 'Delivered']) ? 'active' : '' }}">
                            <div class="icon"><i class="icon-check"></i></div>
                            <h6>Order Placed</h6>
                            <div class="body-text">{{ $order->created_at->format('h:i A') }}</div>
                        </div>
                        
                        <div class="road-map-item {{ in_array($order->order_status, ['Processing', 'Shipped', 'Delivered']) ? 'active' : '' }}">
                            <div class="icon"><i class="icon-check"></i></div>
                            <h6>Order Processing</h6>
                            <div class="body-text">
                                @if(in_array($order->order_status, ['Processing', 'Shipped', 'Delivered']))
                                    Processing
                                @else
                                    Pending
                                @endif
                            </div>
                        </div>
                        
                        <div class="road-map-item {{ in_array($order->order_status, ['Shipped', 'Delivered']) ? 'active' : '' }}">
                            <div class="icon"><i class="icon-check"></i></div>
                            <h6>Being Shipped</h6>
                            <div class="body-text">
                                @if(in_array($order->order_status, ['Shipped', 'Delivered']))
                                    Shipped
                                @else
                                    Pending
                                @endif
                            </div>
                        </div>
                        
                        <div class="road-map-item {{ $order->order_status === 'Delivered' ? 'active' : '' }}">
                            <div class="icon"><i class="icon-check"></i></div>
                            <h6>Delivered</h6>
                            <div class="body-text">
                                @if($order->order_status === 'Delivered')
                                    Complete
                                @else
                                    Pending
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Add Manual Tracking Entry (Admin Only) -->
                <div class="wg-box mb-20">
                    <h6 class="mb-10">Add Tracking Entry</h6>
                    <form action="{{ route('admin.order.add-tracking', $order->id) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label>Status</label>
                                <input type="text" name="status" class="form-control" 
                                       placeholder="e.g., Out for delivery" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Location</label>
                                <input type="text" name="location" class="form-control" 
                                       placeholder="e.g., Dhaka, Bangladesh">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Description</label>
                                <textarea name="description" class="form-control" rows="2" 
                                          placeholder="e.g., Package arrived at sorting facility" required></textarea>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="tf-button style-1">Add Tracking Entry</button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Tracking History Table -->
                <div class="wg-box">
                    <div class="wg-table table-order-track">
                        <ul class="table-title flex mb-24 gap20">
                            <li><div class="body-title">Date</div></li>
                            <li><div class="body-title">Time</div></li>
                            <li><div class="body-title">Status</div></li>
                            <li><div class="body-title">Description</div></li>
                            <li><div class="body-title">Location</div></li>
                        </ul>
                        
                        <ul class="flex flex-column gap14">
                            @forelse($order->trackings as $tracking)
                                <li class="cart-totals-item">
                                    <div class="body-text">{{ $tracking->tracking_date->format('d M Y') }}</div>
                                    <div class="body-text">{{ $tracking->tracking_date->format('h:i A') }}</div>
                                    <div class="body-text"><strong>{{ $tracking->status }}</strong></div>
                                    <div class="body-text">{{ $tracking->description }}</div>
                                    <div class="body-text">{{ $tracking->location ?? 'N/A' }}</div>
                                </li>
                                @if(!$loop->last)
                                    <li class="divider"></li>
                                @endif
                            @empty
                                <li class="cart-totals-item">
                                    <div class="body-text" colspan="5">No tracking history available.</div>
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="bottom-page">
            <div class="body-text">Copyright © 2026 Earth Craft. All
                rights
                reserved. Designed and Developed </div>
            {{-- <i class="icon-heart"></i> --}}
            <div class="body-text">by <a href="https://innovatechbd.net/">Innovatech</a></div>
        </div>
    </div>
@endsection