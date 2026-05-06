@extends('layouts.doctor-dash')

@section('title', 'Appointments')

@section('content')
<div class="container-fluid px-2 px-sm-3 px-md-4">
    <h2 class="mb-4 fs-3 fs-md-2">Appointments</h2>
    
    <div class="card">
        <div class="card-body p-2 p-sm-3 p-md-4">
            <div class="table-responsive">
                <table class="table table-bordered datatable w-100">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Patient Name</th>
                            <th>Patient Phone</th>
                            <th>Date & Time</th>
                            <th>Reason</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->appointment_id }}</td>
                            <td>{{ $appointment->patient_name }}</td>
                            <td>{{ $appointment->patient_phone }}</td>
                            <td>{{ $appointment->appointment_time->format('M d, Y h:i A') }}</td>
                            <td>{{ Str::limit($appointment->reason, 50) }}</td>
                            <td>
                                <span class="badge bg-{{ $appointment->status == 'pending' ? 'warning' : ($appointment->status == 'confirmed' ? 'info' : ($appointment->status == 'completed' ? 'success' : 'danger')) }}">
                                    {{ ucfirst($appointment->status) }}
                                </span>
                            </td>
                            <td>
                                <form method="POST" action="{{ route('doctor.appointments.status', $appointment->id) }}" class="d-inline">
                                    @csrf @method('PATCH')
                                    <select name="status" class="form-select form-select-sm d-inline-block w-auto" onchange="this.form.submit()" style="min-width: 100px;">
                                        <option value="pending" {{ $appointment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="confirmed" {{ $appointment->status == 'confirmed' ? 'selected' : '' }}>Confirm</option>
                                        <option value="completed" {{ $appointment->status == 'completed' ? 'selected' : '' }}>Complete</option>
                                        <option value="cancelled" {{ $appointment->status == 'cancelled' ? 'selected' : '' }}>Cancel</option>
                                    </select>
                                </form>
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
    
    .form-select-sm {
        min-width: 85px !important;
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
    }
    
    td, th {
        font-size: 0.85rem;
        padding: 0.5rem !important;
    }
}

@media (max-width: 576px) {
    td, th {
        font-size: 0.75rem;
        padding: 0.4rem !important;
    }
    
    .badge {
        font-size: 0.7rem;
        padding: 0.2rem 0.4rem;
    }
}
</style>
@endsection