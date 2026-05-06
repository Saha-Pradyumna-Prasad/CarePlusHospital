<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-lg sticky-top" style="backdrop-filter: blur(0px);">
    <div class="container px-2 px-sm-3 px-md-4">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}" style="font-size: 1.4rem;">
            <div class="d-flex align-items-center gap-2">
                <div class="brand-icon bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                    <i class="fas fa-hospital-user text-white fa-lg"></i>
                </div>
                <div>
                    <span class="text-primary d-none d-sm-inline" style="font-size: 1.2rem;">Care Plus</span>
                    <span class="text-dark fw-semibold d-none d-sm-inline" style="font-size: 1.2rem;">Hospital</span>
                    <span class="d-inline d-sm-none text-primary fw-bold">CPH</span>
                </div>
            </div>
        </a>
        
        <button class="navbar-toggler border-0 p-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" style="background: linear-gradient(135deg, #1A4A6B, #0B2B40);">
            <span class="navbar-toggler-icon" style="filter: brightness(0) invert(1);"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto gap-1 gap-lg-2">
                <li class="nav-item">
                    <a class="nav-link fw-semibold px-3" href="{{ route('home') }}" style="color: #2c3e50; transition: all 0.3s;">
                        <i class="fas fa-home me-1 d-lg-none"></i> Home
                    </a>
                </li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-semibold px-3" href="#" data-bs-toggle="dropdown" style="color: #2c3e50; transition: all 0.3s;">
                        <i class="fas fa-users me-1 d-lg-none"></i> Staffs
                    </a>
                    <ul class="dropdown-menu border-0 shadow-lg rounded-3 mt-2">
                        <li><a class="dropdown-item py-2" href="{{ route('doctors.index') }}"><i class="fas fa-user-md me-2 text-primary"></i>Doctors</a></li>
                        <li><a class="dropdown-item py-2" href="{{ route('pas.index') }}"><i class="fas fa-user-nurse me-2 text-success"></i>P.A.s</a></li>
                        <li><a class="dropdown-item py-2" href="{{ route('staff.index') }}"><i class="fas fa-user-tie me-2 text-info"></i>Other Staff</a></li>
                    </ul>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link fw-semibold px-3" href="{{ route('services.index') }}" style="color: #2c3e50; transition: all 0.3s;">
                        <i class="fas fa-concierge-bell me-1 d-lg-none"></i> Services
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link fw-semibold px-3" href="{{ route('rooms.index') }}" style="color: #2c3e50; transition: all 0.3s;">
                        <i class="fas fa-bed me-1 d-lg-none"></i> Rooms
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link fw-semibold px-3" href="{{ route('about') }}" style="color: #2c3e50; transition: all 0.3s;">
                        <i class="fas fa-info-circle me-1 d-lg-none"></i> About Us
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link fw-semibold px-3" href="{{ route('appointment.create') }}" style="color: #2c3e50; transition: all 0.3s;">
                        <i class="fas fa-calendar-check me-1 d-lg-none"></i> Appointment
                    </a>
                </li>
                
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center gap-2 px-3" href="#" data-bs-toggle="dropdown" style="color: #2c3e50; transition: all 0.3s;">
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                <i class="fas fa-user text-white fa-sm"></i>
                            </div>
                            <span class="fw-semibold d-none d-md-inline">{{ Str::limit(Auth::user()->name, 12) }}</span>
                            <span class="d-inline d-md-none"><i class="fas fa-user"></i></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-3 mt-2">
                            <li><a class="dropdown-item py-2" href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt me-2 text-primary"></i>Dashboard</a></li>
                            <li><a class="dropdown-item py-2" href="{{ route('profile.edit') }}"><i class="fas fa-user-edit me-2 text-info"></i>Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item py-2"><i class="fas fa-sign-out-alt me-2 text-danger"></i>Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="btn btn-primary rounded-pill px-4 py-2 ms-0 ms-lg-2 mt-2 mt-lg-0 fw-semibold shadow-sm" href="{{ route('login') }}" style="background: linear-gradient(135deg, #1A4A6B, #0B2B40); border: none;">
                            <i class="fas fa-sign-in-alt me-2"></i> Login
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<style>
/* Navbar Professional Styling */
.navbar {
    padding-top: 0.8rem;
    padding-bottom: 0.8rem;
    transition: all 0.3s ease;
}

.navbar.scrolled {
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1) !important;
}

.navbar-brand {
    transition: transform 0.3s ease;
}

.navbar-brand:hover {
    transform: scale(1.02);
}

.brand-icon {
    transition: all 0.3s ease;
}

.navbar-brand:hover .brand-icon {
    transform: rotate(5deg);
}

.nav-link {
    position: relative;
    transition: all 0.3s ease;
}

.nav-link:hover {
    color: #1A4A6B !important;
    transform: translateY(-2px);
}

.nav-link::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    width: 0;
    height: 2px;
    background: linear-gradient(90deg, #1A4A6B, #3498db);
    transition: all 0.3s ease;
    transform: translateX(-50%);
}

.nav-link:hover::after {
    width: 70%;
}

.dropdown-menu {
    animation: fadeInDown 0.3s ease;
    border-radius: 12px;
    min-width: 200px;
}

.dropdown-item {
    transition: all 0.3s ease;
    border-radius: 8px;
    margin: 4px 8px;
    width: auto;
}

.dropdown-item:hover {
    background: linear-gradient(90deg, rgba(26,74,107,0.1), rgba(52,152,219,0.1));
    transform: translateX(5px);
    padding-left: 1.5rem !important;
}

.btn-primary {
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(26,74,107,0.3) !important;
}

@keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Mobile Responsive */
@media (max-width: 991px) {
    .navbar-nav {
        padding-top: 1rem;
    }
    
    .nav-item {
        margin: 0.25rem 0;
    }
    
    .nav-link {
        padding: 0.6rem 1rem !important;
        border-radius: 8px;
    }
    
    .nav-link:hover {
        background: rgba(26,74,107,0.05);
        transform: translateX(5px);
    }
    
    .nav-link::after {
        display: none;
    }
    
    .dropdown-menu {
        background-color: #f8f9fa;
        border: none;
        box-shadow: none;
        padding-left: 1rem;
    }
    
    .dropdown-item {
        padding: 0.5rem 1rem;
    }
    
    .dropdown-item:hover {
        transform: translateX(10px);
    }
    
    .btn-primary {
        width: 100%;
        text-align: center;
        margin-top: 0.5rem;
    }
}

@media (max-width: 768px) {
    .navbar-brand {
        font-size: 1rem;
    }
    
    .brand-icon {
        width: 32px !important;
        height: 32px !important;
    }
    
    .brand-icon i {
        font-size: 14px !important;
    }
    
    .nav-link {
        font-size: 0.85rem;
        padding: 0.5rem 0.75rem !important;
    }
    
    .dropdown-item {
        font-size: 0.85rem;
    }
    
    .btn-primary {
        font-size: 0.85rem;
        padding: 0.5rem 1rem !important;
    }
}

@media (max-width: 576px) {
    .navbar-brand {
        font-size: 0.9rem;
    }
    
    .brand-icon {
        width: 28px !important;
        height: 28px !important;
    }
    
    .nav-link {
        font-size: 0.8rem;
    }
    
    .dropdown-item {
        font-size: 0.8rem;
    }
}

/* Active link styling */
.nav-link.active {
    color: #1A4A6B !important;
    font-weight: 700;
}

.nav-link.active::after {
    width: 70%;
}

/* Scroll effect */
window.addEventListener('scroll', function() {
    if (window.scrollY > 50) {
        document.querySelector('.navbar').classList.add('scrolled');
    } else {
        document.querySelector('.navbar').classList.remove('scrolled');
    }
});
</style>

<script>
// Add scroll class to navbar
document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.querySelector('.navbar');
    if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
    }
    
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
    
    // Active link highlighting
    const currentPath = window.location.pathname;
    document.querySelectorAll('.nav-link').forEach(link => {
        const href = link.getAttribute('href');
        if (href && href !== '#' && currentPath === href) {
            link.classList.add('active');
        }
    });
});
</script>