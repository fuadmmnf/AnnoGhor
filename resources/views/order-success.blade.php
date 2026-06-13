@extends('layouts.app')

@section('title', 'Order Success - AnnoGhor')

@section('content')
    <style>
        .invoice-card {
            background: #ffffff;
            padding: 50px;
            border-radius: 20px;
            border: 1px solid #eef2f6;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.03);
            position: relative;
        }
        .invoice-badge {
            background: #f0fdf4;
            color: #16a34a;
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 600;
            display: inline-block;
        }
        .table-custom {
            width: 100%;
            margin-top: 20px;
        }
        .table-custom th {
            background: #f8fafc !important;
            color: #475569;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
            padding: 14px;
            border: none !important;
        }
        .table-custom td {
            padding: 16px 14px;
            border-bottom: 1px solid #f1f5f9 !important;
            color: #334155;
            font-size: 14px;
        }
        .summary-box {
            background: #f8fafc;
            border-radius: 14px;
            padding: 20px;
            margin-top: 15px;
        }
        .text-brand {
            color: #f15922 !important;
        }
        .dot-divider {
            border: none;
            border-top: 2px dotted #cbd5e1;
            margin: 20px 0;
            height: 1px;
        }
        /* 🖨️ প্রিন্ট মোড কনফিগারেশন: প্রিন্ট করার সময় বাটন ও ব্যানার হাইড হয়ে পারফেক্ট পেপার সাইজ নিবে */
        @media print {
            body {
                background: #fff !important;
                color: #000 !important;
            }
            .no-print, .main-header, .main-footer, .btn, .alert {
                display: none !important;
            }
            .invoice-card {
                padding: 0 !important;
                border: none !important;
                box-shadow: none !important;
            }
            .order-success-section {
                padding: 0 !important;
                background: #fff !important;
            }
        }
    </style>

    <section class="order-success-section pt-80 pb-80" style="background: #f4f7fa;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">

                    {{-- Guest Suggestion Banner --}}
                    @if(Auth::guest())
                        <div class="alert d-flex align-items-center justify-content-between flex-wrap gap-2 mb-4 no-print"
                             style="background:#fff8e1; border:1px solid #E2B718; border-radius:12px; padding:16px 20px; box-shadow: 0 4px 12px rgba(0,0,0,0.02);">
                            <span style="color:#7a6000; font-weight:500; font-size: 14px;">
                                <i class="fas fa-info-circle me-2" style="color:#E2B718; font-size: 16px;"></i>
                                Create an account to track your orders and enjoy faster checkout next time!
                            </span>
                            <div class="d-flex gap-2">
                                <a href="{{ route('register') }}" class="btn btn-sm btn-warning fw-semibold text-white px-3" style="border-radius: 8px;">Create Account</a>
                                <a href="{{ route('login') }}" class="btn btn-sm btn-outline-warning fw-semibold px-3" style="border-radius: 8px;">Login</a>
                            </div>
                        </div>
                    @endif

                    <div class="invoice-card" id="printableInvoice">
                        
                        <div class="row align-items-start mb-4">
                            <div class="col-sm-7">
                                <h1 class="fw-bold mb-1" style="font-size: 32px; letter-spacing: -0.5px; color: #0f172a;">AnnoGhor</h1>
                                <p class="text-muted small mb-0" style="line-height: 1.6;">
                                    <i class="fas fa-map-marker-alt me-1 text-secondary"></i> {{ $siteSettings->site_address ?? 'AnnoGhor Shop Address' }}<br>
                                    <i class="fas fa-phone-alt me-1 text-secondary"></i> {{ $siteSettings->site_phone ?? '+880 1XXX-XXXXXX' }} | 
                                    <i class="fas fa-envelope me-1 text-secondary"></i> {{ $siteSettings->site_email ?? 'info@annoghor.com' }}
                                </p>
                            </div>
                            <div class="col-sm-5 text-sm-end mt-3 mt-sm-0">
                                <img src="{{ (isset($siteSettings) && $siteSettings->site_logo) ? asset('uploads/settings/' . $siteSettings->site_logo) : asset('assets/images/logo/logo-main.png') }}"
                                     alt="Logo" style="max-height: 65px; object-fit: contain;">
                            </div>
                        </div>

                        <hr style="border-color: #f1f5f9; margin: 25px 0;">

                        <div class="row mb-4">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <span style="font-size: 11px; text-transform: uppercase; color: #94a3b8; font-weight: 700; display: block; margin-bottom: 6px; letter-spacing: 0.5px;">Customer Details</span>
                                <h6 class="fw-bold mb-1 text-dark" style="font-size: 16px;">{{ $order->guest_name ?? $order->user?->name ?? 'Customer' }}</h6>
                                <p class="text-muted small mb-0" style="line-height: 1.5;">
                                    {{-- 💡 এখানে আপনার নতুন কলাম $order->address ব্যবহার করা হয়েছে --}}
                                    <strong>Address:</strong> {{ $order->address ?? 'N/A' }}<br>
                                    <strong>Phone:</strong> {{ $order->phone }}<br>
                                    @if($order->user?->email)
                                        <strong>Email:</strong> {{ $order->user->email }}
                                    @endif
                                </p>
                            </div>

                            <div class="col-sm-6 text-sm-end">
                                <span style="font-size: 11px; text-transform: uppercase; color: #94a3b8; font-weight: 700; display: block; margin-bottom: 6px; letter-spacing: 0.5px;">Order Information</span>
                                <p class="text-muted small mb-0" style="line-height: 1.6;">
                                    <strong class="text-dark">Invoice No:</strong> <span class="text-brand fw-bold">#EC-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span><br>
                                    <strong class="text-dark">Order ID:</strong> {{ $order->order_number }}<br>
                                    <strong class="text-dark">Date:</strong> {{ $order->created_at?->format('d M, Y') }}
                                </p>
                            </div>
                        </div>

                        <div class="table-responsive mt-4">
                            <table class="table table-custom align-middle">
                                <thead>
                                    <tr>
                                        <th style="width: 8%;" class="text-center">#</th>
                                        <th style="width: 52%;">Product Description</th>
                                        <th style="width: 15%;" class="text-center">Unit Price</th>
                                        <th style="width: 10%;" class="text-center">Qty</th>
                                        <th style="width: 15%;" class="text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- 💡 কালেকশন জ্যাম দূর করতে রিয়েল রিলেশনটি কল করা হয়েছে --}}
                                    @forelse ($order->orderItems as $index => $item)
                                        <tr>
                                            <td class="text-center text-muted" style="font-size: 13px;">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</td>
                                            <td>
                                                <strong style="color: #1e293b; font-size: 15px;">{{ $item->product_name ?? 'Product Name' }}</strong>
                                            </td>
                                            <td class="text-center fw-medium">{{ \App\Helpers\CurrencyHelper::formatPrice($item->price ?? 0) }}</td>
                                            <td class="text-center fw-semibold"><span class="badge bg-light text-dark px-2 py-1" style="font-size: 12px; border: 1px solid #e2e8f0;">{{ $item->quantity ?? 1 }}</span></td>
                                            <td class="text-end fw-bold text-dark">{{ \App\Helpers\CurrencyHelper::formatPrice($item->total_price ?? 0) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-danger py-4">No items found for this order.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="row align-items-start mt-4">
                            <div class="col-md-6 mb-4 mb-md-0 pt-2">
                                <div style="background: #fafafa; border: 1px dashed #e2e8f0; border-radius: 12px; padding: 16px;">
                                    <span style="font-size: 11px; text-transform: uppercase; color: #94a3b8; font-weight: 700; display: block; margin-bottom: 5px;">Payment Method</span>
                                    <span class="fw-bold text-success" style="font-size: 15px;"><i class="fas fa-check-circle me-1"></i> {{ $order->payment_method }}</span>
                                    <small class="text-muted d-block mt-1">Please keep the cash ready upon delivery cargo arrival.</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="summary-box">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted small">Subtotal:</span>
                                        <span class="fw-semibold text-dark">{{ \App\Helpers\CurrencyHelper::formatPrice($order->subtotal ?? $order->total_amount) }}</span>
                                    </div>
                                    
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted small">Shipping Cost:</span>
                                        <span class="fw-bold text-brand">+ {{ \App\Helpers\CurrencyHelper::formatPrice($order->shipping_cost ?? 0) }}</span>
                                    </div>

                                    @if(($order->tax ?? 0) > 0)
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-muted small">Tax:</span>
                                            <span class="fw-semibold text-dark">{{ \App\Helpers\CurrencyHelper::formatPrice($order->tax) }}</span>
                                        </div>
                                    @endif

                                    <hr class="my-2" style="border-color: #cbd5e1;">
                                    
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-bold text-dark" style="font-size: 16px;">Grand Total:</span>
                                        <span class="fw-bold" style="font-size: 20px; color: #2563eb;">{{ \App\Helpers\CurrencyHelper::formatPrice($order->total_amount) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="dot-divider"></div>

                        <div class="text-center text-muted small" style="font-size: 12px; letter-spacing: 0.2px;">
                            Thank you for shopping with <strong class="text-dark">AnnoGhor</strong>! If you have any inquiries regarding this transactional invoice, feel free to ring us anytime.
                        </div>
                    </div>

                    <div class="text-center mt-4 no-print d-flex justify-content-center gap-3">
                        <a href="{{ route('home') }}" class="btn btn-dark px-4 py-2" style="border-radius: 10px; font-weight: 500; transition: all 0.3s;">
                            <i class="fas fa-shopping-bag me-2"></i> Continue Shopping
                        </a>
                        <button onclick="window.print()" class="btn btn-success px-4 py-2 text-white" style="background: #16a34a; border: none; border-radius: 10px; font-weight: 500; transition: all 0.3s;">
                            <i class="fas fa-print me-2"></i> Print/Download Invoice
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            fbq('track', 'Purchase', {
                value: {{ $order->total_amount ?? 0 }}, 
                currency: 'BDT', 
                content_ids: ['{{ $order->order_number }}'], 
                num_items: {{ $order->orderItems->count() ?? 1 }} 
            });
        });
    </script>
@endpush