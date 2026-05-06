@extends('layouts.admin-dash')

@section('title', 'Manage Doctors')

@section('content')
<div class="container-fluid px-2 px-sm-3 px-md-4">
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-4 gap-3">
        <h2 class="mb-0 fs-4 fs-sm-3">Manage Doctors</h2>
        <button type="button" class="btn btn-primary w-100 w-sm-auto" data-bs-toggle="modal" data-bs-target="#addDoctorModal">
            <i class="fas fa-plus"></i> Add New Doctor
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
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Specialty</th>
                            <th class="d-none d-md-table-cell">Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($doctors as $doctor)
                        <tr>
                            <td class="align-middle">{{ $doctor->doctor_id }}</td>
                            <td class="text-center align-middle">
                                @if($doctor->photo)
                                    <img src="{{ asset('storage/' . $doctor->photo) }}" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                                @else
                                    <i class="fas fa-user-md fa-2x text-secondary"></i>
                                @endif
                            </td>
                            <td class="align-middle">Dr. {{ $doctor->name }}</td>
                            <td class="align-middle">{{ $doctor->specialty }}</td>
                            <td class="align-middle d-none d-md-table-cell">{{ $doctor->email }}</td>
                            <td class="align-middle">{{ $doctor->phone }}</td>
                            <td class="align-middle">
                                @if($doctor->status)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td class="align-middle">
                                <div class="d-flex flex-wrap gap-1">
                                    <button type="button" class="btn btn-sm btn-warning edit-doctor-btn" 
                                            data-id="{{ $doctor->id }}"
                                            data-name="{{ $doctor->name }}"
                                            data-designation="{{ $doctor->designation }}"
                                            data-specialty="{{ $doctor->specialty }}"
                                            data-degree="{{ $doctor->degree }}"
                                            data-email="{{ $doctor->email }}"
                                            data-phone="{{ $doctor->phone }}"
                                            data-status="{{ $doctor->status }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    
                                    <form action="{{ route('admin.doctors.delete', $doctor->id) }}" method="POST" class="d-inline delete-form" onsubmit="return confirm('Are you sure you want to delete this doctor?')">
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

<!-- Add Doctor Modal - Pure PHP (No AJAX) -->
<div class="modal fade" id="addDoctorModal" tabindex="-1" aria-labelledby="addDoctorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.doctors.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="addDoctorModalLabel">
                        <i class="fas fa-user-md me-2"></i>Add New Doctor
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Full Name *</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Email *</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Password *</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Phone *</label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Designation *</label>
                            <input type="text" name="designation" class="form-control" required>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Specialty *</label>
                            <input type="text" name="specialty" class="form-control" required>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Degree *</label>
                            <input type="text" name="degree" class="form-control" required>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Photo</label>
                            <input type="file" name="photo" class="form-control" accept="image/*">
                            <small class="text-muted">Max 2MB, JPG/PNG only</small>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input type="checkbox" name="status" class="form-check-input" value="1" checked>
                                <label class="form-check-label">Active</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Doctor</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Doctor Modal - Pure PHP (No AJAX) -->
<div class="modal fade" id="editDoctorModal" tabindex="-1" aria-labelledby="editDoctorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <form method="POST" id="editDoctorForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="editDoctorModalLabel">
                        <i class="fas fa-edit me-2"></i>Edit Doctor
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Full Name *</label>
                            <input type="text" name="name" id="edit_name" class="form-control" required>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Email</label>
                            <input type="email" id="edit_email" class="form-control" readonly>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Phone *</label>
                            <input type="text" name="phone" id="edit_phone" class="form-control" required>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Designation *</label>
                            <input type="text" name="designation" id="edit_designation" class="form-control" required>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Specialty *</label>
                            <input type="text" name="specialty" id="edit_specialty" class="form-control" required>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Degree *</label>
                            <input type="text" name="degree" id="edit_degree" class="form-control" required>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">New Photo</label>
                            <input type="file" name="photo" class="form-control" accept="image/*">
                            <small class="text-muted">Leave empty to keep current photo</small>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-check mt-4">
                                <input type="checkbox" name="status" id="edit_status" class="form-check-input" value="1">
                                <label class="form-check-label">Active Status</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning">Update Doctor</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
@media (max-width: 768px) {
    .modal-body {
        padding: 1rem;
    }
    .modal-title {
        font-size: 1rem;
    }
    .modal-footer {
        padding: 0.75rem;
    }
    .modal-footer .btn {
        font-size: 0.85rem;
        padding: 0.35rem 0.75rem;
    }
}

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
    // Edit Doctor Button Click - Fill form data
    $('.edit-doctor-btn').click(function() {
        let id = $(this).data('id');
        let name = $(this).data('name');
        let email = $(this).data('email');
        let phone = $(this).data('phone');
        let designation = $(this).data('designation');
        let specialty = $(this).data('specialty');
        let degree = $(this).data('degree');
        let status = $(this).data('status');
        
        $('#editDoctorForm').attr('action', '/admin/doctors/' + id);
        
        $('#edit_name').val(name);
        $('#edit_email').val(email);
        $('#edit_phone').val(phone);
        $('#edit_designation').val(designation);
        $('#edit_specialty').val(specialty);
        $('#edit_degree').val(degree);
        
        if (status == 1) {
            $('#edit_status').prop('checked', true);
        } else {
            $('#edit_status').prop('checked', false);
        }
        
        $('#editDoctorModal').modal('show');
    });
    
    // Modal cleanup to prevent black screen
    $('#addDoctorModal, #editDoctorModal').on('hidden.bs.modal', function() {
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open');
        $('body').css('padding-right', '');
    });
});
</script>
@endpush