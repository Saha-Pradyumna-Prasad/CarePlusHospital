@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="container-fluid px-2 px-sm-3 px-md-4">
    <div class="row justify-content-center g-3 g-md-4">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0 fs-6 fs-md-5"><i class="fas fa-user-circle me-2"></i>Edit Profile</h5>
                </div>
                <div class="card-body p-3 p-sm-4">
                    @if(session('status') == 'profile-updated')
                        <div class="alert alert-success alert-dismissible fade show mb-3 mb-md-4" role="alert">
                            <i class="fas fa-check-circle me-2"></i>Profile updated successfully!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <input type="text" class="form-control bg-light" id="role" value="{{ ucfirst($user->role) }}" disabled>
                            <small class="text-muted">Role cannot be changed</small>
                        </div>

                        <div class="d-flex flex-column flex-sm-row gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update Profile
                            </button>
                            <a href="{{ route('dashboard') }}" class="btn btn-secondary text-center">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Change Password Section -->
            <div class="card shadow-sm mt-4">
                <div class="card-header bg-warning text-white">
                    <h5 class="mb-0 fs-6 fs-md-5"><i class="fas fa-key me-2"></i>Change Password</h5>
                </div>
                <div class="card-body p-3 p-sm-4">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                                   id="current_password" name="current_password" required>
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                   id="password" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Password must be at least 8 characters</small>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" 
                                   id="password_confirmation" name="password_confirmation" required>
                        </div>

                        <button type="submit" class="btn btn-warning w-100 w-sm-auto">
                            <i class="fas fa-key me-2"></i>Change Password
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@media (max-width: 768px) {
    .card-header h5 {
        font-size: 0.9rem !important;
    }
    
    .card-body {
        padding: 1rem !important;
    }
    
    .form-label {
        font-size: 0.85rem;
        margin-bottom: 0.3rem;
    }
    
    .form-control {
        font-size: 0.85rem;
        padding: 0.4rem 0.6rem;
    }
    
    .btn {
        font-size: 0.85rem;
        padding: 0.4rem 0.8rem;
    }
    
    .alert {
        font-size: 0.85rem;
        padding: 0.6rem 0.8rem;
    }
    
    small, .text-muted {
        font-size: 0.7rem;
    }
}

@media (max-width: 576px) {
    .card-header h5 {
        font-size: 0.85rem !important;
    }
    
    .form-label {
        font-size: 0.8rem;
    }
    
    .form-control {
        font-size: 0.8rem;
        padding: 0.35rem 0.5rem;
    }
    
    .btn {
        font-size: 0.8rem;
        padding: 0.35rem 0.7rem;
        width: 100%;
    }
    
    .d-flex {
        gap: 0.5rem !important;
    }
    
    .alert {
        font-size: 0.75rem;
        padding: 0.5rem 0.7rem;
    }
    
    small, .text-muted {
        font-size: 0.65rem;
    }
    
    .mb-3 {
        margin-bottom: 0.75rem !important;
    }
}
</style>
@endsection