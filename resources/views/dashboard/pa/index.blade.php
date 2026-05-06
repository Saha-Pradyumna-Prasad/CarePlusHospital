@extends('layouts.pa-dash')

@section('title', 'PA Dashboard')

@section('content')
<div class="container-fluid px-2 px-sm-3 px-md-4">
    <div class="row g-3 g-md-4">
        <div class="col-12 col-md-4 mb-3 mb-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0 fs-6 fs-md-5"><i class="fas fa-user"></i> My Profile</h5>
                </div>
                <div class="card-body text-center">
                    @if($pa->photo)
                        <img src="{{ asset('storage/' . $pa->photo) }}" class="rounded-circle mb-3" style="width: 120px; height: 120px; max-width: 100%; object-fit: cover;">
                    @else
                        <i class="fas fa-user-circle fa-5x text-secondary mb-3"></i>
                    @endif
                    <h4 class="fs-5 fs-md-4">{{ $pa->name }}</h4>
                    <p class="small"><i class="fas fa-envelope"></i> {{ $pa->email }}<br><i class="fas fa-phone"></i> {{ $pa->phone }}</p>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-md-4 mb-3 mb-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0 fs-6 fs-md-5"><i class="fas fa-user-md"></i> Assigned Doctor</h5>
                </div>
                <div class="card-body text-center">
                    @if($doctor)
                        @if($doctor->photo)
                            <img src="{{ asset('storage/' . $doctor->photo) }}" class="rounded-circle mb-2" style="width: 80px; height: 80px; object-fit: cover; border: 2px solid #28a745; max-width: 100%;">
                        @else
                            <i class="fas fa-user-md fa-4x text-secondary mb-2"></i>
                        @endif
                        <h5 class="mt-2 fs-6">Dr. {{ $doctor->name }}</h5>
                        <p class="small">{{ $doctor->specialty }}<br>{{ $doctor->designation }}<br><i class="fas fa-phone"></i> {{ $doctor->phone }}</p>
                    @else
                        <i class="fas fa-user-md fa-4x text-secondary mb-2"></i>
                        <h5 class="fs-6">No doctor assigned yet.</h5>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-12 col-md-4 mb-3 mb-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0 fs-6 fs-md-5"><i class="fas fa-calendar"></i> Upcoming Appointments</h5>
                </div>
                <div class="card-body d-flex flex-column justify-content-center">
                    <h2 class="text-center mb-0 fs-1">{{ $upcomingAppointments->count() }}</h2>
                    <p class="text-center text-muted small mb-0">Pending Appointments</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card shadow-sm">
        <div class="card-header bg-warning">
            <h5 class="mb-0 fs-6 fs-md-5"><i class="fas fa-list"></i> Today's Schedule</h5>
        </div>
        <div class="card-body p-2 p-sm-3">
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Time</th>
                            <th>Patient</th>
                            <th>Reason</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($upcomingAppointments->take(5) as $appointment)
                        <tr>
                            <td>{{ $appointment->appointment_time->format('h:i A') }}</td>
                            <td>{{ $appointment->patient_name }}<br><small>{{ $appointment->patient_phone }}</small></td>
                            <td>{{ Str::limit($appointment->reason, 50) }}</td>
                            <td>
                                <span class="badge bg-{{ $appointment->status == 'pending' ? 'warning' : 'info' }}">
                                    {{ ucfirst($appointment->status) }}
                                </span>
                            </td>
                            <td>
                                <form method="POST" action="{{ route('pa.appointments.status', $appointment->id) }}" class="d-inline">
                                    @csrf @method('PATCH')
                                    <select name="status" class="form-select form-select-sm" onchange="this.form.submit()" style="min-width: 85px;">
                                        <option value="confirmed" {{ $appointment->status == 'confirmed' ? 'selected' : '' }}>Cancel</option>
                                        <option value="cancelled" {{ $appointment->status == 'cancelled' ? 'selected' : '' }}>Done</option>
                                        
                                    </select>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center small">No appointments scheduled.</td></tr>
                        @endforelse
                    </tbody>
                </table>
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
    
    h5 {
        font-size: 0.9rem !important;
    }
    
    .btn-sm {
        font-size: 0.7rem;
        padding: 0.25rem 0.5rem;
    }
    
    table th, table td {
        font-size: 0.8rem;
        padding: 0.5rem !important;
    }
    
    .badge {
        font-size: 0.7rem;
        padding: 0.2rem 0.4rem;
    }
    
    .form-select-sm {
        font-size: 0.7rem;
        padding: 0.2rem 0.4rem;
        min-width: 75px !important;
    }
    
    .fa-5x {
        font-size: 3rem !important;
    }
    
    .fa-4x {
        font-size: 2.5rem !important;
    }
}

@media (max-width: 576px) {
    .fs-1 {
        font-size: 1.75rem !important;
    }
    
    table th, table td {
        font-size: 0.7rem;
        padding: 0.4rem !important;
    }
    
    .form-select-sm {
        font-size: 0.65rem;
        padding: 0.15rem 0.3rem;
        min-width: 70px !important;
    }
    
    .rounded-circle {
        width: 80px !important;
        height: 80px !important;
    }
    
    .fa-5x {
        font-size: 2.5rem !important;
    }
    
    small {
        font-size: 0.65rem;
    }
}
</style>
@endsection