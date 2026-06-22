@extends('layouts.app')

@section('title', 'Track Your Order - AnnoGhor')

@section('content')

    <section class="page-banner-section pt-120 pb-40" style="background: #fdfaf7; border-bottom: 1px solid #f3ece6;">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-12">
                    <h3 class="mb-10">Track Your Order</h3>
                    <p style="color: #666;">Enter your Order Number and Phone Number to check your delivery status instantly.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="tracking-section pt-60 pb-120">
        <div class="container">
            <div class="row justify-content-center">
                
                <div class="col-lg-5 mb-40">
                    <div class="tracking-form-box p-4" style="background: #fff; border: 1px solid #eaeaea; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.02);">
                        <h4 class="mb-20" style="font-size: 18px; color: #5a3e2b; font-weight: 700;"><i class="fas fa-search-location"></i> Find Your Package</h4>
                        
                        @if(session('error'))
                            <div class="alert alert-danger p-2 small mb-15" style="background: #fdf2f2; color: #dc3545; border-radius: 4px;">
                                <i class="fas fa-exclamation-circle mr-1"></i> {{ session('error') }}
                            </div>
                        @endif

                        <form action="{{ route('order.track.search') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label style="font-size: 14px; font-weight: 600; color: #333;" class="mb-1">Order Number / Invoice:</label>
                                <input type="text" name="order_number" value="{{ old('order_number') }}" class="form-control" placeholder="Example: #65AFB2" required style="font-size: 14px; padding: 10px;">
                            </div>
                            <div class="form-group mb-4">
                                <label style="font-size: 14px; font-weight: 600; color: #333;" class="mb-1">Phone Number:</label>
                                <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" placeholder="Example: 017XXXXXXXX" required style="font-size: 14px; padding: 10px;">
                            </div>
                            <button type="submit" class="btn text-white w-100" style="background: #5a3e2b; font-weight: 600; padding: 10px; border-radius: 4px; border: none; cursor: pointer;">Track Status</button>
                        </form>
                    </div>
                </div>

                @if(isset($order))
                    <div class="col-lg-7">
                        <div class="tracking-result-box p-4" style="background: #fff; border: 1px solid #eaeaea; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.02);">
                            
                            <div class="d-flex justify-content-between align-items-center mb-20 pb-15" style="border-bottom: 1px solid #f1f5f9;">
                                <div>
                                    <h5 style="margin: 0; font-size: 16px; font-weight: 700;">Order Number: <span style="color: #f15922;">{{ $order->order_number }}</span></h5>
                                    <small class="text-muted">Payment: <strong>{{ $order->payment_method }}</strong> ({{ $order->payment_status }})</small>
                                </div>
                                <div>
                                    <span class="badge" style="padding: 6px 12px; font-size: 13px; background: #5a3e2b; color: #fff; border-radius: 4px; font-weight: 600;">
                                        {{ $order->order_status }}
                                    </span>
                                </div>
                            </div>

                            @if($order->expected_delivery_date)
                                <div class="delivery-notice p-3 mb-25" style="background: #fffbfe; border: 1px solid #ffd8e4; border-radius: 6px; display: flex; align-items: center; gap: 10px;">
                                    <i class="far fa-clock" style="color: #ef4444; font-size: 18px;"></i>
                                    <span style="font-size: 14px; color: #333; font-weight: 500;">
                                        Expected Delivery Date: <strong style="color: #ef4444;">{{ \Carbon\Carbon::parse($order->expected_delivery_date)->format('d M Y') }}</strong>
                                    </span>
                                </div>
                            @endif

                            <h5 class="mb-20" style="font-size: 15px; font-weight: 700; color: #1e293b;"><i class="fas fa-route text-muted mr-1"></i> Shipment Journey Logs</h5>
                            <div class="tracking-timeline-wrapper" style="position: relative; padding-left: 30px; border-left: 2px solid #f1f5f9; margin-left: 10px; margin-bottom: 30px;">
                                
                                @forelse($trackingLogs as $log)
                                    <div class="timeline-item mb-25" style="position: relative;">
                                        <span style="position: absolute; left: -39px; top: 0; background: #f15922; color: #fff; width: 16px; height: 16px; border-radius: 50%; border: 3px solid #fff; box-shadow: 0 0 0 2px #f15922;"></span>
                                        
                                        <div class="log-content">
                                            <h6 style="margin: 0 0 4px 0; font-size: 14px; font-weight: 700; color: #1e293b;">
                                                {{ $log->status }}
                                            </h6>
                                            <p style="margin: 0 0 4px 0; font-size: 13px; color: #64748b; line-height: 1.5;">
                                                {{ $log->description }}
                                            </p>
                                            <small class="text-muted" style="font-size: 11px; font-weight: 500;">
                                                <i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($log->tracking_date)->format('d M Y, h:i A') }} 
                                                @if($log->location) | <i class="fas fa-map-marker-alt"></i> {{ $log->location }} @endif
                                            </small>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-muted small italic">Your package tracking information will be updated shortly.</p>
                                @endforelse
                            </div>

                            <h5 class="mb-15" style="font-size: 15px; font-weight: 700; color: #1e293b; border-top: 1px solid #f1f5f9; padding-top: 20px;"><i class="fas fa-shopping-basket text-muted mr-1"></i> Items Ordered</h5>
                            <div class="ordered-products" style="display: flex; flex-direction: column; gap: 12px;">
                                @foreach($order->orderItems as $item)
                                    <div class="product-item-row d-flex align-items-center justify-content-between p-2" style="background: #fdfdfd; border: 1px solid #f1f5f9; border-radius: 6px; display: flex;">
                                        <div class="d-flex align-items-center" style="display: flex; gap: 12px;">
                                            <img src="{{ asset('storage/' . $item->product_image) }}" style="width: 45px; height: 45px; object-fit: cover; border-radius: 4px; border: 1px solid #eee;">
                                            <div>
                                                <h6 style="margin: 0; font-size: 13px; font-weight: 600; color: #333;">{{ $item->product_name }}</h6>
                                                <small class="text-muted">Qty: {{ $item->quantity }} x ৳{{ number_format($item->price) }}</small>
                                            </div>
                                        </div>
                                        <div style="font-weight: 700; font-size: 14px; color: #222;">
                                            {{ \App\Helpers\CurrencyHelper::formatPrice($item->total_price) }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="text-right mt-20 p-3" style="background: #fafafa; border-radius: 6px; text-align: right; font-size: 14px;">
                                <span class="text-muted">Subtotal: ৳{{ number_format($order->subtotal) }}</span><br>
                                <span class="text-muted">Shipping Cost: ৳{{ number_format($order->shipping_cost) }}</span><br>
                                <div class="mt-2" style="border-top: 1px solid #eee; padding-top: 5px; font-size: 16px;">
                                    <strong>Total Amount: <span style="color: #f15922;">{{ \App\Helpers\CurrencyHelper::formatPrice($order->total_amount) }}</span></strong>
                                </div>
                            </div>

                        </div>
                    </div>
                @endif

            </div>
        </div>
    </section>

@endsection