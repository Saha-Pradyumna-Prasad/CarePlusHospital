@extends('layouts.labtester-dash')

@section('title', 'Lab Dashboard')

@section('content')
<div class="container-fluid px-2 px-sm-3 px-md-4">
    <div class="row g-3 g-md-4">
        <div class="col-12 col-md-4 mb-3 mb-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0 fs-6 fs-md-5"><i class="fas fa-user"></i> Lab Tester Profile</h5>
                </div>
                <div class="card-body text-center">
                    <i class="fas fa-flask fa-4x text-secondary mb-3"></i>
                    <h4 class="fs-5 fs-md-4">{{ $labTester->name }}</h4>
                    <p class="small">{{ ucfirst($labTester->role_type) }}<br>{{ $labTester->email }}<br>{{ $labTester->phone }}</p>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-md-4 mb-3 mb-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-warning text-white">
                    <h5 class="mb-0 fs-6 fs-md-5"><i class="fas fa-clock"></i> Pending Tests</h5>
                </div>
                <div class="card-body text-center">
                    <h2 class="mb-0 fs-1">{{ $pendingTests->count() }}</h2>
                    <p class="small">Tests awaiting processing</p>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-md-4 mb-3 mb-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0 fs-6 fs-md-5"><i class="fas fa-check-circle"></i> Completed Tests</h5>
                </div>
                <div class="card-body text-center">
                    <h2 class="mb-0 fs-1">{{ $recentTests->count() }}</h2>
                    <p class="small">Tests completed this month</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row g-3 g-md-4">
        <div class="col-12 col-md-6 mb-3 mb-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0 fs-6 fs-md-5"><i class="fas fa-plus"></i> Create New Test</h5>
                </div>
                <div class="card-body p-3 p-sm-4">
                    <form method="POST" action="{{ route('lab.tests.store') }}" id="createTestForm">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Patient *</label>
                            <select name="patient_id" id="patient_id" class="form-select" required>
                                <option value="">Select Patient</option>
                                @foreach($patients as $patient)
                                    <option value="{{ $patient->id }}">{{ $patient->name }} ({{ $patient->patient_id }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Test Type *</label>
                            <select name="test_type" id="test_type" class="form-select" required>
                                <option value="Blood Test">Blood Test</option>
                                <option value="Urine Test">Urine Test</option>
                                <option value="X-Ray">X-Ray</option>
                                <option value="Ultrasound">Ultrasound</option>
                                <option value="ECG">ECG</option>
                                <option value="MRI">MRI</option>
                                <option value="CT Scan">CT Scan</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Bottle/Sample ID</label>
                            <input type="text" name="bottle_id" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status *</label>
                            <select name="status" id="test_status" class="form-select" required>
                                <option value="pending">Pending</option>
                                <option value="processing">Processing</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                        <div class="mb-3" id="result_section" style="display: none;">
                            <label class="form-label">Result *</label>
                            <textarea name="result" id="test_result" class="form-control" rows="4" placeholder="Enter test results here..."></textarea>
                            <small class="text-muted">After completing the test, a PDF report will be generated automatically</small>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Create Test</button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-md-6 mb-3 mb-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0 fs-6 fs-md-5"><i class="fas fa-list"></i> Recent Tests</h5>
                </div>
                <div class="card-body p-3 p-sm-4">
                    <div class="table-responsive">
                        <table class="table table-bordered w-100" id="testsTable">
                            <thead>
                                <tr>
                                    <th>Test ID</th>
                                    <th>Patient</th>
                                    <th>Test Type</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentTests as $test)
                                <tr>
                                    <td class="align-middle">{{ $test->test_id }}</td>
                                    <td class="align-middle">{{ $test->patient->name ?? 'N/A' }}</td>
                                    <td class="align-middle">{{ $test->test_type }}</td>
                                    <td class="align-middle">
                                        @if($test->status == 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif($test->status == 'processing')
                                            <span class="badge bg-info">Processing</span>
                                        @else
                                            <span class="badge bg-success">Completed</span>
                                        @endif
                                    </td>
                                    <td class="align-middle">{{ $test->created_at->format('M d, Y') }}</td>
                                    <td class="align-middle">
                                        <div class="d-flex flex-column flex-sm-row gap-1">
                                            <button type="button" class="btn btn-sm btn-info view-test-btn" data-id="{{ $test->id }}">
                                                <i class="fas fa-eye"></i> <span class="d-none d-sm-inline">View</span>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-warning edit-test-btn" data-id="{{ $test->id }}">
                                                <i class="fas fa-edit"></i> <span class="d-none d-sm-inline">Edit</span>
                                            </button>
                                            @if($test->status == 'completed' && $test->result)
                                                <button type="button" class="btn btn-sm btn-danger pdf-download-btn" data-id="{{ $test->id }}">
                                                    <i class="fas fa-file-pdf"></i> <span class="d-none d-sm-inline">PDF</span>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">No tests found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- View Test Modal -->
<div class="modal fade" id="viewTestModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title"><i class="fas fa-flask me-2"></i>Test Result: <span id="view_test_id"></span></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Test Type:</label>
                        <p id="view_test_type" class="border-bottom pb-1"></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Patient ID:</label>
                        <p id="view_patient_id" class="border-bottom pb-1"></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Patient Name:</label>
                        <p id="view_patient_name" class="border-bottom pb-1"></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Bottle ID:</label>
                        <p id="view_bottle_id" class="border-bottom pb-1"></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Status:</label>
                        <p id="view_status" class="border-bottom pb-1"></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Date:</label>
                        <p id="view_date" class="border-bottom pb-1"></p>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="fw-bold">Result:</label>
                        <div id="view_result" class="border p-3 rounded bg-light" style="min-height: 100px; white-space: pre-wrap;"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" id="downloadPdfFromViewBtn">
                    <i class="fas fa-file-pdf"></i> Download PDF Report
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Test Modal -->
<div class="modal fade" id="editTestModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <form method="POST" id="editTestForm">
                @csrf
                @method('PUT')
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Test</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">Test ID</label>
                            <input type="text" id="edit_test_id" class="form-control" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">Patient</label>
                            <input type="text" id="edit_patient_name" class="form-control" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">Test Type</label>
                            <input type="text" id="edit_test_type" class="form-control" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">Status</label>
                            <select name="status" id="edit_status" class="form-select" required>
                                <option value="pending">Pending</option>
                                <option value="processing">Processing</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">Bottle/Sample ID</label>
                            <input type="text" name="bottle_id" id="edit_bottle_id" class="form-control">
                        </div>
                        <div class="col-12 mb-3">
                            <label class="fw-bold">Result</label>
                            <textarea name="result" id="edit_result" class="form-control" rows="5" placeholder="Enter test results here..."></textarea>
                            <small class="text-muted">After completing the test, PDF report will be generated automatically</small>
                        </div>
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
    .card-header h5 { font-size: 0.9rem !important; }
    .card-body { padding: 1rem !important; }
    h4 { font-size: 1.1rem !important; }
    .btn-sm { font-size: 0.7rem; padding: 0.25rem 0.5rem; }
    .form-label { font-size: 0.85rem; }
    .form-control, .form-select { font-size: 0.85rem; padding: 0.4rem 0.6rem; }
    .fa-4x { font-size: 2.5rem !important; }
}
@media (max-width: 576px) {
    .fs-1 { font-size: 1.75rem !important; }
    .modal-body { padding: 1rem; }
    .modal-title { font-size: 1rem; }
    .modal-footer { padding: 0.75rem; }
    .modal-footer .btn { font-size: 0.85rem; padding: 0.35rem 0.75rem; }
    .badge { font-size: 0.7rem; padding: 0.2rem 0.4rem; }
}

/* Modal z-index fix */
.modal {
    z-index: 1050;
}
.modal-backdrop {
    z-index: 1040;
}
</style>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Show/Hide Result section based on status in create form
    $('#test_status').change(function() {
        if ($(this).val() == 'completed') {
            $('#result_section').slideDown();
            $('#test_result').prop('required', true);
        } else {
            $('#result_section').slideUp();
            $('#test_result').prop('required', false);
        }
    });
    
    // Show/Hide Result section in edit modal when status changes
    $(document).on('change', '#edit_status', function() {
        if ($(this).val() == 'completed') {
            $('#edit_result').closest('.col-12').find('small').show();
        } else {
            $('#edit_result').closest('.col-12').find('small').hide();
        }
    });
    
    // Variable to store current test id
    let currentViewTestId = null;
    
    // View Test Button Click
    $(document).on('click', '.view-test-btn', function(e) {
        e.preventDefault();
        let testId = $(this).data('id');
        currentViewTestId = testId;
        
        // Show loading
        Swal.fire({ title: 'Loading...', text: 'Please wait', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } });
        
        $.ajax({
            url: '/lab/tests/' + testId,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                Swal.close();
                $('#view_test_id').text(data.test_id || 'N/A');
                $('#view_test_type').text(data.test_type || 'N/A');
                $('#view_patient_id').text(data.patient ? data.patient.patient_id : 'N/A');
                $('#view_patient_name').text(data.patient ? data.patient.name : 'N/A');
                $('#view_bottle_id').text(data.bottle_id || 'N/A');
                
                let statusText = '';
                if (data.status == 'pending') {
                    statusText = '<span class="badge bg-warning">Pending</span>';
                } else if (data.status == 'processing') {
                    statusText = '<span class="badge bg-info">Processing</span>';
                } else {
                    statusText = '<span class="badge bg-success">Completed</span>';
                }
                $('#view_status').html(statusText);
                
                let date = new Date(data.created_at);
                $('#view_date').text(date.toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' }));
                
                let resultText = data.result ? data.result.replace(/\n/g, '<br>') : '<em class="text-muted">No result entered yet</em>';
                $('#view_result').html(resultText);
                
                $('#viewTestModal').modal('show');
            },
            error: function(xhr) {
                Swal.close();
                Swal.fire('Error', 'Could not load test details', 'error');
            }
        });
    });
    
    // Download PDF from View Modal
    $('#downloadPdfFromViewBtn').click(function() {
        if (currentViewTestId) {
            window.open('/lab/tests/' + currentViewTestId + '/pdf', '_blank');
        }
    });
    
    // Generate PDF button click
    $(document).on('click', '.pdf-download-btn', function(e) {
        e.preventDefault();
        let testId = $(this).data('id');
        window.open('/lab/tests/' + testId + '/pdf', '_blank');
    });
    
    // Edit Test Button Click
    $(document).on('click', '.edit-test-btn', function(e) {
        e.preventDefault();
        let testId = $(this).data('id');
        
        Swal.fire({ title: 'Loading...', text: 'Please wait', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } });
        
        $.ajax({
            url: '/lab/tests/' + testId,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                Swal.close();
                $('#edit_test_id').val(data.test_id || '');
                $('#edit_patient_name').val(data.patient ? data.patient.name : 'N/A');
                $('#edit_test_type').val(data.test_type || '');
                $('#edit_status').val(data.status || 'pending');
                $('#edit_bottle_id').val(data.bottle_id || '');
                $('#edit_result').val(data.result || '');
                
                $('#editTestForm').attr('action', '/lab/tests/' + testId);
                $('#editTestModal').modal('show');
            },
            error: function(xhr) {
                Swal.close();
                Swal.fire('Error', 'Could not load test details for editing', 'error');
            }
        });
    });
    
    // Edit Form Submit
    $('#editTestForm').submit(function(e) {
        e.preventDefault();
        let form = $(this);
        let url = form.attr('action');
        
        Swal.fire({ title: 'Updating...', text: 'Please wait', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } });
        
        $.ajax({
            url: url,
            type: 'POST',
            data: form.serialize(),
            success: function(response) {
                Swal.close();
                $('#editTestModal').modal('hide');
                Swal.fire('Success', 'Test updated successfully! Report generated automatically.', 'success').then(() => {
                    location.reload();
                });
            },
            error: function(xhr) {
                Swal.close();
                Swal.fire('Error', 'Could not update test', 'error');
            }
        });
    });
    
    // Create Test Form Submit
    $('#createTestForm').submit(function(e) {
        e.preventDefault();
        let form = $(this);
        
        Swal.fire({ title: 'Creating...', text: 'Please wait', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } });
        
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            success: function(response) {
                Swal.close();
                Swal.fire('Success', 'Test created successfully!', 'success').then(() => {
                    location.reload();
                });
            },
            error: function(xhr) {
                Swal.close();
                let errors = xhr.responseJSON?.errors;
                let errorMsg = 'Could not create test';
                if (errors) {
                    errorMsg = Object.values(errors).flat().join('\n');
                }
                Swal.fire('Error', errorMsg, 'error');
            }
        });
    });
});
</script>
@endpush