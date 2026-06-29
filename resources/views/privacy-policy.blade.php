@extends('layouts.app')

@section('title', 'Privacy Policy - AnnoGhor')

@section('content')

    <style>
        /* =========================================
           Privacy Policy Page Styles
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
            display: inline-flex;
            align-items: center;
            margin-right: 5px;
        }
        .policy-list li i {
            color: #10b981; /* Success Green */
            margin-right: 10px;
            font-size: 16px;
        }

        /* Feature Box */
        .feature-box {
            background: #fdfdfd;
            border: 1px solid var(--border-soft);
            border-radius: 8px;
            padding: 15px;
            height: 100%;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }
        .feature-box:hover {
            border-color: var(--brand-primary);
            background: var(--brand-light);
            box-shadow: 0 4px 12px rgba(90, 62, 43, 0.05);
        }
        .feature-box i {
            font-size: 20px;
            color: var(--brand-primary);
            margin-right: 15px;
            background: #ffffff;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            flex-shrink: 0;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        }
        .feature-box p {
            margin: 0;
            font-size: 14px;
            color: var(--text-muted);
            line-height: 1.5;
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
            color: var(--brand-primary);
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
                            <span class="hero-sub-title"><i class="flaticon-sparkler me-2"></i> Data Protection</span>
                        </div>
                        <h1 class="hero-title">Privacy Policy</h1>
                        <p class="hero-desc">At AnnoGhor (annoghor.com), we highly value your privacy and are committed to protecting your personal information. Please review how we safeguard your data.</p>
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
                                <h3 class="policy-card-title">Information We Collect</h3>
                            </div>
                            <p class="policy-text">To provide you with our premium products and services, we may collect the following information when you place an order or interact with our site:</p>
                            
                            <ul class="policy-list">
                                <li>
                                    <i class="fas fa-user-check"></i>
                                    <span><strong>Contact Information:</strong> Your name, shipping/billing address, phone number, and email address.</span>
                                </li>
                                <li>
                                    <i class="fas fa-shopping-basket"></i>
                                    <span><strong>Order Details:</strong> Information about the specific items you purchase and your delivery preferences.</span>
                                </li>
                                <li>
                                    <i class="fas fa-laptop-code"></i>
                                    <span><strong>Technical Data:</strong> IP address, browser type, and device information gathered automatically through cookies.</span>
                                </li>
                            </ul>
                        </div>

                        <div class="policy-card">
                            <div class="card-title-box">
                                <span class="num-badge">2</span>
                                <h3 class="policy-card-title">How We Use Your Information</h3>
                            </div>
                            <p class="policy-text mb-4">We use the collected information solely to enhance your shopping experience and manage our business operations, specifically to:</p>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="feature-box">
                                        <i class="fas fa-box"></i>
                                        <p>Process, pack, and ship your orders smoothly.</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="feature-box">
                                        <i class="fas fa-comment-alt"></i>
                                        <p>Contact you for confirmations or support queries.</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="feature-box">
                                        <i class="fas fa-truck"></i>
                                        <p>Deliver packages accurately via our courier partners.</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="feature-box">
                                        <i class="fas fa-shield-alt"></i>
                                        <p>Prevent fraudulent transactions and ensure security.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="policy-card">
                            <div class="card-title-box">
                                <span class="num-badge">3</span>
                                <h3 class="policy-card-title">Information Sharing & Third Parties</h3>
                            </div>
                            <p class="policy-text">We respect your privacy. <strong>We do not sell, rent, or trade your personal information</strong> to third parties. We only share data with trusted partners necessary to fulfill your order:</p>
                            
                            <div class="policy-alert-box">
                                <p><strong>Courier Services:</strong> Sharing your name, address, and phone number so they can deliver your products to your doorstep.</p>
                            </div>
                            <div class="policy-alert-box mb-0">
                                <p><strong>Legal Requirements:</strong> Shared only if required strictly by law or to protect our rights, safety, and property.</p>
                            </div>
                        </div>

                        <div class="policy-card">
                            <div class="card-title-box">
                                <span class="num-badge">4</span>
                                <h3 class="policy-card-title">Data Security</h3>
                            </div>
                            <p class="policy-text mb-0">We implement strict security measures to maintain the safety of your personal data. Your information is stored behind secured networks and is only accessible by a limited number of authorized personnel who are required to keep the information confidential.</p>
                        </div>

                        <div class="policy-card">
                            <div class="card-title-box">
                                <span class="num-badge">5</span>
                                <h3 class="policy-card-title">Cookies</h3>
                            </div>
                            <p class="policy-text mb-0">Our website uses cookies to understand and save your preferences for future visits, keep track of items in your shopping cart, and compile aggregate data about site traffic so we can offer a better user experience in the future. You can choose to turn off cookies through your browser settings if you prefer.</p>
                        </div>

                        <div class="policy-card mb-0">
                            <div class="card-title-box">
                                <span class="num-badge">6</span>
                                <h3 class="policy-card-title">Changes to This Policy</h3>
                            </div>
                            <p class="policy-text mb-0">AnnoGhor reserves the right to modify this Privacy Policy at any time. Any changes or updates will take effect immediately upon being posted on this page. We encourage you to review this page periodically.</p>
                        </div>

                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="sticky-top" style="top: 100px; z-index: 10;" data-aos="fade-left" data-aos-delay="100" data-aos-duration="1000">
                        <div class="support-sidebar-box">
                            <span class="support-icon"><i class="fas fa-user-shield"></i></span>
                            <h4 class="support-title">Contact Us</h4>
                            <p class="support-desc">If you have any questions, concerns, or requests regarding your privacy or data security, feel free to reach out to us.</p>
                            
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
                                        <span class="contact-info-label">Helpline</span>
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