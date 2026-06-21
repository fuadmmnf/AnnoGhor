@extends('layouts.app')

@section('title', 'Terms of Use - AnnoGhor')

@section('content')

    <!--====== Start Page Banner/Hero Section ======-->
    <section class="page-banner-section pt-120 pb-60 bg_cover" style="background: #fdfaf7; border-bottom: 1px solid #f3ece6;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="page-banner-content" data-aos="fade-up" data-aos-duration="1000">
                        <div class="sub-heading d-inline-flex align-items-center mb-15">
                            <i class="flaticon-sparkler"></i>
                            <span class="sub-title" style="color:#5a3e2b; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">User Agreement</span>
                        </div>
                        <h1 style="color: #222; font-size: 42px; font-weight: 700; margin-bottom: 15px;">Terms of Use</h1>
                        <p style="font-size: 16px; color: #666; max-width: 650px; margin: 0 auto;">Welcome to AnnoGhor (annoghor.com). These Terms of Use govern your access to and use of our website, mobile services, and platform.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== End Page Banner/Hero Section ======-->

    <!--====== Start Terms Details Section ======-->
    <section class="terms-details-section pt-80 pb-120">
        <div class="container">
            <div class="row">
                <!-- Left Side: Terms Contents -->
                <div class="col-xl-8 col-lg-7">
                    <div class="terms-wrapper" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1200">
                        
                        <!-- 1. Use of the Website -->
                        <div class="terms-card mb-40 p-4" style="background: #ffffff; border: 1px solid #eaeaea; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.02);">
                            <div class="card-title-box d-flex align-items-center mb-20">
                                <span class="num-badge d-flex align-items-center justify-content-center" style="background: #5a3e2b; color: #fff; width: 35px; height: 35px; border-radius: 50%; font-weight: 600; margin-right: 15px;">1</span>
                                <h3 style="font-size: 22px; color: #222; font-weight: 600; margin: 0;">Use of the Website</h3>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="p-3" style="background: #fdfdfd; border: 1px solid #f0f0f0; border-radius: 6px; height: 100%;">
                                        <h6 style="color: #5a3e2b; font-weight: 600;"><i class="fas fa-user-check mr-2"></i> Eligibility</h6>
                                        <p style="margin:0; font-size: 13px; color: #666; line-height: 1.5;">Must be at least the age of majority in your district of residence.</p>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="p-3" style="background: #fdfdfd; border: 1px solid #f0f0f0; border-radius: 6px; height: 100%;">
                                        <h6 style="color: #5a3e2b; font-weight: 600;"><i class="fas fa-ban mr-2"></i> Prohibited</h6>
                                        <p style="margin:0; font-size: 13px; color: #666; line-height: 1.5;">No unlawful conduct, IP infringement, or transmitting malicious code.</p>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="p-3" style="background: #fdfdfd; border: 1px solid #f0f0f0; border-radius: 6px; height: 100%;">
                                        <h6 style="color: #5a3e2b; font-weight: 600;"><i class="fas fa-lock mr-2"></i> Security</h6>
                                        <p style="margin:0; font-size: 13px; color: #666; line-height: 1.5;">Entirely responsible for maintaining account credential confidentiality.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 2. Intellectual Property Rights -->
                        <div class="terms-card mb-40 p-4" style="background: #ffffff; border: 1px solid #eaeaea; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.02);">
                            <div class="card-title-box d-flex align-items-center mb-20">
                                <span class="num-badge d-flex align-items-center justify-content-center" style="background: #5a3e2b; color: #fff; width: 35px; height: 35px; border-radius: 50%; font-weight: 600; margin-right: 15px;">2</span>
                                <h3 style="font-size: 22px; color: #222; font-weight: 600; margin: 0;">Intellectual Property Rights</h3>
                            </div>
                            <p style="color: #555; line-height: 1.7; margin-bottom: 15px;">All content included on this website—such as text, graphics, logos, images, digital downloads, and software—is the property of AnnoGhor and is protected by local and international copyright laws.</p>
                            <div class="alert-box p-3" style="background: #fff8f4; border-left: 4px solid #5a3e2b; border-radius: 4px;">
                                <p style="color: #666; font-size: 14px; margin: 0; line-height: 1.6;"><i class="fas fa-exclamation-triangle mr-2" style="color: #5a3e2b;"></i> You may not replicate, duplicate, sell, resell, or exploit any portion of our service or website content without express written permission from us.</p>
                            </div>
                        </div>

                        <!-- 3. Accuracy of Information -->
                        <div class="terms-card mb-40 p-4" style="background: #ffffff; border: 1px solid #eaeaea; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.02);">
                            <div class="card-title-box d-flex align-items-center mb-20">
                                <span class="num-badge d-flex align-items-center justify-content-center" style="background: #5a3e2b; color: #fff; width: 35px; height: 35px; border-radius: 50%; font-weight: 600; margin-right: 15px;">3</span>
                                <h3 style="font-size: 22px; color: #222; font-weight: 600; margin: 0;">Accuracy of Information</h3>
                            </div>
                            <p style="color: #555; line-height: 1.7; margin-bottom: 0;">While we strive to ensure all information on our website is accurate, complete, and current, we are not responsible if information made available on this site is inaccurate or outdated. Material on this site is provided for general information only and should not be relied upon as the sole basis for making decisions.</p>
                        </div>

                        <!-- 4. Modifications to the Service and Prices -->
                        <div class="terms-card mb-40 p-4" style="background: #ffffff; border: 1px solid #eaeaea; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.02);">
                            <div class="card-title-box d-flex align-items-center mb-20">
                                <span class="num-badge d-flex align-items-center justify-content-center" style="background: #5a3e2b; color: #fff; width: 35px; height: 35px; border-radius: 50%; font-weight: 600; margin-right: 15px;">4</span>
                                <h3 style="font-size: 22px; color: #222; font-weight: 600; margin: 0;">Modifications to the Service and Prices</h3>
                            </div>
                            <p style="color: #555; line-height: 1.7; margin-bottom: 0;">Prices for our premium products (such as our Sukkari Gold Khajoor) are subject to change without notice. We reserve the right at any time to modify or discontinue any part of our service, product listings, or website content without notice.</p>
                        </div>

                        <!-- 5. Limitation of Liability -->
                        <div class="terms-card mb-40 p-4" style="background: #ffffff; border: 1px solid #eaeaea; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.02);">
                            <div class="card-title-box d-flex align-items-center mb-20">
                                <span class="num-badge d-flex align-items-center justify-content-center" style="background: #5a3e2b; color: #fff; width: 35px; height: 35px; border-radius: 50%; font-weight: 600; margin-right: 15px;">5</span>
                                <h3 style="font-size: 22px; color: #222; font-weight: 600; margin: 0;">Limitation of Liability</h3>
                            </div>
                            <p style="color: #555; line-height: 1.7; margin-bottom: 0;">AnnoGhor, our directors, officers, employees, or partners shall not be liable for any injury, loss, claim, or any direct, indirect, incidental, or consequential damages of any kind arising from your use of our service. Your use of the website and consumption of products is at your sole risk.</p>
                        </div>

                        <!-- 6. Governing Law & 7. Changes -->
                        <div class="row">
                            <div class="col-md-6 mb-40">
                                <div class="terms-card p-4" style="background: #ffffff; border: 1px solid #eaeaea; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.02); height: 100%;">
                                    <h4 style="font-size: 18px; color: #222; font-weight: 600;" class="mb-15"><i class="fas fa-gavel mr-2" style="color: #5a3e2b;"></i> Governing Law</h4>
                                    <p style="color: #555; font-size: 14px; line-height: 1.6; margin: 0;">These Terms of Use and any separate agreements whereby we provide you services shall be governed by and construed in accordance with the laws of Bangladesh.</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-40">
                                <div class="terms-card p-4" style="background: #ffffff; border: 1px solid #eaeaea; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.02); height: 100%;">
                                    <h4 style="font-size: 18px; color: #222; font-weight: 600;" class="mb-15"><i class="fas fa-edit mr-2" style="color: #5a3e2b;"></i> Changes to Terms</h4>
                                    <p style="color: #555; font-size: 14px; line-height: 1.6; margin: 0;">We reserve the right to update or change any part of these Terms of Use by posting updates. Your continued use constitutes acceptance of those changes.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Right Side: Sticky Support Sidebar -->
                <div class="col-xl-4 col-lg-5">
                    <div class="sidebar-widget-area sticky-top" style="top: 30px;" data-aos="fade-left" data-aos-delay="100" data-aos-duration="1200">
                        <div class="support-sidebar-box p-4 text-center" style="background: #5a3e2b; border-radius: 8px; color: #fff;">
                            <div class="icon mb-20" style="font-size: 40px; color: #fff;">
                                <i class="fas fa-info-circle"></i>
                            </div>
                            <h4 style="color: #fff; font-size: 22px; font-weight: 600; margin-bottom: 10px;">Contact Information</h4>
                            <p style="color: #f3ece6; font-size: 14px; margin-bottom: 25px;">Questions about the Terms of Use should be sent directly to our customer support team.</p>
                            
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
                                        <a href="mailto:info@mydomain.com" style="font-size: 15px; font-weight: 600; color: #222;">info@mydomain.com</a>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center">
                                    <i class="far fa-clock text-warning mr-3" style="font-size: 24px;"></i>
                                    <div>
                                        <span class="d-block text-muted" style="font-size: 12px; font-weight: 600; text-transform: uppercase;">Support</span>
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
    <!--====== End Terms Details Section ======-->

@endsection