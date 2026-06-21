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

            @guest
                <div class="alert d-flex align-items-center justify-content-between flex-wrap gap-2 mb-30"
                     style="background:#fff8e1; border:1px solid #E2B718; border-radius:10px; padding:14px 20px;">
                    <span style="color:#7a6000; font-weight:500;">
                        <i class="fas fa-info-circle me-2" style="color:#E2B718;"></i>
                        Have an account? Login for faster checkout and order history.
                    </span>
                    <div class="d-flex gap-2">
                        <a href="{{ route('login') }}" class="btn btn-sm btn-outline-warning fw-semibold">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-sm btn-warning fw-semibold text-white">Register</a>
                    </div>
                </div>
            @endguest

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

                                            {{-- Name --}}
                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Full Name</label>
                                                    @auth
                                                        <input type="text" class="form-control"
                                                               value="{{ auth()->user()->name }}"
                                                               name="name" required readonly>
                                                    @else
                                                        <input type="text" class="form-control"
                                                               placeholder="Your full name"
                                                               name="name" required
                                                               value="{{ old('name') }}">
                                                    @endauth
                                                </div>
                                            </div>

                                            {{-- Phone --}}
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Phone Number</label>
                                                    @auth
                                                        <input type="text" class="form-control"
                                                               placeholder="Ex: +880 1XXX-XXXXXX"
                                                               value="{{ auth()->user()->phone }}"
                                                               name="phone" required>
                                                    @else
                                                        <input type="text" class="form-control"
                                                               placeholder="Ex: +880 1XXX-XXXXXX"
                                                               name="phone" required
                                                               value="{{ old('phone') }}">
                                                    @endauth
                                                </div>
                                            </div>

                                            {{-- Address --}}
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Address</label>
                                                    @auth
                                                        <input type="text" class="form-control"
                                                               value="{{ auth()->user()->address }}"
                                                               name="address" required>
                                                    @else
                                                        <input type="text" class="form-control"
                                                               placeholder="Address"
                                                               name="address" required
                                                               value="{{ old('address') }}">
                                                    @endauth
                                                </div>
                                            </div>

                                            {{-- 🚚 ডাইনামিক চেকমার্ক (Radio Card) সেকশন --}}
                                            <div class="col-lg-12 mt-3 mb-3">
                                                <label class="fw-semibold mb-2" style="color: #333; font-size: 15px;">Select Shipping Method</label>
                                                <div class="shipping-methods-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
                                                    
                                                    <label class="shipping-card" style="border: 2px solid #eceff8; padding: 15px; border-radius: 10px; cursor: pointer; display: flex; align-items: center; gap: 12px; transition: all 0.3s ease; background: #fff;">
                                                        <input type="radio" name="delivery_area" value="inside" class="delivery-radio" onchange="calculateLiveTotal(this)" required style="width: 18px; height: 18px; accent-color: #f15922;">
                                                        <div>
                                                            <span style="display: block; font-weight: 600; color: #333;">Inside Dhaka</span>
                                                            <small style="color: #666;" id="inside-cost-text">Connecting...</small>
                                                        </div>
                                                    </label>

                                                    <label class="shipping-card" style="border: 2px solid #eceff8; padding: 15px; border-radius: 10px; cursor: pointer; display: flex; align-items: center; gap: 12px; transition: all 0.3s ease; background: #fff;">
                                                        <input type="radio" name="delivery_area" value="outside" class="delivery-radio" onchange="calculateLiveTotal(this)" required style="width: 18px; height: 18px; accent-color: #f15922;">
                                                        <div>
                                                            <span style="display: block; font-weight: 600; color: #333;">Outside Dhaka</span>
                                                            <small style="color: #666;" id="outside-cost-text">Connecting...</small>
                                                        </div>
                                                    </label>

                                                </div>
                                            </div>

                                            {{-- Order Notes --}}
                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Order Notes (optional)</label>
                                                    <textarea name="order_notes" class="form-control" rows="3"
                                                              placeholder="e.g. special notes for delivery.">{{ old('order_notes') }}</textarea>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                {{-- Order Summary & Payment --}}
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
                                                    <span id="subtotal-display" data-subtotal="{{ $subtotal }}">{{ \App\Helpers\CurrencyHelper::formatPrice($subtotal) }}</span>
                                                </div>
                                            </div>
                                            
                                            <div class="list-item">
                                                <div class="shipping">Shipping</div>
                                                <div class="shipping-total" id="shipping-cost-display" style="font-weight: 500; color: #666;">Select area</div>
                                            </div>
                                            
                                            <div class="list-item">
                                                <div class="total">Total</div>
                                                <div class="product-total" style="font-weight: 700; color: #f15922;">
                                                    <span id="grand-total-display">{{ \App\Helpers\CurrencyHelper::formatPrice($subtotal) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="payment-method-wrapper">
                                        <h4 class="title mb-20">Payment Method</h4>
                                        <ul id="paymentMethod" class="mb-20 list-unstyled">
                                            <li class="form-check mb-0 p-0">
                                                <div class="d-block w-100 p-3 mb-0" style="background: #f8fafc; border-radius: 8px; border: 1px solid #e2e8f0;">
                                                    <input type="hidden" name="payment_method" value="Cash On Delivery">
                                                    <span class="form-check-label fw-medium text-dark">Cash On Delivery</span>
                                                    <p class="mt-2 mb-0 text-muted small">Pay with cash upon delivery.</p>
                                                </div>
                                            </li>
                                        </ul>
                                        <button id="place-order-btn" type="submit" class="theme-btn style-one w-100">Place Order</button>
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

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof fbq !== 'undefined') {
                fbq('track', 'InitiateCheckout');
            }
        }); // <-- এখানে ব্র্যাকেট ক্লোজিং ফিক্স করা হয়েছে

        var insideDhakaCharge = 0;
        var outsideDhakaCharge = 0;
        var isChargesApiReady = false;

        // ১. ন্যাটিভ ভ্যানিলা জেএস দিয়ে এপিআই কল
        function fetchDynamicCharges() {
            fetch('{{ route("api.delivery-charges") }}')
                .then(function(res) {
                    return res.json();
                })
                .then(function(data) {
                    insideDhakaCharge = parseFloat(data.inside_dhaka) || 60;
                    outsideDhakaCharge = parseFloat(data.outside_dhaka) || 120;
                    isChargesApiReady = true;

                    // রেডিও বক্সের লোডিং টেক্সট লাইভ আপডেট
                    document.getElementById('inside-cost-text').innerText = '৳' + insideDhakaCharge.toFixed(2);
                    document.getElementById('outside-cost-text').innerText = '৳' + outsideDhakaCharge.toFixed(2);

                    // ইউজার যদি এপিআই লোড শেষ হওয়ার আগেই রেডিও সিলেক্ট করে ফেলে, তবে দাম অটোমেটিক আপডেট হবে
                    var checkedInput = document.querySelector('.delivery-radio:checked');
                    if (checkedInput) {
                        calculateLiveTotal(checkedInput);
                    }
                })
                .catch(function(err) {
                    // ফলব্যাক সেফটি রেট
                    insideDhakaCharge = 60;
                    outsideDhakaCharge = 120;
                    isChargesApiReady = true;
                    document.getElementById('inside-cost-text').innerText = '৳60.00';
                    document.getElementById('outside-cost-text').innerText = '৳120.00';
                });
        }

        // পেজ লোড হওয়ার সাথে সাথেই এপিআই থেকে রিয়েল প্রাইস নিয়ে আসবে
        window.addEventListener('DOMContentLoaded', fetchDynamicCharges);

        // ২. লাইভ গ্র্যান্ড টোটাল ও শিপিং কস্ট রেন্ডারিং মেকানিজম
        function calculateLiveTotal(radioElement) {
            // কার্ডের হাইলাইট বর্ডার রেন্ডারিং
            var cards = document.querySelectorAll('.shipping-card');
            cards.forEach(function(card) {
                card.style.borderColor = '#eceff8';
                card.style.background = '#fff';
            });
            
            var targetCard = radioElement.closest('.shipping-card');
            if (targetCard) {
                targetCard.style.borderColor = '#f15922';
                targetCard.style.background = '#fffbf9';
            }

            // যদি এপিআই ডেটা লোড হতে কয়েক মিলি সেকেন্ড দেরি হয়
            if (!isChargesApiReady) {
                document.getElementById('shipping-cost-display').innerText = 'Calculating...';
                return;
            }

            // ক্যালকুলেশন জোন
            var subtotalSpan = document.getElementById('subtotal-display');
            var subtotal = parseFloat(subtotalSpan.getAttribute('data-subtotal')) || 0;
            
            var selectedZone = radioElement.value;
            var currentCharge = (selectedZone === 'inside') ? insideDhakaCharge : outsideDhakaCharge;
            var finalTotal = subtotal + currentCharge;

            // ডান পাশের উইন্ডোতে লাইভ রেন্ডারিং
            document.getElementById('shipping-cost-display').innerText = '৳' + currentCharge.toFixed(2);
            document.getElementById('shipping-cost-display').style.color = '#333';
            document.getElementById('grand-total-display').innerText = '৳' + finalTotal.toFixed(2);
        }
    </script>
@endpush