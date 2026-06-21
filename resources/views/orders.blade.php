@extends('layouts.app')

@section('title', 'My Orders')

@section('content')

    <style>
        /* পপআপের ব্যাকগ্রাউন্ড (কালো ঝাপসা পর্দা) */
        .annoghor-custom-modal {
            display: none; 
            position: fixed; 
            z-index: 9999; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgba(0,0,0,0.5); /* কালো ঝাপসা ব্যাকগ্রাউন্ড */
            backdrop-filter: blur(3px);
        }

        /* পপআপ বক্সের ভেতরের মেইন বডি */
        .annoghor-modal-content {
            background-color: #fff;
            margin: 10% auto; 
            padding: 25px;
            border-radius: 8px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
            position: relative;
            animation: slideDown 0.3s ease-out;
        }

        /* পপআপ আসার অ্যানিমেশন */
        @keyframes slideDown {
            from { transform: translateY(-50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        /* ক্লোজ (ক্রস) বাটন */
        .annoghor-modal-close {
            position: absolute;
            right: 20px;
            top: 15px;
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            border: none;
            background: transparent;
        }
        .annoghor-modal-close:hover {
            color: #000;
        }

        /* ফর্মের ভেতরের ইনপুট স্টাইল */
        .annoghor-form-group {
            margin-bottom: 15px;
        }
        .annoghor-form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            font-size: 14px;
            color: #333;
        }
        .annoghor-input-field {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            box-sizing: border-box;
        }
    </style>

    <section class="page-banner-section pt-120 pb-40" style="background: #fdfaf7; border-bottom: 1px solid #f3ece6;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="mb-10">Order History</h3>
                    <p style="color: #666;">Track your deliveries and share your premium product experiences.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="orders-section pt-40 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    
                    @if(session('success'))
                        <div class="alert alert-success mb-20 p-3" style="border-left: 4px solid #28a745; background: #eafaf1; color: #28a745; border-radius: 4px; display: flex; justify-content: space-between;">
                            <span><strong>Success!</strong> {{ session('success') }}</span>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger mb-20 p-3" style="border-left: 4px solid #dc3545; background: #fdf2f2; color: #dc3545; border-radius: 4px; display: flex; justify-content: space-between;">
                            <span><strong>Error!</strong> {{ session('error') }}</span>
                        </div>
                    @endif
                    
                    @forelse($orders as $order)
                        <div class="order-container mb-40" style="background: #fff; border: 1px solid #eaeaea; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.02); overflow: hidden;">
                            
                            <div class="order-box-header p-3 d-flex flex-wrap justify-content-between align-items-center" style="background: #fdfdfd; border-bottom: 1px solid #eaeaea;">
                                <div>
                                    <span style="font-weight: 700; color: #222; font-size: 16px;">Order ID: <span style="color: #5a3e2b;">{{ $order->order_number }}</span></span>
                                    <span class="text-muted mx-2">|</span>
                                    <span style="font-size: 14px; color: #666;"><i class="far fa-calendar-alt mr-1"></i> {{ $order->created_at->format('d M Y, h:i A') }}</span>
                                </div>
                                <div class="d-flex align-items-center" style="gap: 15px;">
                                    @if($order->order_status === 'Delivered')
                                        <span class="badge bg-success" style="padding: 6px 12px; font-size: 13px; font-weight: 500; border-radius: 4px; background: #28a745; color:#fff;">Delivered</span>
                                    @elseif($order->order_status === 'Shipped')
                                        <span class="badge bg-info text-white" style="padding: 6px 12px; font-size: 13px; font-weight: 500; border-radius: 4px; background: #17a2b8; color:#fff;">Shipped</span>
                                    @elseif($order->order_status === 'Processing')
                                        <span class="badge bg-warning text-dark" style="padding: 6px 12px; font-size: 13px; font-weight: 500; border-radius: 4px; background: #ffc107; color:#222;">Processing</span>
                                    @elseif($order->order_status === 'Cancelled')
                                        <span class="badge bg-danger" style="padding: 6px 12px; font-size: 13px; font-weight: 500; border-radius: 4px; background: #dc3545; color:#fff;">Cancelled</span>
                                    @else
                                        <span class="badge bg-secondary" style="padding: 6px 12px; font-size: 13px; font-weight: 500; border-radius: 4px; background: #6c757d; color:#fff;">Pending</span>
                                    @endif
                                    
                                    <a href="{{ route('order.success', $order->id) }}" class="btn btn-sm btn-outline-secondary" style="font-size: 13px; padding: 5px 12px; border: 1px solid #ccc; border-radius:4px; text-decoration:none; color:#333;"><i class="far fa-eye"></i> Track Details</a>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-borderless align-middle mb-0" style="min-width: 600px; width:100%; border-collapse: collapse;">
                                    <thead style="background: #fafafa; border-bottom: 1px solid #eaeaea; font-size: 14px; color: #555; text-align: left;">
                                        <tr>
                                            <th style="padding: 12px 20px; width: 45%;">Product Details</th>
                                            <th style="padding: 12px 20px; text-align: center;">Quantity</th>
                                            <th style="padding: 12px 20px; text-align: right;">Price</th>
                                            <th style="padding: 12px 20px; text-align: center; width: 20%;">Action Feed</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->orderItems as $item)
                                            <tr style="border-bottom: 1px solid #f7f7f7;">
                                                <td style="padding: 15px 20px;">
                                                    <div class="d-flex align-items-center" style="gap: 15px; display:flex;">
                                                        <img src="{{ asset('storage/' . $item->product_image) }}" alt="{{ $item->product_name }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 6px; border: 1px solid #eee;">
                                                        <div style="margin-left: 15px;">
                                                            <h6 style="margin: 0 0 4px 0; font-size: 15px; font-weight: 600; color: #222;">{{ $item->product_name }}</h6>
                                                            <span style="font-size: 13px; color: #888;">Unit Price: {{ \App\Helpers\CurrencyHelper::formatPrice($item->price) }}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="padding: 15px 20px; text-align: center; font-weight: 600; color: #555;">
                                                    {{ $item->quantity }}
                                                </td>
                                                <td style="padding: 15px 20px; text-align: right; font-weight: 700; color: #222;">
                                                    {{ \App\Helpers\CurrencyHelper::formatPrice($item->total_price) }}
                                                </td>
                                                <td style="padding: 15px 20px; text-align: center;">
                                                    @if($order->order_status === 'Delivered')
                                                        
                                                        <button type="button" class="btn btn-sm" 
                                                                style="background: #5a3e2b; color: #fff; font-size: 12px; font-weight: 500; border-radius: 4px; padding: 6px 12px; cursor: pointer; border: none;"
                                                                onclick="openAnnoghorModal('{{ $item->id }}')">
                                                            <i class="fas fa-pen-square mr-1"></i> Write Review
                                                        </button>

                                                        <div id="customReviewModal-{{ $item->id }}" class="annoghor-custom-modal">
                                                            <div class="annoghor-modal-content">
                                                                <button type="button" class="annoghor-modal-close" onclick="closeAnnoghorModal('{{ $item->id }}')">&times;</button>
                                                                
                                                                <h5 style="font-size: 16px; font-weight: 700; margin-top: 0; margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 10px;">
                                                                    <i class="fas fa-star text-warning"></i> Product Review Feedback
                                                                </h5>
                                                                
                                                                <form action="{{ route('store.review') }}" method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                                                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                                                    
                                                                    <div style="display: flex; align-items: center; gap: 12px; background: #fdfaf7; padding: 10px; border-radius: 6px; margin-bottom: 15px;">
                                                                        <img src="{{ asset('storage/' . $item->product_image) }}" style="width: 45px; height: 45px; object-fit: cover; border-radius: 4px;">
                                                                        <h6 style="margin:0; font-size: 14px; font-weight: 600; color: #5a3e2b;">{{ $item->product_name }}</h6>
                                                                    </div>

                                                                    <div class="annoghor-form-group">
                                                                        <label>Select Rating:</label>
                                                                        <select name="rating" class="annoghor-input-field" required>
                                                                            <option value="5">⭐⭐⭐⭐⭐ (5 - Excellent Quality)</option>
                                                                            <option value="4">⭐⭐⭐⭐ (4 - Very Good)</option>
                                                                            <option value="3">⭐⭐⭐ (3 - Average)</option>
                                                                            <option value="2">⭐⭐ (2 - Poor)</option>
                                                                            <option value="1">⭐ (1 - Terrible)</option>
                                                                        </select>
                                                                    </div>

                                                                    <div class="annoghor-form-group">
                                                                        <label>Your Valuable Experience:</label>
                                                                        <textarea name="review_text" class="annoghor-input-field" rows="4" placeholder="How was the freshness, package quality and taste? Write here..." required style="resize: none;"></textarea>
                                                                    </div>

                                                                    <div style="text-align: right; margin-top: 20px; padding-top: 10px; border-top: 1px solid #eee;">
                                                                        <button type="button" class="btn btn-sm" style="background:#6c757d; color:#fff; padding:6px 15px; border:none; border-radius:4px; margin-right:5px; cursor:pointer;" onclick="closeAnnoghorModal('{{ $item->id }}')">Cancel</button>
                                                                        <button type="submit" class="btn btn-sm" style="background: #5a3e2b; color:#fff; font-weight: 500; padding: 6px 15px; border:none; border-radius:4px; cursor:pointer;">Submit Review</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        @else
                                                        <span class="text-muted" style="font-size: 13px; font-style: italic;"><i class="fas fa-lock mr-1" style="font-size: 11px;"></i> Review Locked</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="order-box-footer p-3 text-right" style="background: #fafafa; border-top: 1px solid #eaeaea; font-size: 15px; text-align: right;">
                                <span class="text-muted" style="margin-right: 15px;">Items Subtotal ({{ $order->orderItems->count() }} item(s)):</span>
                                <strong style="font-size: 18px; color: #222; font-weight: 700;">{{ \App\Helpers\CurrencyHelper::formatPrice($order->total_amount) }}</strong>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-info border-0 p-4 text-center" style="background: #fdfaf7; border-radius: 8px; text-align: center;">
                            <p style="color: #5a3e2b; font-size: 16px; font-weight: 500; margin-bottom: 15px;">You haven't placed any orders yet.</p>
                            <a href="{{ route('shops') }}" class="theme-btn style-one" style="text-decoration: none;">Start Shopping Now</a>
                        </div>
                    @endforelse

                    @if($orders->hasPages())
                        <div class="pagination-wrapper mt-40 d-flex justify-content-center">
                            {{ $orders->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <script>
        // মডাল ওপেন করার ফাংশন
        function openAnnoghorModal(itemId) {
            var modal = document.getElementById('customReviewModal-' + itemId);
            if (modal) {
                modal.style.display = "block";
                document.body.style.overflow = "hidden"; // পপআপ থাকা অবস্থায় পেজ স্ক্রল লক করবে
            }
        }

        // মডাল ক্লোজ করার ফাংশন
        function closeAnnoghorModal(itemId) {
            var modal = document.getElementById('customReviewModal-' + itemId);
            if (modal) {
                modal.style.display = "none";
                document.body.style.overflow = "auto"; // স্ক্রল আবার চালু করবে
            }
        }

        // পপআপ বক্সের বাইরে কোথাও ক্লিক করলে যেন অটোমেটিক বন্ধ হয়ে যায়
        window.onclick = function(event) {
            if (event.target.classList.contains('annoghor-custom-modal')) {
                event.target.style.display = "none";
                document.body.style.overflow = "auto";
            }
        }
    </script>
@endsection