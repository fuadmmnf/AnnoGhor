@extends('layouts.admin')

@section('title', 'Social Media Settings')

@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="main-content-wrap">
            
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Social Media Settings</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li><a href="{{ route('admin.dashboard') }}"><div class="text-tiny">Dashboard</div></a></li>
                    <li><i class="icon-chevron-right"></i></li>
                    <li><div class="text-tiny">Settings</div></li>
                    <li><i class="icon-chevron-right"></i></li>
                    <li><div class="text-tiny">Social Links</div></li>
                </ul>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    <i class="icon-check-circle mr-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="wg-box">
                {{-- Social Links Update Form --}}
                <form action="{{ route('admin.social-links.update') }}" method="POST">
                    @csrf
                    
                    <div class="settings-section-title mb-24">
                        <h5 class="mb-4">Social Media Profile Links</h5>
                        <p class="text-tiny text-muted">Manage the social media icons and links displayed in the website footer.</p>
                    </div>

                    <div class="row">
                        {{-- Facebook URL --}}
                        <div class="col-lg-6">
                            <fieldset class="mb-24">
                                <div class="body-title mb-10">Facebook URL</div>
                                <div class="input-with-icon">
                                    <i class="fab fa-facebook-f"></i>
                                    <input class="flex-grow custom-input" type="url" placeholder="https://facebook.com/yourpage" 
                                           name="facebook_url" value="{{ old('facebook_url', $setting->facebook_url ?? '') }}">
                                </div>
                                @error('facebook_url')
                                    <span class="text-danger text-tiny mt-2 d-block">{{ $message }}</span>
                                @enderror
                            </fieldset>
                        </div>

                        {{-- Instagram URL --}}
                        <div class="col-lg-6">
                            <fieldset class="mb-24">
                                <div class="body-title mb-10">Instagram URL</div>
                                <div class="input-with-icon">
                                    <i class="fab fa-instagram"></i>
                                    <input class="flex-grow custom-input" type="url" placeholder="https://instagram.com/yourprofile" 
                                           name="instagram_url" value="{{ old('instagram_url', $setting->instagram_url ?? '') }}">
                                </div>
                                @error('instagram_url')
                                    <span class="text-danger text-tiny mt-2 d-block">{{ $message }}</span>
                                @enderror
                            </fieldset>
                        </div>

                        {{-- LinkedIn URL --}}
                        <div class="col-lg-6">
                            <fieldset class="mb-24">
                                <div class="body-title mb-10">LinkedIn URL</div>
                                <div class="input-with-icon">
                                    <i class="fab fa-linkedin-in"></i>
                                    <input class="flex-grow custom-input" type="url" placeholder="https://linkedin.com/in/yourprofile" 
                                           name="linkedin_url" value="{{ old('linkedin_url', $setting->linkedin_url ?? '') }}">
                                </div>
                                @error('linkedin_url')
                                    <span class="text-danger text-tiny mt-2 d-block">{{ $message }}</span>
                                @enderror
                            </fieldset>
                        </div>

                        {{-- Twitter URL --}}
                        <div class="col-lg-6">
                            <fieldset class="mb-24">
                                <div class="body-title mb-10">Twitter / X URL</div>
                                <div class="input-with-icon">
                                    <i class="fab fa-twitter"></i>
                                    <input class="flex-grow custom-input" type="url" placeholder="https://twitter.com/yourprofile" 
                                           name="twitter_url" value="{{ old('twitter_url', $setting->twitter_url ?? '') }}">
                                </div>
                                @error('twitter_url')
                                    <span class="text-danger text-tiny mt-2 d-block">{{ $message }}</span>
                                @enderror
                            </fieldset>
                        </div>

                        <div class="col-12 mt-10">
                            <div class="flex justify-end">
                                <button class="tf-button w208 style-1" type="submit">
                                    <i class="icon-save mr-2"></i> Update Social Links
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
    /* Tomar deoya existing style gulo ekhaneu kaaj korbe */
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
</style>
@endsection