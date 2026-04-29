@extends('layouts.app')

@section('title', 'About - AnnoGhor')

@section('content')

    <!--====== Start About Us Section ======-->
    <section class="about-us-section pt-120">
        <div class="container">
            <div class="row">
                <div class="col-xl-6">
                    <!--====== Section Image Box ======-->
                    <div class="section-image-box style-one mb-50" data-aos="fade-up" data-aos-delay="30"
                        data-aos-duration="1000">
                        <div class="image-one">
                            <img src="assets/images/about/about-1.jpg" alt="About Image">
                            <div class="img-shape"></div>
                        </div>
                        <div class="image-two">
                            <img src="assets/images/about/about-2.jpg" alt="About Image">
                            <span class="line"></span>
                        </div>
                        <div class="experience-box">
                            <div class="icon">
                                <img src="assets/images/about/star.svg" alt="Icon">
                            </div>
                            <div class="text">
                                <div class="year">
                                    25
                                </div>
                                <div class="duration">
                                    Year’s <br> Experience
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <!--====== Section Content Box ======-->
                    <div class="section-content-box style-one" data-aos="fade-up" data-aos-delay="50"
                        data-aos-duration="1200">
                        <div class="section-title mb-30">
                            <div class="sub-heading d-inline-flex align-items-center">
                                <i class="flaticon-sparkler"></i>
                                <span class="sub-title" style="color:#5a3e2b;">About us</span>
                            </div>
                            <h2>Online shopping is buying things from stores on the internet.</h2>
                        </div>
                        <p>There are many variations of passages of Lorem Ipsum available, but the our majority have
                            suffered alteration in some form, by injected humour, or randomised words which don't look even
                            slightly believable you are going to.</p>
                        <div class="row">
                            <div class="col-sm-6">
                                <ul class="list mb-25">
                                    <li><i class="flaticon-star-3"></i> We are provide 100% best products</li>
                                    <li><i class="flaticon-star-3"></i>Flexible and affordable price</li>
                                    <li><i class="flaticon-star-3"></i>All products is imported</li>
                                </ul>
                            </div>
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="thumbnail-img mb-25">
                                            <img src="assets/images/about/about-3.png" alt="thumbnail img">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="thumbnail-img mb-25">
                                            <img src="assets/images/about/about-4.png" alt="thumbnail img">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="content-wrap-box d-flex mt-25">
                            <div class="author-item">
                                <div class="author-thumb">
                                    <img src="assets/images/testimonial/author-3.png" alt="author image">
                                </div>
                                <div class="author-info">
                                    <h5>Thomas Alison</h5>
                                    <span class="position">CEO at PESCO</span>
                                </div>
                            </div>
                            <div class="divider">
                                <img src="assets/images/about/divider.png" alt="divider">
                            </div>
                            <div class="signature">
                                <img src="assets/images/about/signature.png" alt="divider">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--====== End About Us Section ======-->
    <!--====== Start Features Section ======-->
    <section class="features-section pt-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!--=== Features Wrapper ===-->
                    <div class="features-wrapper" data-aos="fade-up" data-aos-delay="70" data-aos-duration="1400">
                        <!--=== Iconic Box Item ===-->
                        <div class="iconic-box-item icon-left-box mb-25">
                            <div class="icon">
                                <i class="fas fa-shipping-fast"></i>
                            </div>
                            <div class="content">
                                <h5>Free Shipping</h5>
                                <p>You get your items delivered without any extra cost.</p>
                            </div>
                        </div>
                        <!--=== Divider ===-->
                        <div class="divider mb-25">
                            <img src="assets/images/divider.png" alt="divider">
                        </div>
                        <!--=== Iconic Box Item ===-->
                        <div class="iconic-box-item icon-left-box mb-25">
                            <div class="icon">
                                <i class="fas fa-microphone"></i>
                            </div>
                            <div class="content">
                                <h5>Great Support 24/7</h5>
                                <p>Our customer support team is available around the clock </p>
                            </div>
                        </div>
                        <!--=== Divider ===-->
                        <div class="divider mb-25">
                            <img src="assets/images/divider.png" alt="divider">
                        </div>
                        <!--=== Iconic Box Item ===-->
                        <div class="iconic-box-item icon-left-box mb-25">
                            <div class="icon">
                                <i class="far fa-handshake"></i>
                            </div>
                            <div class="content">
                                <h5>Return Available</h5>
                                <p>Making it easy to return any items if you're not satisfied.</p>
                            </div>
                        </div>
                        <!--=== Divider ===-->
                        <div class="divider mb-25">
                            <img src="assets/images/divider.png" alt="divider">
                        </div>
                        <!--=== Iconic Box Item ===-->
                        <div class="iconic-box-item icon-left-box mb-25">
                            <div class="icon">
                                <i class="fas fa-sack-dollar"></i>
                            </div>
                            <div class="content">
                                <h5>Secure Payment</h5>
                                <p>Shop with confidence knowing that our secure payment</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--====== End Features Section ======-->

    <!--====== Start Testimonial Sections  ======-->
<section class="testimonial-section">
    <div class="testimonial-wrapper overflow-x-hidden pt-190 mt-30 pb-90 white-bg">
        {{-- <div class="shape svg-shape1"><img src="assets/images/testimonial/tl-svgTop.svg" alt="svg shape"></div>
        <div class="shape svg-shape2"><img src="assets/images/testimonial/tl-svgBottom.svg" alt="svg shape"></div> --}}
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="section-content-box mb-40" data-aos="fade-right" data-aos-delay="30" data-aos-duration="800">
                        <div class="section-title mb-50">
                            <h2>What Our Clients Say About Us</h2>
                        </div>
                        <div class="testimonial-arrows style-one"></div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="testimonial-slider-one" data-aos="fade-left" data-aos-delay="50" data-aos-duration="1000">
                        @forelse($reviews as $review)
                        <div class="testimonial-item style-one mb-40">
                            <div class="testimonial-content">
                                <p>{{ $review->review_text }}</p>
                                <div class="author-quote-item d-flex justify-content-between align-items-center">
                                    <div class="author-item">
                                        <div class="author-thumb">
                                            @if($review->reviewer_image)
                                                <img src="{{ asset('assets/images/testimonial/' . $review->reviewer_image) }}" alt="{{ $review->reviewer_name }}">
                                            @else
                                                <img src="{{ asset('assets/images/testimonial/default-avatar.png') }}" alt="{{ $review->reviewer_name }}">
                                            @endif
                                        </div>
                                        <div class="author-info">
                                            <h5>{{ $review->reviewer_name }}</h5>
                                            <ul class="ratings rating{{ $review->rating }}">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= $review->rating)
                                                        <li><i class="fas fa-star"></i></li>
                                                    @else
                                                        <li><i class="far fa-star"></i></li>
                                                    @endif
                                                @endfor
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="quote-icon">
                                        <i class="flaticon flaticon-right-quote"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="testimonial-item style-one mb-40">
                            <div class="testimonial-content">
                                <p>No reviews available yet.</p>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <!--====== Start Newsletter Sections  ======-->
    <section class="newsletter-section pb-95">
        <div class="container">
            <!--=== Newsletter Wrapper  ===-->
            <div class="newsletter-wrapper white-bg p-r z-1 mt-30" data-aos="fade-up" data-aos-duration="1000">
                <div class="newsletter-shape pattern-one"><span><img src="assets/images/newsletter/pattern-1.png"
                            alt="Pattern Shape"></span></div>
                <div class="newsletter-shape pattern-two"><span><img src="assets/images/newsletter/pattern-2.png"
                            alt="Pattern Shape"></span></div>
                <div class="newsletter-shape shape-one"><span><img src="assets/images/newsletter/shape-1.png"
                            alt="Shape"></span></div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="newsletter-content-box">
                            <span class="sub-text">Our Newsletter</span>
                            <h3>Get weekly update. Sign up and get up to <span>20% off</span> your first purchase</h3>
                            <form>
                                <div class="form-group">
                                    <input type="email" class="form_control" placeholder="Write your Email Address"
                                        name="email">
                                    <button class="theme-btn style-one">Subscribe</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="newsletter-image">
                            <img src="assets/images/newsletter/newsletter-1.png" alt="Image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--====== End Newsletter Sections  ======-->
@endsection
