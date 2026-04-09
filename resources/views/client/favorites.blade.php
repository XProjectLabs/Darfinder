@extends('layouts.app')

@section('content')
<div class="bg-light border-bottom py-4">
    <div class="container">
        <h1 class="playfair fs-2 mb-0">Mes Favoris</h1>
        <p class="text-muted mb-0">Vos propriétés sauvegardées pour plus tard</p>
    </div>
</div>

<div class="container my-5">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        @forelse ($favorites as $favorite)
            @php $prop = $favorite->property; @endphp
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="card h-100 shadow-sm position-relative">
                    <!-- Favorite Button -->
                    <button class="btn btn-light rounded-circle shadow-sm position-absolute top-0 end-0 m-3 toggle-favorite" data-id="{{ $prop->id }}" title="Retirer des favoris" style="z-index: 10; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(5px); background: rgba(255,255,255,0.7);">
                        <i class="bi bi-heart-fill text-danger fs-5"></i>
                    </button>

                    <div class="position-relative">
                        @php
                            $primaryImage = $prop->images->where('is_primary', true)->first() ?? $prop->images->first();
                            $imageUrl = $primaryImage ? asset('storage/' . $primaryImage->path) : 'https://images.unsplash.com/photo-1548013146-72479768bada?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';
                        @endphp
                        <img src="{{ $imageUrl }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="{{ $prop->title }}">
                        @if($prop->status !== 'active')
                            <div class="hero-overlay d-flex align-items-center justify-content-center" style="background: rgba(0,0,0,0.6);">
                                <span class="badge bg-danger fs-6">Non disponible</span>
                            </div>
                        @endif
                    </div>
                    
                    <div class="card-body p-3">
                        <div class="text-muted small mb-1"><i class="bi bi-geo-alt-fill text-gold"></i> {{ $prop->city->name ?? 'Maroc' }}</div>
                        <h6 class="card-title fw-bold text-truncate" title="{{ $prop->title }}">{{ $prop->title }}</h6>
                        <div class="card-price mb-2 text-primary fw-bold">{{ number_format($prop->price, 0, ',', ' ') }} DH</div>
                    </div>
                    <div class="card-footer bg-white border-top-0 pt-0 pb-3 p-3">
                        <a href="{{ url('/properties/' . $prop->id) }}" class="btn btn-outline-primary btn-sm w-100">Voir les détails</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5 bg-white rounded shadow-sm">
                <div class="display-1 text-muted mb-3 opacity-25">
                    <i class="bi bi-heartbreak"></i>
                </div>
                <h3>Vous n'avez pas encore de favoris</h3>
                <p class="text-muted">Parcourez nos annonces et cliquez sur le cœur pour sauvegarder les propriétés qui vous plaisent.</p>
                <a href="{{ route('properties.index') }}" class="btn btn-primary mt-3">Rechercher des biens</a>
            </div>
        @endforelse
    </div>
    
    <div class="d-flex justify-content-center mt-5">
        {{ $favorites->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
