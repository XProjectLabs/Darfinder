@extends('layouts.app')

@section('content')
<div class="hero-section" style="background-image: url('{{ asset('moroccan_real_estate_hero_1774304079671.png') }}');">
    <div class="hero-overlay"></div>
    <div class="container hero-content">
        <div class="row">
            <div class="col-lg-7">
                <h1 class="display-3 fw-bold mb-3">L'Art de Vivre <br><span style="color: var(--moroccan-gold);">Marocain</span></h1>
                <p class="lead mb-5 fs-4">Découvrez des propriétés d'exception alliant tradition séculaire et confort moderne au cœur du Royaume.</p>
                
                <div class="card p-4 shadow-lg border-0 bg-white text-dark" style="border-left: 8px solid var(--moroccan-gold) !important;">
                    <form class="row g-3">
                        <div class="col-md-5">
                            <label class="form-label small fw-bold text-uppercase">Type de Bien</label>
                            <select class="form-select form-select-lg border-0 bg-light">
                                <option>Acheter un Riad</option>
                                <option>Louer un Appartement</option>
                                <option>Villa de Luxe</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-uppercase">Ville</label>
                            <select class="form-select form-select-lg border-0 bg-light">
                                <option>Toutes les villes</option>
                                <option>Marrakech</option>
                                <option>Casablanca</option>
                                <option>Tanger</option>
                                <option>Rabat</option>
                            </select>
                        </div>
                        <div class="col-md-3 d-grid">
                            <label class="form-label invisible">Submit</label>
                            <button class="btn btn-primary btn-lg" type="button">Explorer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container my-5 py-5">
    <div class="row align-items-center mb-5">
        <div class="col-md-8">
            <h2 class="playfair section-title fs-1">Nos Propriétés Vedettes</h2>
            <p class="text-muted fs-5">Une sélection rigoureuse des plus belles demeures du Maroc.</p>
        </div>
        <div class="col-md-4 text-md-end">
            <a href="#" class="btn btn-outline-primary">Toutes les propriétés <i class="bi bi-arrow-right ms-2"></i></a>
        </div>
    </div>

    <div class="row g-4">
        @php
            $properties = [
                ['title' => 'Riad Authentique au Cœur de la Médina', 'city' => 'Marrakech', 'price' => '4,500,000 DH', 'img' => 'https://images.unsplash.com/photo-1548013146-72479768bada?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Appartement Moderne Vue sur Mer', 'city' => 'Tanger', 'price' => '2,200,000 DH', 'img' => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Villa Contemporaine style Andalou', 'city' => 'Casablanca', 'price' => '8,900,000 DH', 'img' => 'https://images.unsplash.com/photo-1613490493576-7fde63acd811?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'],
            ];
        @endphp

        @foreach ($properties as $prop)
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="position-relative">
                    <img src="{{ $prop['img'] }}" class="card-img-top" style="height: 250px; object-fit: cover;" alt="{{ $prop['title'] }}">
                    <div class="position-absolute top-0 start-0 m-3">
                        <span class="badge badge-status bg-white shadow-sm">Nouveau</span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="small text-muted"><i class="bi bi-geo-alt-fill text-gold"></i> {{ $prop['city'] }}</span>
                        <div class="card-price">{{ $prop['price'] }}</div>
                    </div>
                    <h5 class="card-title fw-bold playfair mb-3" style="min-height: 56px;">{{ $prop['title'] }}</h5>
                    <div class="d-flex text-muted small border-top pt-3 mb-0">
                        <span class="me-3"><i class="bi bi-door-open-fill me-1"></i> 4 Ch</span>
                        <span class="me-3"><i class="bi bi-aspect-ratio-fill me-1"></i> 180m²</span>
                        <span><i class="bi bi-check-circle-fill text-success me-1"></i> Meublé</span>
                    </div>
                </div>
                <div class="card-footer bg-white border-0 p-4 pt-0">
                    <a href="#" class="btn btn-outline-primary w-100">Voir les détails</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="container my-5 py-5 rounded-5" style="background-color: #006241; background-image: url('https://www.transparenttextures.com/patterns/az-subtle.png');">
    <div class="row justify-content-center text-center py-5">
        <div class="col-lg-8">
            <h2 class="playfair text-white display-4 mb-4">Envie de publier votre annonce ?</h2>
            <p class="text-white-50 lead mb-5">Rejoignez la plus grande communauté immobilière du Maroc et trouvez l'acheteur ou le locataire idéal en un temps record.</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg px-5">S'inscrire</a>
                <a href="#" class="btn btn-light btn-lg px-5" style="color: var(--moroccan-green); font-weight: bold;">Publier Gratuitement</a>
            </div>
        </div>
    </div>
</div>

<div class="container my-5 py-5 text-center">
    <h2 class="playfair mb-5">Villes les plus recherchées</h2>
    <div class="row g-3">
        @php
            $cities = [
                ['name' => 'Marrakech', 'img' => asset('cities/marrakech.png')],
                ['name' => 'Casablanca', 'img' => asset('cities/casablanca.png')],
                ['name' => 'Tanger', 'img' => asset('cities/tanger.png')],
                ['name' => 'Rabat', 'img' => asset('cities/rabat.png')],
                ['name' => 'Chefchaouen', 'img' => asset('cities/chefchaouen.png')],
                ['name' => 'Agadir', 'img' => 'https://images.unsplash.com/photo-1623594001815-5192ee1e17f9?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80'],
            ];
        @endphp
        @foreach ($cities as $city)
        <div class="col-6 col-md-2">
            <div class="position-relative hover-zoom rounded-4 shadow-sm h-100" style="height: 150px !important;">
                <img src="{{ $city['img'] }}" class="rounded-4 w-100 h-100 object-fit-cover opacity-75" alt="{{ $city['name'] }}">
                <div class="position-absolute top-50 start-50 translate-middle w-100">
                    <h5 class="text-white fw-bold mb-0 shadow-text">{{ $city['name'] }}</h5>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
