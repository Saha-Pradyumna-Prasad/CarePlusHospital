<div class="sidebar bg-dark text-white" style="width: 250px; min-height: 100vh; position: fixed; top: 0; left: 0; z-index: 100; overflow-y: auto; overflow-x: hidden; transition: all 0.3s ease;">
    
    <div class="sidebar-header p-3">
        <h5 class="fs-7 fs-md-5 mb-0"><i class="fas fa-hospital-user"></i> <span class="d-none d-md-inline">HMS Dashboard</span><span class="d-inline d-md-none">HMS</span></h5>
    </div>
    <hr class="bg-light my-2">
    <ul class="nav flex-column pb-4">
        <li class="nav-item">
            <a class="nav-link text-white py-2 py-md-3" href="{{ route('dashboard') }}">
                <i class="fas fa-tachometer-alt me-2"></i> <span class="d-none d-md-inline">Dashboard</span>
            </a>
        </li>
        
        {{-- @role('admin') --}}
        <h3><b><u><i>Admin Menu</i></u></b></h3>
        <li class="nav-item">
            <a class="nav-link text-white py-2 py-md-3" href="#doctorsMenu" data-bs-toggle="collapse" aria-expanded="false">
                <i class="fas fa-user-md me-2"></i> <span class="d-none d-md-inline">Doctors Management</span>
                <i class="fas fa-chevron-down float-end d-none d-md-inline-block"></i>
            </a>
            <div class="collapse" id="doctorsMenu">
                <ul class="nav flex-column ms-3">
                    <li><a class="nav-link text-white py-1 py-md-2" href="{{ route('admin.doctors') }}">View Doctors</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white py-2 py-md-3" href="{{ route('admin.pas') }}">
                <i class="fas fa-user-nurse me-2"></i> <span class="d-none d-md-inline">PAs Management</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white py-2 py-md-3" href="{{ route('admin.staff') }}">
                <i class="fas fa-users me-2"></i> <span class="d-none d-md-inline">Staff Management</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white py-2 py-md-3" href="{{ route('admin.patients') }}">
                <i class="fas fa-procedures me-2"></i> <span class="d-none d-md-inline">Patients Management</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white py-2 py-md-3" href="{{ route('admin.services') }}">
                <i class="fas fa-concierge-bell me-2"></i> <span class="d-none d-md-inline">Services</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white py-2 py-md-3" href="{{ route('admin.rooms') }}">
                <i class="fas fa-bed me-2"></i> <span class="d-none d-md-inline">Rooms</span>
            </a>
        </li>
        {{-- @endrole --}}
        

      
       
    </ul>
</div>

<style>
/* Sidebar independent scrolling */
.sidebar {
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 100;
    overflow-y: auto;
    overflow-x: hidden;
    scrollbar-width: thin;
    scrollbar-color: #4a5568 #2d3748;
    text-align: center
}

/* Custom scrollbar for Webkit browsers (Chrome, Safari, Edge) */
.sidebar::-webkit-scrollbar {
    width: 5px;
}

.sidebar::-webkit-scrollbar-track {
    background: #2d3748;
    border-radius: 10px;
}

.sidebar::-webkit-scrollbar-thumb {
    background: #4a5568;
    border-radius: 10px;
}

.sidebar::-webkit-scrollbar-thumb:hover {
    background: #718096;
}

/* Main content wrapper - adjust for fixed sidebar */
#page-content-wrapper {
    margin-left: 250px;
    width: calc(100% - 250px);
    min-height: 100vh;
}

/* Desktop styles */
@media (min-width: 769px) and (max-width: 1024px) {
    .sidebar {
        width: 220px !important;
    }
    #page-content-wrapper {
        margin-left: 220px !important;
        width: calc(100% - 220px) !important;
    }
}

/* Tablet styles */
@media (max-width: 768px) {
    .sidebar {
        width: 60px !important;
        left: -60px;
        transition: left 0.3s ease;
    }
    
    .sidebar.active {
        left: 0;
        width: 250px !important;
    }
    
    .sidebar .nav-link {
        text-align: center;
        padding: 0.75rem 0 !important;
        white-space: nowrap;
    }
    
    .sidebar.active .nav-link {
        text-align: left;
        padding: 0.75rem 1rem !important;
    }
    
    .sidebar .nav-link i {
        font-size: 1.2rem;
        margin-right: 0 !important;
    }
    
    .sidebar.active .nav-link i {
        margin-right: 0.5rem !important;
    }
    
    .sidebar .nav-link span {
        display: none;
    }
    
    .sidebar.active .nav-link span {
        display: inline-block;
    }
    
    .sidebar .nav-link .fa-chevron-down {
        display: none !important;
    }
    
    .sidebar.active .nav-link .fa-chevron-down {
        display: inline-block !important;
    }
    
    .sidebar-header h5 span {
        display: none;
    }
    
    .sidebar.active .sidebar-header h5 span {
        display: inline;
    }
    
    .sidebar .sidebar-header h5 {
        text-align: center;
        font-size: 0.8rem !important;
    }
    
    .sidebar.active .sidebar-header h5 {
        text-align: left;
    }
    
    .sidebar hr {
        margin: 0.5rem 0;
    }
    
    .collapse {
        display: block !important;
    }
    
    .sidebar .ms-3 {
        margin-left: 0 !important;
    }
    
    .sidebar.active .ms-3 {
        margin-left: 1rem !important;
    }
    
    .sidebar .ms-3 .nav-link {
        font-size: 0.7rem;
        padding: 0.4rem 0 !important;
    }
    
    .sidebar.active .ms-3 .nav-link {
        font-size: 0.85rem;
        padding: 0.5rem 1rem !important;
    }
    
    #page-content-wrapper {
        margin-left: 0 !important;
        width: 100% !important;
    }
    
    /* Sidebar toggle button */
    .sidebar-toggle-btn {
        position: fixed;
        top: 70px;
        left: 15px;
        z-index: 1050;
        background: #2c3e50;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 8px 12px;
        cursor: pointer;
        display: block;
    }
}

@media (max-width: 576px) {
    .sidebar.active {
        width: 100% !important;
    }
    
    .sidebar .nav-link i {
        font-size: 1rem;
    }
    
    .sidebar-header h5 {
        font-size: 0.7rem !important;
    }
}

/* Mobile sidebar toggle button style */
.sidebar-toggle-btn {
    display: none;
}

@media (max-width: 768px) {
    .sidebar-toggle-btn {
        display: block;
    }
}

/* Prevent body scroll when sidebar is open on mobile */
body.sidebar-open {
    overflow: hidden;
}
</style>

<script>
// Sidebar toggle functionality for mobile
$(document).ready(function() {
    // Add toggle button if not exists
    if ($('.sidebar-toggle-btn').length === 0 && $(window).width() <= 768) {
        $('body').prepend('<button class="sidebar-toggle-btn" id="sidebarToggleBtn"><i class="fas fa-bars"></i></button>');
    }
    
    // Toggle sidebar
    $('#sidebarToggleBtn').click(function() {
        $('.sidebar').toggleClass('active');
        $('body').toggleClass('sidebar-open');
    });
    
    // Close sidebar when clicking outside on mobile
    $(document).click(function(e) {
        if ($(window).width() <= 768) {
            if (!$(e.target).closest('.sidebar').length && !$(e.target).closest('#sidebarToggleBtn').length) {
                $('.sidebar').removeClass('active');
                $('body').removeClass('sidebar-open');
            }
        }
    });
    
    // Handle window resize
    $(window).resize(function() {
        if ($(window).width() > 768) {
            $('.sidebar').removeClass('active');
            $('body').removeClass('sidebar-open');
            $('#sidebarToggleBtn').remove();
        } else if ($(window).width() <= 768 && $('#sidebarToggleBtn').length === 0) {
            $('body').prepend('<button class="sidebar-toggle-btn" id="sidebarToggleBtn"><i class="fas fa-bars"></i></button>');
            $('#sidebarToggleBtn').click(function() {
                $('.sidebar').toggleClass('active');
                $('body').toggleClass('sidebar-open');
            });
        }
    });
});
</script>