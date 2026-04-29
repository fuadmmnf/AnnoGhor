@extends('layouts.admin')

@section('title', 'Contact Settings')

@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="main-content-wrap">
            
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Website Settings</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li><a href="{{ route('admin.dashboard') }}"><div class="text-tiny">Dashboard</div></a></li>
                    <li><i class="icon-chevron-right"></i></li>
                    <li><div class="text-tiny">Settings</div></li>
                </ul>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    <i class="icon-check-circle mr-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="wg-box">
                {{-- লোগো আপলোডের জন্য enctype যুক্ত করা হয়েছে --}}
                <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="settings-section-title mb-24">
                        <h5 class="mb-4">General & Contact Information</h5>
                        <p class="text-tiny text-muted">Manage your website's logo and public contact details.</p>
                    </div>

                    <div class="row">
                        {{-- লোগো আপলোড সেকশন --}}
                        <div class="col-lg-12 mb-24">
                            <fieldset>
                                <div class="body-title mb-10">Website Logo <span class="text-muted">(Required Ratio: 155x44 px)</span></div>
                                <div class="upload-image mb-16">
                                    @if($setting->site_logo)
                                        <div class="item mb-10">
                                            <img src="{{ asset('uploads/settings/'.$setting->site_logo) }}" alt="Logo" style="height: 44px; background: #f1f1f1; padding: 5px; border-radius: 4px; border: 1px solid #ddd;">
                                        </div>
                                    @endif
                                    <input class="form-control" type="file" name="site_logo" accept="image/*">
                                </div>
                                @error('site_logo')
                                    <span class="text-danger text-tiny d-block">{{ $message }}</span>
                                @enderror
                            </fieldset>
                        </div>

                        <div class="col-lg-6">
                            <fieldset class="mb-24">
                                <div class="body-title mb-10">Website Phone Number <span class="tf-color-1">*</span></div>
                                <div class="input-with-icon">
                                    <i class="icon-phone"></i>
                                    <input class="flex-grow custom-input" type="text" placeholder="+880 1XXX XXXXXX" 
                                           name="site_phone" value="{{ old('site_phone', $setting->site_phone ?? '') }}" required>
                                </div>
                                @error('site_phone')
                                    <span class="text-danger text-tiny mt-2 d-block">{{ $message }}</span>
                                @enderror
                            </fieldset>
                        </div>

                        <div class="col-lg-6">
                            <fieldset class="mb-24">
                                <div class="body-title mb-10">Website Email <span class="tf-color-1">*</span></div>
                                <div class="input-with-icon">
                                    <i class="icon-mail"></i>
                                    <input class="flex-grow custom-input" type="email" placeholder="support@website.com" 
                                           name="site_email" value="{{ old('site_email', $setting->site_email ?? '') }}" required>
                                </div>
                                @error('site_email')
                                    <span class="text-danger text-tiny mt-2 d-block">{{ $message }}</span>
                                @enderror
                            </fieldset>
                        </div>

                        <div class="col-lg-12">
                            <fieldset class="mb-24">
                                <div class="body-title mb-10">Website Office Address <span class="tf-color-1">*</span></div>
                                <div class="input-with-icon align-items-start">
                                    <i class="icon-map-pin mt-10"></i>
                                    <textarea class="flex-grow custom-input" placeholder="Enter full office address" 
                                              name="site_address" rows="4" required>{{ old('site_address', $setting->site_address ?? '') }}</textarea>
                                </div>
                                @error('site_address')
                                    <span class="text-danger text-tiny mt-2 d-block">{{ $message }}</span>
                                @enderror
                            </fieldset>
                        </div>

                        <div class="col-12 mt-10">
                            <div class="flex justify-end">
                                <button class="tf-button w208 style-1" type="submit">
                                    <i class="icon-save mr-2"></i> Save Changes
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom Input Styling */
    .custom-input {
        width: 100%;
        padding: 12px 16px 12px 45px !important;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 16px;
        transition: all 0.3s;
        background-color: #f8fafc;
    }
    .custom-input:focus {
        border-color: #2275fc;
        background-color: #fff;
        box-shadow: 0 0 0 4px rgba(34, 117, 252, 0.1);
        outline: none;
    }

    /* Icon within Input */
    .input-with-icon {
        position: relative;
        display: flex;
        align-items: center;
    }
    .input-with-icon i {
        position: absolute;
        left: 16px;
        font-size: 18px;
        color: #94a3b8;
    }
    .input-with-icon.align-items-start i {
        top: 15px;
    }

    /* Form Control for File */
    .form-control {
        display: block;
        width: 100%;
        padding: 0.5rem 1rem;
        font-size: 14px;
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
    }

    /* Section Title */
    .settings-section-title h5 {
        font-weight: 700;
        color: #1e293b;
        font-size: 18px;
    }

    .tf-button.style-1 {
        height: 50px;
        font-size: 16px;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        cursor: pointer;
    }

    .alert-success {
        background-color: #dcfce7;
        color: #166534;
        border: 1px solid #bbf7d0;
        border-radius: 8px;
        font-weight: 500;
    }

    @media (max-width: 768px) {
        .wg-box { padding: 15px; }
        .custom-input { font-size: 14px; }
    }
</style>
@endsection