@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <h2 class="playfair">Tableau de Bord Administrateur</h2>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4 text-center">
                <i class="bi bi-tag fs-1 text-primary mb-3"></i>
                <h3 class="fw-bold mb-1">{{ \App\Models\Category::count() }}</h3>
                <p class="text-muted small text-uppercase mb-0">Catégories</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4 text-center">
                <i class="bi bi-geo-alt fs-1 text-success mb-3"></i>
                <h3 class="fw-bold mb-1">{{ \App\Models\City::count() }}</h3>
                <p class="text-muted small text-uppercase mb-0">Villes</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4 text-center">
                <i class="bi bi-building fs-1 text-info mb-3"></i>
                <h3 class="fw-bold mb-1">{{ \App\Models\Property::count() }}</h3>
                <p class="text-muted small text-uppercase mb-0">Annonces</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4 text-center">
                <i class="bi bi-people fs-1 text-warning mb-3"></i>
                <h3 class="fw-bold mb-1">{{ \App\Models\User::count() }}</h3>
                <p class="text-muted small text-uppercase mb-0">Utilisateurs</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold">Gestion des Catégories</h5>
            </div>
            <div class="card-body">
                <p>Gérez les types de propriétés disponibles sur votre plateforme. Vous pouvez ajouter, modifier ou supprimer des catégories à tout moment.</p>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-primary">Gérer les catégories</a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold">Modération des Annonces</h5>
            </div>
            <div class="card-body">
                <p>Consultez les nouvelles annonces soumises par les propriétaires et décidez de les valider ou de les refuser.</p>
                <button class="btn btn-outline-primary" disabled>Bientôt disponible</button>
            </div>
        </div>
    </div>
</div>
@endsection
