@extends('layouts.pa-dash')

@section('title', 'Manage Appointments')

@section('content')
<div class="container-fluid px-2 px-sm-3 px-md-4">
    <h2 class="mb-4 fs-3 fs-md-2">All Appointments</h2>
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    
    <div class="card">
        <div class="card-body p-2 p-sm-3 p-md-4">
            <div class="table-responsive">
                <table class="table table-bordered datatable w-100">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Patient</th>
                            <th>Phone</th>
                            <th>Doctor</th>
                            <th>Date & Time</th>
                            <th>Reason</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->appointment_id }}</td>
                            <td>{{ $appointment->patient_name }}</td>
                            <td>{{ $appointment->patient_phone }}</td>
                            <td>Dr. {{ $appointment->doctor->name ?? 'N/A' }}</td>
                            <td>{{ $appointment->appointment_time->format('M d, Y h:i A') }}</td>
                            <td>{{ Str::limit($appointment->reason, 50) }}</td>
                            <td>
                                @if($appointment->status == 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @elseif($appointment->status == 'confirmed')
                                    <span class="badge bg-info">Confirmed</span>
                                @elseif($appointment->status == 'completed')
                                    <span class="badge bg-success">Completed</span>
                                @else
                                    <span class="badge bg-danger">Cancelled</span>
                                @endif
                            </td>
                            <td>
                                @if($appointment->status != 'completed' && $appointment->status != 'cancelled')
                                    <form method="POST" action="{{ route('pa.appointments.status', $appointment->id) }}" class="d-inline">
                                        @csrf 
                                        @method('PATCH')
                                        <select name="status" class="form-select form-select-sm" onchange="this.form.submit()" style="min-width: 95px;">
                                            <option value="pending" {{ $appointment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="confirmed" {{ $appointment->status == 'confirmed' ? 'selected' : '' }}>Confirm</option>
                                            <option value="cancelled" {{ $appointment->status == 'cancelled' ? 'selected' : '' }}>Cancel</option>
                                            <option value="completed">Done</option>
                                        </select>
                                    </form>
                                @elseif($appointment->status == 'completed')
                                    <span class="badge bg-success">✅ Completed</span>
                                @elseif($appointment->status == 'cancelled')
                                    <span class="badge bg-danger">❌ Cancelled</span>
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
        font-size: 0.75rem;
        padding: 0.5rem !important;
    }
    
    .badge {
        font-size: 0.65rem;
        padding: 0.25rem 0.5rem;
    }
    
    .form-select-sm {
        font-size: 0.65rem;
        padding: 0.25rem 0.5rem;
        min-width: 80px !important;
    }
}

@media (max-width: 576px) {
    td, th {
        font-size: 0.65rem;
        padding: 0.35rem !important;
    }
    
    .badge {
        font-size: 0.6rem;
        padding: 0.2rem 0.35rem;
    }
    
    .form-select-sm {
        font-size: 0.6rem;
        padding: 0.2rem 0.3rem;
        min-width: 70px !important;
    }
    
    .table-bordered td, .table-bordered th {
        white-space: normal;
        word-break: break-word;
    }
}
</style>
@endsection