@extends('layouts.manager-dash')

@section('title', 'Manage Rooms')

@section('content')
<div class="container-fluid px-2 px-sm-3 px-md-4">
    <h2 class="mb-4 fs-3 fs-md-2">Manage Rooms</h2>
    
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
                            <th>Room #</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Floor</th>
                            <th>Capacity</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rooms as $room)
                        <tr>
                            <td class="align-middle">{{ $room->room_number }}</td>
                            <td class="align-middle">{{ $room->name }}</td>
                            <td class="align-middle">{{ str_replace('_', ' ', ucfirst($room->type)) }}</td>
                            <td class="align-middle">{{ $room->floor }}</td>
                            <td class="align-middle">{{ $room->capacity }}</td>
                            <td class="align-middle">
                                <span class="badge bg-{{ $room->status == 'available' ? 'success' : ($room->status == 'occupied' ? 'danger' : 'warning') }}">
                                    {{ ucfirst($room->status) }}
                                </span>
                            </td>
                            <td class="align-middle">
                                <button type="button" class="btn btn-sm btn-warning edit-room-btn" 
                                        data-id="{{ $room->id }}" 
                                        data-name="{{ $room->name }}" 
                                        data-floor="{{ $room->floor }}" 
                                        data-capacity="{{ $room->capacity }}" 
                                        data-status="{{ $room->status }}">
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

<!-- Edit Room Modal -->
<div class="modal fade" id="editRoomModal" tabindex="-1" aria-labelledby="editRoomModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <form method="POST" id="editRoomForm">
                @csrf 
                @method('PUT')
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="editRoomModalLabel">
                        <i class="fas fa-edit me-2"></i>Edit Room
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Room Name *</label>
                        <input type="text" name="name" id="edit_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Floor *</label>
                        <input type="number" name="floor" id="edit_floor" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Capacity *</label>
                        <input type="number" name="capacity" id="edit_capacity" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status *</label>
                        <select name="status" id="edit_status" class="form-select" required>
                            <option value="available">Available</option>
                            <option value="occupied">Occupied</option>
                            <option value="maintenance">Maintenance</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning">Update Room</button>
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
    $('.edit-room-btn').on('click', function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var floor = $(this).data('floor');
        var capacity = $(this).data('capacity');
        var status = $(this).data('status');
        
        $('#edit_name').val(name);
        $('#edit_floor').val(floor);
        $('#edit_capacity').val(capacity);
        $('#edit_status').val(status);
        $('#editRoomForm').attr('action', '/manager/rooms/' + id);
        $('#editRoomModal').modal('show');
    });
    
    $('#editRoomModal').on('hidden.bs.modal', function() {
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open');
        $('body').css('padding-right', '');
    });
});
</script>
@endpush