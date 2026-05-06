<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'City Care Hospital')</title>
    
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
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
    
    <style>
        /* Ensure proper responsive behavior on all devices */
        main {
            min-height: calc(100vh - 160px);
        }
        
        .container {
            width: 100%;
            padding-right: var(--bs-gutter-x, 0.75rem);
            padding-left: var(--bs-gutter-x, 0.75rem);
            margin-right: auto;
            margin-left: auto;
        }
        
        /* Responsive table handling */
        .table-responsive {
            margin-bottom: 1rem;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        
        /* Mobile optimizations */
        @media (max-width: 768px) {
            .alert {
                font-size: 0.85rem;
                padding: 0.75rem 1rem;
            }
            
            .btn-close {
                font-size: 0.7rem;
            }
            
            main {
                min-height: calc(100vh - 140px);
            }
        }
        
        @media (max-width: 576px) {
            .alert {
                font-size: 0.75rem;
                padding: 0.6rem 0.8rem;
            }
            
            .container {
                padding-right: 0.5rem;
                padding-left: 0.5rem;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body>
    @include('partials.navbar')
    
    <main class="py-3 py-md-4">
        <div class="container px-2 px-sm-3 px-md-4">
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
    </main>
    
    @include('partials.footer')
    
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    
    <script>
        // Ensure DataTables responsive on mobile
        $(document).ready(function() {
            if ($.fn.dataTable) {
                $('.datatable').each(function() {
                    if (!$.fn.DataTable.isDataTable(this)) {
                        $(this).DataTable({
                            responsive: true,
                            autoWidth: false,
                            scrollX: true,
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
        });
    </script>
    
    @stack('scripts')
</body>
</html>