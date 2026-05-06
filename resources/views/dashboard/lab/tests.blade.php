@extends('layouts.labtester-dash')

@section('title', 'All Lab Tests')

@section('content')
<div class="container-fluid px-2 px-sm-3 px-md-4">
    <h2 class="mb-4 fs-3 fs-md-2">All Lab Tests</h2>
    
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
                            <th>Test ID</th>
                            <th>Patient ID</th>
                            <th>Patient Name</th>
                            <th>Test Type</th>
                            <th>Bottle ID</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tests as $test)
                        <tr>
                            <td class="align-middle">{{ $test->test_id }}</td>
                            <td class="align-middle">{{ $test->patient->patient_id ?? 'N/A' }}</td>
                            <td class="align-middle">{{ $test->patient->name ?? 'N/A' }}</td>
                            <td class="align-middle">{{ $test->test_type }}</td>
                            <td class="align-middle">{{ $test->bottle_id ?? 'N/A' }}</td>
                            <td class="align-middle">
                                <span class="badge bg-{{ $test->status == 'pending' ? 'warning' : ($test->status == 'processing' ? 'info' : 'success') }}">
                                    {{ ucfirst($test->status) }}
                                </span>
                            </td>
                            <td class="align-middle">{{ $test->created_at->format('M d, Y') }}</td>
                            <td class="align-middle">
                                <div class="d-flex flex-column flex-sm-row gap-1">
                                    <button type="button" class="btn btn-sm btn-info view-test-btn w-100 w-sm-auto" 
                                            data-id="{{ $test->id }}"
                                            data-test_id="{{ $test->test_id }}"
                                            data-test_type="{{ $test->test_type }}"
                                            data-patient_id="{{ $test->patient->patient_id ?? 'N/A' }}"
                                            data-patient_name="{{ $test->patient->name ?? 'N/A' }}"
                                            data-bottle_id="{{ $test->bottle_id ?? 'N/A' }}"
                                            data-status="{{ $test->status }}"
                                            data-date="{{ $test->created_at->format('M d, Y') }}"
                                            data-result="{{ $test->result ?? 'No result entered yet.' }}">
                                        <i class="fas fa-eye"></i> View Result
                                    </button>
                                    <button type="button" class="btn btn-sm btn-warning edit-test-btn w-100 w-sm-auto" 
                                            data-id="{{ $test->id }}"
                                            data-status="{{ $test->status }}"
                                            data-result="{{ $test->result }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
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

<!-- View Test Modal -->
<div class="modal fade" id="viewTestModal" tabindex="-1" aria-labelledby="viewTestModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="viewTestModalLabel">
                    <i class="fas fa-flask me-2"></i>Test Result: <span id="view_test_id"></span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-12 col-md-6 mb-2">
                        <strong>Test Type:</strong> <span id="view_test_type"></span>
                    </div>
                    <div class="col-12 col-md-6 mb-2">
                        <strong>Patient Name:</strong> <span id="view_patient_name"></span>
                    </div>
                    <div class="col-12 col-md-6 mb-2">
                        <strong>Patient ID:</strong> <span id="view_patient_id"></span>
                    </div>
                    <div class="col-12 col-md-6 mb-2">
                        <strong>Bottle ID:</strong> <span id="view_bottle_id"></span>
                    </div>
                    <div class="col-12 col-md-6 mb-2">
                        <strong>Status:</strong> <span id="view_status"></span>
                    </div>
                    <div class="col-12 col-md-6 mb-2">
                        <strong>Date:</strong> <span id="view_date"></span>
                    </div>
                </div>
                <div class="mb-3">
                    <strong>Result:</strong>
                    <div id="view_result" class="border rounded p-3 mt-2 bg-light" style="min-height: 100px; white-space: pre-wrap;"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Test Modal -->
<div class="modal fade" id="editTestModal" tabindex="-1" aria-labelledby="editTestModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <form method="POST" id="editTestForm">
                @csrf
                @method('PUT')
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="editTestModalLabel">
                        <i class="fas fa-edit me-2"></i>Edit Test
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" id="edit_status" class="form-select" required>
                            <option value="pending">Pending</option>
                            <option value="processing">Processing</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Result</label>
                        <textarea name="result" id="edit_result" class="form-control" rows="5"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning">Update Test</button>
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
    .d-flex.flex-column { gap: 0.25rem !important; }
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
    // View Test Button Click
    $('.view-test-btn').on('click', function() {
        var testId = $(this).data('test_id');
        var testType = $(this).data('test_type');
        var patientId = $(this).data('patient_id');
        var patientName = $(this).data('patient_name');
        var bottleId = $(this).data('bottle_id');
        var status = $(this).data('status');
        var date = $(this).data('date');
        var result = $(this).data('result');
        
        $('#view_test_id').text(testId);
        $('#view_test_type').text(testType);
        $('#view_patient_id').text(patientId);
        $('#view_patient_name').text(patientName);
        $('#view_bottle_id').text(bottleId);
        
        var statusBadge = '';
        if (status == 'pending') {
            statusBadge = '<span class="badge bg-warning">Pending</span>';
        } else if (status == 'processing') {
            statusBadge = '<span class="badge bg-info">Processing</span>';
        } else {
            statusBadge = '<span class="badge bg-success">Completed</span>';
        }
        $('#view_status').html(statusBadge);
        
        $('#view_date').text(date);
        $('#view_result').html(result);
        
        $('#viewTestModal').modal('show');
    });
    
    // Edit Test Button Click
    $('.edit-test-btn').on('click', function() {
        var id = $(this).data('id');
        var status = $(this).data('status');
        var result = $(this).data('result');
        
        $('#edit_status').val(status);
        $('#edit_result').val(result);
        $('#editTestForm').attr('action', '/lab/tests/' + id);
        $('#editTestModal').modal('show');
    });
    
    // Modal cleanup
    $('#viewTestModal, #editTestModal').on('hidden.bs.modal', function() {
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open');
        $('body').css('padding-right', '');
    });
});
</script>
@endpush@extends('layouts.labtester-dash')

@section('title', 'All Lab Tests')

@section('content')
<div class="container-fluid px-2 px-sm-3 px-md-4">
    <h2 class="mb-4 fs-3 fs-md-2">All Lab Tests</h2>
    
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
                            <th>Test ID</th>
                            <th>Patient ID</th>
                            <th>Patient Name</th>
                            <th>Test Type</th>
                            <th>Bottle ID</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tests as $test)
                        <tr>
                            <td class="align-middle">{{ $test->test_id }}</td>
                            <td class="align-middle">{{ $test->patient->patient_id ?? 'N/A' }}</td>
                            <td class="align-middle">{{ $test->patient->name ?? 'N/A' }}</td>
                            <td class="align-middle">{{ $test->test_type }}</td>
                            <td class="align-middle">{{ $test->bottle_id ?? 'N/A' }}</td>
                            <td class="align-middle">
                                <span class="badge bg-{{ $test->status == 'pending' ? 'warning' : ($test->status == 'processing' ? 'info' : 'success') }}">
                                    {{ ucfirst($test->status) }}
                                </span>
                            </td>
                            <td class="align-middle">{{ $test->created_at->format('M d, Y') }}</td>
                            <td class="align-middle">
                                <div class="d-flex flex-column flex-sm-row gap-1">
                                    <button type="button" class="btn btn-sm btn-info view-test-btn w-100 w-sm-auto" 
                                            data-id="{{ $test->id }}"
                                            data-test_id="{{ $test->test_id }}"
                                            data-test_type="{{ $test->test_type }}"
                                            data-patient_id="{{ $test->patient->patient_id ?? 'N/A' }}"
                                            data-patient_name="{{ $test->patient->name ?? 'N/A' }}"
                                            data-bottle_id="{{ $test->bottle_id ?? 'N/A' }}"
                                            data-status="{{ $test->status }}"
                                            data-date="{{ $test->created_at->format('M d, Y') }}"
                                            data-result="{{ $test->result ?? 'No result entered yet.' }}">
                                        <i class="fas fa-eye"></i> View Result
                                    </button>
                                    <button type="button" class="btn btn-sm btn-warning edit-test-btn w-100 w-sm-auto" 
                                            data-id="{{ $test->id }}"
                                            data-status="{{ $test->status }}"
                                            data-result="{{ $test->result }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
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

<!-- View Test Modal -->
<div class="modal fade" id="viewTestModal" tabindex="-1" aria-labelledby="viewTestModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="viewTestModalLabel">
                    <i class="fas fa-flask me-2"></i>Test Result: <span id="view_test_id"></span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-12 col-md-6 mb-2">
                        <strong>Test Type:</strong> <span id="view_test_type"></span>
                    </div>
                    <div class="col-12 col-md-6 mb-2">
                        <strong>Patient Name:</strong> <span id="view_patient_name"></span>
                    </div>
                    <div class="col-12 col-md-6 mb-2">
                        <strong>Patient ID:</strong> <span id="view_patient_id"></span>
                    </div>
                    <div class="col-12 col-md-6 mb-2">
                        <strong>Bottle ID:</strong> <span id="view_bottle_id"></span>
                    </div>
                    <div class="col-12 col-md-6 mb-2">
                        <strong>Status:</strong> <span id="view_status"></span>
                    </div>
                    <div class="col-12 col-md-6 mb-2">
                        <strong>Date:</strong> <span id="view_date"></span>
                    </div>
                </div>
                <div class="mb-3">
                    <strong>Result:</strong>
                    <div id="view_result" class="border rounded p-3 mt-2 bg-light" style="min-height: 100px; white-space: pre-wrap;"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Test Modal -->
<div class="modal fade" id="editTestModal" tabindex="-1" aria-labelledby="editTestModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <form method="POST" id="editTestForm">
                @csrf
                @method('PUT')
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="editTestModalLabel">
                        <i class="fas fa-edit me-2"></i>Edit Test
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" id="edit_status" class="form-select" required>
                            <option value="pending">Pending</option>
                            <option value="processing">Processing</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Result</label>
                        <textarea name="result" id="edit_result" class="form-control" rows="5"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning">Update Test</button>
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
    .d-flex.flex-column { gap: 0.25rem !important; }
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
    // View Test Button Click
    $('.view-test-btn').on('click', function() {
        var testId = $(this).data('test_id');
        var testType = $(this).data('test_type');
        var patientId = $(this).data('patient_id');
        var patientName = $(this).data('patient_name');
        var bottleId = $(this).data('bottle_id');
        var status = $(this).data('status');
        var date = $(this).data('date');
        var result = $(this).data('result');
        
        $('#view_test_id').text(testId);
        $('#view_test_type').text(testType);
        $('#view_patient_id').text(patientId);
        $('#view_patient_name').text(patientName);
        $('#view_bottle_id').text(bottleId);
        
        var statusBadge = '';
        if (status == 'pending') {
            statusBadge = '<span class="badge bg-warning">Pending</span>';
        } else if (status == 'processing') {
            statusBadge = '<span class="badge bg-info">Processing</span>';
        } else {
            statusBadge = '<span class="badge bg-success">Completed</span>';
        }
        $('#view_status').html(statusBadge);
        
        $('#view_date').text(date);
        $('#view_result').html(result);
        
        $('#viewTestModal').modal('show');
    });
    
    // Edit Test Button Click
    $('.edit-test-btn').on('click', function() {
        var id = $(this).data('id');
        var status = $(this).data('status');
        var result = $(this).data('result');
        
        $('#edit_status').val(status);
        $('#edit_result').val(result);
        $('#editTestForm').attr('action', '/lab/tests/' + id);
        $('#editTestModal').modal('show');
    });
    
    // Modal cleanup
    $('#viewTestModal, #editTestModal').on('hidden.bs.modal', function() {
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open');
        $('body').css('padding-right', '');
    });
});
</script>
@endpush