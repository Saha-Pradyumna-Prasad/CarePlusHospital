@extends('layouts.app')

@section('title', 'Our Doctors')

@section('content')
<div class="container px-3 px-md-4">
    <h1 class="text-center mb-4 fs-2 fs-md-1">Our Doctors</h1>
    
    <!-- Search Bar -->
    <div class="row mb-4">
        <div class="col-12 col-md-10 col-lg-8 mx-auto">
            <form method="GET" action="{{ route('doctors.index') }}" class="d-flex flex-column flex-sm-row gap-2">
                <input type="text" name="search" class="form-control" placeholder="Search by name, specialty or designation..." value="{{ request('search') }}">
                <select name="specialty" class="form-select w-auto">
                    <option value="">All Specialties</option>
                    @foreach($specialties as $specialty)
                        <option value="{{ $specialty }}" {{ request('specialty') == $specialty ? 'selected' : '' }}>{{ $specialty }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
    </div>
    
    <!-- Doctors Grid -->
    <div class="row g-3 g-md-4">
        @forelse($doctors as $doctor)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <div class="card h-100 shadow-sm text-center">
                <div class="text-center mt-3">
                    @if($doctor->photo)
                        <img src="{{ asset('storage/' . $doctor->photo) }}" class="rounded-circle" style="width: 100px; height: 100px; max-width: 100%; object-fit: cover;">
                    @else
                        <i class="fas fa-user-md fa-4x text-secondary"></i>
                    @endif
                </div>
                <div class="card-body">
                    <h5 class="card-title fs-6 fs-md-5">Dr. {{ $doctor->name }}</h5>
                    <p class="card-text text-primary small">{{ $doctor->specialty }}</p>
                    <p class="card-text small">{{ $doctor->designation }}</p>
                    <p class="card-text small">{{ $doctor->degree }}</p>
                    <hr>
                    <p class="card-text small">
                        <i class="fas fa-envelope"></i> <a href="mailto:{{ $doctor->email }}" class="text-break">{{ $doctor->email }}</a><br>
                        <i class="fas fa-phone"></i> <a href="tel:{{ $doctor->phone }}">{{ $doctor->phone }}</a>
                    </p>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info text-center">No doctors found.</div>
        </div>
        @endforelse
    </div>
    
    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $doctors->links() }}
    </div>
</div>

<style>
@media (max-width: 576px) {
    .rounded-circle {
        width: 80px !important;
        height: 80px !important;
    }
    .fa-user-md {
        font-size: 3rem !important;
    }
}
</style>
@endsection