<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight responsive-heading">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6 py-md-12">
        <div class="container px-3 px-md-4 mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg responsive-card">
                <div class="p-4 p-md-6 text-gray-900 responsive-content">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Responsive CSS for Dashboard - No backend code changed */
        
        /* Base responsive container */
        .container {
            width: 100%;
            padding-right: var(--bs-gutter-x, 0.75rem);
            padding-left: var(--bs-gutter-x, 0.75rem);
            margin-right: auto;
            margin-left: auto;
        }
        
        /* Responsive breakpoints for container */
        @media (min-width: 576px) {
            .container {
                max-width: 540px;
            }
        }
        
        @media (min-width: 768px) {
            .container {
                max-width: 720px;
            }
        }
        
        @media (min-width: 992px) {
            .container {
                max-width: 960px;
            }
        }
        
        @media (min-width: 1200px) {
            .container {
                max-width: 1140px;
            }
        }
        
        @media (min-width: 1400px) {
            .container {
                max-width: 1320px;
            }
        }
        
        /* Mobile First (Extra small devices - 0 to 575px) */
        @media (max-width: 575.98px) {
            .responsive-heading {
                font-size: 1.25rem !important;
                padding: 0 1rem !important;
                word-break: break-word;
            }
            
            .py-6 {
                padding-top: 1rem !important;
                padding-bottom: 1rem !important;
            }
            
            .responsive-card {
                border-radius: 0.5rem !important;
                margin: 0 0.5rem !important;
            }
            
            .responsive-content {
                padding: 1rem !important;
                font-size: 0.875rem !important;
                text-align: center !important;
                word-wrap: break-word;
            }
        }
        
        /* Small devices (576px to 767px) */
        @media (min-width: 576px) and (max-width: 767.98px) {
            .responsive-heading {
                font-size: 1.35rem !important;
            }
            
            .py-6 {
                padding-top: 1.25rem !important;
                padding-bottom: 1.25rem !important;
            }
            
            .responsive-content {
                padding: 1.25rem !important;
                font-size: 0.9rem !important;
            }
        }
        
        /* Medium devices (768px to 991px) */
        @media (min-width: 768px) and (max-width: 991.98px) {
            .responsive-heading {
                font-size: 1.5rem !important;
            }
            
            .py-6 {
                padding-top: 1.75rem !important;
                padding-bottom: 1.75rem !important;
            }
            
            .responsive-content {
                padding: 1.5rem !important;
                font-size: 0.95rem !important;
            }
        }
        
        /* Large devices (992px and above) */
        @media (min-width: 992px) {
            .responsive-heading {
                font-size: 1.6rem !important;
            }
            
            .py-md-12 {
                padding-top: 2.5rem !important;
                padding-bottom: 2.5rem !important;
            }
            
            .p-md-6 {
                padding: 1.75rem !important;
            }
            
            .responsive-content {
                font-size: 1rem !important;
            }
        }
        
        /* Extra large devices (1200px and above) */
        @media (min-width: 1200px) {
            .responsive-heading {
                font-size: 1.75rem !important;
            }
            
            .py-md-12 {
                padding-top: 3rem !important;
                padding-bottom: 3rem !important;
            }
            
            .p-md-6 {
                padding: 2rem !important;
            }
        }
        
        /* 2K and above devices */
        @media (min-width: 1600px) {
            .responsive-heading {
                font-size: 2rem !important;
            }
            
            .py-md-12 {
                padding-top: 4rem !important;
                padding-bottom: 4rem !important;
            }
            
            .p-md-6 {
                padding: 2.5rem !important;
            }
            
            .responsive-content {
                font-size: 1.125rem !important;
            }
        }
        
        /* Card hover effect - preserved from original */
        .responsive-card {
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }
        
        .responsive-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        }
        
        /* Typography responsive */
        .text-gray-900 {
            color: #1a202c;
            line-height: 1.5;
        }
        
        /* Ensure proper box sizing */
        * {
            box-sizing: border-box;
        }
        
        /* Mobile touch optimization */
        @media (max-width: 768px) {
            button, 
            a,
            [role="button"],
            .btn,
            .cursor-pointer {
                min-height: 44px;
                min-width: 44px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
            }
        }
        
        /* Landscape mode optimization for mobile */
        @media (max-width: 768px) and (orientation: landscape) {
            .py-6 {
                padding-top: 0.75rem !important;
                padding-bottom: 0.75rem !important;
            }
            
            .responsive-content {
                padding: 0.75rem !important;
            }
        }
        
        /* Ensure proper spacing on very small devices */
        @media (max-width: 380px) {
            .container {
                padding-left: 0.5rem !important;
                padding-right: 0.5rem !important;
            }
            
            .responsive-content {
                padding: 0.75rem !important;
                font-size: 0.8rem !important;
            }
            
            .responsive-heading {
                font-size: 1.1rem !important;
            }
        }
        
        /* Accessibility - Reduced motion preference */
        @media (prefers-reduced-motion: reduce) {
            .responsive-card {
                transition: none !important;
            }
            
            .responsive-card:hover {
                transform: none !important;
            }
        }
        
        /* Print styles - preserve functionality when printing */
        @media print {
            .responsive-card {
                box-shadow: none !important;
                border: 1px solid #ddd !important;
            }
            
            .responsive-card:hover {
                transform: none !important;
            }
            
            button, a {
                min-height: auto !important;
            }
        }
        
        /* High contrast text for better readability */
        @media (prefers-contrast: high) {
            .text-gray-900 {
                color: #000 !important;
            }
            
            .responsive-card {
                border: 1px solid #000 !important;
            }
        }
    </style>
</x-app-layout>