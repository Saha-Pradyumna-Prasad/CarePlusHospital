@extends('layouts.receptionist-dash')

@section('title', 'Receptionist Dashboard')

@section('content')
<div class="container-fluid px-2 px-sm-3 px-md-4">
    <div class="row g-3 g-md-4">
        <div class="col-12 col-md-4 mb-3 mb-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0 fs-6 fs-md-5"><i class="fas fa-user"></i> Receptionist Profile</h5>
                </div>
                <div class="card-body text-center">
                    <i class="fas fa-user-circle fa-4x text-secondary mb-3"></i>
                    <h4 class="fs-5 fs-md-4">{{ $receptionist->name }}</h4>
                    <p class="small">{{ ucfirst($receptionist->role_type) }}<br>{{ $receptionist->email }}<br>{{ $receptionist->phone }}</p>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-md-4 mb-3 mb-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0 fs-6 fs-md-5"><i class="fas fa-calendar"></i> Today's Appointments</h5>
                </div>
                <div class="card-body text-center d-flex flex-column justify-content-center">
                    <h2 class="mb-0 fs-1">{{ $todayAppointments->count() }}</h2>
                    <p class="small mb-0">Scheduled for today</p>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-md-4 mb-3 mb-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0 fs-6 fs-md-5"><i class="fas fa-clock"></i> Recent Bookings</h5>
                </div>
                <div class="card-body text-center d-flex flex-column justify-content-center">
                    <h2 class="mb-0 fs-1">{{ $recentAppointments->count() }}</h2>
                    <p class="small mb-0">Last 10 bookings</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row g-3 g-md-4">
        <div class="col-12 col-md-6 mb-3 mb-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-warning">
                    <h5 class="mb-0 fs-6 fs-md-5"><i class="fas fa-plus"></i> Book New Appointment</h5>
                </div>
                <div class="card-body p-3 p-sm-4">
                    <form method="POST" action="{{ route('receptionist.appointments.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Select Doctor *</label>
                            <select name="doctor_id" id="doctor_id" class="form-select" required>
                                <option value="">Choose doctor...</option>
                                @foreach($doctors as $doctor)
                                    <option value="{{ $doctor->id }}">Dr. {{ $doctor->name }} - {{ $doctor->specialty }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="pa-info" class="mb-3" style="display: none;">
                            <div class="alert alert-info small">
                                <strong>Assigned PA:</strong> <span id="pa-name"></span><br>
                                <strong>Contact:</strong> <span id="pa-phone"></span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Patient Name *</label>
                            <input type="text" name="patient_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Patient Age *</label>
                            <input type="number" name="patient_age" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone Number *</label>
                            <input type="text" name="patient_phone" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Reason for Visit *</label>
                            <textarea name="reason" class="form-control" rows="2" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Appointment Date & Time *</label>
                            <input type="datetime-local" name="appointment_time" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Book Appointment</button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-md-6 mb-3 mb-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0 fs-6 fs-md-5"><i class="fas fa-list"></i> Today's Schedule</h5>
                </div>
                <div class="card-body p-2 p-sm-3">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Time</th>
                                    <th>Patient</th>
                                    <th>Doctor</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($todayAppointments as $appointment)
                                <tr>
                                    <td>{{ $appointment->appointment_time->format('h:i A') }}</td>
                                    <td>{{ $appointment->patient_name }}<br><small>{{ $appointment->patient_phone }}</small></td>
                                    <td>Dr. {{ $appointment->doctor->name }}</td>
                                    <td><span class="badge bg-{{ $appointment->status == 'pending' ? 'warning' : 'success' }}">{{ ucfirst($appointment->status) }}</span></td>
                                </tr>
                                @empty
                                <tr><td colspan="4" class="text-center small">No appointments today.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
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
    
    .form-label {
        font-size: 0.85rem;
    }
    
    .form-control, .form-select {
        font-size: 0.85rem;
        padding: 0.4rem 0.6rem;
    }
    
    .fa-4x {
        font-size: 2.5rem !important;
    }
    
    .alert {
        font-size: 0.8rem;
        padding: 0.6rem;
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
    
    .btn-sm {
        font-size: 0.65rem;
        padding: 0.2rem 0.4rem;
    }
    
    small {
        font-size: 0.65rem;
    }
    
    .form-label {
        font-size: 0.8rem;
    }
    
    .form-control, .form-select {
        font-size: 0.8rem;
        padding: 0.35rem 0.5rem;
    }
    
    .btn-primary {
        font-size: 0.85rem;
        padding: 0.5rem;
    }
}
</style>

@push('scripts')
<script>
    $('#doctor_id').change(function() {
        let doctorId = $(this).val();
        if (doctorId) {
            $.ajax({
                url: '/get-pa/' + doctorId,
                type: 'GET',
                success: function(data) {
                    if (data.success) {
                        $('#pa-name').text(data.pa_name);
                        $('#pa-phone').text(data.pa_phone);
                        $('#pa-info').show();
                    } else {
                        $('#pa-info').hide();
                        alert('No PA assigned to this doctor.');
                    }
                }
            });
        } else {
            $('#pa-info').hide();
        }
    });
</script>
@endpush
@endsection