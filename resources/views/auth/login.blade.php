@extends('layouts.app')

@section('title', 'Login')

@section('content')
<section class="auth-section py-120 mt-70" style="background-color: #fcfcfc;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10"> <div class="auth-wrapper p-5 shadow-sm rounded-4 bg-white border">
                    <div class="row g-5">
                        
                        <div class="col-lg-6 border-end">
                            <h2 class="fw-bold mb-5 text-uppercase letter-spacing-1" style="font-size: 1.6rem;">Login</h2>
                            
                            @if ($errors->any())
                                <div class="alert alert-danger py-2 small">{{ $errors->first() }}</div>
                            @endif

                            <form method="POST" action="{{ route('user.login') }}" class="auth-form">
                                @csrf
                                <div class="form-group mb-4">
                                    <label class="fs-6 fw-bold text-muted mb-2">Username or email address <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control rounded-0 py-3 shadow-none border-dark" value="{{ old('email') }}" required>
                                </div>

                                <div class="form-group mb-4">
                                    <label class="fs-6 fw-bold text-muted mb-2">Password <span class="text-danger">*</span></label>
                                    <input type="password" name="password" class="form-control rounded-0 py-3 shadow-none border-dark" required>
                                </div>

                                <div class="d-flex align-items-center mb-4">
                                    <button type="submit" class="btn btn-dark px-5 py-3 fw-bold text-uppercase rounded-0" style="background: #c19416; border: none;">
                                        Log In
                                    </button>
                                </div>

                                <div class="form-check d-flex align-items-center gap-2">
                                    <input class="form-check-input shadow-none" type="checkbox" name="remember" id="remember">
                                    <label class="form-check-label text-muted fw-bold" for="remember">Remember me</label>
                                    <a href="{{ route('password.request') }}" class="ms-auto text-decoration-none fw-bold" style="color: #c19416;">Forgot password?</a>
                                </div>
                            </form>
                        </div>

                        <div class="col-lg-6 ps-lg-5 text-center d-flex flex-column justify-content-start">
                            <h2 class="fw-bold mb-5 text-uppercase letter-spacing-1" style="font-size: 1.6rem;">Register</h2>
                            <p class="text-muted fs-6 mb-4 lh-base text-start">
                                Registering for this site allows you to access your order status and history. Just fill in the fields below, and we'll get a new account set up for you in no time.
                            </p>
                            <div class="mt-auto mb-auto">
                                <a href="{{ route('register') }}" class="btn btn-dark px-5 py-3 fw-bold text-uppercase rounded-0 w-100" style="background: #c19416; border: none;">
                                    Register
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection