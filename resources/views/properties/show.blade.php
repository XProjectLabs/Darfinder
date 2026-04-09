@extends('layouts.app')

@section('content')
<div class="container my-5 py-4">
    <!-- Fil d'ariane simple -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/" class="text-decoration-none" style="color: var(--moroccan-gold);"><i class="bi bi-house-door-fill"></i> Accueil</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $property->title }}</li>
        </ol>
    </nav>

    <div class="row g-5">
        <!-- Section Principale (Images + Informations) -->
        <div class="col-lg-8">
            <!-- Images -->
            <div class="mb-4 position-relative">
                <!-- Favorite Button -->
                <button class="btn btn-light rounded-circle shadow-sm position-absolute top-0 end-0 m-3 toggle-favorite" data-id="{{ $property->id }}" style="z-index: 10; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(5px); background: rgba(255,255,255,0.7);">
                    @auth
                        @php
                            $isFav = $property->favorites->where('user_id', auth()->id())->first();
                        @endphp
                        <i class="bi bi-heart{{ $isFav ? '-fill text-danger' : '' }} fs-4"></i>
                    @else
                        <i class="bi bi-heart fs-4"></i>
                    @endauth
                </button>
                @php
                    $primaryImage = $property->images->where('is_primary', true)->first();
                    $otherImages = $property->images->where('is_primary', false);
                    $mainImageUrl = $primaryImage ? asset('storage/' . $primaryImage->path) : 'https://images.unsplash.com/photo-1548013146-72479768bada?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80';
                @endphp
                <img src="{{ $mainImageUrl }}" class="img-fluid rounded-4 shadow-sm w-100 object-fit-cover" style="height: 500px;" alt="{{ $property->title }}">
            </div>
            
            <div class="row g-3 mb-5">
                @foreach($otherImages as $image)
                <div class="col-4 col-md-3">
                    <img src="{{ asset('storage/' . $image->path) }}" class="img-fluid rounded-3 shadow-sm w-100 object-fit-cover" style="height: 100px; cursor: pointer;" alt="{{ $property->title }}">
                </div>
                @endforeach
            </div>

            <!-- Détails -->
            <h1 class="playfair fw-bold mb-3">{{ $property->title }}</h1>
            <div class="d-flex flex-wrap gap-3 mb-4">
                <span class="badge text-dark px-3 py-2 fs-6 rounded-pill" style="background-color: var(--moroccan-gold);"><i class="bi bi-tag-fill me-1"></i> {{ ucfirst($property->type) }}</span>
                <span class="badge bg-light text-dark px-3 py-2 fs-6 rounded-pill border"><i class="bi bi-geo-alt-fill me-1" style="color: var(--moroccan-gold);"></i> {{ $property->city->name ?? 'Maroc' }}</span>
                <span class="badge bg-light text-dark px-3 py-2 fs-6 rounded-pill border"><i class="bi bi-eye-fill me-1" style="color: var(--moroccan-green);"></i> {{ $property->views_count }} vues</span>
            </div>

            <div class="card border-0 shadow-sm rounded-4 mb-5">
                <div class="card-body p-4 p-md-5">
                    <h4 class="playfair fw-bold mb-4">Description du bien</h4>
                    <p class="lead text-secondary" style="white-space: pre-line;">{{ $property->description }}</p>
                    
                    <hr class="my-4 border-secondary opacity-25">
                    
                    <h4 class="playfair fw-bold mb-4">Caractéristiques</h4>
                    <div class="row g-4">
                        <div class="col-6 col-md-4">
                            <div class="d-flex align-items-center text-muted">
                                <i class="bi bi-aspect-ratio-fill fs-3 me-3" style="color: var(--moroccan-gold);"></i>
                                <div>
                                    <h6 class="mb-0 fw-bold text-dark">Surface</h6>
                                    <small>{{ $property->surface }} m²</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-4">
                            <div class="d-flex align-items-center text-muted">
                                <i class="bi bi-door-open-fill fs-3 me-3" style="color: var(--moroccan-gold);"></i>
                                <div>
                                    <h6 class="mb-0 fw-bold text-dark">Pièces</h6>
                                    <small>{{ $property->rooms }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-4">
                            <div class="d-flex align-items-center text-muted">
                                <i class="bi bi-check-circle-fill fs-3 text-success me-3"></i>
                                <div>
                                    <h6 class="mb-0 fw-bold text-dark">Meublé</h6>
                                    <small>{{ $property->furnished ? 'Oui' : 'Non' }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section Sidebar Coté (Propriétaire et Prix) -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-lg rounded-4 sticky-top" style="top: 100px;">
                <div class="card-body p-4 p-md-5">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold mb-0" style="color: var(--moroccan-green);">
                            {{ number_format($property->price, 0, ',', ' ') }} <small class="fs-5 text-muted">DH</small>
                        </h2>
                    </div>

                    <hr class="my-4 border-secondary opacity-25">

                    <h5 class="playfair fw-bold mb-4">Contactez le propriétaire</h5>
                    
                    <div class="d-flex align-items-center mb-4">
                        <div class="text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px; background-color: var(--moroccan-green); font-size: 1.5rem;">
                            {{ substr($property->user->name ?? 'P', 0, 1) }}
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">{{ $property->user->name ?? 'Propriétaire' }}</h6>
                            <p class="small text-muted mb-0">Membre certifié</p>
                        </div>
                    </div>

                    <!-- Logique très simple (Beginner PHP) pour afficher/cacher le numéro -->
                    @php
                        // Nous récupérons le numéro de téléphone du propriétaire
                        $phone = $property->user->phone ?? '+212 600 000 000';
                    @endphp
                    
                    <div class="d-grid gap-3">
                        <!-- Le bouton initial -->
                        <button id="showPhoneBtn" class="btn btn-outline-primary btn-lg" onclick="showPhoneNumber()" style="color: var(--moroccan-green); border-color: var(--moroccan-green);">
                            <i class="bi bi-telephone-fill me-2"></i> Voir le numéro
                        </button>
                        
                        <!-- La div contenant le numéro (cachée par défaut) -->
                        <div id="phoneDisplay" class="alert mt-2 text-center d-none" style="background-color: #E8F5E9; color: var(--moroccan-green); font-size: 1.25rem; font-weight: bold; border: 1px solid var(--moroccan-green);">
                            <i class="bi bi-telephone-outbound me-2"></i> {{ $phone }}
                        </div>

                        <!-- Bouton Envoyer un email -->
                        <a href="mailto:{{ $property->user->email ?? '' }}" class="btn btn-primary btn-lg" style="background-color: var(--moroccan-green); border:none;">
                            <i class="bi bi-envelope-fill me-2"></i> Envoyer un Email
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function showPhoneNumber() {
        // Cacher le bouton 'Voir le numéro'
        document.getElementById('showPhoneBtn').classList.add('d-none');
        // Afficher l'alerte contenant le numéro
        document.getElementById('phoneDisplay').classList.remove('d-none');
    }
</script>
@endsection
