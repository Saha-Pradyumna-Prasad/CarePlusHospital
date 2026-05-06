@extends('layouts.receptionist-dash')

@section('title', 'Manage Appointments')

@section('content')
<div class="container-fluid px-2 px-sm-3 px-md-4">
    <h2 class="mb-4 fs-3 fs-md-2">All Appointments</h2>
    
    <div class="card">
        <div class="card-body p-2 p-sm-3 p-md-4">
            <div class="table-responsive">
                <table class="table table-bordered datatable w-100">
                    <thead>
                        <tr>
                            <th>Ref ID</th>
                            <th>Patient Name</th>
                            <th>Doctor Name</th>
                            <th>PA Name</th>
                            <th>Date & Time</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->appointment_id }}</td>
                            <td>{{ $appointment->patient_name }}<br><small>{{ $appointment->patient_phone }}</small></td>
                            <td>Dr. {{ $appointment->doctor->name }}</td>
                            <td>{{ $appointment->pa->name }}</td>
                            <td>{{ $appointment->appointment_time->format('M d, Y h:i A') }}</td>
                            <td>
                                <span class="badge bg-{{ $appointment->status == 'pending' ? 'warning' : ($appointment->status == 'confirmed' ? 'info' : ($appointment->status == 'completed' ? 'success' : 'danger')) }}">
                                    {{ ucfirst($appointment->status) }}
                                </span>
                            </td>
                            <td>
                                @if($appointment->status != 'cancelled')
                                    <form action="{{ route('receptionist.appointments.cancel', $appointment->id) }}" method="POST" class="d-inline delete-form">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger w-100 w-sm-auto">Cancel</button>
                                    </form>
                                @endif
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
    
    .btn-sm {
        font-size: 0.7rem;
        padding: 0.25rem 0.5rem;
    }
    
    .badge {
        font-size: 0.7rem;
        padding: 0.25rem 0.5rem;
    }
    
    small {
        font-size: 0.7rem;
    }
}

@media (max-width: 576px) {
    td, th {
        font-size: 0.7rem;
        padding: 0.4rem !important;
    }
    
    .btn-sm {
        font-size: 0.65rem;
        padding: 0.2rem 0.4rem;
    }
    
    .badge {
        font-size: 0.65rem;
        padding: 0.2rem 0.35rem;
    }
    
    small {
        font-size: 0.6rem;
    }
}
</style>
@endsection