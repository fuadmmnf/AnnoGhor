@extends('layouts.app')

@section('title', 'Delivery & Return Policy - AnnoGhor')

@section('content')

    <style>
        /* =========================================
           Delivery & Return Policy Page Styles
           ========================================= */
        :root {
            --brand-primary: #5a3e2b;
            --brand-light: #fff8f4;
            --bg-offwhite: #fdfaf7;
            --text-dark: #222222;
            --text-muted: #555555;
            --border-soft: #eaeaea;
        }

        /* Hero Section */
        .policy-hero-section {
            background-color: var(--bg-offwhite);
            border-bottom: 1px solid var(--border-soft);
            padding: 80px 0 60px;
        }
        .hero-sub-title {
            color: var(--brand-primary);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-size: 14px;
            background: #ffffff;
            padding: 6px 16px;
            border-radius: 30px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.03);
            border: 1px solid var(--border-soft);
        }
        .hero-title {
            color: var(--text-dark);
            font-size: 44px;
            font-weight: 800;
            margin-bottom: 15px;
            line-height: 1.2;
        }
        .hero-desc {
            font-size: 17px;
            color: var(--text-muted);
            max-width: 650px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* Policy Cards */
        .policy-card {
            background: #ffffff;
            border: 1px solid var(--border-soft);
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.02);
            transition: all 0.3s ease;
        }
        .policy-card:hover {
            box-shadow: 0 12px 30px rgba(90, 62, 43, 0.08);
            transform: translateY(-3px);
            border-color: #e5d8d0;
        }
        .card-title-box {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
        }
        .num-badge {
            background: var(--brand-primary);
            color: #fff;
            width: 42px;
            height: 42px;
            min-width: 42px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            font-weight: 700;
            margin-right: 15px;
            box-shadow: 0 4px 12px rgba(90, 62, 43, 0.25);
        }
        .policy-card-title {
            font-size: 22px;
            color: var(--text-dark);
            font-weight: 700;
            margin: 0;
            line-height: 1.3;
        }
        .policy-text {
            color: var(--text-muted);
            line-height: 1.7;
            font-size: 16px;
            margin-bottom: 20px;
        }

        /* Info Grid Boxes (Shipping) */
        .shipping-info-box {
            background: #ffffff;
            border: 1px dashed #d1c4bc;
            border-radius: 8px;
            padding: 20px 15px;
            text-align: center;
            height: 100%;
            transition: all 0.3s ease;
        }
        .shipping-info-box:hover {
            border-color: var(--brand-primary);
            background: var(--brand-light);
        }
        .shipping-info-box i {
            font-size: 28px;
            color: var(--brand-primary);
            margin-bottom: 12px;
            display: block;
        }
        .shipping-info-box h5 {
            font-size: 16px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 8px;
        }
        .shipping-info-box p {
            font-size: 14px;
            color: var(--text-muted);
            margin: 0;
            line-height: 1.5;
        }

        /* Lists */
        .policy-list {
            list-style: none;
            padding-left: 0;
            margin: 0;
        }
        .policy-list li {
            margin-bottom: 15px;
            color: var(--text-muted);
            font-size: 15.5px;
            line-height: 1.7;
            display: flex;
            align-items: flex-start;
        }
        .policy-list li strong {
            color: var(--text-dark);
            font-weight: 600;
        }
        .policy-list li i {
            color: #10b981; /* Success Green */
            margin-top: 5px;
            margin-right: 12px;
            font-size: 16px;
        }

        /* Alert Box */
        .policy-alert-box {
            background: var(--brand-light);
            border-left: 4px solid var(--brand-primary);
            border-radius: 6px;
            padding: 15px 20px;
            margin-bottom: 15px;
        }
        .policy-alert-box p {
            color: var(--text-muted);
            margin: 0;
            font-size: 15px;
            line-height: 1.6;
        }
        .policy-alert-box p strong {
            color: var(--text-dark);
        }

        /* Sidebar Support */
        .support-sidebar-box {
            background: var(--brand-primary);
            border-radius: 12px;
            padding: 35px 25px;
            color: #fff;
            text-align: center;
            box-shadow: 0 10px 30px rgba(90, 62, 43, 0.15);
        }
        .support-icon {
            font-size: 45px;
            color: #ffffff;
            margin-bottom: 15px;
            display: inline-block;
        }
        .support-title {
            color: #ffffff;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .support-desc {
            color: rgba(255, 255, 255, 0.85);
            font-size: 15px;
            margin-bottom: 25px;
            line-height: 1.6;
        }
        .contact-methods {
            background: #ffffff;
            border-radius: 8px;
            padding: 20px;
            text-align: left;
        }
        .contact-item {
            display: flex;
            align-items: center;
        }
        .contact-item:not(:last-child) {
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border-soft);
        }
        .contact-item-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-right: 15px;
            flex-shrink: 0;
        }
        .icon-whatsapp { background: #e8f5e9; color: #10b981; }
        .icon-clock { background: #fff8e1; color: #f59e0b; }
        
        .contact-info-label {
            display: block;
            font-size: 11px;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 2px;
        }
        .contact-info-value {
            font-size: 16px;
            font-weight: 700;
            color: var(--text-dark);
            text-decoration: none;
            display: block;
        }
        a.contact-info-value:hover {
            color: var(--brand-primary);
        }

        /* Responsive Fixes */
        @media (max-width: 991px) {
            .support-sidebar-box {
                margin-top: 10px;
            }
        }
        @media (max-width: 767px) {
            .policy-hero-section {
                padding: 50px 0 40px;
            }
            .hero-title {
                font-size: 32px;
            }
            .policy-card {
                padding: 20px;
            }
            .policy-card-title {
                font-size: 18px;
            }
            .num-badge {
                width: 35px;
                height: 35px;
                min-width: 35px;
                font-size: 16px;
            }
        }
    </style>

    <section class="policy-hero-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div data-aos="fade-up" data-aos-duration="1000">
                        <div class="d-inline-block mb-3">
                            <span class="hero-sub-title"><i class="flaticon-sparkler me-2"></i> Shipping & Returns</span>
                        </div>
                        <h1 class="hero-title">Delivery & Return Policy</h1>
                        <p class="hero-desc">At AnnoGhor, we strive to provide a seamless shopping experience. From the moment you place your order to the time it arrives at your doorstep, we ensure maximum care and premium service.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="policy-details-section pt-60 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="policy-wrapper" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1000">
                        
                        <div class="policy-card">
                            <div class="card-title-box">
                                <span class="num-badge">1</span>
                                <h3 class="policy-card-title">Shipping & Delivery</h3>
                            </div>
                            
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="shipping-info-box">
                                        <i class="fas fa-map-marked-alt"></i>
                                        <h5>Coverage</h5>
                                        <p>Home delivery all over Bangladesh.</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="shipping-info-box">
                                        <i class="far fa-calendar-alt"></i>
                                        <h5>Delivery Time</h5>
                                        <p>Processed & delivered within 5 days.</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="shipping-info-box">
                                        <i class="fas fa-hand-holding-usd"></i>
                                        <h5>Payment</h5>
                                        <p>Cash on Delivery (COD) available.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="policy-card">
                            <div class="card-title-box">
                                <span class="num-badge">2</span>
                                <h3 class="policy-card-title">Doorstep Return Policy (Check Before You Pay)</h3>
                            </div>
                            <p class="policy-text">We believe in 100% transparency. To ensure you are completely satisfied with your purchase, we offer an instant doorstep checking policy:</p>
                            
                            <ul class="policy-list">
                                <li>
                                    <i class="fas fa-search"></i>
                                    <span><strong>Inspect on Arrival:</strong> When the courier agent delivers your package, please open and inspect the product (quality, packaging, and quantity) right in front of them.</span>
                                </li>
                                <li>
                                    <i class="fas fa-undo"></i>
                                    <span><strong>Instant Return:</strong> If the product is damaged, spoiled, or does not match what you ordered, you can hand it right back to the delivery rider.</span>
                                </li>
                                <li>
                                    <i class="fas fa-shield-alt"></i>
                                    <span><strong>Zero Risk:</strong> If you choose to return the item at the doorstep, you do not have to pay for the product.</span>
                                </li>
                            </ul>
                        </div>

                        <div class="policy-card mb-0">
                            <div class="card-title-box">
                                <span class="num-badge">3</span>
                                <h3 class="policy-card-title">After-Delivery Support</h3>
                            </div>
                            <p class="policy-text">If you notice an issue with your product after the delivery rider has already left, please contact us <strong>within 24 hours</strong>:</p>
                            
                            <div class="policy-alert-box">
                                <p><strong>Condition:</strong> For a return or exchange post-delivery, the product must remain unused, untampered, and in its original packaging.</p>
                            </div>
                            <div class="policy-alert-box mb-0">
                                <p><strong>Process:</strong> Reach out to our support team with your order details, and we will arrange a replacement or refund depending on the issue.</p>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="sticky-top" style="top: 100px; z-index: 10;" data-aos="fade-left" data-aos-delay="100" data-aos-duration="1000">
                        <div class="support-sidebar-box">
                            <span class="support-icon"><i class="fas fa-truck-loading"></i></span>
                            <h4 class="support-title">24/7 Support Helpline</h4>
                            <p class="support-desc">If you have any questions about your delivery or need to initiate a return, our team is always ready to help.</p>
                            
                            <div class="contact-methods">
                                <div class="contact-item">
                                    <div class="contact-item-icon icon-whatsapp">
                                        <i class="fab fa-whatsapp"></i>
                                    </div>
                                    <div>
                                        <span class="contact-info-label">Phone / WhatsApp / Imo</span>
                                        <a href="tel:01700900059" class="contact-info-value">01700-900059</a>
                                    </div>
                                </div>
                                <div class="contact-item">
                                    <div class="contact-item-icon icon-clock">
                                        <i class="far fa-clock"></i>
                                    </div>
                                    <div>
                                        <span class="contact-info-label">Service Status</span>
                                        <span class="contact-info-value">Available 24 Hours / 7 Days</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection