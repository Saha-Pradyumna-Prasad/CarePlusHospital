@extends('layouts.app')

@section('title', 'Our Facilities & Rooms')

@section('content')
<div class="container px-3 px-md-4">
    <h1 class="text-center mb-4 fs-2 fs-md-1">Our Facilities & Rooms</h1>
    
    <div class="row mb-4">
        <div class="col-12">
            <div class="btn-group w-100 flex-wrap" role="group" style="gap: 5px;">
                <button class="btn btn-outline-primary filter-btn mb-1 active" data-type="all">All</button>
                @foreach($roomTypes as $type)
                    <button class="btn btn-outline-primary filter-btn mb-1" data-type="{{ $type }}">
                        {{ str_replace('_', ' ', ucfirst($type)) }}
                    </button>
                @endforeach
            </div>
        </div>
    </div>
    
    <div class="row g-3 g-md-4" id="rooms-container">
        @foreach($rooms as $room)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4 room-card" data-type="{{ $room->type }}">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <div class="d-flex flex-wrap justify-content-between align-items-start gap-2 mb-2">
                        <h5 class="card-title fs-6 fs-md-5 mb-0">{{ $room->name }}</h5>
                        @if($room->status == 'available')
                            <span class="badge bg-success">Available</span>
                        @elseif($room->status == 'occupied')
                            <span class="badge bg-danger">Occupied</span>
                        @else
                            <span class="badge bg-warning">Maintenance</span>
                        @endif
                    </div>
                    <p class="card-text">
                        <small class="text-muted">
                            <i class="fas fa-hashtag"></i> Room #{{ $room->room_number }}<br>
                            <i class="fas fa-layer-group"></i> Floor: {{ $room->floor }}<br>
                            <i class="fas fa-users"></i> Capacity: {{ $room->capacity }} people
                        </small>
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <div class="d-flex justify-content-center mt-4">
        {{ $rooms->links() }}
    </div>
</div>

@push('scripts')
<script>
    $('.filter-btn').click(function() {
        let type = $(this).data('type');
        $('.filter-btn').removeClass('active');
        $(this).addClass('active');
        
        if (type === 'all') {
            $('.room-card').show();
        } else {
            $('.room-card').hide();
            $(`.room-card[data-type="${type}"]`).show();
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