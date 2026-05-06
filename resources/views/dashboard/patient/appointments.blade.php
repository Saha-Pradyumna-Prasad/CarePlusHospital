@extends('layouts.patient-dash')

@section('title', 'My Appointments')

@section('content')
<div class="container-fluid px-2 px-sm-3 px-md-4">
    <h2 class="mb-4 fs-3 fs-md-2">My Appointments</h2>
    
    <div class="card">
        <div class="card-body p-2 p-sm-3 p-md-4">
            <div class="table-responsive">
                <table class="table table-bordered datatable w-100">
                    <thead>
                        <tr>
                            <th>Appointment ID</th>
                            <th>Doctor</th>
                            <th>PA</th>
                            <th>Date & Time</th>
                            <th>Reason</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->appointment_id }}</td>
                            <td>Dr. {{ $appointment->doctor->name }}</td>
                            <td>{{ $appointment->pa->name }}</td>
                            <td>{{ $appointment->appointment_time->format('M d, Y h:i A') }}</td>
                            <td>{{ $appointment->reason }}</td>
                            <td>
                                <span class="badge bg-{{ $appointment->status == 'pending' ? 'warning' : ($appointment->status == 'confirmed' ? 'info' : ($appointment->status == 'completed' ? 'success' : 'danger')) }}">
                                    {{ ucfirst($appointment->status) }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
@media (max-width: 768px) {
    .table-responsive {
        margin-bottom: 0;
    }
    
    td, th {
        font-size: 0.85rem;
        padding: 0.5rem !important;
    }
    
    .badge {
        font-size: 0.7rem;
        padding: 0.25rem 0.5rem;
    }
}

@media (max-width: 576px) {
    td, th {
        font-size: 0.7rem;
        padding: 0.4rem !important;
    }
    
    .badge {
        font-size: 0.65rem;
        padding: 0.2rem 0.35rem;
    }
}
</style>
@endsection