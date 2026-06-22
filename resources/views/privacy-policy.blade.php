@extends('layouts.app')

@section('title', 'Privacy Policy - AnnoGhor')

@section('content')

    <!--====== Start Page Banner/Hero Section ======-->
    <section class="page-banner-section pt-120 pb-60 bg_cover" style="background: #fdfaf7; border-bottom: 1px solid #f3ece6;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="page-banner-content" data-aos="fade-up" data-aos-duration="1000">
                        <div class="sub-heading d-inline-flex align-items-center mb-15">
                            <i class="flaticon-sparkler"></i>
                            <span class="sub-title" style="color:#5a3e2b; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">Data Protection</span>
                        </div>
                        <h1 style="color: #222; font-size: 42px; font-weight: 700; margin-bottom: 15px;">Privacy Policy</h1>
                        <p style="font-size: 16px; color: #666; max-width: 650px; margin: 0 auto;">At AnnoGhor (annoghor.com), we highly value your privacy and are committed to protecting your personal information. Please review how we safeguard your data.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== End Page Banner/Hero Section ======-->

    <!--====== Start Privacy Details Section ======-->
    <section class="privacy-details-section pt-80 pb-120">
        <div class="container">
            <div class="row">
                <!-- Left Side: Privacy Contents -->
                <div class="col-xl-8 col-lg-7">
                    <div class="privacy-wrapper" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1200">
                        
                        <!-- 1. Information We Collect -->
                        <div class="privacy-card mb-40 p-4" style="background: #ffffff; border: 1px solid #eaeaea; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.02);">
                            <div class="card-title-box d-flex align-items-center mb-20">
                                <span class="num-badge d-flex align-items-center justify-content-center" style="background: #5a3e2b; color: #fff; width: 35px; height: 35px; border-radius: 50%; font-weight: 600; margin-right: 15px;">1</span>
                                <h3 style="font-size: 22px; color: #222; font-weight: 600; margin: 0;">Information We Collect</h3>
                            </div>
                            <p style="color: #555; line-height: 1.7; margin-bottom: 15px;">To provide you with our premium products and services, we may collect the following information when you place an order or interact with our site:</p>
                            
                            <ul class="list-unstyled pl-2" style="color: #555; line-height: 1.8;">
                                <li class="mb-2"><strong style="color: #222;"><i class="fas fa-user-check text-success mr-2"></i> Contact Information:</strong> Your name, shipping/billing address, phone number, and email address.</li>
                                <li class="mb-2"><strong style="color: #222;"><i class="fas fa-shopping-basket text-success mr-2"></i> Order Details:</strong> Information about the specific items you purchase and your delivery preferences.</li>
                                <li><strong style="color: #222;"><i class="fas fa-laptop-code text-success mr-2"></i> Technical Data:</strong> IP address, browser type, and device information gathered automatically through cookies.</li>
                            </ul>
                        </div>

                        <!-- 2. How We Use Your Information -->
                        <div class="privacy-card mb-40 p-4" style="background: #ffffff; border: 1px solid #eaeaea; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.02);">
                            <div class="card-title-box d-flex align-items-center mb-20">
                                <span class="num-badge d-flex align-items-center justify-content-center" style="background: #5a3e2b; color: #fff; width: 35px; height: 35px; border-radius: 50%; font-weight: 600; margin-right: 15px;">2</span>
                                <h3 style="font-size: 22px; color: #222; font-weight: 600; margin: 0;">How We Use Your Information</h3>
                            </div>
                            <p style="color: #555; line-height: 1.7; margin-bottom: 15px;">We use the collected information solely to enhance your shopping experience and manage our business operations, specifically to:</p>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="p-3" style="background: #fdfdfd; border: 1px solid #f0f0f0; border-radius: 6px; height: 100%;">
                                        <p style="margin:0; font-size: 14px; color: #555;"><i class="fas fa-box text-muted mr-2"></i> Process, pack, and ship your orders smoothly.</p>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="p-3" style="background: #fdfdfd; border: 1px solid #f0f0f0; border-radius: 6px; height: 100%;">
                                        <p style="margin:0; font-size: 14px; color: #555;"><i class="fas fa-comment-alt text-muted mr-2"></i> Contact you for confirmations or support queries.</p>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="p-3" style="background: #fdfdfd; border: 1px solid #f0f0f0; border-radius: 6px; height: 100%;">
                                        <p style="margin:0; font-size: 14px; color: #555;"><i class="fas fa-truck text-muted mr-2"></i> Deliver packages accurately via our courier partners.</p>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="p-3" style="background: #fdfdfd; border: 1px solid #f0f0f0; border-radius: 6px; height: 100%;">
                                        <p style="margin:0; font-size: 14px; color: #555;"><i class="fas fa-shield-alt text-muted mr-2"></i> Prevent fraudulent transactions and ensure security.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 3. Information Sharing & Third Parties -->
                        <div class="privacy-card mb-40 p-4" style="background: #ffffff; border: 1px solid #eaeaea; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.02);">
                            <div class="card-title-box d-flex align-items-center mb-20">
                                <span class="num-badge d-flex align-items-center justify-content-center" style="background: #5a3e2b; color: #fff; width: 35px; height: 35px; border-radius: 50%; font-weight: 600; margin-right: 15px;">3</span>
                                <h3 style="font-size: 22px; color: #222; font-weight: 600; margin: 0;">Information Sharing & Third Parties</h3>
                            </div>
                            <p style="color: #555; line-height: 1.7; margin-bottom: 15px;">We respect your privacy. <strong>We do not sell, rent, or trade your personal information</strong> to third parties. We only share data with trusted partners necessary to fulfill your order:</p>
                            <div class="alert-box p-3 mb-10" style="background: #fff8f4; border-left: 4px solid #5a3e2b; border-radius: 4px;">
                                <p style="color: #666; font-size: 14px; margin: 0;"><strong style="color: #5a3e2b;">Courier Services:</strong> Sharing your name, address, and phone number so they can deliver your products to your doorstep.</p>
                            </div>
                            <div class="alert-box p-3" style="background: #fff8f4; border-left: 4px solid #5a3e2b; border-radius: 4px;">
                                <p style="color: #666; font-size: 14px; margin: 0;"><strong style="color: #5a3e2b;">Legal Requirements:</strong> Shared only if required strictly by law or to protect our rights, safety, and property.</p>
                            </div>
                        </div>

                        <!-- 4. Data Security -->
                        <div class="privacy-card mb-40 p-4" style="background: #ffffff; border: 1px solid #eaeaea; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.02);">
                            <div class="card-title-box d-flex align-items-center mb-20">
                                <span class="num-badge d-flex align-items-center justify-content-center" style="background: #5a3e2b; color: #fff; width: 35px; height: 35px; border-radius: 50%; font-weight: 600; margin-right: 15px;">4</span>
                                <h3 style="font-size: 22px; color: #222; font-weight: 600; margin: 0;">Data Security</h3>
                            </div>
                            <p style="color: #555; line-height: 1.7; margin-bottom: 0;">We implement strict security measures to maintain the safety of your personal data. Your information is stored behind secured networks and is only accessible by a limited number of authorized personnel who are required to keep the information confidential.</p>
                        </div>

                        <!-- 5. Cookies -->
                        <div class="privacy-card mb-40 p-4" style="background: #ffffff; border: 1px solid #eaeaea; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.02);">
                            <div class="card-title-box d-flex align-items-center mb-20">
                                <span class="num-badge d-flex align-items-center justify-content-center" style="background: #5a3e2b; color: #fff; width: 35px; height: 35px; border-radius: 50%; font-weight: 600; margin-right: 15px;">5</span>
                                <h3 style="font-size: 22px; color: #222; font-weight: 600; margin: 0;">Cookies</h3>
                            </div>
                            <p style="color: #555; line-height: 1.7; margin-bottom: 0;">Our website uses cookies to understand and save your preferences for future visits, keep track of items in your shopping cart, and compile aggregate data about site traffic so we can offer a better user experience in the future. You can choose to turn off cookies through your browser settings if you prefer.</p>
                        </div>

                        <!-- 6. Changes to This Policy -->
                        <div class="privacy-card mb-20 p-4" style="background: #ffffff; border: 1px solid #eaeaea; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.02);">
                            <div class="card-title-box d-flex align-items-center mb-20">
                                <span class="num-badge d-flex align-items-center justify-content-center" style="background: #5a3e2b; color: #fff; width: 35px; height: 35px; border-radius: 50%; font-weight: 600; margin-right: 15px;">6</span>
                                <h3 style="font-size: 22px; color: #222; font-weight: 600; margin: 0;">Changes to This Policy</h3>
                            </div>
                            <p style="color: #555; line-height: 1.7; margin-bottom: 0;">AnnoGhor reserves the right to modify this Privacy Policy at any time. Any changes or updates will take effect immediately upon being posted on this page. We encourage you to review this page periodically.</p>
                        </div>

                    </div>
                </div>

                <!-- Right Side: Sticky Support Sidebar -->
                <div class="col-xl-4 col-lg-5">
                    <div class="sidebar-widget-area sticky-top" style="top: 30px;" data-aos="fade-left" data-aos-delay="100" data-aos-duration="1200">
                        <div class="support-sidebar-box p-4 text-center" style="background: #5a3e2b; border-radius: 8px; color: #fff;">
                            <div class="icon mb-20" style="font-size: 40px; color: #fff;">
                                <i class="fas fa-user-shield"></i>
                            </div>
                            <h4 style="color: #fff; font-size: 22px; font-weight: 600; margin-bottom: 10px;">Contact Us</h4>
                            <p style="color: #f3ece6; font-size: 14px; margin-bottom: 25px;">If you have any questions, concerns, or requests regarding your privacy or data security, feel free to reach out to us.</p>
                            
                            <div class="contact-methods text-left bg-white p-3 rounded" style="color: #222;">
                                <div class="d-flex align-items-center mb-15">
                                    <i class="fab fa-whatsapp text-success mr-3" style="font-size: 24px;"></i>
                                    <div>
                                        <span class="d-block text-muted" style="font-size: 12px; font-weight: 600; text-transform: uppercase;">Phone / WhatsApp / Imo</span>
                                        <a href="tel:01700900059" style="font-size: 18px; font-weight: 700; color: #222;">01700-900059</a>
                                    </div>
                                </div>
                                
                                <div class="d-flex align-items-center mb-15">
                                    <i class="far fa-envelope text-primary mr-3" style="font-size: 24px;"></i>
                                    <div>
                                        <span class="d-block text-muted" style="font-size: 12px; font-weight: 600; text-transform: uppercase;">Email Address</span>
                                        <a href="mailto:annoghor@gmail.com" style="font-size: 15px; font-weight: 600; color: #222;">annoghor@gmail.com</a>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center">
                                    <i class="far fa-clock text-warning mr-3" style="font-size: 24px;"></i>
                                    <div>
                                        <span class="d-block text-muted" style="font-size: 12px; font-weight: 600; text-transform: uppercase;">Helpline</span>
                                        <span style="font-size: 15px; font-weight: 600;">24/7 Premium Support</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== End Privacy Details Section ======-->

@endsection