@extends('layouts.app')

@section('title', 'Faq - AnnoGhor')

@section('content')

    <!--====== Start Faqs Section  ======-->
    <section class="faqs-section pt-50 pb-115">

        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="section-title mb-50" data-aos="fade-right" data-aos-delay="20" data-aos-duration="1000">
                        <div class="sub-heading d-inline-flex align-items-center">
                            <i class="flaticon-sparkler"></i>
                            <span class="sub-title" style="color:#5a3e2b;">FAQs</span>
                        </div>
                        <h2>How can we help you?</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    @if ($faqs->count() > 0)
                        <!--====== Accordion   ======-->
                        <div class="accordion" id="accordionOne">
                            @foreach ($faqs as $index => $faq)
                                <!--====== Accordion Item  ======-->
                                <div class="accordion-item style-one mb-25 faq-item"
                                    @if ($index > 0) data-aos="fade-up" 
                                 data-aos-delay="{{ 20 + $index * 5 }}" 
                                 data-aos-duration="{{ 800 + $index * 200 }}" @endif>
                                    <div class="accordion-header">
                                        <h4 class="accordion-title" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ $faq->id }}"
                                            aria-expanded="{{ $index === 0 ? 'true' : 'false' }}">
                                            {{ $faq->question }}
                                        </h4>
                                    </div>
                                    <div id="collapse{{ $faq->id }}"
                                        class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                        data-bs-parent="#accordionOne">
                                        <div class="accordion-content">
                                            <p>{{ $faq->answer }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="faq-empty-box">

                            <div class="faq-empty-icon-wrap">
                                <i class="fas fa-info-circle"></i>
                            </div>

                            <h4 class="faq-empty-title">
                                No FAQs Available
                            </h4>

                            <p class="faq-empty-sub">
                                We're currently updating our FAQ section. Please check back soon!
                            </p>

                        </div>
                    @endif

                    <!-- No results message (hidden by default) -->
                    <div id="no-results" class="faq-empty-box" style="display:none;">

                        <div class="faq-empty-icon-wrap">
                            <i class="fas fa-search"></i>
                        </div>

                        <h4 class="faq-empty-title">
                            No FAQs Found
                        </h4>

                        <p class="faq-empty-sub">
                            No FAQs found matching your search. Try different keywords.
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== End Faqs Section  ======-->
@endsection


<style>
    /* ===== FAQ EMPTY STATE ===== */
    :root {
        --gold: #E2B718;
        --gold-dark: #c9a215;
        --gold-light: #f5d44e;
        --danger: #e53e3e;
        --danger-dark: #c53030;
        --text-primary: #1a202c;
        --text-secondary: #718096;
        --border: #e2e8f0;
        --bg-light: #f7fafc;
        --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.08);
        --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.1);
        --radius: 12px;
        --radius-sm: 8px;
    }

    .faq-empty-box {
        padding: 60px 20px;
        background: var(--bg-light);
        border-radius: var(--radius);
        border: 1px dashed var(--border);
        text-align: center;
    }

    .faq-empty-icon-wrap {
        width: 100px;
        height: 100px;
        background: #ffffff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        box-shadow: var(--shadow-md);
    }

    .faq-empty-icon-wrap i {
        font-size: 2.5rem;
        color: var(--gold);
    }

    .faq-empty-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 8px;
    }

    .faq-empty-sub {
        color: var(--text-secondary);
        font-size: 0.95rem;
        margin-bottom: 20px;
    }
</style>
