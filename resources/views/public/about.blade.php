@extends('layouts.app')

@section('title', 'About Us - Care Plus Hospital')

@section('content')
<!-- Hero Section -->
<div class="hero-section position-relative text-white" style="background: linear-gradient(135deg, #0B2B40 0%, #1A4A6B 50%, #0B2B40 100%); padding: 80px 0; position: relative; overflow: hidden;">
    <div class="position-absolute w-100 h-100" style="background-image: url('data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 1440 320\'%3E%3Cpath fill=\'rgba(255,255,255,0.05)\' d=\'M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,165.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z\'%3E%3C/path%3E%3C/svg%3E'); background-repeat: repeat-x; background-position: bottom; opacity: 0.4;"></div>
    <div class="container position-relative">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <span class="badge bg-warning text-dark px-4 py-2 rounded-pill mb-3 fw-semibold">About Us</span>
                <h1 class="display-4 fw-bold mb-3">Care Plus Hospital</h1>
                <p class="lead opacity-90">Serving the community with excellence since 1999</p>
                <div class="mt-4">
                    <div class="d-flex justify-content-center gap-2">
                        <div class="bg-white rounded-pill" style="width: 50px; height: 3px;"></div>
                        <div class="bg-warning rounded-pill" style="width: 30px; height: 3px;"></div>
                        <div class="bg-white rounded-pill" style="width: 50px; height: 3px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <!-- Hospital Overview -->
    <div class="row align-items-center g-5 mb-5">
        <div class="col-lg-6">
            <div class="position-relative">
                <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?w=600&h=400&fit=crop" alt="Hospital Building" class="img-fluid rounded-4 shadow-lg" style="width: 100%;">
                <div class="position-absolute bottom-0 start-0 translate-middle-y ms-3 mb-2">
                    <div class="bg-warning rounded-3 p-2 px-3 shadow">
                        <span class="fw-bold text-dark">25+ Years of Excellence</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill mb-3">Our Legacy</span>
            <h2 class="display-6 fw-bold" style="color: #1A4A6B;">Welcome to Care Plus Hospital</h2>
            <p class="text-muted mt-3">Care Plus Hospital is a multi-specialty healthcare institution committed to providing world-class medical services at affordable costs.</p>
            <p class="text-muted">Founded in 1999, we have grown to become one of the most trusted healthcare providers in the region, serving over 500,000 patients annually with a 98% satisfaction rate.</p>
            <div class="row g-4 mt-2">
                <div class="col-6">
                    <div class="d-flex align-items-center gap-3 p-3 bg-light rounded-3">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-hospital-user fa-2x text-primary"></i>
                        </div>
                        <div>
                            <h3 class="mb-0 fw-bold text-primary">500+</h3>
                            <small class="text-muted">Beds Capacity</small>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-flex align-items-center gap-3 p-3 bg-light rounded-3">
                        <div class="bg-success bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-user-md fa-2x text-success"></i>
                        </div>
                        <div>
                            <h3 class="mb-0 fw-bold text-success">200+</h3>
                            <small class="text-muted">Expert Doctors</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mission & Vision -->
    <div class="row g-4 mb-5">
        <div class="col-md-6">
            <div class="card border-0 shadow-lg rounded-4 h-100 mission-card">
                <div class="card-body p-4 p-md-5 text-center">
                    <div class="mission-icon mx-auto mb-4">
                        <i class="fas fa-bullseye fa-3x"></i>
                    </div>
                    <h3 class="fw-bold mb-3">Our Mission</h3>
                    <p class="text-muted">To provide compassionate, high-quality healthcare services to our community with excellence, innovation, and integrity, ensuring every patient receives personalized attention.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-lg rounded-4 h-100 vision-card">
                <div class="card-body p-4 p-md-5 text-center">
                    <div class="vision-icon mx-auto mb-4">
                        <i class="fas fa-eye fa-3x"></i>
                    </div>
                    <h3 class="fw-bold mb-3">Our Vision</h3>
                    <p class="text-muted">To be the leading healthcare provider in the region, recognized for excellence in patient care, medical research, education, and innovation.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Management Team Section -->
    <div class="text-center mb-5">
        <span class="badge bg-primary bg-opacity-10 text-primary px-4 py-2 rounded-pill mb-3">Leadership</span>
        <h2 class="display-6 fw-bold" style="color: #1A4A6B;">Our Management Team</h2>
        <div class="divider mx-auto my-3" style="width: 80px; height: 4px; background: linear-gradient(90deg, #1A4A6B, #3498db); border-radius: 2px;"></div>
        <p class="text-muted mx-auto" style="max-width: 600px;">Meet the dedicated leaders who drive our excellence and ensure the highest standards of care</p>
    </div>

    <div class="row g-4 mb-5">
        <!-- Management Card 1 -->
        <div class="col-lg-4 col-md-6">
            <div class="card border-0 shadow-lg rounded-4 text-center team-card h-100">
                <div class="card-body p-4">
                    <div class="team-img mx-auto mb-3">
                        <img src="{{ asset('images/ankur.png') }}" alt="Dev.Ankur" class="rounded-circle" style="width: 140px; height: 140px; object-fit: cover; border: 4px solid #1A4A6B;">
                    </div>
                    <h4 class="fw-bold mb-1">Mr. Ankur</h4>
                    <p class="text-primary fw-semibold mb-2">The Full Stack Developer(Leader)</p>
                    <p class="text-muted small mb-3">B.Sc in Computer Science</p>
                    <div class="quote-box p-3 rounded-3">
                        <i class="fas fa-quote-left text-primary me-2"></i>
                        <span class="small fst-italic">"Our commitment is to deliver exceptional healthcare with compassion and innovation, leveraging technology for better patient outcomes."</span>
                    </div>
                    <div class="social-links mt-3">
                        <a href="#" class="btn btn-sm btn-outline-primary rounded-circle me-1"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="btn btn-sm btn-outline-info rounded-circle me-1"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="btn btn-sm btn-outline-dark rounded-circle"><i class="fab fa-github"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Management Card 2 -->
        <div class="col-lg-4 col-md-6">
            <div class="card border-0 shadow-lg rounded-4 text-center team-card h-100">
                <div class="card-body p-4">
                    <div class="team-img mx-auto mb-3">
                        <img src="{{ asset('images/tina2.png') }}" alt="Maria Afrin Tina" class="rounded-circle" style="width: 140px; height: 140px; object-fit: cover; border: 4px solid #1A4A6B;">
                    </div>
                    <h4 class="fw-bold mb-1">Maria Afrin Tina</h4>
                    <p class="text-primary fw-semibold mb-2">Frontend Designer & Planner</p>
                    <p class="text-muted small mb-3">B.Sc in Computer Science</p>
                    <div class="quote-box p-3 rounded-3">
                        <i class="fas fa-quote-left text-primary me-2"></i>
                        <span class="small fst-italic">"Every patient deserves personalized care. We make it our priority to ensure comfort, dignity, and excellence in treatment."</span>
                    </div>
                    <div class="social-links mt-3">
                        <a href="#" class="btn btn-sm btn-outline-primary rounded-circle me-1"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="btn btn-sm btn-outline-info rounded-circle me-1"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="btn btn-sm btn-outline-danger rounded-circle"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Management Card 3 -->
        <div class="col-lg-4 col-md-6">
            <div class="card border-0 shadow-lg rounded-4 text-center team-card h-100">
                <div class="card-body p-4">
                    <div class="team-img mx-auto mb-3">
                        <img src="{{ asset('images/manik pa.png') }}" alt="Manik Halder" class="rounded-circle" style="width: 140px; height: 140px; object-fit: cover; border: 4px solid #1A4A6B;">
                    </div>
                    <h4 class="fw-bold mb-1">Mr. Manik Halder</h4>
                    <p class="text-primary fw-semibold mb-2">Structure Designer & Assistant Developer</p>
                    <p class="text-muted small mb-3">B.Sc in Computer Science</p>
                    <div class="quote-box p-3 rounded-3">
                        <i class="fas fa-quote-left text-primary me-2"></i>
                        <span class="small fst-italic">"Efficiency and patient comfort go hand in hand. We optimize our operations to deliver seamless healthcare experiences."</span>
                    </div>
                    <div class="social-links mt-3">
                        <a href="#" class="btn btn-sm btn-outline-primary rounded-circle me-1"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="btn btn-sm btn-outline-info rounded-circle me-1"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="btn btn-sm btn-outline-dark rounded-circle"><i class="fab fa-github"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Core Values -->
    <div class="bg-light rounded-4 p-4 p-md-5 mb-5">
        <div class="text-center mb-4">
            <span class="badge bg-primary bg-opacity-10 text-primary px-4 py-2 rounded-pill mb-3">Our Principles</span>
            <h2 class="display-6 fw-bold" style="color: #1A4A6B;">Our Core Values</h2>
            <div class="divider mx-auto my-3" style="width: 60px; height: 4px; background: linear-gradient(90deg, #1A4A6B, #3498db); border-radius: 2px;"></div>
        </div>
        <div class="row g-4">
            <div class="col-md-3 col-6">
                <div class="text-center p-3">
                    <div class="bg-white rounded-circle d-inline-flex align-items-center justify-content-center shadow-sm" style="width: 70px; height: 70px;">
                        <i class="fas fa-heartbeat fa-2x text-danger"></i>
                    </div>
                    <h6 class="mt-3 fw-bold mb-0">Compassion</h6>
                    <small class="text-muted">Caring Hearts</small>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="text-center p-3">
                    <div class="bg-white rounded-circle d-inline-flex align-items-center justify-content-center shadow-sm" style="width: 70px; height: 70px;">
                        <i class="fas fa-star fa-2x text-warning"></i>
                    </div>
                    <h6 class="mt-3 fw-bold mb-0">Excellence</h6>
                    <small class="text-muted">Best in Class</small>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="text-center p-3">
                    <div class="bg-white rounded-circle d-inline-flex align-items-center justify-content-center shadow-sm" style="width: 70px; height: 70px;">
                        <i class="fas fa-hand-holding-heart fa-2x text-success"></i>
                    </div>
                    <h6 class="mt-3 fw-bold mb-0">Integrity</h6>
                    <small class="text-muted">Honest Care</small>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="text-center p-3">
                    <div class="bg-white rounded-circle d-inline-flex align-items-center justify-content-center shadow-sm" style="width: 70px; height: 70px;">
                        <i class="fas fa-lightbulb fa-2x text-info"></i>
                    </div>
                    <h6 class="mt-3 fw-bold mb-0">Innovation</h6>
                    <small class="text-muted">Modern Approach</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Location & Contact Section -->
    <div class="row g-4 mb-5">
        <div class="col-lg-6">
            <div class="card border-0 shadow-lg rounded-4 h-100">
                <div class="card-body p-4">
                    <h3 class="fw-bold mb-4" style="color: #1A4A6B;"><i class="fas fa-map-marker-alt text-primary me-2"></i>Our Location</h3>
                    <div class="ratio ratio-16x9 mb-3 rounded-3 overflow-hidden">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3075.3419804031064!2d90.42360667444127!3d23.801410186817883!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c7bba6ffeb31%3A0xdb02a491b63b8494!2sUniversity%20of%20Information%20Technology%20and%20Sciences%20(UITS)!5e1!3m2!1sen!2sbd!4v1777038147520!5m2!1sen!2sbd" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <p class="mb-2"><i class="fas fa-building me-2 text-primary"></i>123 Healthcare Avenue, Medical District</p>
                    <p class="mb-0"><i class="fas fa-university me-2 text-primary"></i>Near University of Information Technology and Sciences (UITS)</p>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card border-0 shadow-lg rounded-4 h-100">
                <div class="card-body p-4">
                    <h3 class="fw-bold mb-4" style="color: #1A4A6B;"><i class="fas fa-address-card text-primary me-2"></i>Contact Information</h3>
                    <div class="contact-info">
                        <div class="d-flex align-items-center gap-3 mb-3 p-3 bg-light rounded-3">
                            <div class="bg-primary rounded-circle p-2" style="width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-phone fa-fw text-white"></i>
                            </div>
                            <div>
                                <strong>Phone:</strong> +92453658
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-3 mb-3 p-3 bg-light rounded-3">
                            <div class="bg-success rounded-circle p-2" style="width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-envelope fa-fw text-white"></i>
                            </div>
                            <div>
                                <strong>Email:</strong> info@CarePlusHospital.com
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-3 mb-3 p-3 bg-light rounded-3">
                            <div class="bg-warning rounded-circle p-2" style="width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-clock fa-fw text-dark"></i>
                            </div>
                            <div>
                                <strong>Emergency:</strong> 24/7 Available
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-3 p-3 bg-light rounded-3">
                            <div class="bg-info rounded-circle p-2" style="width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-calendar-alt fa-fw text-white"></i>
                            </div>
                            <div>
                                <strong>OPD Hours:</strong> Mon-Sat: 9:00 AM - 6:00 PM
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="social-links">
                        <h6 class="fw-bold mb-3">Connect With Us</h6>
                        <div class="d-flex gap-2">
                            <a href="https://www.facebook.com/saha.pradyumna.prasad" class="btn btn-outline-primary rounded-circle" style="width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center;"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://github.com/Saha-Pradyumna-Prasad" class="btn btn-outline-dark rounded-circle" style="width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center;"><i class="fab fa-github"></i></a>
                            <a href="#" class="btn btn-outline-danger rounded-circle" style="width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center;"><i class="fab fa-instagram"></i></a>
                            <a href="https://www.linkedin.com/in/saha-pradyumna-prasad-ankur-815101313/" class="btn btn-outline-primary rounded-circle" style="width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center;"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Form -->
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="row g-0">
                    <div class="col-md-4 bg-primary text-white p-4 d-flex flex-column justify-content-center" style="background: linear-gradient(135deg, #1A4A6B, #0B2B40);">
                        <i class="fas fa-envelope-open-text fa-3x mb-3"></i>
                        <h4 class="fw-bold">Send Us a Message</h4>
                        <p class="opacity-75 small">Have questions? We'd love to hear from you. Our team will respond within 24 hours.</p>
                        <div class="mt-3">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <i class="fas fa-phone-alt"></i>
                                <small>Emergency: +92453658</small>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-envelope"></i>
                                <small>info@CarePlusHospital.com</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body p-4 p-md-5">
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <form action="{{ route('about.contact') }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Your Name *</label>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Email Address *</label>
                                        <input type="email" name="email" class="form-control" required>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Subject</label>
                                        <input type="text" name="subject" class="form-control">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Message *</label>
                                        <textarea name="message" rows="5" class="form-control" required></textarea>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary w-100 py-3 fw-semibold rounded-pill" style="background: linear-gradient(135deg, #1A4A6B, #0B2B40); border: none;">
                                            <i class="fas fa-paper-plane me-2"></i>Send Message
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .mission-card, .vision-card, .team-card {
        transition: all 0.3s ease;
    }
    
    .mission-card:hover, .vision-card:hover, .team-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15) !important;
    }
    
    .mission-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, rgba(26,74,107,0.1), rgba(52,152,219,0.1));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .mission-icon i, .vision-icon i {
        color: #1A4A6B;
    }
    
    .vision-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, rgba(26,74,107,0.1), rgba(52,152,219,0.1));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .quote-box {
        background: #f8f9fa;
        border-left: 4px solid #1A4A6B;
    }
    
    .team-img img {
        transition: transform 0.3s ease;
    }
    
    .team-card:hover .team-img img {
        transform: scale(1.05);
        border-color: #3498db !important;
    }
    
    .contact-info > div {
        transition: all 0.3s ease;
    }
    
    .contact-info > div:hover {
        transform: translateX(5px);
        background: #e9ecef !important;
    }
    
    @media (max-width: 768px) {
        .display-4 {
            font-size: 2rem;
        }
        .display-6 {
            font-size: 1.5rem;
        }
        .mission-icon, .vision-icon {
            width: 60px;
            height: 60px;
        }
        .team-img img {
            width: 100px !important;
            height: 100px !important;
        }
    }
</style>
@endsection