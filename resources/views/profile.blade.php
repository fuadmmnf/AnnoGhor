@extends('layouts.app')

@section('title', 'My Profile - Ecommerce')

@section('content')
<section class="profile-section" style="padding-top: 20px;"> <div class="container">
        <div class="row g-4">
            <div class="col-lg-3">
                <div class="profile-sidebar border-0 px-0 sticky-top" style="top: 80px; z-index: 10;">
                    <h4 class="sidebar-main-title mb-4" style="margin-top: 0; line-height: 1;">MY PROFILE</h4>
                    
<ul class="nav flex-column profile-menu">
    <li class="nav-item mb-3">
        <a class="nav-link p-0 active d-flex align-items-center" href="#profile-info-section" 
           style="color: #000; font-size: 1.25rem; font-weight: 700; text-decoration: none;">
            <i class="fas fa-user-circle me-3" style="width: 25px;"></i> Profile Information
        </a>
    </li>

    <li class="nav-item mb-3">
        <a class="nav-link p-0 d-flex align-items-center" href="#change-password-section" 
           style="color: #000; font-size: 1.25rem; font-weight: 700; text-decoration: none;">
            <i class="fas fa-lock me-3" style="width: 25px;"></i> Change Password
        </a>
    </li>

    <li class="nav-item mb-3">
        <a class="nav-link p-0 d-flex align-items-center" href="{{ route('cart') }}" 
           style="color: #000; font-size: 1.25rem; font-weight: 700; text-decoration: none;">
            <i class="fas fa-shopping-bag me-3" style="width: 25px;"></i> My Cart
        </a>
    </li>

    <li class="nav-item mb-3">
        <a class="nav-link p-0 d-flex align-items-center" href="{{ route('wishlist') }}" 
           style="color: #000; font-size: 1.25rem; font-weight: 700; text-decoration: none;">
            <i class="fas fa-heart me-3" style="width: 25px;"></i> My Wishlist
        </a>
    </li>

    <li class="nav-item mb-4">
        <a class="nav-link p-0 d-flex align-items-center" href="{{ route('user.orders') }}" 
           style="color: #000; font-size: 1.25rem; font-weight: 700; text-decoration: none;">
            <i class="fas fa-box me-3" style="width: 25px;"></i> My Orders
        </a>
    </li>

    <hr style="border-top: 2px solid #eee;">

    <li class="nav-item">
        <form method="POST" action="{{ route('user.logout') }}">
            @csrf
            <button type="submit" class="nav-link p-0 border-0 bg-transparent d-flex align-items-center text-danger" 
                    style="font-size: 1.25rem; font-weight: 700; cursor: pointer;">
                <i class="fas fa-sign-out-alt me-3" style="width: 25px;"></i> Logout
            </button>
        </form>
    </li>
</ul>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="welcome-header mb-4" style="margin-top: 0; padding-top: 2px;">
                    <h6 class="fw-bold" style="line-height: 1;">Hello {{ auth()->user()->name }}!</h6>
                </div>

                <div id="profile-info-section" class="card mb-5 shadow-sm border-0">
                    <div class="card-header bg-white border-bottom py-3">
                        <h5 class="mb-0 fw-bold text-dark">Profile Information</h5>
                        <small class="text-muted">Update your profile and contact details</small>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label class="form-label fw-bold text-dark">Full Name</label>
                                <input type="text" name="name" class="form-control py-2 shadow-none" value="{{ auth()->user()->name }}" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-bold text-dark">Email Address</label>
                                <input type="email" class="form-control bg-light py-2" value="{{ auth()->user()->email }}" disabled>
                            </div>
                            <button type="submit" class="btn fw-bold text-uppercase px-5 py-2" 
                                    style="background-color: #FFC107 !important; color: #000 !important; border: 2px solid #E0A800 !important; display: inline-block !important;">
                                Update Profile
                            </button>
                        </form>
                    </div>
                </div>

                <div id="change-password-section" class="card shadow-sm border-0">
                    <div class="card-header bg-white border-bottom py-3">
                        <h5 class="mb-0 fw-bold text-dark">Change Password</h5>
                        <small class="text-muted">Update your password to keep your account secure</small>
                    </div>
                    <div class="card-body p-4">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <form action="{{ route('profile.update-password') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="form-label fw-bold text-dark">Current Password</label>
                                <input type="password" name="current_password" class="form-control py-2 shadow-none" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-bold text-dark">New Password</label>
                                <input type="password" name="new_password" class="form-control py-2 shadow-none" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-bold text-dark">Confirm New Password</label>
                                <input type="password" name="new_password_confirmation" class="form-control py-2 shadow-none" required>
                            </div>
                            <button type="submit" class="btn fw-bold text-uppercase px-5 py-2" 
                                    style="background-color: #FFC107 !important; color: #000 !important; border: 2px solid #E0A800 !important; display: inline-block !important;">
                                Update Password
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('styles')
<style>
    html { scroll-behavior: smooth; }

    /* Alignment fix */
    .profile-section {
        background-color: #fff;
    }

    .sidebar-main-title {
        font-size: 1.4rem;
        font-weight: 800;
        color: #000;
        margin-bottom: 30px;
    }

    .profile-menu .nav-link {
        color: #000 !important;
        font-size: 1.2rem; /* Font ektu boro kora hoyeche */
        font-weight: 600;
        display: flex;
        align-items: center;
        text-decoration: none;
    }

    .profile-menu .nav-link i {
        font-size: 1.3rem;
        width: 35px;
        color: #000;
    }

    .profile-menu .nav-link:hover, .profile-menu .nav-link.active {
        color: #FFC107 !important;
    }
    
    .profile-menu .nav-link:hover i, .profile-menu .nav-link.active i {
        color: #FFC107 !important;
    }

    .card {
        border: 1px solid #f0f0f0 !important;
        border-radius: 8px;
    }
</style>
@endsection