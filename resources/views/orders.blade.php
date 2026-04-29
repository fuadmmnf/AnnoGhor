@extends('layouts.app')

@section('title', 'My Orders')

@section('content')

    <section class="orders-section pt-120 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="mb-30">Order History</h3>
                    
                    @forelse($orders as $order)
                        <div class="order-card mb-30" style="background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 0 15px rgba(0,0,0,0.1);">
                            <div class="order-header" style="display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #f0f0f0; padding-bottom: 20px; margin-bottom: 20px;">
                                <div>
                                    <h5>Order {{ $order->order_number }}</h5>
                                    <p style="color: #666; margin: 5px 0;">Placed on {{ $order->created_at->format('d M Y, h:i A') }}</p>
                                </div>
                                <div>
                                    @if($order->order_status === 'Delivered')
                                        <span class="badge bg-success" style="padding: 8px 15px; font-size: 14px;">Delivered</span>
                                    @elseif($order->order_status === 'Shipped')
                                        <span class="badge bg-info" style="padding: 8px 15px; font-size: 14px;">Shipped</span>
                                    @elseif($order->order_status === 'Processing')
                                        <span class="badge bg-warning" style="padding: 8px 15px; font-size: 14px;">Processing</span>
                                    @elseif($order->order_status === 'Cancelled')
                                        <span class="badge bg-danger" style="padding: 8px 15px; font-size: 14px;">Cancelled</span>
                                    @else
                                        <span class="badge bg-secondary" style="padding: 8px 15px; font-size: 14px;">Pending</span>
                                    @endif
                                </div>
                            </div>

                            <div class="order-items">
                                @foreach($order->orderItems as $item)
                                    <div class="item" style="display: flex; gap: 20px; padding: 10px 0; border-bottom: 1px solid #f5f5f5;">
                                        <div class="item-image" style="width: 80px; height: 80px;">
                                            <img src="{{ asset('storage/' . $item->product_image) }}" 
                                                 alt="{{ $item->product_name }}" 
                                                 style="width: 100%; height: 100%; object-fit: cover; border-radius: 5px;">
                                        </div>
                                        <div class="item-details" style="flex: 1;">
                                            <h6>{{ $item->product_name }}</h6>
                                            <p style="color: #666;">Quantity: {{ $item->quantity }}</p>
                                            <p style="color: #333; font-weight: bold;">{{ \App\Helpers\CurrencyHelper::formatPrice($item->total_price) }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="order-footer" style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px; padding-top: 20px; border-top: 2px solid #f0f0f0;">
                                <div>
                                    <strong style="font-size: 18px;">Total: {{ \App\Helpers\CurrencyHelper::formatPrice($item->total_price) }}</strong>
                                    <p style="color: #666; margin: 5px 0;">{{ $order->orderItems->count() }} item(s)</p>
                                </div>
                                <div>
                                    <a href="{{ route('order.success', $order->id) }}" class="theme-btn style-one">View Details</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-info">
                            <p>You haven't placed any orders yet.</p>
                            <a href="{{ route('shops') }}" class="theme-btn style-one mt-3">Start Shopping</a>
                        </div>
                    @endforelse

                    <!-- Pagination -->
                    @if($orders->hasPages())
                        <div class="pagination-wrapper mt-30">
                            {{ $orders->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection