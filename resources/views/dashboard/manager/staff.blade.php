@extends('layouts.manager-dash')

@section('title', 'Manage Staff')

@section('content')
<div class="container-fluid px-2 px-sm-3 px-md-4">
    <h2 class="mb-4 fs-3 fs-md-2">Manage Staff</h2>
    
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
                                <button type="button" class="btn btn-sm btn-warning edit-staff-btn" 
                                        data-id="{{ $member->id }}" 
                                        data-name="{{ $member->name }}" 
                                        data-phone="{{ $member->phone }}" 
                                        data-status="{{ $member->status }}">
                                    <i class="fas fa-edit"></i> Edit
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

<!-- Edit Staff Modal -->
<div class="modal fade" id="editStaffModal" tabindex="-1" aria-labelledby="editStaffModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <form method="POST" id="editStaffForm">
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
                        <label class="form-label">Phone *</label>
                        <input type="text" name="phone" id="edit_phone" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status *</label>
                        <select name="status" id="edit_status" class="form-select" required>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
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
    .table-responsive { margin-bottom: 0; }
    td, th { font-size: 0.85rem; padding: 0.5rem !important; }
    .btn-sm { font-size: 0.7rem; padding: 0.25rem 0.5rem; }
    .badge { font-size: 0.7rem; padding: 0.25rem 0.5rem; }
    .modal-body { padding: 1rem; }
    .modal-title { font-size: 1rem; }
    .modal-footer { padding: 0.75rem; }
    .modal-footer .btn { font-size: 0.85rem; padding: 0.35rem 0.75rem; }
}

@media (max-width: 576px) {
    td, th { font-size: 0.7rem; padding: 0.4rem !important; }
    .btn-sm { font-size: 0.65rem; padding: 0.2rem 0.4rem; }
    .badge { font-size: 0.65rem; padding: 0.2rem 0.35rem; }
    .form-label { font-size: 0.85rem; }
    .form-control, .form-select { font-size: 0.85rem; padding: 0.4rem 0.6rem; }
}

.modal { z-index: 1060 !important; }
.modal-backdrop { z-index: 1050 !important; }
.modal-backdrop.show { opacity: 0.5 !important; }
body.modal-open { overflow: hidden !important; padding-right: 0 !important; }
</style>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('.edit-staff-btn').on('click', function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var phone = $(this).data('phone');
        var status = $(this).data('status');
        
        $('#edit_name').val(name);
        $('#edit_phone').val(phone);
        $('#edit_status').val(status);
        $('#editStaffForm').attr('action', '/manager/staff/' + id);
        $('#editStaffModal').modal('show');
    });
    
    $('#editStaffModal').on('hidden.bs.modal', function() {
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open');
        $('body').css('padding-right', '');
    });
});
</script>
@endpush