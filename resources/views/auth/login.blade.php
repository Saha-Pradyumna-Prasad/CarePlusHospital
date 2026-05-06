@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container-fluid px-2 px-sm-3 px-md-4">
    <div class="row justify-content-center min-vh-100 align-items-center g-0">
        <div class="col-11 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white text-center py-3 py-sm-4 rounded-top-4">
                    <h3 class="mb-0 fs-4 fs-sm-3 fs-md-2">
                        <i class="fas fa-hospital-user me-2"></i>
                        Care Plus Hospital
                    </h3>
                    <p class="mb-0 mt-2 opacity-75 small">Login to your account</p>
                </div>
                <div class="card-body p-3 p-sm-4 p-md-5">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            {{ $errors->first() }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3 mb-md-4">
                            <label for="email" class="form-label fw-semibold">
                                <i class="fas fa-envelope me-2"></i>Email Address
                            </label>
                            <input type="email" name="email" id="email" class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                   value="{{ old('email') }}" required autofocus placeholder="Enter your email">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 mb-md-4">
                            <label for="password" class="form-label fw-semibold">
                                <i class="fas fa-lock me-2"></i>Password
                            </label>
                            <input type="password" name="password" id="password" class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                   required placeholder="Enter your password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 mb-md-4 d-flex flex-wrap justify-content-between align-items-center gap-2">
                            <div class="form-check">
                                <input type="checkbox" name="remember" id="remember" class="form-check-input">
                                <label for="remember" class="form-check-label">Remember Me</label>
                            </div>
                            <a href="{{ route('password.request') }}" class="text-decoration-none small">Forgot Password?</a>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">
                            <i class="fas fa-sign-in-alt me-2"></i> Login
                        </button>

                        <div class="text-center">
                            <small class="text-muted">Demo Credentials:</small>
                            <div class="small mt-2 d-flex flex-wrap justify-content-center gap-2">
                                <span class="badge bg-info">Admin: admin@rcms.com / admin123</span>
                                <span class="badge bg-success">Doctor: sarah.johnson@citycare.com / password123</span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Bootstrap responsive overrides - maintaining original design */
    @media (max-width: 576px) {
        .form-control-lg {
            font-size: 1rem;
            padding: 0.5rem 0.75rem;
        }
        
        .btn-lg {
            font-size: 1rem;
            padding: 0.5rem 1rem;
        }
        
        .card-body {
            padding: 1.5rem !important;
        }
    }
    
    @media (min-width: 577px) and (max-width: 768px) {
        .card-body {
            padding: 2rem !important;
        }
    }
    
    /* Ensure proper touch targets on mobile */
    @media (max-width: 768px) {
        .form-check-input,
        .btn,
        a {
            min-height: 40px;
        }
        
        .form-check-label,
        a {
            font-size: 0.875rem;
        }
    }
    
    /* Extra small devices optimization */
    @media (max-width: 380px) {
        .container-fluid {
            padding-left: 0.75rem !important;
            padding-right: 0.75rem !important;
        }
        
        .card-body {
            padding: 1rem !important;
        }
        
        .badge {
            font-size: 0.7rem;
            padding: 0.25rem 0.5rem;
        }
    }
    
    /* Tablet landscape optimization */
    @media (min-width: 768px) and (max-width: 992px) {
        .col-md-8 {
            max-width: 70%;
        }
    }
    
    /* Ensure smooth responsive behavior for all screen sizes */
    @media (min-width: 1400px) {
        .col-xxl-4 {
            max-width: 30%;
        }
    }
</style>
@endsection