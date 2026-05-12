@extends('layouts.app')

@section('title', 'Checkout - Pesco')

@section('content')
    <section class="checkout-section pt-50 pb-80">
        <div class="container">
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row">
                <div class="col-xl-12">
                    <div class="checkout-wrapper" data-aos="fade-up" data-aos-duration="1200">
                        <form class="checkout-form" action="{{ route('order.place') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-xl-7">
                                    <div class="billing-wrapper">
                                        <h3 class="title">Billing details</h3>
                                        <div class="row">
                                            {{-- Name (Readonly) --}}
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>Full Name <span>*</span></label>
                                                    <input type="text" class="form_control"
                                                           value="{{ auth()->user()->name }}"
                                                           name="name" required readonly>
                                                </div>
                                            </div>

                                            {{-- Phone (Auto-fill) --}}
                                            <div class="col-lg-6">
                                                <div class="form_group">
                                                    <label>Phone Number <span>*</span></label>
                                                    <input type="text" class="form_control"
                                                           placeholder="Ex: +1 (555) 123-4567"
                                                           value="{{ auth()->user()->phone }}"
                                                           name="phone" required>
                                                </div>
                                            </div>

                                            {{-- Email (Readonly) --}}
                                            <div class="col-lg-6">
                                                <div class="form_group">
                                                    <label>Email address <span>*</span></label>
                                                    <input type="email" class="form_control"
                                                           value="{{ auth()->user()->email }}"
                                                           name="email" required readonly>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form_group">
                                                    <label>Order Notes (optional)</label>
                                                    <textarea name="order_notes" class="form_control"
                                                              placeholder="e.g. special notes for delivery."></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Order Summary & Payment Method (Keep as it is) --}}
                                <div class="col-xl-5">
                                    <div class="order-summary-wrapper mb-30">
                                        <h3 class="title">Order Summary</h3>
                                        <div class="order-list">
                                            <div class="list-item">
                                                <div class="item-title">Product</div>
                                                <div class="subtotal">Subtotal</div>
                                            </div>

                                            @forelse($cartItems as $item)
                                                <div class="product-item">
                                                    <div class="product-name">
                                                        {{ $item->product->name }} <span>x{{ $item->quantity }}</span>
                                                    </div>
                                                    <div class="product-total">
                                                        {{ \App\Helpers\CurrencyHelper::formatPrice($item->total_price) }}
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="product-item">
                                                    <div class="product-name">Cart is empty</div>
                                                </div>
                                            @endforelse

                                            <div class="list-item">
                                                <div class="subtotal">Subtotal</div>
                                                <div class="product-total">
                                                    {{ \App\Helpers\CurrencyHelper::formatPrice($subtotal) }}
                                                </div>
                                            </div>
                                            <div class="list-item">
                                                <div class="shipping">Shipping</div>
                                                <div class="shipping-total">Free</div>
                                            </div>
                                            <div class="list-item">
                                                <div class="total">Total</div>
                                                <div class="product-total">
                                                    {{ \App\Helpers\CurrencyHelper::formatPrice($total) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="payment-method-wrapper">
                                        <h4 class="title mb-20">Payment Method</h4>
                                        <ul id="paymentMethod" class="mb-20">
                                            {{-- <li class="form-check">
                                                <input class="form-check-input" type="radio" name="payment_method" value="Direct bank transfer" id="method1" checked required>
                                                <label class="form-check-label" for="method1" data-bs-toggle="collapse" data-bs-target="#collapse0">
                                                    Direct bank transfer
                                                </label>
                                                <div id="collapse0" class="collapse show" data-bs-parent="#paymentMethod">
                                                    <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference.</p>
                                                </div>
                                            </li>
                                            <li class="form-check">
                                                <input class="form-check-input" type="radio" name="payment_method" value="Check payments" id="method2">
                                                <label class="form-check-label" for="method2" data-bs-toggle="collapse" data-bs-target="#collapse1">
                                                    Check payments
                                                </label>
                                                <div id="collapse1" class="collapse" data-bs-parent="#paymentMethod">
                                                    <p>Please send a check to our store address. We will process your order once we receive the payment.</p>
                                                </div>
                                            </li> --}}
                                            <li class="form-check mb-0 p-0">
                                                <div class="d-block w-100 p-3 mb-0">
                                                    <input type="hidden" name="payment_method" value="Cash On Delivery">
                                                    <span class="form-check-label fw-medium">Cash On Delivery</span>
                                                    <p class="mt-2 mb-0">Pay with cash upon delivery. Please have exact change ready.</p>
                                                </div>
                                            </li>
                                        </ul>
                                        <button id="place-order-btn" type="submit" class="theme-btn style-one">Place Order</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

