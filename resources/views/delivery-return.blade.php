@extends('layouts.app')

@section('title', 'Delivery & Return Policy - AnnoGhor')

@section('content')

    <!--====== Start Page Banner/Hero Section ======-->
    <section class="page-banner-section pt-120 pb-60 bg_cover" style="background: #fdfaf7; border-bottom: 1px solid #f3ece6;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="page-banner-content" data-aos="fade-up" data-aos-duration="1000">
                        <div class="sub-heading d-inline-flex align-items-center mb-15">
                            <i class="flaticon-sparkler"></i>
                            <span class="sub-title" style="color:#5a3e2b; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">Shipping & Returns</span>
                        </div>
                        <h1 style="color: #222; font-size: 42px; font-weight: 700; margin-bottom: 15px;">Delivery & Return Policy</h1>
                        <p style="font-size: 16px; color: #666; max-width: 650px; margin: 0 auto;">At AnnoGhor, we strive to provide a seamless shopping experience. From the moment you place your order to the time it arrives at your doorstep, we ensure maximum care and premium service.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== End Page Banner/Hero Section ======-->

    <!--====== Start Policy Details Section ======-->
    <section class="policy-details-section pt-80 pb-120">
        <div class="container">
            <div class="row">
                <!-- Left Side: Policy Contents -->
                <div class="col-xl-8 col-lg-7">
                    <div class="policy-wrapper" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1200">
                        
                        <!-- 1. Shipping & Delivery -->
                        <div class="policy-card mb-40 p-4" style="background: #ffffff; border: 1px solid #eaeaea; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.02);">
                            <div class="card-title-box d-flex align-items-center mb-25">
                                <span class="num-badge d-flex align-items-center justify-content-center" style="background: #5a3e2b; color: #fff; width: 35px; height: 35px; border-radius: 50%; font-weight: 600; margin-right: 15px;">1</span>
                                <h3 style="font-size: 22px; color: #222; font-weight: 600; margin: 0;">Shipping & Delivery</h3>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4 mb-15">
                                    <div class="shipping-info-box text-center p-3" style="background: #fdfdfd; border: 1px solid #f0f0f0; border-radius: 6px; h-100">
                                        <i class="fas fa-map-marked-alt mb-10" style="font-size: 24px; color: #5a3e2b;"></i>
                                        <h5 style="font-size: 15px; font-weight: 600; margin-bottom: 5px;">Coverage</h5>
                                        <p style="font-size: 13px; margin: 0; color: #666;">Home delivery all over Bangladesh.</p>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-15">
                                    <div class="shipping-info-box text-center p-3" style="background: #fdfdfd; border: 1px solid #f0f0f0; border-radius: 6px; h-100">
                                        <i class="far fa-calendar-alt mb-10" style="font-size: 24px; color: #5a3e2b;"></i>
                                        <h5 style="font-size: 15px; font-weight: 600; margin-bottom: 5px;">Delivery Time</h5>
                                        <p style="font-size: 13px; margin: 0; color: #666;">Processed & delivered within 5 days.</p>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-15">
                                    <div class="shipping-info-box text-center p-3" style="background: #fdfdfd; border: 1px solid #f0f0f0; border-radius: 6px; h-100">
                                        <i class="fas fa-hand-holding-usd mb-10" style="font-size: 24px; color: #5a3e2b;"></i>
                                        <h5 style="font-size: 15px; font-weight: 600; margin-bottom: 5px;">Payment</h5>
                                        <p style="font-size: 13px; margin: 0; color: #666;">Cash on Delivery (COD) available.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 2. Doorstep Return Policy -->
                        <div class="policy-card mb-40 p-4" style="background: #ffffff; border: 1px solid #eaeaea; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.02);">
                            <div class="card-title-box d-flex align-items-center mb-20">
                                <span class="num-badge d-flex align-items-center justify-content-center" style="background: #5a3e2b; color: #fff; width: 35px; height: 35px; border-radius: 50%; font-weight: 600; margin-right: 15px;">2</span>
                                <h3 style="font-size: 22px; color: #222; font-weight: 600; margin: 0;">Doorstep Return Policy (Check Before You Pay)</h3>
                            </div>
                            <p style="color: #555; line-height: 1.7; margin-bottom: 20px;">We believe in 100% transparency. To ensure you are completely satisfied with your purchase, we offer an instant doorstep checking policy:</p>
                            
                            <ul class="list-unstyled pl-2" style="color: #555; line-height: 1.8;">
                                <li class="mb-10"><strong style="color: #222;"><i class="fas fa-search text-success mr-2"></i> Inspect on Arrival:</strong> When the courier agent delivers your package, please open and inspect the product (quality, packaging, and quantity) right in front of them.</li>
                                <li class="mb-10"><strong style="color: #222;"><i class="fas fa-undo text-success mr-2"></i> Instant Return:</strong> If the product is damaged, spoiled, or does not match what you ordered, you can hand it right back to the delivery rider.</li>
                                <li><strong style="color: #222;"><i class="fas fa-shield-alt text-success mr-2"></i> Zero Risk:</strong> If you choose to return the item at the doorstep, you do not have to pay for the product.</li>
                            </ul>
                        </div>

                        <!-- 3. After-Delivery Support -->
                        <div class="policy-card mb-40 p-4" style="background: #ffffff; border: 1px solid #eaeaea; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.02);">
                            <div class="card-title-box d-flex align-items-center mb-20">
                                <span class="num-badge d-flex align-items-center justify-content-center" style="background: #5a3e2b; color: #fff; width: 35px; height: 35px; border-radius: 50%; font-weight: 600; margin-right: 15px;">3</span>
                                <h3 style="font-size: 22px; color: #222; font-weight: 600; margin: 0;">After-Delivery Support</h3>
                            </div>
                            <p style="color: #555; line-height: 1.7; margin-bottom: 15px;">If you notice an issue with your product after the delivery rider has already left, please contact us <strong>within 24 hours</strong>:</p>
                            
                            <div class="p-3 mb-15" style="background: #fdfdfd; border-left: 4px solid #5a3e2b; border-radius: 4px;">
                                <p style="margin: 0; font-size: 14px; color: #555;"><strong style="color:#222;">Condition:</strong> For a return or exchange post-delivery, the product must remain unused, untampered, and in its original packaging.</p>
                            </div>
                            <div class="p-3" style="background: #fdfdfd; border-left: 4px solid #5a3e2b; border-radius: 4px;">
                                <p style="margin: 0; font-size: 14px; color: #555;"><strong style="color:#222;">Process:</strong> Reach out to our support team with your order details, and we will arrange a replacement or refund depending on the issue.</p>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Right Side: Sticky Support Sidebar -->
                <div class="col-xl-4 col-lg-5">
                    <div class="sidebar-widget-area sticky-top" style="top: 30px;" data-aos="fade-left" data-aos-delay="100" data-aos-duration="1200">
                        <div class="support-sidebar-box p-4 text-center" style="background: #5a3e2b; border-radius: 8px; color: #fff;">
                            <div class="icon mb-20" style="font-size: 40px; color: #fff;">
                                <i class="fas fa-truck-loading"></i>
                            </div>
                            <h4 style="color: #fff; font-size: 22px; font-weight: 600; margin-bottom: 10px;">24/7 Support Helpline</h4>
                            <p style="color: #f3ece6; font-size: 14px; margin-bottom: 25px;">If you have any questions about your delivery or need to initiate a return, our team is always ready to help.</p>
                            
                            <div class="contact-methods text-left bg-white p-3 rounded" style="color: #222;">
                                <div class="d-flex align-items-center mb-15">
                                    <i class="fab fa-whatsapp text-success mr-3" style="font-size: 24px;"></i>
                                    <div>
                                        <span class="d-block text-muted" style="font-size: 12px; font-weight: 600; text-transform: uppercase;">Phone / WhatsApp / Imo</span>
                                        <a href="tel:01700900059" style="font-size: 18px; font-weight: 700; color: #222;">01700-900059</a>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="far fa-clock text-warning mr-3" style="font-size: 24px;"></i>
                                    <div>
                                        <span class="d-block text-muted" style="font-size: 12px; font-weight: 600; text-transform: uppercase;">Service Status</span>
                                        <span style="font-size: 14px; font-weight: 600;">Available 24 Hours / 7 Days</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== End Policy Details Section ======-->

@endsection