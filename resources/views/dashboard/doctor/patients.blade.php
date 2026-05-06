@extends('layouts.doctor-dash')

@section('title', 'My Patients')

@section('content')
<div class="container-fluid px-2 px-sm-3 px-md-4">
    <h2 class="mb-4 fs-3 fs-md-2">My Patients</h2>
    
    <div class="card">
        <div class="card-body p-2 p-sm-3 p-md-4">
            <div class="table-responsive">
                <table class="table table-bordered datatable w-100">
                    <thead>
                        <tr>
                            <th>Patient ID</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Phone</th>
                            <th>Blood Group</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($patients as $patient)
                        <tr>
                            <td>{{ $patient->patient_id }}</td>
                            <td>{{ $patient->name }}</td>
                            <td>{{ $patient->age }}</td>
                            <td>{{ ucfirst($patient->gender) }}</td>
                            <td>{{ $patient->phone }}</td>
                            <td>{{ $patient->blood_group ?? 'N/A' }}</td>
                            <td>
                                <button class="btn btn-sm btn-primary w-100 w-sm-auto" data-bs-toggle="modal" data-bs-target="#reportModal{{ $patient->id }}">
                                    <i class="fas fa-file-medical"></i> Add Report
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@foreach($patients as $patient)
<!-- Report Modal -->
<div class="modal fade" id="reportModal{{ $patient->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <form method="POST" action="{{ route('doctor.reports.store') }}">
                @csrf
                <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fs-6 fs-md-5">Add Medical Report for {{ $patient->name }}</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Report Title *</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Report Type *</label>
                        <select name="type" class="form-select" required>
                            <option value="diagnosis">Diagnosis</option>
                            <option value="discharge">Discharge Summary</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Report Content *</label>
                        <textarea name="content" class="form-control" rows="6" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Report</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

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
    
    .btn-sm i {
        font-size: 0.7rem;
    }
    
    .modal-body {
        padding: 1rem;
    }
    
    .modal-title {
        font-size: 1rem;
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
    
    .form-label {
        font-size: 0.85rem;
    }
    
    .form-control, .form-select {
        font-size: 0.85rem;
        padding: 0.4rem 0.6rem;
    }
    
    .modal-footer {
        padding: 0.75rem;
    }
    
    .modal-footer .btn {
        font-size: 0.85rem;
        padding: 0.35rem 0.75rem;
    }
}
</style>
@endsection