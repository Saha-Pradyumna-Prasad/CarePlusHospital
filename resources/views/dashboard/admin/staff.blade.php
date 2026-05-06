@extends('layouts.admin-dash')

@section('title', 'Manage Staff')

@section('content')
<div class="container-fluid px-2 px-sm-3 px-md-4">
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-4 gap-3">
        <h2 class="mb-0 fs-4 fs-sm-3">Manage Staff</h2>
        <button type="button" class="btn btn-primary w-100 w-sm-auto" data-bs-toggle="modal" data-bs-target="#addStaffModal">
            <i class="fas fa-plus"></i> Add New Staff
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
                            <th>Role</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($staff as $member)
                        <tr>
                            <td class="align-middle">{{ $member->staff_id }}</td>
                            <td class="text-center align-middle">
                                @if($member->photo)
                                    <img src="{{ asset('storage/' . $member->photo) }}" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                                @else
                                    <i class="fas fa-user fa-2x text-secondary"></i>
                                @endif
                            </td>
                            <td class="align-middle">{{ $member->name }}</td>
                            <td class="align-middle"><span class="badge bg-info">{{ ucfirst($member->role_type) }}</span></td>
                            <td class="align-middle">{{ $member->email }}</td>
                            <td class="align-middle">{{ $member->phone }}</td>
                            <td class="align-middle">
                                <span class="badge bg-{{ $member->status ? 'success' : 'danger' }}">
                                    {{ $member->status ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="align-middle">
                                <div class="d-flex flex-wrap gap-1">
                                    <button type="button" class="btn btn-sm btn-warning edit-staff-btn" 
                                            data-id="{{ $member->id }}"
                                            data-name="{{ $member->name }}"
                                            data-email="{{ $member->email }}"
                                            data-phone="{{ $member->phone }}"
                                            data-role_type="{{ $member->role_type }}"
                                            data-status="{{ $member->status }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <form action="{{ route('admin.staff.delete', $member->id) }}" method="POST" class="d-inline delete-form">
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

<!-- Add Staff Modal -->
<div class="modal fade" id="addStaffModal" tabindex="-1" aria-labelledby="addStaffModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.staff.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="addStaffModalLabel">
                        <i class="fas fa-user-plus me-2"></i>Add New Staff
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Name *</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email *</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password *</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone *</label>
                        <input type="text" name="phone" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Role *</label>
                        <select name="role_type" class="form-select" required>
                            <option value="receptionist">Receptionist</option>
                            <option value="lab_tester">Lab Tester</option>
                            <option value="manager">Manager</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Photo</label>
                        <input type="file" name="photo" class="form-control" accept="image/*">
                        <small class="text-muted">Max 2MB, JPG/PNG only</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Staff</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Staff Modal -->
<div class="modal fade" id="editStaffModal" tabindex="-1" aria-labelledby="editStaffModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <form method="POST" id="editStaffForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="editStaffModalLabel">
                        <i class="fas fa-user-edit me-2"></i>Edit Staff
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Name *</label>
                        <input type="text" name="name" id="edit_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" id="edit_email" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone *</label>
                        <input type="text" name="phone" id="edit_phone" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Role *</label>
                        <select name="role_type" id="edit_role_type" class="form-select" required>
                            <option value="receptionist">Receptionist</option>
                            <option value="lab_tester">Lab Tester</option>
                            <option value="manager">Manager</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">New Photo</label>
                        <input type="file" name="photo" class="form-control" accept="image/*">
                        <small class="text-muted">Leave empty to keep current photo</small>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input type="checkbox" name="status" id="edit_status" class="form-check-input" value="1">
                            <label class="form-check-label">Active Status</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning">Update Staff</button>
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
    // Edit Staff Button Click
    $('.edit-staff-btn').click(function() {
        let id = $(this).data('id');
        let name = $(this).data('name');
        let email = $(this).data('email');
        let phone = $(this).data('phone');
        let role_type = $(this).data('role_type');
        let status = $(this).data('status');
        
        $('#edit_name').val(name);
        $('#edit_email').val(email);
        $('#edit_phone').val(phone);
        $('#edit_role_type').val(role_type);
        
        if (status == 1) {
            $('#edit_status').prop('checked', true);
        } else {
            $('#edit_status').prop('checked', false);
        }
        
        $('#editStaffForm').attr('action', '{{ url("admin/staff") }}/' + id);
        $('#editStaffModal').modal('show');
    });
    
    // Delete Staff Confirmation
    $('.delete-form').on('submit', function(e) {
        e.preventDefault();
        let form = $(this);
        
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
    
    // Modal cleanup to prevent black screen
    $('#addStaffModal, #editStaffModal').on('hidden.bs.modal', function() {
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open');
        $('body').css('padding-right', '');
    });
});
</script>
@endpush