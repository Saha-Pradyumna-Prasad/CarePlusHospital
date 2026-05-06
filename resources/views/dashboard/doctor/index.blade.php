@extends('layouts.doctor-dash')

@section('title', 'Doctor Dashboard')

@section('content')

<div class="container-fluid px-2 px-sm-3 px-md-4">
    <div class="row g-3 g-md-4">
        <div class="col-12 col-md-4 mb-3 mb-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0 fs-6 fs-md-5"><i class="fas fa-user-md"></i> Profile</h5>
                </div>
                <div class="card-body text-center">
                    @if($doctor->photo)
                        <img src="{{ asset('storage/' . $doctor->photo) }}" class="rounded-circle mb-3" style="width: 120px; height: 120px; object-fit: cover; max-width: 100%;">
                    @else
                        <i class="fas fa-user-circle fa-5x text-secondary mb-3"></i>
                    @endif
                    <h4 class="fs-5 fs-md-4">Dr. {{ $doctor->name }}</h4>
                    <p class="text-muted small">{{ $doctor->designation }}<br>{{ $doctor->specialty }}<br>{{ $doctor->degree }}</p>
                    <hr>
                    <p class="small"><i class="fas fa-envelope"></i> {{ $doctor->email }}<br><i class="fas fa-phone"></i> {{ $doctor->phone }}</p>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-md-4 mb-3 mb-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0 fs-6 fs-md-5"><i class="fas fa-user-nurse"></i> Assigned PA</h5>
                </div>
                <div class="card-body">
                    @if($pa)
                        <div class="text-center">
                            @if($pa->photo)
                                <img src="{{ asset('storage/' . $pa->photo) }}" class="rounded-circle mb-2" style="width: 80px; height: 80px; object-fit: cover; border: 2px solid #28a745; max-width: 100%;">
                            @else
                                <i class="fas fa-user-circle fa-5x text-secondary mb-2"></i>
                            @endif
                            <h5 class="mt-2 fs-6">{{ $pa->name }}</h5>
                            <p class="small"><i class="fas fa-envelope"></i> {{ $pa->email }}<br><i class="fas fa-phone"></i> {{ $pa->phone }}</p>
                        </div>
                    @else
                        <div class="alert alert-warning text-center mb-0 small">No PA assigned yet.</div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-12 col-md-4 mb-3 mb-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0 fs-6 fs-md-5"><i class="fas fa-chart-line"></i> Statistics</h5>
                </div>
                <div class="card-body text-center">
                    <h2 class="mb-0 fs-2">{{ $patients->count() }}</h2>
                    <p class="small">Total Patients</p>
                    <h2 class="mb-0 fs-2">{{ $upcomingAppointments->count() }}</h2>
                    <p class="small">Upcoming Appointments</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row g-3 g-md-4">
        <div class="col-12 col-md-6 mb-3 mb-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-warning">
                    <h5 class="mb-0 fs-6 fs-md-5"><i class="fas fa-calendar"></i> Upcoming Appointments</h5>
                </div>
                <div class="card-body p-2 p-sm-3">
                    @forelse($upcomingAppointments as $appointment)
                        <div class="border-bottom mb-2 pb-2">
                            <strong class="d-block fs-6">{{ $appointment->patient_name }}</strong>
                            <small class="text-muted d-block">{{ $appointment->appointment_time->format('M d, Y h:i A') }}</small>
                            <small class="d-block">Reason: {{ Str::limit($appointment->reason, 50) }}</small>
                            <span class="badge bg-{{ $appointment->status == 'pending' ? 'warning' : 'info' }} float-end">{{ ucfirst($appointment->status) }}</span>
                        </div>
                    @empty
                        <p class="text-muted small">No upcoming appointments.</p>
                    @endforelse
                </div>
            </div>
        </div>
        
        <div class="col-12 col-md-6 mb-3 mb-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0 fs-6 fs-md-5"><i class="fas fa-users"></i> Recent Patients</h5>
                </div>
                <div class="card-body p-2 p-sm-3">
                    @forelse($patients->take(5) as $patient)
                        <div class="border-bottom mb-2 pb-2">
                            <div class="d-flex flex-wrap justify-content-between align-items-start gap-2">
                                <div class="flex-grow-1">
                                    <strong class="d-block fs-6">{{ $patient->name }}</strong>
                                    <small>Age: {{ $patient->age }} | Phone: {{ $patient->phone }}</small>
                                </div>
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#reportModal{{ $patient->id }}">
                                    Add Report
                                </button>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted small">No patients yet.</p>
                    @endforelse
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
    
    h4 {
        font-size: 1.1rem !important;
    }
    
    .btn-sm {
        font-size: 0.7rem;
        padding: 0.2rem 0.5rem;
    }
}

@media (max-width: 576px) {
    .rounded-circle {
        width: 80px !important;
        height: 80px !important;
    }
    
    .fa-5x {
        font-size: 3rem !important;
    }
    
    .fs-2 {
        font-size: 1.75rem !important;
    }
    
    .border-bottom {
        padding-bottom: 0.75rem !important;
        margin-bottom: 0.75rem !important;
    }
}
</style>
@endsection