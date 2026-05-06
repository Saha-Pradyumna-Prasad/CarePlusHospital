@extends('layouts.patient-dash')

@section('title', 'My Medical Reports')

@section('content')
<div class="container-fluid px-2 px-sm-3 px-md-4">
    <h2 class="mb-4 fs-3 fs-md-2">My Medical Reports</h2>
    
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
                            <th>Report ID</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Created By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reports as $report)
                        <tr>
                            <td class="align-middle">#{{ $report->id }}</td>
                            <td class="align-middle">{{ $report->title }}</td>
                            <td class="align-middle"><span class="badge bg-primary">{{ ucfirst($report->type) }}</span></td>
                            <td class="align-middle">{{ $report->created_at->format('M d, Y') }}</td>
                            <td class="align-middle">{{ $report->createdBy->name }}</td>
                            <td class="align-middle">
                                <div class="d-flex flex-column flex-sm-row gap-1">
                                    <a href="{{ route('patient.reports.download', $report->id) }}" class="btn btn-sm btn-primary w-100 w-sm-auto">
                                        <i class="fas fa-download"></i> Download PDF
                                    </a>
                                    <button type="button" class="btn btn-sm btn-info view-report-btn w-100 w-sm-auto" 
                                            data-title="{{ $report->title }}"
                                            data-type="{{ ucfirst($report->type) }}"
                                            data-date="{{ $report->created_at->format('F d, Y') }}"
                                            data-created_by="{{ $report->createdBy->name }}"
                                            data-content='{{ addslashes($report->content) }}'>
                                        <i class="fas fa-eye"></i> View
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

<!-- View Report Modal -->
<div class="modal fade" id="viewReportModal" tabindex="-1" aria-labelledby="viewReportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="viewReportModalLabel">
                    <i class="fas fa-file-medical me-2"></i><span id="report_title"></span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-12 col-sm-6">
                        <strong>Date:</strong> <span id="report_date"></span>
                    </div>
                    <div class="col-12 col-sm-6">
                        <strong>Type:</strong> <span id="report_type"></span>
                    </div>
                    <div class="col-12 mt-2">
                        <strong>Created By:</strong> <span id="report_created_by"></span>
                    </div>
                </div>
                <hr>
                <div class="report-content" id="report_content" style="white-space: pre-wrap; word-break: break-word;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
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
    .report-content { font-size: 0.85rem; }
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
    // View Report Button Click
    $('.view-report-btn').on('click', function() {
        var title = $(this).data('title');
        var type = $(this).data('type');
        var date = $(this).data('date');
        var createdBy = $(this).data('created_by');
        var content = $(this).data('content');
        
        $('#report_title').text(title);
        $('#report_date').text(date);
        $('#report_type').html('<span class="badge bg-primary">' + type + '</span>');
        $('#report_created_by').text(createdBy);
        
        // Handle content with line breaks
        var formattedContent = content.replace(/\\n/g, '<br>').replace(/\\r/g, '');
        $('#report_content').html(formattedContent);
        
        $('#viewReportModal').modal('show');
    });
    
    // Modal cleanup
    $('#viewReportModal').on('hidden.bs.modal', function() {
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open');
        $('body').css('padding-right', '');
    });
});
</script>
@endpush