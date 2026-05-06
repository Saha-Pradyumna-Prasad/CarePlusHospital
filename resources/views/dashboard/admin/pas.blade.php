@extends('layouts.admin-dash')

@section('title', 'Manage PAs')

@section('content')
<div class="container-fluid px-2 px-sm-3 px-md-4">
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-4 gap-3">
        <h2 class="mb-0 fs-4 fs-sm-3">Manage Physician Assistants</h2>
        <button type="button" class="btn btn-primary w-100 w-sm-auto" data-bs-toggle="modal" data-bs-target="#addPAModal">
            <i class="fas fa-plus"></i> Add New PA
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
                            <th class="d-none d-md-table-cell">Email</th>
                            <th>Phone</th>
                            <th>Doctor</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pas as $pa)
                        <tr>
                            <td class="align-middle">{{ $pa->pa_id }}</td>
                            <td class="text-center align-middle">
                                @if($pa->photo)
                                    <img src="{{ asset('storage/' . $pa->photo) }}" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                                @else
                                    <i class="fas fa-user-nurse fa-2x text-secondary"></i>
                                @endif
                            </td>
                            <td class="align-middle">{{ $pa->name }}</td>
                            <td class="align-middle d-none d-md-table-cell">{{ $pa->email }}</td>
                            <td class="align-middle">{{ $pa->phone }}</td>
                            <td class="align-middle">{{ $pa->doctor->name ?? 'N/A' }}</td>
                            <td class="align-middle">
                                <span class="badge bg-{{ $pa->status ? 'success' : 'danger' }}">
                                    {{ $pa->status ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="align-middle">
                                <div class="d-flex flex-wrap gap-1">
                                    <button type="button" class="btn btn-sm btn-warning edit-pa-btn" 
                                            data-id="{{ $pa->id }}"
                                            data-name="{{ $pa->name }}"
                                            data-email="{{ $pa->email }}"
                                            data-phone="{{ $pa->phone }}"
                                            data-doctor_id="{{ $pa->doctor_id }}"
                                            data-status="{{ $pa->status }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <form action="{{ route('admin.pas.delete', $pa->id) }}" method="POST" class="d-inline delete-form" onsubmit="return confirm('Are you sure you want to delete this PA?')">
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

<!-- Add PA Modal - Fixed (Pure PHP) -->
<div class="modal fade" id="addPAModal" tabindex="-1" aria-labelledby="addPAModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.pas.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="addPAModalLabel">
                        <i class="fas fa-user-nurse me-2"></i>Add New PA
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
                            <label class="form-label">Assign Doctor *</label>
                            <select name="doctor_id" class="form-select" required>
                                <option value="">Select Doctor</option>
                                @foreach($doctors as $doctor)
                                    <option value="{{ $doctor->id }}">Dr. {{ $doctor->name }} ({{ $doctor->specialty }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Photo</label>
                            <input type="file" name="photo" class="form-control" accept="image/*">
                            <small class="text-muted">Max 2MB, JPG/PNG only</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save PA</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit PA Modal - Fixed (Pure PHP) -->
<div class="modal fade" id="editPAModal" tabindex="-1" aria-labelledby="editPAModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <form method="POST" id="editPAForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="editPAModalLabel">
                        <i class="fas fa-edit me-2"></i>Edit PA
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Name *</label>
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
                            <label class="form-label">Assign Doctor *</label>
                            <select name="doctor_id" id="edit_doctor_id" class="form-select" required>
                                <option value="">Select Doctor</option>
                                @foreach($doctors as $doctor)
                                    <option value="{{ $doctor->id }}">Dr. {{ $doctor->name }}</option>
                                @endforeach
                            </select>
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
                    <button type="submit" class="btn btn-warning">Update PA</button>
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
    // Edit PA Button Click - Fill form data
    $('.edit-pa-btn').click(function() {
        let id = $(this).data('id');
        let name = $(this).data('name');
        let email = $(this).data('email');
        let phone = $(this).data('phone');
        let doctor_id = $(this).data('doctor_id');
        let status = $(this).data('status');
        
        $('#edit_name').val(name);
        $('#edit_email').val(email);
        $('#edit_phone').val(phone);
        $('#edit_doctor_id').val(doctor_id);
        
        if (status == 1) {
            $('#edit_status').prop('checked', true);
        } else {
            $('#edit_status').prop('checked', false);
        }
        
        $('#editPAForm').attr('action', '/admin/pas/' + id);
        $('#editPAModal').modal('show');
    });
    
    // Modal cleanup to prevent black screen
    $('#addPAModal, #editPAModal').on('hidden.bs.modal', function() {
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open');
        $('body').css('padding-right', '');
    });
});
</script>
@endpush