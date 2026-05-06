@extends('layouts.app')

@section('title', 'Our Services')

@section('content')
<div class="container px-3 px-md-4">
    <h1 class="text-center mb-4 fs-2 fs-md-1">Our Medical Services</h1>
    
    <div class="row mb-4">
        <div class="col-12 col-md-10 col-lg-8 mx-auto">
            <div class="btn-group w-100 flex-wrap" role="group" style="gap: 5px;">
                <button class="btn btn-outline-primary filter-btn mb-1 active" data-category="all">All</button>
                <button class="btn btn-outline-primary filter-btn mb-1" data-category="diagnostic">Diagnostic</button>
                <button class="btn btn-outline-primary filter-btn mb-1" data-category="clinical">Clinical</button>
                <button class="btn btn-outline-primary filter-btn mb-1" data-category="support">Support</button>
                <button class="btn btn-outline-primary filter-btn mb-1" data-category="facility">Facility</button>
            </div>
        </div>
    </div>
    
    <div class="row g-3 g-md-4" id="services-container">
        @foreach($services as $service)
        <div class="col-12 col-md-6 col-lg-4 mb-4 service-card" data-category="{{ $service->category }}">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    @php
                        $icons = [
                            'diagnostic' => 'fa-microscope',
                            'clinical' => 'fa-stethoscope',
                            'support' => 'fa-ambulance',
                            'facility' => 'fa-building'
                        ];
                    @endphp
                    <i class="fas {{ $icons[$service->category] ?? 'fa-medkit' }} fa-2x fa-md-3x text-primary mb-3"></i>
                    <h5 class="card-title fs-6 fs-md-5">{{ $service->name }}</h5>
                    <p class="card-text small">{{ $service->description }}</p>
                    <span class="badge bg-success">Available 24/7</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@push('scripts')
<script>
    $('.filter-btn').click(function() {
        let category = $(this).data('category');
        $('.filter-btn').removeClass('active');
        $(this).addClass('active');
        
        if (category === 'all') {
            $('.service-card').show();
        } else {
            $('.service-card').hide();
            $(`.service-card[data-category="${category}"]`).show();
        }
    });
</script>
@endpush

<style>
.filter-btn.active {
    background-color: #0d6efd;
    color: white;
    border-color: #0d6efd;
}
@media (max-width: 576px) {
    .filter-btn {
        font-size: 0.7rem;
        padding: 0.25rem 0.5rem;
    }
}
</style>
@endsection