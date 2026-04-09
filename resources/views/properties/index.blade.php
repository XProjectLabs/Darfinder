@extends('layouts.app')

@section('content')
<div class="bg-light border-bottom py-4">
    <div class="container">
        <h1 class="playfair fs-2 mb-0">Recherche Avancée</h1>
        <p class="text-muted mb-0">Trouvez la maison de vos rêves selon vos critères exacts</p>
    </div>
</div>

<div class="container my-5">
    <div class="row g-4">
        <!-- Sidebar Filters -->
        <div class="col-lg-3">
            <div class="card border-0 shadow-sm sticky-top" style="top: 100px; z-index: 1;">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                    <h5 class="fw-bold"><i class="bi bi-funnel text-gold"></i> Filtres</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('properties.index') }}" method="GET">
                        <!-- City -->
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-uppercase">Ville</label>
                            <select name="city_id" class="form-select bg-light border-0">
                                <option value="">Toutes les villes</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}" {{ request('city_id') == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Quartier (Address) -->
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-uppercase">Quartier / Adresse</label>
                            <input type="text" name="address" class="form-control bg-light border-0" value="{{ request('address') }}" placeholder="Ex: Maarif, Gueliz...">
                        </div>

                        <!-- Category -->
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-uppercase">Type de bien</label>
                            <select name="category_id" class="form-select bg-light border-0">
                                <option value="">Tous les types</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Price -->
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-uppercase">Prix (DH)</label>
                            <div class="row g-2">
                                <div class="col-6">
                                    <input type="number" name="price_min" class="form-control bg-light border-0" placeholder="Min" value="{{ request('price_min') }}">
                                </div>
                                <div class="col-6">
                                    <input type="number" name="price_max" class="form-control bg-light border-0" placeholder="Max" value="{{ request('price_max') }}">
                                </div>
                            </div>
                        </div>

                        <!-- Surface -->
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-uppercase">Surface (m²)</label>
                            <div class="row g-2">
                                <div class="col-6">
                                    <input type="number" name="surface_min" class="form-control bg-light border-0" placeholder="Min" value="{{ request('surface_min') }}">
                                </div>
                                <div class="col-6">
                                    <input type="number" name="surface_max" class="form-control bg-light border-0" placeholder="Max" value="{{ request('surface_max') }}">
                                </div>
                            </div>
                        </div>

                        <!-- Furnished -->
                        <div class="mb-4 form-check form-switch mt-3">
                            <input class="form-check-input" type="checkbox" name="furnished" id="furnished" value="1" {{ request('furnished') ? 'checked' : '' }}>
                            <label class="form-check-label small fw-bold text-uppercase ms-2" for="furnished">Meublé uniquement</label>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Appliquer les filtres</button>
                            <a href="{{ route('properties.index') }}" class="btn btn-light text-muted">Réinitialiser</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Results -->
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="mb-0">{{ $properties->total() }} Propriétés trouvées</h5>
                <div>
                    <!-- Optional sorting could go here -->
                </div>
            </div>

            <div class="row g-4">
                @forelse ($properties as $prop)
                <div class="col-md-6 col-xl-4">
                    <div class="card h-100 shadow-sm position-relative">
                        <!-- Favorite Button -->
                        <button class="btn btn-light rounded-circle shadow-sm position-absolute top-0 end-0 m-3 toggle-favorite" data-id="{{ $prop->id }}" style="z-index: 10; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(5px); background: rgba(255,255,255,0.7);">
                            @auth
                                @php
                                    $isFav = $prop->favorites->where('user_id', auth()->id())->first();
                                @endphp
                                <i class="bi bi-heart{{ $isFav ? '-fill text-danger' : '' }} fs-5"></i>
                            @else
                                <i class="bi bi-heart fs-5"></i>
                            @endauth
                        </button>

                        <div class="position-relative">
                            @php
                                $primaryImage = $prop->images->where('is_primary', true)->first() ?? $prop->images->first();
                                $imageUrl = $primaryImage ? asset('storage/' . $primaryImage->path) : 'https://images.unsplash.com/photo-1548013146-72479768bada?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';
                            @endphp
                            <img src="{{ $imageUrl }}" class="card-img-top" style="height: 220px; object-fit: cover;" alt="{{ $prop->title }}">
                            @if(now()->diffInDays($prop->created_at) < 7)
                            <div class="position-absolute top-0 start-0 m-3">
                                <span class="badge badge-status bg-white shadow-sm">Nouveau</span>
                            </div>
                            @endif
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="small text-muted"><i class="bi bi-geo-alt-fill text-gold"></i> {{ $prop->city->name ?? 'Maroc' }}</span>
                            </div>
                            <h5 class="card-title fw-bold playfair mb-2 text-truncate" title="{{ $prop->title }}">{{ $prop->title }}</h5>
                            <div class="card-price mb-3">{{ number_format($prop->price, 0, ',', ' ') }} DH</div>
                            <div class="d-flex text-muted small border-top pt-3 mb-0">
                                @if($prop->rooms)
                                <span class="me-3"><i class="bi bi-door-open-fill me-1"></i> {{ $prop->rooms }}</span>
                                @endif
                                @if($prop->surface)
                                <span class="me-3"><i class="bi bi-aspect-ratio-fill me-1"></i> {{ $prop->surface }}m²</span>
                                @endif
                                @if($prop->furnished)
                                <span><i class="bi bi-check-circle-fill text-success me-1"></i></span>
                                @endif
                                @if($prop->category)
                                <span class="ms-auto" style="border-radius: 12px; border: 1px solid var(--moroccan-green); padding: 0 8px; color: var(--moroccan-green);">{{ $prop->category->name }}</span>
                                @endif
                            </div>
                        </div>
                        <a href="{{ url('/properties/' . $prop->id) }}" class="stretched-link"></a>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5 bg-white rounded-3 shadow-sm border-0">
                    <i class="bi bi-search display-1 text-muted mb-3 opacity-25"></i>
                    <h4 class="fw-bold">Aucune propriété trouvée</h4>
                    <p class="text-muted">Essayez de modifier vos filtres pour voir plus de résultats.</p>
                    <a href="{{ route('properties.index') }}" class="btn btn-outline-primary mt-3">Réinitialiser la recherche</a>
                </div>
                @endforelse
            </div>
            
            @if($properties->hasPages())
            <div class="d-flex justify-content-center mt-5">
                {{ $properties->links('pagination::bootstrap-5') }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
