<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
    <div class="container-fluid px-2 px-sm-3 px-md-4">
        <button class="btn btn-primary" id="sidebar-toggle" aria-label="Toggle Sidebar">
            <i class="fas fa-bars"></i>
        </button>

        <div class="ms-auto">
            <div class="dropdown">
                <button class="btn btn-light dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-user-circle"></i>
                    <span class="d-none d-sm-inline">{{ Str::limit(Auth::user()->name, 15) }}</span>
                    <span class="d-inline d-sm-none"><i class="fas fa-user"></i></span>
                    <span class="badge bg-primary d-none d-md-inline">{{ ucfirst(Auth::user()->role) }}</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-user me-2"></i> Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt me-2"></i> Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<style>
@media (max-width: 768px) {
    .btn-light {
        font-size: 0.85rem;
        padding: 0.35rem 0.7rem;
    }
    
    .btn-primary {
        padding: 0.35rem 0.7rem;
        font-size: 0.85rem;
    }
    
    .badge {
        font-size: 0.65rem;
        padding: 0.2rem 0.4rem;
    }
    
    .dropdown-item {
        font-size: 0.85rem;
        padding: 0.4rem 0.75rem;
    }
}

@media (max-width: 576px) {
    .btn-light {
        font-size: 0.75rem;
        padding: 0.3rem 0.6rem;
    }
    
    .btn-primary {
        padding: 0.3rem 0.6rem;
        font-size: 0.75rem;
    }
    
    .dropdown-item {
        font-size: 0.8rem;
        padding: 0.35rem 0.7rem;
    }
    
    .me-2 {
        margin-right: 0.3rem !important;
    }
}

/* Sidebar toggle functionality */
.sidebar {
    transition: all 0.3s ease;
}

@media (min-width: 769px) {
    .sidebar.active {
        margin-left: -250px;
    }
}

@media (max-width: 768px) {
    .sidebar {
        position: fixed;
        left: 0;
        top: 0;
        z-index: 1000;
    }
    
    .sidebar.active {
        left: -250px;
    }
}
</style>

<script>
$(document).ready(function() {
    // Sidebar toggle functionality
    $('#sidebar-toggle').on('click', function(e) {
        e.preventDefault();
        $('.sidebar').toggleClass('active');
        
        // Store sidebar state in localStorage
        const isActive = $('.sidebar').hasClass('active');
        localStorage.setItem('sidebarActive', isActive);
    });
    
    // Restore sidebar state
    const sidebarActive = localStorage.getItem('sidebarActive') === 'true';
    if (sidebarActive) {
        $('.sidebar').addClass('active');
    }
    
    // Auto-close sidebar on mobile when clicking a link
    if (window.innerWidth <= 768) {
        $('.sidebar .nav-link').on('click', function() {
            if (!$(this).hasClass('dropdown-toggle')) {
                $('.sidebar').removeClass('active');
                localStorage.setItem('sidebarActive', false);
            }
        });
    }
});
</script>