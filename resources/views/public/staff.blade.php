@extends('layouts.app')

@section('title', 'Our Support Staff')

@section('content')
<div class="container px-3 px-md-4">
    <h1 class="text-center mb-4 fs-2 fs-md-1">Our Support Staff</h1>
    
    <div class="row mb-4">
        <div class="col-12 col-md-8 col-lg-6 mx-auto">
            <form method="GET" action="{{ route('staff.index') }}" class="d-flex flex-column flex-sm-row gap-2">
                <select name="role" class="form-select">
                    <option value="">All Roles</option>
                    @foreach($roles as $role)
                        <option value="{{ $role }}" {{ request('role') == $role ? 'selected' : '' }}>
                            {{ ucfirst($role) }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>
        </div>
    </div>
    
    <div class="row g-3 g-md-4">
        @forelse($staff as $staffMember)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <div class="card h-100 shadow-sm text-center">
                <div class="text-center mt-3">
                    @if($staffMember->photo)
                        <img src="{{ asset('storage/' . $staffMember->photo) }}" class="rounded-circle" style="width: 100px; height: 100px; max-width: 100%; object-fit: cover;">
                    @else
                        <i class="fas fa-user-tie fa-4x text-secondary"></i>
                    @endif
                </div>
                <div class="card-body">
                    <h5 class="card-title fs-6 fs-md-5">{{ $staffMember->name }}</h5>
                    <span class="badge bg-info mb-2">{{ ucfirst($staffMember->role_type) }}</span>
                    <p class="card-text text-muted small">
                        <i class="fas fa-envelope"></i> <span class="text-break">{{ $staffMember->email }}</span><br>
                        <i class="fas fa-phone"></i> {{ $staffMember->phone }}
                    </p>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info text-center">No staff members found.</div>
        </div>
        @endforelse
    </div>
    
    <div class="d-flex justify-content-center mt-4">
        {{ $staff->links() }}
    </div>
</div>

<style>
@media (max-width: 576px) {
    .rounded-circle {
        width: 80px !important;
        height: 80px !important;
    }
    .badge {
        font-size: 0.7rem;
    }
}
</style>
@endsection