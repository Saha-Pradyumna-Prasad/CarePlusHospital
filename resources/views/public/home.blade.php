@extends('layouts.app')

@section('title', 'Care Plus Hospital - Home')

@section('content')
<!-- Hero Section - Ultra Professional with Doctor Image -->
<div class="hero-section position-relative text-white" style="background: linear-gradient(135deg, #0B2B40 0%, #1A4A6B 50%, #0B2B40 100%); min-height: 90vh; display: flex; align-items: center; position: relative; overflow: hidden;">
    
    <!-- Background Image with Overlay -->
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background-image: url('https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=1920&h=1080&fit=crop'); background-size: cover; background-position: center; opacity: 0.15;"></div>
    
    <!-- Animated Medical Background Pattern -->
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background-image: url('data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 1440 320\'%3E%3Cpath fill=\'rgba(255,255,255,0.05)\' d=\'M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,165.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z\'%3E%3C/path%3E%3C/svg%3E'); background-repeat: repeat-x; background-position: bottom; opacity: 0.6;"></div>
    
    <!-- Medical Cross Pattern -->
    <div class="position-absolute w-100 h-100" style="background-image: url('data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'60\' height=\'60\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'rgba(255,255,255,0.03)\' stroke-width=\'1\'%3E%3Cpath d=\'M12 2v20M2 12h20\'/%3E%3C/svg%3E'); background-repeat: repeat; opacity: 0.4;"></div>
    
    <!-- Gradient Overlay -->
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: radial-gradient(circle at 30% 50%, rgba(26,74,107,0.4) 0%, rgba(11,43,64,0.85) 100%);"></div>
    
    <div class="container position-relative py-5">
        <div class="row align-items-center min-vh-75">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="mb-4">
                    <span class="badge bg-warning text-dark px-4 py-2 rounded-pill fs-6 fw-bold shadow-sm">
                        <i class="fas fa-star-of-life me-2"></i> World-Class Healthcare
                    </span>
                </div>
                <h1 class="display-3 fw-bold mb-4" style="line-height: 1.1;">Your Health, <br>Our <span class="text-warning">Commitment</span></h1>
                <p class="lead mb-4 opacity-90" style="font-size: 1.2rem; font-weight: 400;">Providing compassionate, innovative, and world-class healthcare services with state-of-the-art technology and expert medical professionals.</p>
                
                <!-- CTA Buttons -->
                <div class="d-flex gap-3 flex-wrap mb-5">
                    <a href="{{ route('appointment.create') }}" class="btn btn-warning btn-lg px-5 py-3 rounded-pill shadow-lg fw-bold">
                        <i class="fas fa-calendar-check me-2"></i> Book Appointment
                    </a>
                    <a href="{{ route('doctors.index') }}" class="btn btn-outline-light btn-lg px-5 py-3 rounded-pill fw-bold">
                        <i class="fas fa-user-md me-2"></i> Our Doctors
                    </a>
                </div>
                
                <!-- Trust Indicators -->
                <div class="row g-4">
                    <div class="col-4">
                        <div class="d-flex align-items-center gap-2">
                            <div class="bg-white bg-opacity-15 rounded-circle p-2">
                                <i class="fas fa-clock fa-lg text-warning"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold">24/7 Service</h6>
                                <small class="opacity-75">Emergency Ready</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="d-flex align-items-center gap-2">
                            <div class="bg-white bg-opacity-15 rounded-circle p-2">
                                <i class="fas fa-trophy fa-lg text-warning"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold">ISO Certified</h6>
                                <small class="opacity-75">Quality Assured</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="d-flex align-items-center gap-2">
                            <div class="bg-white bg-opacity-15 rounded-circle p-2">
                                <i class="fas fa-smile fa-lg text-warning"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold">98% Happy</h6>
                                <small class="opacity-75">Patients</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="position-relative">
                    <!-- Professional Doctor Image Card -->
                    <div class="card bg-transparent border-0 overflow-hidden">
                        <div class="card-body p-0 text-center">
                            <img src="https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=500&h=550&fit=crop" 
                                 alt="Expert Doctor with Stethoscope" 
                                 class="img-fluid rounded-4 shadow-xxl" 
                                 style="max-width: 100%; height: auto; object-fit: cover; border-radius: 20px !important;"
                                 onerror="this.src='https://placehold.co/500x550/1A4A6B/white?text=Expert+Doctor'">
                        </div>
                    </div>
                    
                    <!-- Floating Emergency Card -->
                    <div class="position-absolute bottom-0 start-0 translate-middle-y ms-4 mb-2">
                        <div class="bg-white rounded-3 shadow-lg p-3" style="min-width: 220px;">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-danger rounded-circle p-2">
                                    <i class="fas fa-ambulance fa-lg text-white"></i>
                                </div>
                                <div>
                                    <small class="text-muted">Emergency Helpline</small>
                                    <h6 class="mb-0 fw-bold text-danger">+880 1234 567890</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Floating Stats Card -->
                    <div class="position-absolute top-0 end-0 translate-middle-x me-2 mt-4">
                        <div class="bg-success rounded-3 shadow-lg p-3 text-center" style="min-width: 140px;">
                            <h3 class="mb-0 fw-bold text-white">5000+</h3>
                            <small class="text-white opacity-75">Happy Patients</small>
                        </div>
                    </div>
                    
                    <!-- Floating Experience Badge -->
                    <div class="position-absolute bottom-0 end-0 translate-middle-y me-2 mb-4">
                        <div class="bg-warning rounded-3 shadow-lg p-2 px-3 text-center">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-calendar-alt fa-lg text-dark"></i>
                                <span class="fw-bold text-dark">25+ Years Excellence</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stats Section - Modern Gradient Cards -->
<div class="container position-relative" style="margin-top: -50px; z-index: 10;">
    <div class="row g-4">
        <div class="col-6 col-lg-3">
            <div class="card border-0 rounded-4 shadow-lg h-100 stat-card" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="card-body text-center text-white p-4">
                    <i class="fas fa-user-md fa-3x mb-3 opacity-75"></i>
                    <h2 class="mb-0 fw-bold display-5">{{ $totalDoctors }}</h2>
                    <p class="mb-0 opacity-75">Expert Doctors</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card border-0 rounded-4 shadow-lg h-100 stat-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                <div class="card-body text-center text-white p-4">
                    <i class="fas fa-microscope fa-3x mb-3 opacity-75"></i>
                    <h2 class="mb-0 fw-bold display-5">{{ $totalServices }}</h2>
                    <p class="mb-0 opacity-75">Services</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card border-0 rounded-4 shadow-lg h-100 stat-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                <div class="card-body text-center text-white p-4">
                    <i class="fas fa-bed fa-3x mb-3 opacity-75"></i>
                    <h2 class="mb-0 fw-bold display-5">{{ $totalRooms }}</h2>
                    <p class="mb-0 opacity-75">Hospital Rooms</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card border-0 rounded-4 shadow-lg h-100 stat-card" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                <div class="card-body text-center text-white p-4">
                    <i class="fas fa-calendar-alt fa-3x mb-3 opacity-75"></i>
                    <h2 class="mb-0 fw-bold display-5">25+</h2>
                    <p class="mb-0 opacity-75">Years</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Services Section -->
<div class="container py-5 mt-4">
    <div class="text-center mb-5">
        <span class="badge bg-primary bg-opacity-10 text-primary px-4 py-2 rounded-pill mb-3">Our Excellence</span>
        <h2 class="display-5 fw-bold" style="color: #1A4A6B;">Comprehensive Medical Services</h2>
        <div class="divider mx-auto my-3" style="width: 80px; height: 4px; background: linear-gradient(90deg, #1A4A6B, #3498db); border-radius: 2px;"></div>
        <p class="text-muted mx-auto" style="max-width: 650px;">Advanced medical care with modern technology and compassionate approach</p>
    </div>
    <div class="row g-4">
        @foreach($featuredServices as $service)
        <div class="col-12 col-md-4">
            <div class="card h-100 border-0 shadow-lg rounded-4 service-card-hover">
                <div class="card-body text-center p-4">
                    <div class="icon-circle mx-auto mb-3">
                        <i class="fas fa-heartbeat fa-3x"></i>
                    </div>
                    <h5 class="card-title fw-bold fs-5">{{ $service->name }}</h5>
                    <p class="card-text text-muted">{{ Str::limit($service->description, 100) }}</p>
                    <span class="badge bg-success px-3 py-2 rounded-pill">Available</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Doctors Section -->
<div class="bg-light py-5">
    <div class="container py-4">
        <div class="text-center mb-5">
            <span class="badge bg-primary bg-opacity-10 text-primary px-4 py-2 rounded-pill mb-3">Medical Experts</span>
            <h2 class="display-5 fw-bold" style="color: #1A4A6B;">Meet Our Specialist Doctors</h2>
            <div class="divider mx-auto my-3" style="width: 80px; height: 4px; background: linear-gradient(90deg, #1A4A6B, #3498db); border-radius: 2px;"></div>
            <p class="text-muted mx-auto" style="max-width: 650px;">Highly qualified and experienced medical professionals dedicated to your health</p>
        </div>
        <div class="row g-4">
            @foreach($featuredDoctors as $doctor)
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-lg rounded-4 text-center doctor-card-hover h-100">
                    <div class="card-body p-4">
                        <div class="doctor-img mx-auto mb-3">
                            @if($doctor->photo)
                                <img src="{{ asset('storage/' . $doctor->photo) }}" class="rounded-circle" style="width: 130px; height: 130px; object-fit: cover; border: 4px solid #1A4A6B;">
                            @else
                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 130px; height: 130px; border: 4px solid #1A4A6B;">
                                    <i class="fas fa-user-md fa-4x" style="color: #1A4A6B;"></i>
                                </div>
                            @endif
                        </div>
                        <h6 class="card-title fw-bold mb-1 fs-6">Dr. {{ $doctor->name }}</h6>
                        <p class="text-primary small mb-1 fw-semibold">{{ $doctor->specialty }}</p>
                        <p class="text-muted small">{{ $doctor->designation }}</p>
                        <div class="rating mt-2">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Emergency Banner -->
<div class="container my-5">
    <div class="card border-0 rounded-4 shadow-xxl overflow-hidden" style="background: linear-gradient(135deg, #1A4A6B 0%, #0B2B40 100%);">
        <div class="card-body p-0">
            <div class="row g-0 align-items-center">
                <div class="col-md-8 p-5">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="bg-danger rounded-circle p-3">
                            <i class="fas fa-ambulance fa-2x text-white"></i>
                        </div>
                        <span class="badge bg-white text-danger px-4 py-2 rounded-pill">Emergency 24/7</span>
                    </div>
                    <h3 class="text-white fw-bold mb-3 display-6">Need Immediate Medical Attention?</h3>
                    <p class="text-white opacity-90 mb-4 fs-5">Our emergency team is always ready to provide immediate care. Don't wait in critical situations.</p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="tel:+8801234567890" class="btn btn-danger btn-lg px-5 py-3 rounded-pill shadow-lg fw-bold">
                            <i class="fas fa-phone-alt me-2"></i> Call Emergency: +880 1234 567890
                        </a>
                        <a href="{{ route('appointment.create') }}" class="btn btn-outline-light btn-lg px-5 py-3 rounded-pill fw-bold">
                            <i class="fas fa-calendar-check me-2"></i> Book Appointment
                        </a>
                    </div>
                </div>
                <div class="col-md-4 bg-success bg-opacity-15 text-center p-5">
                    <i class="fas fa-clock fa-4x text-white mb-3"></i>
                    <h4 class="text-white fw-bold">Quick Response</h4>
                    <p class="text-white opacity-90 mb-0">Average arrival time: <strong class="text-warning">15 minutes</strong></p>
                    <hr class="bg-white opacity-25 my-3">
                    <p class="text-white mb-0"><i class="fas fa-check-circle me-2 text-success"></i> Fully Equipped ICU</p>
                    <p class="text-white mb-0"><i class="fas fa-check-circle me-2 text-success"></i> Expert Emergency Team</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Testimonials -->
<div class="bg-light py-5">
    <div class="container py-4">
        <div class="text-center mb-5">
            <span class="badge bg-primary bg-opacity-10 text-primary px-4 py-2 rounded-pill mb-3">Patient Stories</span>
            <h2 class="display-5 fw-bold" style="color: #1A4A6B;">What Our Patients Say</h2>
            <div class="divider mx-auto my-3" style="width: 80px; height: 4px; background: linear-gradient(90deg, #1A4A6B, #3498db); border-radius: 2px;"></div>
            <p class="text-muted mx-auto" style="max-width: 650px;">Real experiences from patients who trusted us with their health journey</p>
        </div>
        <div class="row g-4">
            <div class="col-12 col-md-4">
                <div class="card border-0 shadow-lg rounded-4 h-100 testimonial-card">
                    <div class="card-body p-4">
                        <div class="d-flex gap-3 mb-3">
                            <img src="https://ui-avatars.com/api/?background=1A4A6B&color=fff&rounded=true&bold=true&size=50&name=John+Doe" class="rounded-circle" width="60" height="60">
                            <div>
                                <h6 class="mb-0 fw-bold">John Doe</h6>
                                <small class="text-muted">Cardiology Patient</small>
                            </div>
                        </div>
                        <i class="fas fa-quote-left fa-2x text-primary opacity-25"></i>
                        <p class="card-text mt-2 text-muted fst-italic">"Excellent care and compassionate staff. The doctors are very knowledgeable and took time to explain everything about my treatment."</p>
                        <div class="text-warning">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card border-0 shadow-lg rounded-4 h-100 testimonial-card">
                    <div class="card-body p-4">
                        <div class="d-flex gap-3 mb-3">
                            <img src="https://ui-avatars.com/api/?background=1A4A6B&color=fff&rounded=true&bold=true&size=50&name=Jane+Smith" class="rounded-circle" width="60" height="60">
                            <div>
                                <h6 class="mb-0 fw-bold">Jane Smith</h6>
                                <small class="text-muted">Neurology Patient</small>
                            </div>
                        </div>
                        <i class="fas fa-quote-left fa-2x text-primary opacity-25"></i>
                        <p class="card-text mt-2 text-muted fst-italic">"State-of-the-art facilities and modern equipment. Very impressed with the service quality and professionalism of the staff."</p>
                        <div class="text-warning">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card border-0 shadow-lg rounded-4 h-100 testimonial-card">
                    <div class="card-body p-4">
                        <div class="d-flex gap-3 mb-3">
                            <img src="https://ui-avatars.com/api/?background=1A4A6B&color=fff&rounded=true&bold=true&size=50&name=Robert+Johnson" class="rounded-circle" width="60" height="60">
                            <div>
                                <h6 class="mb-0 fw-bold">Robert Johnson</h6>
                                <small class="text-muted">Surgery Patient</small>
                            </div>
                        </div>
                        <i class="fas fa-quote-left fa-2x text-primary opacity-25"></i>
                        <p class="card-text mt-2 text-muted fst-italic">"The staff is very friendly and helpful. Made my hospital stay comfortable and stress-free. Highly recommended!"</p>
                        <div class="text-warning">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Professional CSS Styles */
.min-vh-75 {
    min-height: 75vh;
}

.shadow-xxl {
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
}

/* Stat Card Animation */
.stat-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 30px 40px rgba(0,0,0,0.2) !important;
}

/* Service Card Hover */
.service-card-hover {
    transition: all 0.3s ease;
}

.service-card-hover:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 35px rgba(0,0,0,0.15) !important;
}

.service-card-hover:hover .icon-circle {
    background: linear-gradient(135deg, #1A4A6B, #3498db);
    transform: scale(1.1);
}

.service-card-hover:hover .icon-circle i {
    color: white;
}

.icon-circle {
    width: 80px;
    height: 80px;
    background: rgba(26, 74, 107, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.icon-circle i {
    color: #1A4A6B;
    transition: all 0.3s ease;
}

/* Doctor Card Hover */
.doctor-card-hover {
    transition: all 0.3s ease;
}

.doctor-card-hover:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 35px rgba(0,0,0,0.15) !important;
}

.doctor-card-hover:hover .doctor-img img {
    border-color: #3498db !important;
    transform: scale(1.05);
}

.doctor-img img, .doctor-img div {
    transition: all 0.3s ease;
}

/* Testimonial Card */
.testimonial-card {
    transition: all 0.3s ease;
}

.testimonial-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 30px rgba(0,0,0,0.1) !important;
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-section {
        min-height: auto;
        padding: 2rem 0;
    }
    
    .display-3 {
        font-size: 2rem;
    }
    
    .lead {
        font-size: 1rem;
    }
    
    .btn-lg {
        font-size: 0.85rem;
        padding: 0.6rem 1.2rem;
    }
    
    .stat-card .display-5 {
        font-size: 1.8rem;
    }
    
    .display-5 {
        font-size: 1.8rem;
    }
    
    .card-body {
        padding: 1.2rem !important;
    }
    
    .rounded-circle {
        width: 80px !important;
        height: 80px !important;
    }
    
    .icon-circle {
        width: 60px;
        height: 60px;
    }
    
    .icon-circle i {
        font-size: 1.8rem;
    }
}

@media (min-width: 769px) and (max-width: 992px) {
    .display-3 {
        font-size: 2.5rem;
    }
    
    .stat-card .display-5 {
        font-size: 2rem;
    }
}

/* Smooth Scroll */
html {
    scroll-behavior: smooth;
}

/* Animation Keyframes */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

.hero-section .col-lg-6:first-child {
    animation: fadeInUp 0.8s ease-out;
}

.hero-section .col-lg-6:last-child {
    animation: fadeIn 1s ease-out;
}

/* Custom Scrollbar */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

::-webkit-scrollbar-thumb {
    background: #1A4A6B;
    border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
    background: #0B2B40;
}
</style>
@endsection