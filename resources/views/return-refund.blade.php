@extends('layouts.app')

@section('title', 'Returns & Refunds Policy - AnnoGhor')

@section('content')

    <!--====== Start Page Banner/Hero Section ======-->
    <section class="page-banner-section pt-120 pb-60 bg_cover" style="background: #fdfaf7; border-bottom: 1px solid #f3ece6;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="page-banner-content" data-aos="fade-up" data-aos-duration="1000">
                        <div class="sub-heading d-inline-flex align-items-center mb-15">
                            <i class="flaticon-sparkler"></i>
                            <span class="sub-title" style="color:#5a3e2b; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">Customer Service</span>
                        </div>
                        <h1 style="color: #222; font-size: 42px; font-weight: 700; margin-bottom: 15px;">Returns & Refunds Policy</h1>
                        <p style="font-size: 16px; color: #666; max-width: 600px; margin: 0 auto;">At AnnoGhor, we are committed to delivering 100% premium, organic, and fresh products to your doorstep. Your satisfaction is our top priority.</p>
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
                        
                        <!-- Block 1 -->
                        <div class="policy-card mb-40 p-4" style="background: #ffffff; border: 1px solid #eaeaea; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.02);">
                            <div class="card-title-box d-flex align-items-center mb-20">
                                <span class="num-badge d-flex align-items-center justify-content-center" style="background: #5a3e2b; color: #fff; width: 35px; height: 35px; border-radius: 50%; font-weight: 600; margin-right: 15px;">1</span>
                                <h3 style="font-size: 22px; color: #222; font-weight: 600; margin: 0;">Delivery Return (Inspection at the Doorstep)</h3>
                            </div>
                            <p style="color: #555; line-height: 1.7; margin-bottom: 15px;">Since we provide a Cash on Delivery (COD) service across Bangladesh, we highly encourage you to inspect the product quality and packaging right in front of the delivery person.</p>
                            <div class="alert-box p-3" style="background: #fff8f4; border-left: 4px solid #5a3e2b; border-radius: 4px;">
                                <p style="color: #5a3e2b; font-weight: 500; margin: 0;"><i class="fas fa-info-circle mr-2"></i> If you find any issues (such as damaged packaging or a quality discrepancy), you can return the product instantly with the delivery rider without making a payment.</p>
                            </div>
                        </div>

                        <!-- Block 2 -->
                        <div class="policy-card mb-40 p-4" style="background: #ffffff; border: 1px solid #eaeaea; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.02);">
                            <div class="card-title-box d-flex align-items-center mb-20">
                                <span class="num-badge d-flex align-items-center justify-content-center" style="background: #5a3e2b; color: #fff; width: 35px; height: 35px; border-radius: 50%; font-weight: 600; margin-right: 15px;">2</span>
                                <h3 style="font-size: 22px; color: #222; font-weight: 600; margin: 0;">Eligibility for Returns & Refunds</h3>
                            </div>
                            <p style="color: #555; line-height: 1.7; margin-bottom: 20px;">If you discover an issue after the delivery rider has left, you may still request a return or refund under the following strict conditions:</p>
                            
                            <div class="row">
                                <div class="col-md-4 mb-20">
                                    <div class="cond-box text-center p-3" style="background: #fdfdfd; border: 1px dashed #ddd; border-radius: 6px;">
                                        <i class="far fa-clock mb-10" style="font-size: 24px; color: #5a3e2b;"></i>
                                        <h5 style="font-size: 16px; font-weight: 600; margin-bottom: 5px;">Timeframe</h5>
                                        <p style="font-size: 14px; margin: 0; color: #666;">Notify us within 24 to 48 hours.</p>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-20">
                                    <div class="cond-box text-center p-3" style="background: #fdfdfd; border: 1px dashed #ddd; border-radius: 6px;">
                                        <i class="fas fa-box-open mb-10" style="font-size: 24px; color: #5a3e2b;"></i>
                                        <h5 style="font-size: 16px; font-weight: 600; margin-bottom: 5px;">Condition</h5>
                                        <p style="font-size: 14px; margin: 0; color: #666;">Unused, unaltered & original packaging.</p>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-20">
                                    <div class="cond-box text-center p-3" style="background: #fdfdfd; border: 1px dashed #ddd; border-radius: 6px;">
                                        <i class="fas fa-exclamation-triangle mb-10" style="font-size: 24px; color: #5a3e2b;"></i>
                                        <h5 style="font-size: 16px; font-weight: 600; margin-bottom: 5px;">Valid Reasons</h5>
                                        <p style="font-size: 14px; margin: 0; color: #666;">Damaged, spoiled, or wrong product.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Block 3 -->
                        <div class="policy-card p-4" style="background: #ffffff; border: 1px solid #eaeaea; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.02);">
                            <div class="card-title-box d-flex align-items-center mb-20">
                                <span class="num-badge d-flex align-items-center justify-content-center" style="background: #5a3e2b; color: #fff; width: 35px; height: 35px; border-radius: 50%; font-weight: 600; margin-right: 15px;">3</span>
                                <h3 style="font-size: 22px; color: #222; font-weight: 600; margin: 0;">How to Request a Return or Refund</h3>
                            </div>
                            <p style="color: #555; line-height: 1.7; margin-bottom: 15px;">If you face any issues with your order, please reach out to us immediately. Please keep your <strong>order details or invoice</strong> handy when contacting us to help us process your request as quickly as possible.</p>
                        </div>

                    </div>
                </div>

                <!-- Right Side: Contact/Support Sidebar -->
                <div class="col-xl-4 col-lg-5">
                    <div class="sidebar-widget-area sticky-top" style="top: 30px;" data-aos="fade-left" data-aos-delay="100" data-aos-duration="1200">
                        <div class="support-sidebar-box p-4 text-center" style="background: #5a3e2b; border-radius: 8px; color: #fff;">
                            <div class="icon mb-20" style="font-size: 40px; color: #fff;">
                                <i class="fas fa-headset"></i>
                            </div>
                            <h4 style="color: #fff; font-size: 22px; font-weight: 600; margin-bottom: 10px;">Need Instant Support?</h4>
                            <p style="color: #f3ece6; font-size: 14px; margin-bottom: 25px;">Our team is available 24/7 to resolve your returns or refund queries.</p>
                            
                            <div class="contact-methods text-left bg-white p-3 rounded" style="color: #222;">
                                <div class="d-flex align-items-center mb-15">
                                    <i class="fab fa-whatsapp text-success mr-3" style="font-size: 24px;"></i>
                                    <div>
                                        <span class="d-block text-muted" style="font-size: 12px; font-weight: 600; text-transform: uppercase;">Call / WhatsApp / Imo</span>
                                        <a href="tel:01700900059" style="font-size: 18px; font-weight: 700; color: #222;">01700-900059</a>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="far fa-clock text-warning mr-3" style="font-size: 24px;"></i>
                                    <div>
                                        <span class="d-block text-muted" style="font-size: 12px; font-weight: 600; text-transform: uppercase;">Availability</span>
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
    <!--====== End Policy Details Section ======-->

@endsection