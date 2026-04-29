@extends('layouts.app')

@section('title', 'Order Success')

@section('content')
    <section class="order-success-section pt-120 pb-120 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="invoice-container shadow-lg" id="printableInvoice">

                        <div class="invoice-header-main">
                            <div class="row align-items-center">
                                <div class="col-md-7">
                                    <h1 class="display-3 fw-bold mb-0">AnnoGhor</h1>
                                    <div class="col-md-4 mb-4">
                                        <p class="info-text">
                                            {{ $siteSettings->site_address }}<br>
                                            {{ $siteSettings->site_phone }}<br>
                                            {{ $siteSettings->site_email }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-5 text-md-end">
                                    <img src="{{ isset($siteSettings->site_logo) ? asset('uploads/settings/' . $siteSettings->site_logo) : asset('assets/images/logo/logo-main.png') }}"
                                        alt="Logo" class="custom-logo">
                                </div>
                            </div>

                            <!-- ===== Invoice Info & Bill To ===== -->
                            <div class="row mb-4 mt-7">
                                <div class="col-md-6">
                                    <h5 class="fw-bold mb-2">Bill To:</h5>
                                    <p class="mb-0">{{ $order->user->name ?? 'Guest User' }}</p>
                                    <p class="mb-0">{{ $order->full_address }}</p>
                                    <p class="mb-0">{{ $order->email }}</p>
                                    <p class="mb-0">{{ $order->phone }}</p>
                                </div>

                                <div class="col-md-6 text-md-end">
                                    <p class="mb-1"><strong>Invoice No:</strong> EC000{{ $order->id }}</p>
                                    <p class="mb-1"><strong>Order ID:</strong> {{ $order->order_number }}</p>
                                    <p class="mb-1"><strong>Date:</strong> {{ $order->created_at->format('d / m / Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="invoice-body-area">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Description</th>
                                            <th class="text-center">Price</th>
                                            <th class="text-center">Qty</th>
                                            <th class="text-end">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->orderItems as $index => $item)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $item->product_name }}</td>
                                                <td class="text-center">
                                                    {{ \App\Helpers\CurrencyHelper::formatPrice($item->price) }}</td>
                                                <td class="text-center">{{ $item->quantity }}</td>
                                                <td class="text-end fw-bold">
                                                    {{ \App\Helpers\CurrencyHelper::formatPrice($item->total_price) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="invoice-footer-area">
                            <div class="row align-items-center">
                                <div class="col-md-6 mb-4 mb-md-0">
                                    <h5 class="fw-bold text-dark mb-3">Payment Method</h5>
                                    <p class="mb-1 fw-medium">{{ $order->payment_method }}</p>
                                    {{-- <p class="info-text mb-0 text-muted">A/C Name: {{ config('app.name') }}</p>
                                <p class="info-text text-muted small">Details: Payment completed successfully.</p> --}}
                                </div>
                                <div class="col-md-6">
                                    <div class="price-summary ms-auto">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-muted">Subtotal:</span>
                                            <span
                                                class="fw-bold">{{ \App\Helpers\CurrencyHelper::formatPrice($order->total_amount) }}</span>
                                        </div>
                                        <hr class="my-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="h4 mb-0 fw-bold text-dark">Total:</span>
                                            <span
                                                class="h3 mb-0 fw-bold text-primary">{{ \App\Helpers\CurrencyHelper::formatPrice($order->total_amount) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ===== Print Footer ===== -->
                    <div class="text-center mt-4">
                        <p class="fw-bold mb-0">AnnoGhor</p>
                    </div>

                    <div class="text-center mt-5 no-print d-flex justify-content-center gap-3">
                        <a href="{{ route('home') }}" class="btn btn-dark btn-lg px-5 rounded-pill">
                            <i class="fas fa-shopping-bag me-2"></i> Continue Shopping
                        </a>
                        <button onclick="window.print()" class="btn btn-primary btn-lg px-5 rounded-pill">
                            <i class="fas fa-print me-2"></i> Print / Download PDF
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
