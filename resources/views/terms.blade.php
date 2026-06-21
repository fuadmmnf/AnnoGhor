@extends('layouts.app')

@section('title', 'Terms & Conditions - AnnoGhor')

@section('content')

    <!--====== Start Page Banner/Hero Section ======-->
    <section class="page-banner-section pt-120 pb-60 bg_cover" style="background: #fdfaf7; border-bottom: 1px solid #f3ece6;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="page-banner-content" data-aos="fade-up" data-aos-duration="1000">
                        <div class="sub-heading d-inline-flex align-items-center mb-15">
                            <i class="flaticon-sparkler"></i>
                            <span class="sub-title" style="color:#5a3e2b; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">Legal & Rules</span>
                        </div>
                        <h1 style="color: #222; font-size: 42px; font-weight: 700; margin-bottom: 15px;">Terms & Conditions</h1>
                        <p style="font-size: 16px; color: #666; max-width: 650px; margin: 0 auto;">Welcome to AnnoGhor (annoghor.com). By accessing and using our website, you agree to comply with and be bound by the following terms and conditions. Please read them carefully.</p>
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
                        
                        <!-- 1. General Conditions -->
                        <div class="terms-card mb-40 p-4" style="background: #ffffff; border: 1px solid #eaeaea; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.02);">
                            <div class="card-title-box d-flex align-items-center mb-20">
                                <span class="num-badge d-flex align-items-center justify-content-center" style="background: #5a3e2b; color: #fff; width: 35px; height: 35px; border-radius: 50%; font-weight: 600; margin-right: 15px;">1</span>
                                <h3 style="font-size: 22px; color: #222; font-weight: 600; margin: 0;">General Conditions</h3>
                            </div>
                            <ul class="list-unstyled pl-2" style="color: #555; line-height: 1.8;">
                                <li class="mb-2"><i class="fas fa-check text-success mr-2" style="font-size: 14px;"></i> We reserve the right to refuse service to anyone for any reason at any time.</li>
                                <li><i class="fas fa-check text-success mr-2" style="font-size: 14px;"></i> The content on this website, including product descriptions, images, and pricing, is subject to change without prior notice.</li>
                            </ul>
                        </div>

                        <!-- 2. Products & Pricing -->
                        <div class="terms-card mb-40 p-4" style="background: #ffffff; border: 1px solid #eaeaea; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.02);">
                            <div class="card-title-box d-flex align-items-center mb-20">
                                <span class="num-badge d-flex align-items-center justify-content-center" style="background: #5a3e2b; color: #fff; width: 35px; height: 35px; border-radius: 50%; font-weight: 600; margin-right: 15px;">2</span>
                                <h3 style="font-size: 22px; color: #222; font-weight: 600; margin: 0;">Products & Pricing</h3>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-15">
                                    <div class="inner-box p-3" style="background: #fdfdfd; border: 1px solid #f0f0f0; border-radius: 6px; height: 100%;">
                                        <h5 style="font-size: 16px; font-weight: 600; color: #5a3e2b;" class="mb-2"><i class="fas fa-leaf mr-2"></i> Quality Assurance</h5>
                                        <p style="font-size: 14px; margin: 0; color: #666; line-height: 1.6;">We specialize in 100% organic, premium, and fresh food products (such as our Sukkari Gold Khajoor). We ensure that all items are safely packaged and safe for consumption.</p>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-15">
                                    <div class="inner-box p-3" style="background: #fdfdfd; border: 1px solid #f0f0f0; border-radius: 6px; height: 100%;">
                                        <h5 style="font-size: 16px; font-weight: 600; color: #5a3e2b;" class="mb-2"><i class="fas fa-tags mr-2"></i> Pricing & Currency</h5>
                                        <p style="font-size: 14px; margin: 0; color: #666; line-height: 1.6;">All prices listed on the website are in Bangladeshi Taka (BDT). Prices and availability of products are subject to change without notice.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 3. Shipping & Delivery -->
                        <div class="terms-card mb-40 p-4" style="background: #ffffff; border: 1px solid #eaeaea; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.02);">
                            <div class="card-title-box d-flex align-items-center mb-20">
                                <span class="num-badge d-flex align-items-center justify-content-center" style="background: #5a3e2b; color: #fff; width: 35px; height: 35px; border-radius: 50%; font-weight: 600; margin-right: 15px;">3</span>
                                <h3 style="font-size: 22px; color: #222; font-weight: 600; margin: 0;">Shipping & Delivery</h3>
                            </div>
                            <p style="color: #555; line-height: 1.7; margin-bottom: 15px;">We provide home delivery services all over Bangladesh. Our standard delivery time is typically <strong>within 5 days</strong>.</p>
                            <div class="alert-box p-3" style="background: #fff8f4; border-left: 4px solid #de935f; border-radius: 4px;">
                                <p style="color: #666; font-size: 14px; margin: 0; line-height: 1.6;"><i class="fas fa-exclamation-triangle mr-2" style="color: #de935f;"></i> Any delays caused by natural disasters, political situations, or unexpected courier issues are beyond our direct control, though we will always work to resolve them quickly.</p>
                            </div>
                        </div>

                        <!-- 4. Payment Methods -->
                        <div class="terms-card mb-40 p-4" style="background: #ffffff; border: 1px solid #eaeaea; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.02);">
                            <div class="card-title-box d-flex align-items-center mb-20">
                                <span class="num-badge d-flex align-items-center justify-content-center" style="background: #5a3e2b; color: #fff; width: 35px; height: 35px; border-radius: 50%; font-weight: 600; margin-right: 15px;">4</span>
                                <h3 style="font-size: 22px; color: #222; font-weight: 600; margin: 0;">Payment Methods</h3>
                            </div>
                            <p style="color: #555; line-height: 1.7; margin-bottom: 0;">We offer a secure <strong>Cash on Delivery (COD)</strong> payment method to guarantee a risk-free shopping experience for our customers. Full payment must be handed over to the delivery representative upon receiving the package.</p>
                        </div>

                        <!-- 5. Order Cancellations -->
                        <div class="terms-card mb-40 p-4" style="background: #ffffff; border: 1px solid #eaeaea; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.02);">
                            <div class="card-title-box d-flex align-items-center mb-20">
                                <span class="num-badge d-flex align-items-center justify-content-center" style="background: #5a3e2b; color: #fff; width: 35px; height: 35px; border-radius: 50%; font-weight: 600; margin-right: 15px;">5</span>
                                <h3 style="font-size: 22px; color: #222; font-weight: 600; margin: 0;">Order Cancellations & Modifications</h3>
                            </div>
                            <p style="color: #555; line-height: 1.7; margin-bottom: 0;">If you wish to change or cancel your order, please contact our support team immediately <strong>before the item is dispatched</strong>. Once an item has been handed over to the courier service, the order cannot be cancelled or modified.</p>
                        </div>

                        <!-- Update Note -->
                        <p style="font-size: 13px; color: #888; font-style: italic;" class="mt-30">Note: AnnoGhor reserves the right to update, change, or replace any part of these Terms & Conditions by posting updates to our website. It is your responsibility to check this page periodically for changes.</p>

                    </div>
                </div>

                <!-- Right Side: Sticky Support Sidebar -->
                <div class="col-xl-4 col-lg-5">
                    <div class="sidebar-widget-area sticky-top" style="top: 30px;" data-aos="fade-left" data-aos-delay="100" data-aos-duration="1200">
                        <div class="support-sidebar-box p-4 text-center" style="background: #5a3e2b; border-radius: 8px; color: #fff;">
                            <div class="icon mb-20" style="font-size: 40px; color: #fff;">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <h4 style="color: #fff; font-size: 22px; font-weight: 600; margin-bottom: 10px;">Customer Support</h4>
                            <p style="color: #f3ece6; font-size: 14px; margin-bottom: 25px;">For any queries, complaints, or assistance regarding our terms, feel free to reach out to us.</p>
                            
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
                                        <span class="d-block text-muted" style="font-size: 12px; font-weight: 600; text-transform: uppercase;">Support Availability</span>
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