@extends('layouts.app')

@section('title', 'Forgot Password')

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
                    <p class="mb-0 mt-2 opacity-75 small">Reset Your Password</p>
                </div>
                <div class="card-body p-3 p-sm-4 p-md-5">
                    @if(session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            {{ $errors->first() }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <p class="text-muted mb-4 small">
                        Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
                    </p>

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold">
                                <i class="fas fa-envelope me-2"></i>Email Address
                            </label>
                            <input type="email" name="email" id="email" class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                   value="{{ old('email') }}" required autofocus placeholder="Enter your registered email">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">
                            <i class="fas fa-paper-plane me-2"></i> Send Password Reset Link
                        </button>

                        <div class="text-center">
                            <a href="{{ route('login') }}" class="text-decoration-none small">
                                <i class="fas fa-arrow-left me-1"></i> Back to Login
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
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
    
    @media (max-width: 380px) {
        .container-fluid {
            padding-left: 0.75rem !important;
            padding-right: 0.75rem !important;
        }
        
        .card-body {
            padding: 1rem !important;
        }
    }
    
    .modal {
        z-index: 1060 !important;
    }
    .modal-backdrop {
        z-index: 1050 !important;
    }
</style>
@endsection