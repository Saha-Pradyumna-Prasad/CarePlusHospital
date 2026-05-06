<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard - City Care Hospital')</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <!-- SweetAlert2 -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    
    <style>
        /* Enhanced responsive sidebar and content */
        #wrapper {
            overflow-x: hidden;
            background-color: #f8f9fc;
        }
        
        #page-content-wrapper {
            width: 100%;
            min-height: 100vh;
            transition: all 0.3s ease;
        }
        
        /* Mobile-first responsive design */
        @media (max-width: 768px) {
            .container-fluid {
                padding: 0.5rem !important;
            }
            
            .alert {
                font-size: 0.85rem;
                padding: 0.75rem 1rem;
            }
            
            .table-responsive {
                margin-bottom: 0.5rem;
            }
            
            /* Card improvements for mobile */
            .card {
                margin-bottom: 1rem;
            }
            
            .card-body {
                padding: 0.75rem !important;
            }
            
            .card-header {
                padding: 0.6rem 0.75rem !important;
            }
            
            /* Modal improvements for mobile */
            .modal-dialog {
                margin: 0.5rem;
            }
            
            .modal-body {
                padding: 0.75rem;
                max-height: 60vh;
                overflow-y: auto;
            }
            
            .modal-footer {
                padding: 0.75rem;
            }
        }
        
        @media (max-width: 576px) {
            .card-header h5, .card-header h6 {
                font-size: 0.9rem !important;
            }
            
            .btn-sm {
                font-size: 0.7rem;
                padding: 0.25rem 0.5rem;
            }
            
            .badge {
                font-size: 0.7rem;
                padding: 0.2rem 0.4rem;
            }
            
            table th, table td {
                font-size: 0.75rem;
                padding: 0.4rem !important;
            }
            
            .modal-title {
                font-size: 1rem;
            }
            
            .form-label {
                font-size: 0.85rem;
            }
            
            .form-control, .form-select {
                font-size: 0.85rem;
                padding: 0.4rem 0.6rem;
            }
        }
        
        /* Ensure proper touch targets on mobile */
        @media (max-width: 768px) {
            .btn, 
            .nav-link,
            .dropdown-item,
            .sidebar-link {
                min-height: 44px;
                display: inline-flex;
                align-items: center;
            }
            
            button.btn-sm {
                min-height: 32px;
            }
            
            .form-check-input {
                min-height: 20px;
            }
        }
        
        /* Responsive tables */
        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        
        /* Improved scrolling for modals on mobile */
        @media (max-width: 576px) {
            .modal-dialog-scrollable .modal-body {
                max-height: 50vh;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body>
    
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        @include('partials.pa-sidebar')
        
        <!-- Page Content -->
        <div id="page-content-wrapper">
            @include('partials.top-nav')

            
            
            <div class="container-fluid px-3 px-sm-4 py-3 py-md-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-3 mb-md-4" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show mb-3 mb-md-4" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                @yield('content')
            </div>
        </div>
    </div>
    
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    
    <script>
        // Toggle sidebar on mobile
        $(document).ready(function() {
            // Initialize DataTables with responsive options
            if ($.fn.dataTable) {
                $('.datatable').each(function() {
                    if (!$.fn.DataTable.isDataTable(this)) {
                        $(this).DataTable({
                            responsive: true,
                            autoWidth: false,
                            scrollX: true,
                            pageLength: 10,
                            language: {
                                search: "Search:",
                                lengthMenu: "Show _MENU_ entries",
                                info: "Showing _START_ to _END_ of _TOTAL_ entries",
                                paginate: {
                                    first: "First",
                                    last: "Last",
                                    next: "Next",
                                    previous: "Previous"
                                }
                            }
                        });
                    }
                });
            }
            
            // Handle sidebar toggle for mobile
            $('#menu-toggle').on('click', function(e) {
                e.preventDefault();
                $('#wrapper').toggleClass('toggled');
            });
            
            // Adjust modal z-index if needed
            $('.modal').on('show.bs.modal', function() {
                $('.modal-backdrop').css('z-index', '1040');
                $(this).css('z-index', '1050');
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>