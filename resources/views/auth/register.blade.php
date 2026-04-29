@extends('layouts.app')

@section('title', 'Register')

@section('content')
<section class="auth-section py-120 mt-70" style="background-color: #fcfcfc;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="auth-wrapper p-5 shadow-sm rounded-4 bg-white border">
                    <div class="row g-5">
                        
                        <div class="col-lg-6 border-end">
                            <h2 class="fw-bold mb-5 text-uppercase letter-spacing-1" style="font-size: 1.6rem;">Register</h2>
                            
                            @if ($errors->any())
                                <div class="alert alert-danger py-2 small">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('register') }}" class="auth-form">
                                @csrf
                                <div class="form-group mb-3">
                                    <label class="fs-6 fw-bold text-muted mb-2">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control rounded-0 py-2 shadow-none border-dark" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="fs-6 fw-bold text-muted mb-2">Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control rounded-0 py-2 shadow-none border-dark" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="fs-6 fw-bold text-muted mb-2">Password <span class="text-danger">*</span></label>
                                    <input type="password" name="password" class="form-control rounded-0 py-2 shadow-none border-dark" required>
                                </div>

                                <div class="form-group mb-4">
                                    <label class="fs-6 fw-bold text-muted mb-2">Confirm Password <span class="text-danger">*</span></label>
                                    <input type="password" name="password_confirmation" class="form-control rounded-0 py-2 shadow-none border-dark" required>
                                </div>

                                <button type="submit" class="btn btn-dark px-5 py-3 fw-bold text-uppercase rounded-0 w-100 mb-3" style="background: #c19416; border: none;">
                                    Register
                                </button>
                                
                                <p class="text-muted small">
                                    Your personal data will be used to support your experience... <a href="#" style="color: #c19416;">privacy policy</a>.
                                </p>
                            </form>
                        </div>

                        <div class="col-lg-6 ps-lg-5 text-center d-flex flex-column justify-content-start">
                            <h2 class="fw-bold mb-5 text-uppercase letter-spacing-1" style="font-size: 1.6rem;">Login</h2>
                            <p class="text-muted fs-6 mb-4 lh-base text-start">
                                Already have an account? Log in to access your order history and profile details.
                            </p>
                            <div class="mt-auto mb-auto">
                                <a href="{{ route('login') }}" class="btn btn-dark px-5 py-3 fw-bold text-uppercase rounded-0 w-100" style="background: #c19416; border: none;">
                                    Login
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .letter-spacing-1 { letter-spacing: 1px; }
    .form-control:focus { border-color: #c19416 !important; box-shadow: none !important; }
    .btn:hover { opacity: 0.8; }
    @media (max-width: 991px) {
        .border-end { border-right: none !important; border-bottom: 1px solid #dee2e6 !important; padding-bottom: 30px; }
        .ps-lg-5 { padding-top: 30px !important; padding-left: 12px !important; }
    }
</style>
@endsection