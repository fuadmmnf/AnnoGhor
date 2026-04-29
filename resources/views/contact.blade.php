@extends('layouts.app')

@section('title', 'Contact Us - AnnoGhor')

@section('content')

    <section class="contact-section" style="background-color: var(--main-bg, #fffaf3); padding: 100px 0 80px;">
        <div class="container">

            {{-- Flash toasts (hidden, shown via JS) --}}
            @if (session('success'))
                <span id="flash-success" data-msg="{{ session('success') }}" style="display:none;"></span>
            @endif
            @if (session('error'))
                <span id="flash-error" data-msg="{{ session('error') }}" style="display:none;"></span>
            @endif

            {{-- Section Header --}}
            <div class="contact-section-header text-center mb-60">
                <span class="contact-eyebrow">GET IN TOUCH</span>
                <h2 class="contact-main-title">We'd Love to <span class="contact-highlight">Hear From You</span></h2>
                <p class="contact-sub">Have a question about your order? Need help? We're here.</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-xl-11">
                    <div class="contact-card">

                        {{-- Left: Info Panel --}}
                        <div class="contact-info-panel">
                            <div class="info-panel-inner">
                                <div class="info-panel-top">
                                    <div class="info-brand-icon">
                                        <i class="fas fa-headset"></i>
                                    </div>
                                    <h3 class="info-title">Support &amp; Contact</h3>
                                    <p class="info-subtitle">Questions about your order? Let's make your shopping experience better.</p>
                                </div>

                                <div class="info-items">
                                    <div class="info-item">
                                        <div class="info-item-icon" style="background: rgba(247,148,31,0.15);">
                                            <i class="fas fa-phone" style="color: var(--secondary-color, #f7941f);"></i>
                                        </div>
                                        <div class="info-item-content">
                                            <span class="info-item-label">Call Anytime</span>
                                            <a href="tel:{{ $setting->site_phone ?? '+8801737988070' }}" class="info-item-value">
                                                {{ $setting->site_phone ?? '+88 01737-988070' }}
                                            </a>
                                        </div>
                                    </div>

                                    <div class="info-item">
                                        <div class="info-item-icon" style="background: rgba(204,13,57,0.12);">
                                            <i class="fas fa-envelope" style="color: var(--primary-color, #cc0d39);"></i>
                                        </div>
                                        <div class="info-item-content">
                                            <span class="info-item-label">Write Email</span>
                                            <a href="mailto:{{ $setting->site_email ?? 'innovatech@gmail.com' }}" class="info-item-value">
                                                {{ $setting->site_email ?? 'innovatech@gmail.com' }}
                                            </a>
                                        </div>
                                    </div>

                                    <div class="info-item">
                                        <div class="info-item-icon" style="background: rgba(254,235,157,0.4);">
                                            <i class="fas fa-map-marker-alt" style="color: #b8860b;"></i>
                                        </div>
                                        <div class="info-item-content">
                                            <span class="info-item-label">Visit Office</span>
                                            <span class="info-item-value">{{ $setting->site_address ?? '62/1, Tejturi Bazar, Dhaka' }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="info-panel-deco"></div>
                            </div>
                        </div>

                        {{-- Right: Form Panel --}}
                        <div class="contact-form-panel">
                            <div class="form-panel-inner">
                                <h2 class="form-title">Send Us a Message</h2>
                                <p class="form-subtitle">Fill in the form and we'll get back to you as soon as possible.</p>

                                <form id="contactForm" class="contact-form" novalidate>
                                    @csrf
                                    <div class="form-row-group">
                                        <div class="cf-group">
                                            <label class="cf-label">Full Name</label>
                                            <div class="cf-input-wrap">
                                                <i class="fas fa-user cf-input-icon"></i>
                                                <input type="text" name="name" class="cf-input" placeholder="Your full name" required>
                                            </div>
                                            <span class="cf-error error-name"></span>
                                        </div>
                                        <div class="cf-group">
                                            <label class="cf-label">Email Address</label>
                                            <div class="cf-input-wrap">
                                                <i class="fas fa-envelope cf-input-icon"></i>
                                                <input type="email" name="email" class="cf-input" placeholder="example@mail.com" required>
                                            </div>
                                            <span class="cf-error error-email"></span>
                                        </div>
                                    </div>

                                    <div class="cf-group">
                                        <label class="cf-label">Your Message</label>
                                        <div class="cf-input-wrap cf-textarea-wrap">
                                            <i class="fas fa-comment-alt cf-input-icon cf-textarea-icon"></i>
                                            <textarea name="message" class="cf-input cf-textarea" rows="6" placeholder="How can we help you?" required></textarea>
                                        </div>
                                        <span class="cf-error error-message"></span>
                                    </div>

                                    <button type="submit" class="cf-submit-btn" id="submitBtn">
                                        <span class="btn-text">Send Message</span>
                                        <span class="btn-loader" style="display:none;"><i class="fas fa-spinner fa-spin"></i> Sending...</span>
                                        <i class="far fa-paper-plane btn-icon ms-2"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        /* ===== SECTION HEADER ===== */
        .mb-60 { margin-bottom: 60px; }

        .contact-eyebrow {
            display: inline-block;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 3px;
            color: var(--primary-color, #cc0d39);
            background: rgba(204,13,57,0.08);
            padding: 5px 16px;
            border-radius: 20px;
            margin-bottom: 16px;
        }

        .contact-main-title {
            font-family: var(--heading-font, 'Aoboshi One', sans-serif);
            font-size: clamp(2rem, 4vw, 2.8rem);
            font-weight: 700;
            color: var(--primary-dark-color, #13172b);
            margin-bottom: 12px;
            line-height: 1.2;
        }

        .contact-highlight {
            color: var(--primary-color, #cc0d39);
            position: relative;
        }

        .contact-highlight::after {
            content: '';
            position: absolute;
            bottom: 2px;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--secondary-light-color, #feeb9d);
            border-radius: 2px;
            z-index: -1;
        }

        .contact-sub {
            font-family: var(--body-font, 'DM Sans', sans-serif);
            color: var(--text-color, #5e626f);
            font-size: 1.05rem;
            margin: 0;
        }

        /* ===== MAIN CARD ===== */
        .contact-card {
            display: flex;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(19,23,43,0.1), 0 4px 16px rgba(19,23,43,0.06);
            background: #fff;
        }

        /* ===== INFO PANEL ===== */
        .contact-info-panel {
            width: 38%;
            flex-shrink: 0;
            background: var(--primary-dark-color, #13172b);
            position: relative;
            overflow: hidden;
        }

        .info-panel-inner {
            padding: 48px 40px;
            position: relative;
            z-index: 2;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .info-panel-top {
            margin-bottom: 40px;
        }

        .info-brand-icon {
            width: 56px;
            height: 56px;
            background: rgba(247,148,31,0.15);
            border: 1.5px solid rgba(247,148,31,0.3);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
        }

        .info-brand-icon i {
            font-size: 1.4rem;
            color: var(--secondary-color, #f7941f);
        }

        .info-title {
            font-family: var(--heading-font, 'Aoboshi One', sans-serif);
            font-size: 1.6rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 12px;
            line-height: 1.3;
        }

        .info-subtitle {
            font-family: var(--body-font, 'DM Sans', sans-serif);
            color: rgba(255,255,255,0.55);
            font-size: 0.95rem;
            line-height: 1.6;
            margin: 0;
        }

        /* Info Items */
        .info-items {
            display: flex;
            flex-direction: column;
            gap: 24px;
            flex: 1;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .info-item-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 1rem;
        }

        .info-item-content {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .info-item-label {
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: rgba(255,255,255,0.4);
        }

        .info-item-value {
            font-family: var(--body-font, 'DM Sans', sans-serif);
            font-size: 0.95rem;
            font-weight: 600;
            color: #fff;
            text-decoration: none;
            transition: color 0.2s;
            word-break: break-word;
        }

        a.info-item-value:hover {
            color: var(--secondary-color, #f7941f);
        }

        /* Decorative background element */
        .info-panel-deco {
            position: absolute;
            bottom: -60px;
            right: -60px;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(247,148,31,0.07);
            z-index: 1;
            pointer-events: none;
        }

        .info-panel-deco::before {
            content: '';
            position: absolute;
            inset: 30px;
            border-radius: 50%;
            border: 1.5px solid rgba(247,148,31,0.12);
        }

        /* ===== FORM PANEL ===== */
        .contact-form-panel {
            flex: 1;
            background: #fff;
        }

        .form-panel-inner {
            padding: 48px 44px;
        }

        .form-title {
            font-family: var(--heading-font, 'Aoboshi One', sans-serif);
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-dark-color, #13172b);
            margin-bottom: 8px;
        }

        .form-subtitle {
            font-family: var(--body-font, 'DM Sans', sans-serif);
            color: var(--text-color, #5e626f);
            font-size: 0.95rem;
            margin-bottom: 36px;
        }

        /* Form Row */
        .form-row-group {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        /* Form Group */
        .cf-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 20px;
        }

        .form-row-group .cf-group {
            margin-bottom: 0;
        }

        .cf-label {
            font-family: var(--body-font, 'DM Sans', sans-serif);
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--primary-dark-color, #13172b);
        }

        .cf-input-wrap {
            position: relative;
        }

        .cf-input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--light-gray, #aeb0b6);
            font-size: 0.85rem;
            pointer-events: none;
            transition: color 0.2s;
        }

        .cf-textarea-icon {
            top: 16px;
            transform: none;
        }

        .cf-input {
            width: 100%;
            padding: 12px 14px 12px 40px;
            border: 1.5px solid #e8e8e8;
            border-radius: 10px;
            font-family: var(--body-font, 'DM Sans', sans-serif);
            font-size: 0.95rem;
            color: var(--primary-dark-color, #13172b);
            background: var(--gray-bg, #f9f3f0);
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
            outline: none;
        }

        .cf-input::placeholder {
            color: var(--light-gray, #aeb0b6);
        }

        .cf-input:focus {
            border-color: var(--primary-color, #cc0d39);
            background: #fff;
            box-shadow: 0 0 0 3px rgba(204,13,57,0.08);
        }

        .cf-input:focus + .cf-input-icon,
        .cf-input-wrap:focus-within .cf-input-icon {
            color: var(--primary-color, #cc0d39);
        }

        .cf-textarea {
            resize: none;
            padding-top: 14px;
        }

        .cf-textarea-wrap .cf-input-icon {
            top: 14px;
            transform: none;
        }

        .cf-error {
            font-size: 0.8rem;
            color: var(--primary-color, #cc0d39);
            font-weight: 500;
            min-height: 16px;
        }

        /* Submit Button */
        .cf-submit-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 14px 36px;
            background: var(--primary-color, #cc0d39);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-family: var(--body-font, 'DM Sans', sans-serif);
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.25s, transform 0.2s, box-shadow 0.25s;
            margin-top: 8px;
        }

        .cf-submit-btn:hover {
            background: #a80c2f;
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(204,13,57,0.28);
        }

        .cf-submit-btn:active {
            transform: translateY(0);
        }

        .cf-submit-btn:disabled {
            opacity: 0.65;
            cursor: not-allowed;
            transform: none;
        }

        /* ===== FLOATING TOAST ===== */
        .ct-toast {
            position: fixed;
            bottom: 28px;
            right: 24px;
            z-index: 99999;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 20px;
            border-radius: 12px;
            font-family: var(--body-font, 'DM Sans', sans-serif);
            font-size: 0.9rem;
            font-weight: 600;
            box-shadow: 0 8px 28px rgba(0,0,0,0.15);
            opacity: 0;
            transform: translateY(16px);
            transition: opacity 0.35s ease, transform 0.35s ease;
            max-width: 340px;
            pointer-events: none;
        }

        .ct-toast--show {
            opacity: 1;
            transform: translateY(0);
        }

        .ct-toast--success {
            background: var(--primary-dark-color, #13172b);
            color: #fff;
            border-left: 4px solid var(--secondary-color, #f7941f);
        }

        .ct-toast--danger {
            background: var(--primary-dark-color, #13172b);
            color: #fff;
            border-left: 4px solid var(--primary-color, #cc0d39);
        }

        .ct-toast__icon {
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .ct-toast--success .ct-toast__icon { color: var(--secondary-color, #f7941f); }
        .ct-toast--danger  .ct-toast__icon { color: #fc8181; }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 991px) {
            .contact-card {
                flex-direction: column;
            }

            .contact-info-panel {
                width: 100%;
            }

            .info-panel-inner {
                padding: 36px 28px;
            }

            .info-items {
                flex-direction: row;
                flex-wrap: wrap;
                gap: 20px;
            }

            .info-item {
                flex: 1;
                min-width: 180px;
            }

            .form-panel-inner {
                padding: 36px 28px;
            }
        }

        @media (max-width: 767px) {
            .contact-section { padding: 70px 0 60px; }
            .mb-60 { margin-bottom: 40px; }

            .form-row-group {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .form-row-group .cf-group {
                margin-bottom: 20px;
            }

            .info-items {
                flex-direction: column;
            }

            .info-item {
                min-width: unset;
            }

            .form-panel-inner {
                padding: 28px 20px;
            }

            .info-panel-inner {
                padding: 28px 20px;
            }

            .ct-toast {
                bottom: 16px;
                right: 12px;
                left: 12px;
                max-width: 100%;
            }

            .cf-submit-btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Floating toast
        function showToast(message, type) {
            const icon = type === 'success' ? '✓' : '✕';
            const toast = document.createElement('div');
            toast.className = 'ct-toast ct-toast--' + type;
            toast.innerHTML =
                '<span class="ct-toast__icon">' + icon + '</span>' +
                '<span>' + message + '</span>';
            document.body.appendChild(toast);
            requestAnimationFrame(() => {
                requestAnimationFrame(() => toast.classList.add('ct-toast--show'));
            });
            setTimeout(() => {
                toast.classList.remove('ct-toast--show');
                setTimeout(() => { if (toast.parentNode) toast.remove(); }, 400);
            }, 4000);
        }

        // Show flash messages from session
        document.addEventListener('DOMContentLoaded', function() {
            const fs = document.getElementById('flash-success');
            const fe = document.getElementById('flash-error');
            if (fs) showToast(fs.dataset.msg, 'success');
            if (fe) showToast(fe.dataset.msg, 'danger');
        });

        $(document).ready(function() {
            $('#contactForm').on('submit', function(e) {
                e.preventDefault();

                // Clear errors
                $('.cf-error').text('');

                const submitBtn = $('#submitBtn');
                submitBtn.prop('disabled', true);
                $('.btn-text').hide();
                $('.btn-loader').show();
                $('.btn-icon').hide();

                $.ajax({
                    url: '{{ route("contact.submit") }}',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.success) {
                            showToast(response.message, 'success');
                            $('#contactForm')[0].reset();
                        }
                        submitBtn.prop('disabled', false);
                        $('.btn-text').show();
                        $('.btn-loader').hide();
                        $('.btn-icon').show();
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $('.error-' + key).text(value[0]);
                            });
                            showToast('Please fix the errors and try again.', 'danger');
                        } else {
                            showToast('Something went wrong. Please try again.', 'danger');
                        }
                        submitBtn.prop('disabled', false);
                        $('.btn-text').show();
                        $('.btn-loader').hide();
                        $('.btn-icon').show();
                    }
                });
            });
        });
    </script>
@endsection