@extends('layouts.app')

@section('title', 'Returns & Refunds Policy - AnnoGhor')

@section('content')

    <style>
        /* =========================================
           Returns & Refunds Policy Page Styles
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
            margin-bottom: 20px;
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
            margin-bottom: 15px;
        }

        /* Alert Box */
        .policy-alert-box {
            background: var(--brand-light);
            border-left: 4px solid var(--brand-primary);
            border-radius: 6px;
            padding: 15px 20px;
            margin-top: 20px;
        }
        .policy-alert-box p {
            color: var(--brand-primary);
            font-weight: 600;
            margin: 0;
            font-size: 15px;
            line-height: 1.6;
        }

        /* Condition Grid */
        .cond-box {
            background: #ffffff;
            border: 1px dashed #d1c4bc;
            border-radius: 8px;
            padding: 20px 15px;
            text-align: center;
            height: 100%;
            transition: all 0.3s ease;
        }
        .cond-box:hover {
            border-color: var(--brand-primary);
            background: var(--brand-light);
        }
        .cond-box i {
            font-size: 28px;
            color: var(--brand-primary);
            margin-bottom: 12px;
            display: block;
        }
        .cond-box h5 {
            font-size: 16px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 8px;
        }
        .cond-box p {
            font-size: 14px;
            color: var(--text-muted);
            margin: 0;
            line-height: 1.5;
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
                            <span class="hero-sub-title"><i class="flaticon-sparkler me-2"></i> Customer Service</span>
                        </div>
                        <h1 class="hero-title">Returns & Refunds Policy</h1>
                        <p class="hero-desc">At AnnoGhor, we are committed to delivering 100% premium, organic, and fresh products to your doorstep. Your satisfaction is our absolute top priority.</p>
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
                                <h3 class="policy-card-title">Delivery Return (Inspection at the Doorstep)</h3>
                            </div>
                            <p class="policy-text">Since we provide a Cash on Delivery (COD) service across Bangladesh, we highly encourage you to inspect the product quality and packaging right in front of the delivery person.</p>
                            
                            <div class="policy-alert-box">
                                <p><i class="fas fa-info-circle me-2"></i> If you find any issues (such as damaged packaging or a quality discrepancy), you can return the product instantly with the delivery rider without making a payment.</p>
                            </div>
                        </div>

                        <div class="policy-card">
                            <div class="card-title-box">
                                <span class="num-badge">2</span>
                                <h3 class="policy-card-title">Eligibility for Returns & Refunds</h3>
                            </div>
                            <p class="policy-text mb-4">If you discover an issue after the delivery rider has left, you may still request a return or refund under the following strict conditions:</p>
                            
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="cond-box">
                                        <i class="far fa-clock"></i>
                                        <h5>Timeframe</h5>
                                        <p>Notify us within 24 to 48 hours of receiving.</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="cond-box">
                                        <i class="fas fa-box-open"></i>
                                        <h5>Condition</h5>
                                        <p>Unused, unaltered & in original packaging.</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="cond-box">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        <h5>Valid Reasons</h5>
                                        <p>Damaged, spoiled, or wrong product delivered.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="policy-card mb-0">
                            <div class="card-title-box">
                                <span class="num-badge">3</span>
                                <h3 class="policy-card-title">How to Request a Return or Refund</h3>
                            </div>
                            <p class="policy-text mb-0">If you face any issues with your order, please reach out to us immediately. Please keep your <strong>order details or invoice</strong> handy when contacting us to help us process your request as quickly as possible. We will review your request and process refunds or replacements swiftly.</p>
                        </div>

                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="sticky-top" style="top: 100px; z-index: 10;" data-aos="fade-left" data-aos-delay="100" data-aos-duration="1000">
                        <div class="support-sidebar-box">
                            <span class="support-icon"><i class="fas fa-headset"></i></span>
                            <h4 class="support-title">Need Instant Support?</h4>
                            <p class="support-desc">Our expert team is available 24/7 to resolve your returns or refund queries without any hassle.</p>
                            
                            <div class="contact-methods">
                                <div class="contact-item">
                                    <div class="contact-item-icon icon-whatsapp">
                                        <i class="fab fa-whatsapp"></i>
                                    </div>
                                    <div>
                                        <span class="contact-info-label">Call / WhatsApp / Imo</span>
                                        <a href="tel:01700900059" class="contact-info-value">01700-900059</a>
                                    </div>
                                </div>
                                <div class="contact-item">
                                    <div class="contact-item-icon icon-clock">
                                        <i class="far fa-clock"></i>
                                    </div>
                                    <div>
                                        <span class="contact-info-label">Availability</span>
                                        <span class="contact-info-value">24/7 Premium Support</span>
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