@extends('layouts.admin-dash')

@section('title', 'Manage Services')

@section('content')
<div class="container-fluid px-2 px-sm-3 px-md-4">
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-4 gap-3">
        <h2 class="mb-0 fs-4 fs-sm-3">Manage Services</h2>
        <button type="button" class="btn btn-primary w-100 w-sm-auto" data-bs-toggle="modal" data-bs-target="#addServiceModal">
            <i class="fas fa-plus"></i> Add New Service
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
                            <th>Name</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($services as $service)
                        <tr>
                            <td class="align-middle">{{ $service->name }}</td>
                            <td class="align-middle">{{ Str::limit($service->description, 50) }}</td>
                            <td class="align-middle"><span class="badge bg-info">{{ ucfirst($service->category) }}</span></td>
                            <td class="align-middle">
                                <span class="badge bg-{{ $service->status ? 'success' : 'danger' }}">
                                    {{ $service->status ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="align-middle">
                                <div class="d-flex flex-wrap gap-1">
                                    <button type="button" class="btn btn-sm btn-warning edit-service-btn" 
                                            data-id="{{ $service->id }}"
                                            data-name="{{ $service->name }}"
                                            data-description="{{ $service->description }}"
                                            data-category="{{ $service->category }}"
                                            data-status="{{ $service->status }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <form action="{{ route('admin.services.delete', $service->id) }}" method="POST" class="d-inline delete-form" onsubmit="return confirm('Are you sure you want to delete this service?')">
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

<!-- Add Service Modal - Fixed (Pure PHP) -->
<div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.services.store') }}">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="addServiceModalLabel">
                        <i class="fas fa-concierge-bell me-2"></i>Add New Service
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Name *</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Description *</label>
                            <textarea name="description" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Category *</label>
                            <select name="category" class="form-select" required>
                                <option value="diagnostic">Diagnostic</option>
                                <option value="clinical">Clinical</option>
                                <option value="support">Support</option>
                                <option value="facility">Facility</option>
                            </select>
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
                    <button type="submit" class="btn btn-primary">Save Service</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Service Modal - Fixed (Pure PHP) -->
<div class="modal fade" id="editServiceModal" tabindex="-1" aria-labelledby="editServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <form method="POST" id="editServiceForm">
                @csrf
                @method('PUT')
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="editServiceModalLabel">
                        <i class="fas fa-edit me-2"></i>Edit Service
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Name *</label>
                            <input type="text" name="name" id="edit_name" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Description *</label>
                            <textarea name="description" id="edit_description" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Category *</label>
                            <select name="category" id="edit_category" class="form-select" required>
                                <option value="diagnostic">Diagnostic</option>
                                <option value="clinical">Clinical</option>
                                <option value="support">Support</option>
                                <option value="facility">Facility</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input type="checkbox" name="status" id="edit_status" class="form-check-input" value="1">
                                <label class="form-check-label">Active Status</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning">Update Service</button>
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
    // Edit Service Button Click - Fill form data
    $('.edit-service-btn').click(function() {
        let id = $(this).data('id');
        let name = $(this).data('name');
        let description = $(this).data('description');
        let category = $(this).data('category');
        let status = $(this).data('status');
        
        $('#edit_name').val(name);
        $('#edit_description').val(description);
        $('#edit_category').val(category);
        
        if (status == 1) {
            $('#edit_status').prop('checked', true);
        } else {
            $('#edit_status').prop('checked', false);
        }
        
        $('#editServiceForm').attr('action', '/admin/services/' + id);
        $('#editServiceModal').modal('show');
    });
    
    // Modal cleanup to prevent black screen
    $('#addServiceModal, #editServiceModal').on('hidden.bs.modal', function() {
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open');
        $('body').css('padding-right', '');
    });
});
</script>
@endpush