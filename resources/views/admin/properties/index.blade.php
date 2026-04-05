@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="playfair text-dark fw-bold">Modération des Annonces</h2>
</div>

<!-- Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm border-start border-warning border-4">
            <div class="card-body p-3 d-flex align-items-center">
                <div class="bg-warning bg-opacity-10 text-warning p-3 rounded-circle me-3">
                    <i class="bi bi-clock-history fs-4"></i>
                </div>
                <div>
                    <h4 class="fw-bold mb-0">{{ $stats['pending'] }}</h4>
                    <p class="text-muted small mb-0">En attente de validation</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm border-start border-success border-4">
            <div class="card-body p-3 d-flex align-items-center">
                <div class="bg-success bg-opacity-10 text-success p-3 rounded-circle me-3">
                    <i class="bi bi-check-circle fs-4"></i>
                </div>
                <div>
                    <h4 class="fw-bold mb-0">{{ $stats['active'] }}</h4>
                    <p class="text-muted small mb-0">Annonces actives</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm border-start border-danger border-4">
            <div class="card-body p-3 d-flex align-items-center">
                <div class="bg-danger bg-opacity-10 text-danger p-3 rounded-circle me-3">
                    <i class="bi bi-x-circle fs-4"></i>
                </div>
                <div>
                    <h4 class="fw-bold mb-0">{{ $stats['rejected'] }}</h4>
                    <p class="text-muted small mb-0">Annonces refusées</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filters -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-3">
        <form action="{{ route('admin.properties.index') }}" method="GET" class="row g-2 align-items-center">
            <div class="col-md-3">
                <select name="status" class="form-select border-light shadow-none" onchange="this.form.submit()">
                    <option value="">Tous les statuts</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>En attente</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Refusée</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="city_id" class="form-select border-light shadow-none" onchange="this.form.submit()">
                    <option value="">Toutes les villes</option>
                    @foreach(\App\Models\City::all() as $city)
                        <option value="{{ $city->id }}" {{ request('city_id') == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="category_id" class="form-select border-light shadow-none" onchange="this.form.submit()">
                    <option value="">Toutes les catégories</option>
                    @foreach(\App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <a href="{{ route('admin.properties.index') }}" class="btn btn-light w-100 border text-muted small">Réinitialiser les filtres</a>
            </div>
        </form>
    </div>
</div>

<div class="row g-4">
    @forelse($properties as $property)
        <div class="col-md-4 col-xl-3">
            <div class="card border-0 shadow-sm h-100 property-card transition">
                <div class="position-relative">
                    @if($property->images->count() > 0)
                        <img src="{{ asset('storage/' . $property->images->first()->image_path) }}" class="card-img-top" alt="{{ $property->title }}" style="height: 180px; object-fit: cover; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center text-muted" style="height: 180px; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                            <i class="bi bi-image fs-1 opacity-25"></i>
                        </div>
                    @endif
                    
                    <div class="position-absolute top-0 end-0 m-2">
                        @php $color = ['pending' => 'warning', 'active' => 'success', 'rejected' => 'danger'][$property->status]; @endphp
                        <span class="badge bg-{{ $color }} shadow-sm px-3 py-2 rounded-pill">
                            {{ $property->status == 'pending' ? 'En attente' : ($property->status == 'active' ? 'Active' : 'Refusée') }}
                        </span>
                    </div>
                </div>
                
                <div class="card-body p-3">
                    <div class="small text-moroccan-gold fw-bold mb-1">{{ $property->category?->name ?? 'Catégorie inconnue' }} • {{ $property->city?->name ?? 'Ville inconnue' }}</div>
                    <h6 class="card-title fw-bold text-dark mb-2 text-truncate">{{ $property->title }}</h6>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="fw-bold text-primary">{{ number_format($property->price, 0, ',', ' ') }} <small>DH</small></span>
                        <small class="text-muted"><i class="bi bi-person me-1"></i> {{ $property->user->name }}</small>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.properties.show', $property) }}" class="btn btn-outline-primary btn-sm rounded-pill py-2">
                            <i class="bi bi-eye me-1"></i> Examiner & Modérer
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 py-5 text-center">
            <div class="bg-white p-5 rounded-4 shadow-sm">
                <i class="bi bi-building fs-1 text-muted opacity-25 mb-3"></i>
                <h5 class="text-muted">Aucune annonce ne correspond à vos critères.</h5>
            </div>
        </div>
    @endforelse
</div>

<div class="mt-4">
    {{ $properties->appends(request()->query())->links() }}
</div>

<style>
    .property-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
    }
    .transition { transition: all 0.3s ease; }
    .text-moroccan-gold { color: #D4AF37; }
</style>
@endsection
