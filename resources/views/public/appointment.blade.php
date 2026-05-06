@extends('layouts.app')

@section('title', 'Book Appointment')

@section('content')
<div class="container px-3 px-md-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white py-2 py-md-3">
                    <h4 class="mb-0 fs-5 fs-md-4">Book an Appointment</h4>
                </div>
                <div class="card-body p-3 p-md-4">
                    <form method="POST" action="{{ route('appointment.store') }}" id="appointmentForm">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="doctor_id" class="form-label small fw-semibold">Select Doctor *</label>
                            <select name="doctor_id" id="doctor_id" class="form-select" required>
                                <option value="">Choose a doctor...</option>
                                @foreach($doctors as $doctor)
                                    <option value="{{ $doctor->id }}">Dr. {{ $doctor->name }} - {{ $doctor->specialty }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div id="pa-info" class="mb-3" style="display: none;">
                            <div class="alert alert-info small p-2 p-md-3">
                                <strong>Assigned PA:</strong> <span id="pa-name"></span><br>
                                <strong>Contact:</strong> <span id="pa-phone"></span>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="patient_name" class="form-label small fw-semibold">Patient Name *</label>
                            <input type="text" name="patient_name" id="patient_name" class="form-control" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="patient_age" class="form-label small fw-semibold">Patient Age *</label>
                            <input type="number" name="patient_age" id="patient_age" class="form-control" required min="0" max="150">
                        </div>
                        
                        <div class="mb-3">
                            <label for="patient_phone" class="form-label small fw-semibold">Phone Number *</label>
                            <input type="tel" name="patient_phone" id="patient_phone" class="form-control" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="reason" class="form-label small fw-semibold">Reason for Visit *</label>
                            <textarea name="reason" id="reason" class="form-control" rows="3" required></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="appointment_time" class="form-label small fw-semibold">Preferred Date & Time *</label>
                            <input type="datetime-local" name="appointment_time" id="appointment_time" class="form-control" required min="{{ now()->format('Y-m-d\TH:i') }}">
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100 py-2">Book Appointment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $('#doctor_id').change(function() {
        let doctorId = $(this).val();
        if (doctorId) {
            $.ajax({
                url: '/get-pa/' + doctorId,
                type: 'GET',
                success: function(data) {
                    if (data.success) {
                        $('#pa-name').text(data.pa_name);
                        $('#pa-phone').text(data.pa_phone);
                        $('#pa-info').show();
                    } else {
                        $('#pa-info').hide();
                        alert('No PA assigned to this doctor. Please contact reception.');
                    }
                }
            });
        } else {
            $('#pa-info').hide();
        }
    });
</script>
@endpush
@endsection