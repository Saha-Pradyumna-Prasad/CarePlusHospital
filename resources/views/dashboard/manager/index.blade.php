@extends('layouts.manager-dash')

@section('title', 'Manager Dashboard')

@section('content')
<div class="container-fluid px-2 px-sm-3 px-md-4">
    <div class="row g-2 g-sm-3">
        <div class="col-6 col-md-3 mb-3">
            <div class="card bg-primary text-white h-100">
                <div class="card-body">
                    <h6 class="mb-1 small">Total Doctors</h6>
                    <h2 class="mb-0 fs-2">{{ $stats['total_doctors'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3 mb-3">
            <div class="card bg-success text-white h-100">
                <div class="card-body">
                    <h6 class="mb-1 small">Total PAs</h6>
                    <h2 class="mb-0 fs-2">{{ $stats['total_pas'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3 mb-3">
            <div class="card bg-info text-white h-100">
                <div class="card-body">
                    <h6 class="mb-1 small">Total Staff</h6>
                    <h2 class="mb-0 fs-2">{{ $stats['total_staff'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3 mb-3">
            <div class="card bg-warning text-white h-100">
                <div class="card-body">
                    <h6 class="mb-1 small">Available Rooms</h6>
                    <h2 class="mb-0 fs-2">{{ $stats['available_rooms'] }}/{{ $stats['total_rooms'] }}</h2>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row g-3 g-md-4">
        <div class="col-12 col-md-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-secondary text-white d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2">
                    <h5 class="mb-0 fs-6 fs-md-5"><i class="fas fa-users"></i> Staff Management</h5>
                    <a href="{{ route('manager.staff') }}" class="btn btn-sm btn-light">View All</a>
                </div>
                <div class="card-body p-2 p-sm-3">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($staff->take(5) as $member)
                                <tr>
                                    <td>{{ $member->name }}</td>
                                    <td>{{ ucfirst($member->role_type) }}</td>
                                    <td>{{ $member->phone }}</td>
                                    <td><span class="badge bg-{{ $member->status ? 'success' : 'danger' }}">{{ $member->status ? 'Active' : 'Inactive' }}</span></td>
                                    <td>
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
        
        <div class="col-12 col-md-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-secondary text-white d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2">
                    <h5 class="mb-0 fs-6 fs-md-5"><i class="fas fa-bed"></i> Room Management</h5>
                    <a href="{{ route('manager.rooms') }}" class="btn btn-sm btn-light">View All</a>
                </div>
                <div class="card-body p-2 p-sm-3">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Room #</th>
                                    <th>Name</th>
                                    <th>Floor</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rooms->take(5) as $room)
                                <tr>
                                    <td>{{ $room->room_number }}</td>
                                    <td>{{ $room->name }}</td>
                                    <td>{{ $room->floor }}</td>
                                    <td><span class="badge bg-{{ $room->status == 'available' ? 'success' : ($room->status == 'occupied' ? 'danger' : 'warning') }}">{{ ucfirst($room->status) }}</span></td>
                                    <td>
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
    </div>
</div>

<!-- Edit Staff Modal -->
<div class="modal fade" id="editStaffModal" tabindex="-1" aria-labelledby="editStaffModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <form method="POST" id="editStaffForm">
                @csrf @method('PUT')
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="editStaffModalLabel">Edit Staff</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" id="edit_staff_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" id="edit_staff_phone" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" id="edit_staff_status" class="form-select">
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

<!-- Edit Room Modal -->
<div class="modal fade" id="editRoomModal" tabindex="-1" aria-labelledby="editRoomModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <form method="POST" id="editRoomForm">
                @csrf @method('PUT')
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="editRoomModalLabel">Edit Room</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Room Name</label>
                        <input type="text" name="name" id="edit_room_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Floor</label>
                        <input type="number" name="floor" id="edit_room_floor" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Capacity</label>
                        <input type="number" name="capacity" id="edit_room_capacity" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" id="edit_room_status" class="form-select">
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
    .card-header h5 { font-size: 0.9rem !important; }
    .card-body { padding: 0.75rem !important; }
    .btn-sm { font-size: 0.7rem; padding: 0.25rem 0.5rem; }
    table th, table td { font-size: 0.8rem; padding: 0.4rem !important; }
    .badge { font-size: 0.7rem; padding: 0.2rem 0.4rem; }
    .modal-body { padding: 1rem; }
    .modal-title { font-size: 1rem; }
}

@media (max-width: 576px) {
    .fs-2 { font-size: 1.5rem !important; }
    h6 { font-size: 0.7rem !important; }
    table th, table td { font-size: 0.7rem; padding: 0.3rem !important; }
    .btn-sm { font-size: 0.65rem; padding: 0.2rem 0.4rem; }
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
    // Edit Staff Button Click
    $('.edit-staff-btn').on('click', function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var phone = $(this).data('phone');
        var status = $(this).data('status');
        
        $('#edit_staff_name').val(name);
        $('#edit_staff_phone').val(phone);
        $('#edit_staff_status').val(status);
        $('#editStaffForm').attr('action', '/manager/staff/' + id);
        $('#editStaffModal').modal('show');
    });
    
    // Edit Room Button Click
    $('.edit-room-btn').on('click', function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var floor = $(this).data('floor');
        var capacity = $(this).data('capacity');
        var status = $(this).data('status');
        
        $('#edit_room_name').val(name);
        $('#edit_room_floor').val(floor);
        $('#edit_room_capacity').val(capacity);
        $('#edit_room_status').val(status);
        $('#editRoomForm').attr('action', '/manager/rooms/' + id);
        $('#editRoomModal').modal('show');
    });
    
    // Modal cleanup
    $('#editStaffModal, #editRoomModal').on('hidden.bs.modal', function() {
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open');
        $('body').css('padding-right', '');
    });
});
</script>
@endpush