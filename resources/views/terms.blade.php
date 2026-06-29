@extends('layouts.app')

@section('title', 'Terms & Conditions - AnnoGhor')

@section('content')

    <style>
        /* =========================================
           Terms & Conditions Page Styles
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

        /* Lists */
        .policy-list {
            list-style: none;
            padding-left: 0;
            margin: 0;
        }
        .policy-list li {
            margin-bottom: 12px;
            color: var(--text-muted);
            font-size: 15.5px;
            line-height: 1.7;
            display: flex;
            align-items: flex-start;
        }
        .policy-list li i {
            color: #10b981; /* Success Green */
            margin-top: 5px;
            margin-right: 12px;
            font-size: 14px;
        }

        /* Feature Box */
        .feature-box {
            background: #fdfdfd;
            border: 1px solid var(--border-soft);
            border-radius: 8px;
            padding: 15px;
            height: 100%;
            transition: all 0.3s ease;
        }
        .feature-box:hover {
            border-color: var(--brand-primary);
            background: var(--brand-light);
            box-shadow: 0 4px 12px rgba(90, 62, 43, 0.05);
        }
        .feature-box h5 {
            font-size: 16px;
            font-weight: 700;
            color: var(--brand-primary);
            margin-bottom: 8px;
            display: flex;
            align-items: center;
        }
        .feature-box h5 i {
            margin-right: 8px;
        }
        .feature-box p {
            margin: 0;
            font-size: 14px;
            color: var(--text-muted);
            line-height: 1.6;
        }

        /* Alert Box */
        .policy-alert-box {
            background: #fff8f4;
            border-left: 4px solid #de935f;
            border-radius: 6px;
            padding: 15px 20px;
        }
        .policy-alert-box p {
            color: var(--text-muted);
            margin: 0;
            font-size: 14px;
            line-height: 1.6;
        }
        .policy-alert-box p i {
            color: #de935f;
            margin-right: 8px;
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
        .icon-email { background: #eff6ff; color: #3b82f6; }
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

        .update-note {
            font-size: 13px;
            color: #888;
            font-style: italic;
            text-align: center;
            margin-top: 30px;
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
                            <span class="hero-sub-title"><i class="flaticon-sparkler me-2"></i> Legal & Rules</span>
                        </div>
                        <h1 class="hero-title">Terms & Conditions</h1>
                        <p class="hero-desc">Welcome to AnnoGhor (annoghor.com). By accessing and using our website, you agree to comply with and be bound by the following terms and conditions. Please read them carefully.</p>
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
                                <h3 class="policy-card-title">General Conditions</h3>
                            </div>
                            <ul class="policy-list">
                                <li>
                                    <i class="fas fa-check"></i>
                                    <span>We reserve the right to refuse service to anyone for any reason at any time.</span>
                                </li>
                                <li>
                                    <i class="fas fa-check"></i>
                                    <span>The content on this website, including product descriptions, images, and pricing, is subject to change without prior notice.</span>
                                </li>
                            </ul>
                        </div>

                        <div class="policy-card">
                            <div class="card-title-box">
                                <span class="num-badge">2</span>
                                <h3 class="policy-card-title">Products & Pricing</h3>
                            </div>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="feature-box">
                                        <div>
                                            <h5><i class="fas fa-leaf"></i> Quality Assurance</h5>
                                            <p>We specialize in 100% organic, premium, and fresh food products (such as our Sukkari Gold Khajoor). We ensure that all items are safely packaged and safe for consumption.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="feature-box">
                                        <div>
                                            <h5><i class="fas fa-tags"></i> Pricing & Currency</h5>
                                            <p>All prices listed on the website are in Bangladeshi Taka (BDT). Prices and availability of products are subject to change without notice.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="policy-card">
                            <div class="card-title-box">
                                <span class="num-badge">3</span>
                                <h3 class="policy-card-title">Shipping & Delivery</h3>
                            </div>
                            <p class="policy-text">We provide home delivery services all over Bangladesh. Our standard delivery time is typically <strong>within 5 days</strong>.</p>
                            
                            <div class="policy-alert-box">
                                <p><i class="fas fa-exclamation-triangle"></i> Any delays caused by natural disasters, political situations, or unexpected courier issues are beyond our direct control, though we will always work to resolve them quickly.</p>
                            </div>
                        </div>

                        <div class="policy-card">
                            <div class="card-title-box">
                                <span class="num-badge">4</span>
                                <h3 class="policy-card-title">Payment Methods</h3>
                            </div>
                            <p class="policy-text mb-0">We offer a secure <strong>Cash on Delivery (COD)</strong> payment method to guarantee a risk-free shopping experience for our customers. Full payment must be handed over to the delivery representative upon receiving the package.</p>
                        </div>

                        <div class="policy-card mb-0">
                            <div class="card-title-box">
                                <span class="num-badge">5</span>
                                <h3 class="policy-card-title">Order Cancellations & Modifications</h3>
                            </div>
                            <p class="policy-text mb-0">If you wish to change or cancel your order, please contact our support team immediately <strong>before the item is dispatched</strong>. Once an item has been handed over to the courier service, the order cannot be cancelled or modified.</p>
                        </div>

                        <p class="update-note">Note: AnnoGhor reserves the right to update, change, or replace any part of these Terms & Conditions by posting updates to our website. It is your responsibility to check this page periodically for changes.</p>

                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="sticky-top" style="top: 100px; z-index: 10;" data-aos="fade-left" data-aos-delay="100" data-aos-duration="1000">
                        <div class="support-sidebar-box">
                            <span class="support-icon"><i class="fas fa-shield-alt"></i></span>
                            <h4 class="support-title">Customer Support</h4>
                            <p class="support-desc">For any queries, complaints, or assistance regarding our terms, feel free to reach out to us.</p>
                            
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
                                    <div class="contact-item-icon icon-email">
                                        <i class="far fa-envelope"></i>
                                    </div>
                                    <div>
                                        <span class="contact-info-label">Email Address</span>
                                        <a href="mailto:annoghor@gmail.com" class="contact-info-value">annoghor@gmail.com</a>
                                    </div>
                                </div>
                                <div class="contact-item">
                                    <div class="contact-item-icon icon-clock">
                                        <i class="far fa-clock"></i>
                                    </div>
                                    <div>
                                        <span class="contact-info-label">Support Availability</span>
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