@extends('layouts.app')

@section('title', 'Our Physician Assistants')

@section('content')
<div class="container px-3 px-md-4">
    <h1 class="text-center mb-4 fs-2 fs-md-1">Our Physician Assistants</h1>
    
    <div class="row mb-4">
        <div class="col-12 col-md-8 col-lg-6 mx-auto">
            <form method="GET" action="{{ route('pas.index') }}" class="d-flex gap-2">
                <input type="text" name="search" class="form-control" placeholder="Search by name or email..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
    </div>
    
    <div class="row g-3 g-md-4">
        @forelse($pas as $pa)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <div class="card h-100 shadow-sm text-center">
                <div class="text-center mt-3">
                    @if($pa->photo)
                        <img src="{{ asset('storage/' . $pa->photo) }}" class="rounded-circle" style="width: 100px; height: 100px; max-width: 100%; object-fit: cover;">
                    @else
                        <i class="fas fa-user-nurse fa-4x text-secondary"></i>
                    @endif
                </div>
                <div class="card-body">
                    <h5 class="card-title fs-6 fs-md-5">{{ $pa->name }}</h5>
                    <p class="card-text text-muted small">
                        <i class="fas fa-envelope"></i> <span class="text-break">{{ $pa->email }}</span><br>
                        <i class="fas fa-phone"></i> {{ $pa->phone }}<br>
                        <i class="fas fa-user-md"></i> Assigned to: Dr. {{ $pa->doctor->name ?? 'N/A' }}
                    </p>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info text-center">No physician assistants found.</div>
        </div>
        @endforelse
    </div>
    
    <div class="d-flex justify-content-center mt-4">
        {{ $pas->links() }}
    </div>
</div>

<style>
@media (max-width: 576px) {
    .rounded-circle {
        width: 80px !important;
        height: 80px !important;
    }
}
</style>
@endsection