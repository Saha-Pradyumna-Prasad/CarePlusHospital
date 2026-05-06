@extends('layouts.patient-dash')


@section('title', 'Patient Dashboard')

@section('content')
<div class="container-fluid px-2 px-sm-3 px-md-4">
    <div class="row g-3 g-md-4">
        <div class="col-12 col-md-4 mb-3 mb-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0 fs-6 fs-md-5"><i class="fas fa-user"></i> Profile Information</h5>
                </div>
                <div class="card-body p-3 p-sm-4">
                    <p class="small mb-2"><strong>Patient ID:</strong> {{ $patient->patient_id }}</p>
                    <p class="small mb-2"><strong>Name:</strong> {{ $patient->name }}</p>
                    <p class="small mb-2"><strong>Age:</strong> {{ $patient->age }}</p>
                    <p class="small mb-2"><strong>Gender:</strong> {{ ucfirst($patient->gender) }}</p>
                    <p class="small mb-2"><strong>Blood Group:</strong> {{ $patient->blood_group ?? 'N/A' }}</p>
                    <p class="small mb-2"><strong>Phone:</strong> {{ $patient->phone }}</p>
                    <p class="small mb-2"><strong>Email:</strong> {{ $patient->email ?? 'N/A' }}</p>
                    <p class="small mb-2"><strong>Address:</strong> {{ $patient->address }}</p>
                    <p class="small mb-3"><strong>Emergency Contact:</strong> {{ $patient->emergency_contact }}</p>
                    <button type="button" class="btn btn-sm btn-warning w-100 w-sm-auto" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                        Edit Profile
                    </button>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-md-8 mb-3 mb-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0 fs-6 fs-md-5"><i class="fas fa-calendar"></i> Upcoming Appointments</h5>
                </div>
                <div class="card-body p-3 p-sm-4">
                    @forelse($upcomingAppointments as $appointment)
                        <div class="alert alert-info mb-3">
                            <strong class="d-block">{{ $appointment->appointment_time->format('M d, Y h:i A') }}</strong>
                            Dr. {{ $appointment->doctor->name }}<br>
                            Reason: {{ $appointment->reason }}<br>
                            Status: <span class="badge bg-warning">{{ ucfirst($appointment->status) }}</span>
                        </div>
                    @empty
                        <p class="text-muted small mb-0">No upcoming appointments.</p>
                    @endforelse
                </div>
            </div>
            
            <div class="card shadow-sm mt-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0 fs-6 fs-md-5"><i class="fas fa-file-medical"></i> Recent Reports</h5>
                </div>
                <div class="card-body p-3 p-sm-4">
                    @forelse($reports->take(5) as $report)
                        <div class="border-bottom mb-2 pb-2">
                            <div class="d-flex flex-wrap justify-content-between align-items-start gap-2">
                                <div class="flex-grow-1">
                                    <strong class="d-block">{{ $report->title }}</strong>
                                    <small>Date: {{ $report->created_at->format('M d, Y') }} | Type: {{ ucfirst($report->type) }}</small>
                                </div>
                                <a href="{{ route('patient.reports.download', $report->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-download"></i> Download PDF
                                </a>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted small mb-0">No reports available.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Profile Modal - Fixed -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <form method="POST" action="{{ route('patient.profile.update') }}" id="editProfileForm">
                @csrf 
                @method('PUT')
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title fs-6 fs-md-5" id="editProfileModalLabel">
                        <i class="fas fa-user-edit me-2"></i>Edit Profile
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Phone *</label>
                        <input type="text" name="phone" class="form-control" value="{{ $patient->phone }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Address *</label>
                        <textarea name="address" class="form-control" rows="3" required>{{ $patient->address }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Emergency Contact *</label>
                        <input type="text" name="emergency_contact" class="form-control" value="{{ $patient->emergency_contact }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning">Update Profile</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
@media (max-width: 768px) {
    .card-header h5 {
        font-size: 0.9rem !important;
    }
    .card-body {
        padding: 1rem !important;
    }
    .btn-sm {
        font-size: 0.7rem;
        padding: 0.25rem 0.5rem;
    }
    .alert {
        padding: 0.75rem;
        font-size: 0.85rem;
    }
    .badge {
        font-size: 0.7rem;
        padding: 0.2rem 0.4rem;
    }
    p {
        font-size: 0.85rem;
        margin-bottom: 0.5rem;
    }
}

@media (max-width: 576px) {
    .alert {
        font-size: 0.75rem;
        padding: 0.6rem;
    }
    .btn-sm {
        font-size: 0.65rem;
        padding: 0.2rem 0.4rem;
    }
    p, .small {
        font-size: 0.75rem !important;
    }
    .modal-body {
        padding: 1rem;
    }
    .modal-title {
        font-size: 1rem;
    }
    .form-label {
        font-size: 0.85rem;
    }
    .form-control {
        font-size: 0.85rem;
        padding: 0.4rem 0.6rem;
    }
    .modal-footer {
        padding: 0.75rem;
    }
    .modal-footer .btn {
        font-size: 0.85rem;
        padding: 0.35rem 0.75rem;
    }
}

/* Modal z-index fix - Prevents black screen */
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
    // Edit Profile Form Submit with AJAX to prevent black screen
    $('#editProfileForm').on('submit', function(e) {
        e.preventDefault();
        
        let form = $(this);
        let url = form.attr('action');
        let formData = form.serialize();
        
        Swal.fire({
            title: 'Updating...',
            text: 'Please wait',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
        
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            success: function(response) {
                Swal.close();
                $('#editProfileModal').modal('hide');
                Swal.fire({
                    title: 'Success!',
                    text: 'Profile updated successfully!',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    location.reload();
                });
            },
            error: function(xhr) {
                Swal.close();
                let errorMsg = 'Could not update profile';
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    errorMsg = Object.values(xhr.responseJSON.errors).flat().join('\n');
                }
                Swal.fire('Error!', errorMsg, 'error');
            }
        });
    });
    
    // Ensure modal closes properly without black screen
    $('#editProfileModal').on('hidden.bs.modal', function() {
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open');
        $('body').css('padding-right', '');
    });
    
    $('#editProfileModal').on('show.bs.modal', function() {
        $('.modal-backdrop').remove();
    });
});
</script>
@endpush