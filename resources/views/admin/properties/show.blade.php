@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.properties.index') }}" class="text-muted text-decoration-none">Annonces</a></li>
            <li class="breadcrumb-item active" aria-current="page">Examen de l'annonce</li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
        <h2 class="playfair text-dark fw-bold mb-0">Examen de l'Annonce #{{ $property->id }}</h2>
        <div class="d-flex gap-2">
            @if($property->status == 'pending' || $property->status == 'rejected')
                <form action="{{ route('admin.properties.approve', $property) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success shadow-sm px-4">
                        <i class="bi bi-check-lg me-1"></i> Approuver
                    </button>
                </form>
            @endif
            
            @if($property->status == 'pending' || $property->status == 'active')
                <form action="{{ route('admin.properties.reject', $property) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger shadow-sm px-4">
                        <i class="bi bi-x-lg me-1"></i> Refuser
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Left Column: Details -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-4 overflow-hidden">
            <!-- Image Carousel -->
            <div id="propertyImages" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @forelse($property->images as $index => $image)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage/' . $image->image_path) }}" class="d-block w-100" alt="Image Property" style="height: 480px; object-fit: cover;">
                        </div>
                    @empty
                        <div class="carousel-item active">
                            <div class="bg-light d-flex align-items-center justify-content-center text-muted" style="height: 480px;">
                                <i class="bi bi-image fs-1 opacity-25"></i>
                            </div>
                        </div>
                    @endforelse
                </div>
                @if($property->images->count() > 1)
                    <button class="carousel-control-prev" type="button" data-bs-target="#propertyImages" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Précédent</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#propertyImages" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Suivant</span>
                    </button>
                @endif
            </div>

            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div>
                        <div class="small text-primary fw-bold text-uppercase mb-1">{{ $property->category?->name ?? 'Catégorie inconnue' }} • {{ $property->city?->name ?? 'Ville inconnue' }}</div>
                        <h3 class="fw-bold text-dark">{{ $property->title }}</h3>
                        <p class="text-muted"><i class="bi bi-geo-alt me-1"></i> {{ $property->city?->name ?? 'Localisation inconnue' }}, Maroc</p>
                    </div>
                    <div class="text-end">
                        <h2 class="fw-bold text-moroccan-green mb-0">{{ number_format($property->price, 0, ',', ' ') }} DH</h2>
                        <small class="text-muted">Prix Total</small>
                    </div>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-3">
                        <div class="card bg-light border-0 text-center p-3">
                            <i class="bi bi-aspect-ratio text-primary mb-2"></i>
                            <div class="fw-bold">{{ $property->surface }} m²</div>
                            <small class="text-muted">Surface</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-light border-0 text-center p-3">
                            <i class="bi bi-door-open text-primary mb-2"></i>
                            <div class="fw-bold">{{ $property->rooms }}</div>
                            <small class="text-muted">Chambres</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-light border-0 text-center p-3">
                            <i class="bi bi-lamp text-primary mb-2"></i>
                            <div class="fw-bold">{{ $property->furnished ? 'Meublé' : 'Non meublé' }}</div>
                            <small class="text-muted">Mobilier</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-light border-0 text-center p-3">
                            <i class="bi bi-eye text-primary mb-2"></i>
                            <div class="fw-bold">{{ $property->views_count }}</div>
                            <small class="text-muted">Vues</small>
                        </div>
                    </div>
                </div>

                <h5 class="fw-bold text-dark mb-3">Description</h5>
                <p class="text-muted lh-lg" style="white-space: pre-line;">{{ $property->description }}</p>
            </div>
        </div>
    </div>

    <!-- Right Column: Owner & Stats -->
    <div class="col-lg-4">
        <!-- Owner Info -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="fw-bold mb-0">Informations Propriétaire</h5>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold me-3" style="width: 50px; height: 50px; font-size: 1.2rem;">
                        {{ substr($property->user->name, 0, 1) }}
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0">{{ $property->user->name }}</h6>
                        <small class="text-muted">Membre depuis {{ $property->user->created_at->format('M Y') }}</small>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="small text-muted text-uppercase mb-1">Email</label>
                    <div class="fw-bold">{{ $property->user->email }}</div>
                </div>
                <div class="mb-0">
                    <label class="small text-muted text-uppercase mb-1">Téléphone</label>
                    <div class="fw-bold">{{ $property->user->phone ?? 'N/A' }}</div>
                </div>
            </div>
            <div class="card-footer bg-white border-top-0 p-3 pt-0">
                <a href="{{ route('admin.users.show', $property->user) }}" class="btn btn-light w-100 btn-sm">Voir le profil complet</a>
            </div>
        </div>

        <!-- System Summary -->
        <div class="card border-0 shadow-sm bg-dark text-white p-4 mb-4">
            <h6 class="fw-bold text-moroccan-gold small text-uppercase mb-3">Informations Système</h6>
            <div class="d-flex flex-column gap-3">
                <div class="d-flex justify-content-between align-items-center small">
                    <span class="opacity-75">Date de création</span>
                    <span>{{ $property->created_at->format('d/m/Y H:i') }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center small">
                    <span class="opacity-75">Dernière modification</span>
                    <span>{{ $property->updated_at->format('d/m/Y H:i') }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center small">
                    <span class="opacity-75">Statut actuel</span>
                    @php $color = ['pending' => 'warning', 'active' => 'success', 'rejected' => 'danger'][$property->status]; @endphp
                    <span class="badge bg-{{ $color }}">{{ ucfirst($property->status) }}</span>
                </div>
            </div>
        </div>
        
        <div class="alert alert-info border-0 shadow-sm">
            <h6 class="fw-bold"><i class="bi bi-info-circle me-1"></i> Guide de Modération</h6>
            <ul class="extra-small mb-0 mt-2 p-0 ps-3">
                <li class="mb-2 text-muted">Vérifiez que les photos sont nettes et appropriées.</li>
                <li class="mb-2 text-muted">Vérifiez que la description n'est pas insultante ou mensongère.</li>
                <li class="text-muted">Vérifiez la concordance entre la catégorie et les photos.</li>
            </ul>
        </div>
    </div>
</div>

<style>
    .text-moroccan-gold { color: #D4AF37; }
    .text-moroccan-green { color: #006241; }
    .extra-small { font-size: 0.8rem; }
    .carousel-item img { border-top-left-radius: 15px; border-top-right-radius: 15px; }
</style>
@endsection
