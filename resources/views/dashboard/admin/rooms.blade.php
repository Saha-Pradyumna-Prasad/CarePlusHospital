@extends('layouts.admin-dash')

@section('title', 'Manage Rooms')

@section('content')
<div class="container-fluid px-2 px-sm-3 px-md-4">
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-4 gap-3">
        <h2 class="mb-0 fs-4 fs-sm-3">Manage Rooms & Facilities</h2>
        <button type="button" class="btn btn-primary w-100 w-sm-auto" data-bs-toggle="modal" data-bs-target="#addRoomModal">
            <i class="fas fa-plus"></i> Add New Room
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
                            <td class="align-middle">
                                <span class="badge bg-secondary">
                                    {{ str_replace('_', ' ', ucfirst($room->type)) }}
                                </span>
                            </td>
                            <td class="align-middle">{{ $room->floor }}</td>
                            <td class="align-middle">{{ $room->capacity }}</td>
                            <td class="align-middle">
                                @if($room->status == 'available')
                                    <span class="badge bg-success">Available</span>
                                @elseif($room->status == 'occupied')
                                    <span class="badge bg-danger">Occupied</span>
                                @else
                                    <span class="badge bg-warning">Maintenance</span>
                                @endif
                            </td>
                            <td class="align-middle">
                                <div class="d-flex flex-wrap gap-1">
                                    <button type="button" class="btn btn-sm btn-warning edit-room-btn" 
                                            data-id="{{ $room->id }}"
                                            data-room_number="{{ $room->room_number }}"
                                            data-name="{{ $room->name }}"
                                            data-type="{{ $room->type }}"
                                            data-floor="{{ $room->floor }}"
                                            data-capacity="{{ $room->capacity }}"
                                            data-status="{{ $room->status }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <form action="{{ route('admin.rooms.delete', $room->id) }}" method="POST" class="d-inline delete-form" onsubmit="return confirm('Are you sure you want to delete this room?')">
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

<!-- Add Room Modal -->
<div class="modal fade" id="addRoomModal" tabindex="-1" aria-labelledby="addRoomModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.rooms.store') }}">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="addRoomModalLabel">
                        <i class="fas fa-bed me-2"></i>Add New Room
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Room Number *</label>
                            <input type="text" name="room_number" class="form-control" required placeholder="e.g., W-101, DR-201">
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Room Name *</label>
                            <input type="text" name="name" class="form-control" required placeholder="e.g., General Ward A">
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Room Type *</label>
                            <select name="type" class="form-select" required>
                                <option value="">Select Type</option>
                                <option value="patient_ward">Patient Ward</option>
                                <option value="doctor_room">Doctor Room</option>
                                <option value="xray_room">X-Ray Room</option>
                                <option value="ultra_scan_room">Ultrasound Scan Room</option>
                                <option value="icu">ICU</option>
                                <option value="emergency">Emergency</option>
                                <option value="ot">Operation Theatre (O.T.)</option>
                                <option value="reception">Reception</option>
                                <option value="report_room">Report Room</option>
                                <option value="washroom">Washroom</option>
                                <option value="lab_room">Lab Room</option>
                                <option value="canteen">Canteen</option>
                            </select>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Floor *</label>
                            <input type="number" name="floor" class="form-control" required>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Capacity *</label>
                            <input type="number" name="capacity" class="form-control" required>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Status *</label>
                            <select name="status" class="form-select" required>
                                <option value="available">Available</option>
                                <option value="occupied">Occupied</option>
                                <option value="maintenance">Maintenance</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Room</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Room Modal -->
<div class="modal fade" id="editRoomModal" tabindex="-1" aria-labelledby="editRoomModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
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
                    <div class="row g-3">
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Room Number</label>
                            <input type="text" id="edit_room_number" class="form-control" readonly>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Room Name *</label>
                            <input type="text" name="name" id="edit_name" class="form-control" required>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Room Type *</label>
                            <select name="type" id="edit_type" class="form-select" required>
                                <option value="patient_ward">Patient Ward</option>
                                <option value="doctor_room">Doctor Room</option>
                                <option value="xray_room">X-Ray Room</option>
                                <option value="ultra_scan_room">Ultrasound Scan Room</option>
                                <option value="icu">ICU</option>
                                <option value="emergency">Emergency</option>
                                <option value="ot">Operation Theatre (O.T.)</option>
                                <option value="reception">Reception</option>
                                <option value="report_room">Report Room</option>
                                <option value="washroom">Washroom</option>
                                <option value="lab_room">Lab Room</option>
                                <option value="canteen">Canteen</option>
                            </select>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Floor *</label>
                            <input type="number" name="floor" id="edit_floor" class="form-control" required>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Capacity *</label>
                            <input type="number" name="capacity" id="edit_capacity" class="form-control" required>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Status *</label>
                            <select name="status" id="edit_status" class="form-select" required>
                                <option value="available">Available</option>
                                <option value="occupied">Occupied</option>
                                <option value="maintenance">Maintenance</option>
                            </select>
                        </div>
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
    // Edit Room Button Click
    $('.edit-room-btn').on('click', function() {
        var id = $(this).data('id');
        var room_number = $(this).data('room_number');
        var name = $(this).data('name');
        var type = $(this).data('type');
        var floor = $(this).data('floor');
        var capacity = $(this).data('capacity');
        var status = $(this).data('status');
        
        $('#edit_room_number').val(room_number);
        $('#edit_name').val(name);
        $('#edit_type').val(type);
        $('#edit_floor').val(floor);
        $('#edit_capacity').val(capacity);
        $('#edit_status').val(status);
        
        $('#editRoomForm').attr('action', '/admin/rooms/' + id);
        $('#editRoomModal').modal('show');
    });
    
    // Modal cleanup
    $('#addRoomModal, #editRoomModal').on('hidden.bs.modal', function() {
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open');
        $('body').css('padding-right', '');
    });
});
</script>
@endpush