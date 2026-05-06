@extends('layouts.admin-dash')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid px-2 px-sm-3 px-md-4">
    <h2 class="mb-4 fs-3 fs-md-2">Welcome, Admin!</h2>
    
    <!-- Statistics Cards -->
    <div class="row g-2 g-sm-3">
        <div class="col-6 col-md-4 col-lg-3 mb-3">
            <div class="card bg-primary text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0 small">Total Doctors</h6>
                            <h2 class="mb-0 fs-3">{{ $stats['total_doctors'] }}</h2>
                        </div>
                        <i class="fas fa-user-md fa-2x fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-6 col-md-4 col-lg-3 mb-3">
            <div class="card bg-success text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0 small">Total PAs</h6>
                            <h2 class="mb-0 fs-3">{{ $stats['total_pas'] }}</h2>
                        </div>
                        <i class="fas fa-user-nurse fa-2x fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-6 col-md-4 col-lg-3 mb-3">
            <div class="card bg-info text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0 small">Total Staff</h6>
                            <h2 class="mb-0 fs-3">{{ $stats['total_staff'] }}</h2>
                        </div>
                        <i class="fas fa-users fa-2x fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-6 col-md-4 col-lg-3 mb-3">
            <div class="card bg-warning text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0 small">Total Patients</h6>
                            <h2 class="mb-0 fs-3">{{ $stats['total_patients'] }}</h2>
                        </div>
                        <i class="fas fa-procedures fa-2x fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-6 col-md-4 col-lg-3 mb-3">
            <div class="card bg-danger text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0 small">Total Rooms</h6>
                            <h2 class="mb-0 fs-3">{{ $stats['total_rooms'] }}</h2>
                        </div>
                        <i class="fas fa-bed fa-2x fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-6 col-md-4 col-lg-3 mb-3">
            <div class="card bg-secondary text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0 small">Total Services</h6>
                            <h2 class="mb-0 fs-3">{{ $stats['total_services'] }}</h2>
                        </div>
                        <i class="fas fa-concierge-bell fa-2x fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="row g-2">
                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-2">
                            <a href="{{ route('admin.doctors') }}" class="btn btn-outline-primary w-100">
                                <i class="fas fa-user-md"></i> <span class="d-none d-sm-inline">Manage Doctors</span>
                            </a>
                        </div>
                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-2">
                            <a href="{{ route('admin.pas') }}" class="btn btn-outline-success w-100">
                                <i class="fas fa-user-nurse"></i> <span class="d-none d-sm-inline">Manage PAs</span>
                            </a>
                        </div>
                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-2">
                            <a href="{{ route('admin.staff') }}" class="btn btn-outline-info w-100">
                                <i class="fas fa-users"></i> <span class="d-none d-sm-inline">Manage Staff</span>
                            </a>
                        </div>
                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-2">
                            <a href="{{ route('admin.patients') }}" class="btn btn-outline-warning w-100">
                                <i class="fas fa-procedures"></i> <span class="d-none d-sm-inline">Manage Patients</span>
                            </a>
                        </div>
                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-2">
                            <a href="{{ route('admin.services') }}" class="btn btn-outline-danger w-100">
                                <i class="fas fa-concierge-bell"></i> <span class="d-none d-sm-inline">Manage Services</span>
                            </a>
                        </div>
                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-2">
                            <a href="{{ route('admin.rooms') }}" class="btn btn-outline-secondary w-100">
                                <i class="fas fa-bed"></i> <span class="d-none d-sm-inline">Manage Rooms</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection