@extends('layouts.admin-dash')

@section('title', 'Manage Patients')

@section('content')
<div class="container-fluid px-2 px-sm-3 px-md-4">
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-4 gap-3">
        <h2 class="mb-0 fs-4 fs-sm-3">Manage Patients</h2>
        <button type="button" class="btn btn-primary w-100 w-sm-auto" data-bs-toggle="modal" data-bs-target="#addPatientModal">
            <i class="fas fa-plus"></i> Add New Patient
        </button>
    </div>
    
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
                            <th>Name</th>
                            <th>Age</th>
                            <th class="d-none d-md-table-cell">Gender</th>
                            <th>Phone</th>
                            <th class="d-none d-lg-table-cell">Blood Group</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($patients as $patient)
                        <tr>
                            <td class="align-middle">{{ $patient->patient_id }}</td>
                            <td class="align-middle">{{ $patient->name }}</td>
                            <td class="align-middle">{{ $patient->age }}</td>
                            <td class="align-middle d-none d-md-table-cell">{{ ucfirst($patient->gender) }}</td>
                            <td class="align-middle">{{ $patient->phone }}</td>
                            <td class="align-middle d-none d-lg-table-cell">{{ $patient->blood_group ?? 'N/A' }}</td>
                            <td class="align-middle">
                                <div class="d-flex flex-wrap gap-1">
                                    <button type="button" class="btn btn-sm btn-warning edit-patient-btn" 
                                            data-id="{{ $patient->id }}"
                                            data-patient_id="{{ $patient->patient_id }}"
                                            data-name="{{ $patient->name }}"
                                            data-age="{{ $patient->age }}"
                                            data-gender="{{ $patient->gender }}"
                                            data-phone="{{ $patient->phone }}"
                                            data-email="{{ $patient->email }}"
                                            data-blood_group="{{ $patient->blood_group }}"
                                            data-emergency_contact="{{ $patient->emergency_contact }}"
                                            data-address="{{ $patient->address }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <form action="{{ route('admin.patients.delete', $patient->id) }}" method="POST" class="d-inline delete-form" onsubmit="return confirm('Are you sure you want to delete this patient?')">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Patient Modal -->
<div class="modal fade" id="addPatientModal" tabindex="-1" aria-labelledby="addPatientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.patients.store') }}">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="addPatientModalLabel">
                        <i class="fas fa-user-plus me-2"></i>Add New Patient
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Name *</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Age *</label>
                            <input type="number" name="age" class="form-control" required min="0" max="150">
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Gender *</label>
                            <select name="gender" class="form-select" required>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Phone *</label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control">
                            {{-- <small class="text-muted">Optional, for patient login</small> --}}
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control">
                            {{-- <small class="text-muted">Required if email provided</small> --}}
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Blood Group</label>
                            <select name="blood_group" class="form-select">
                                <option value="">Select Blood Group</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                            </select>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Emergency Contact *</label>
                            <input type="text" name="emergency_contact" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Address *</label>
                            <textarea name="address" class="form-control" rows="2" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Patient</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Patient Modal -->
<div class="modal fade" id="editPatientModal" tabindex="-1" aria-labelledby="editPatientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <form method="POST" id="editPatientForm">
                @csrf
                @method('PUT')
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="editPatientModalLabel">
                        <i class="fas fa-user-edit me-2"></i>Edit Patient
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Patient ID</label>
                            <input type="text" name="patient_id" id="edit_patient_id" class="form-control" readonly>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Name *</label>
                            <input type="text" name="name" id="edit_name" class="form-control" required>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Age *</label>
                            <input type="number" name="age" id="edit_age" class="form-control" required>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Gender *</label>
                            <select name="gender" id="edit_gender" class="form-select" required>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Phone *</label>
                            <input type="text" name="phone" id="edit_phone" class="form-control" required>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" id="edit_email" class="form-control">
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Blood Group</label>
                            <select name="blood_group" id="edit_blood_group" class="form-select">
                                <option value="">Select Blood Group</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                            </select>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Emergency Contact *</label>
                            <input type="text" name="emergency_contact" id="edit_emergency_contact" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Address *</label>
                            <textarea name="address" id="edit_address" class="form-control" rows="2" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning">Update Patient</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
@media (max-width: 768px) {
    .card-header h5 { font-size: 0.9rem !important; }
    .card-body { padding: 1rem !important; }
    .btn-sm { font-size: 0.7rem; padding: 0.25rem 0.5rem; }
    .form-label { font-size: 0.85rem; }
    .form-control, .form-select { font-size: 0.85rem; padding: 0.4rem 0.6rem; }
}

@media (max-width: 576px) {
    .modal-body { padding: 1rem; }
    .modal-title { font-size: 1rem; }
    .modal-footer { padding: 0.75rem; }
    .modal-footer .btn { font-size: 0.85rem; padding: 0.35rem 0.75rem; }
}

/* Modal z-index fix */
.modal {
    z-index: 1060 !important;
}
.modal-backdrop {
    z-index: 1050 !important;
}
.modal-backdrop.show {
    opacity: 0.5 !important;
}
body.modal-open {
    overflow: hidden !important;
    padding-right: 0 !important;
}
</style>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Edit Patient Button Click - Fill form data
    $('.edit-patient-btn').click(function() {
        let id = $(this).data('id');
        let patient_id = $(this).data('patient_id');
        let name = $(this).data('name');
        let age = $(this).data('age');
        let gender = $(this).data('gender');
        let phone = $(this).data('phone');
        let email = $(this).data('email');
        let blood_group = $(this).data('blood_group');
        let emergency_contact = $(this).data('emergency_contact');
        let address = $(this).data('address');
        
        $('#edit_patient_id').val(patient_id);
        $('#edit_name').val(name);
        $('#edit_age').val(age);
        $('#edit_gender').val(gender);
        $('#edit_phone').val(phone);
        $('#edit_email').val(email || '');
        $('#edit_blood_group').val(blood_group || '');
        $('#edit_emergency_contact').val(emergency_contact);
        $('#edit_address').val(address);
        
        $('#editPatientForm').attr('action', '/admin/patients/' + id);
        $('#editPatientModal').modal('show');
    });
    
    // Modal cleanup to prevent black screen
    $('#addPatientModal, #editPatientModal').on('hidden.bs.modal', function() {
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open');
        $('body').css('padding-right', '');
    });
});
</script>
@endpush