@extends('layouts.owner')

@section('title', 'Tableau de Bord')

@section('content')
<!-- Stats Grid -->
<div class="row g-4 mb-5">
    <div class="col-md-3">
        <div class="card card-custom p-4 border-start border-primary border-5">
            <div class="d-flex align-items-center">
                <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                    <i class="bi bi-buildings fs-3 text-primary"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1 small uppercase fw-bold">Total Biens</h6>
                    <h3 class="mb-0 fw-bold">{{ $stats['total_properties'] }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-custom p-4 border-start border-success border-5">
            <div class="d-flex align-items-center">
                <div class="bg-success bg-opacity-10 p-3 rounded-circle me-3">
                    <i class="bi bi-broadcast fs-3 text-success"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1 small uppercase fw-bold">Annonces Actives</h6>
                    <h3 class="mb-0 fw-bold">{{ $stats['active_listings'] }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-custom p-4 border-start border-info border-5">
            <div class="d-flex align-items-center">
                <div class="bg-info bg-opacity-10 p-3 rounded-circle me-3">
                    <i class="bi bi-eye fs-3 text-info"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1 small uppercase fw-bold">Total Vues</h6>
                    <h3 class="mb-0 fw-bold">{{ number_format($stats['total_views']) }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-custom p-4 border-start border-warning border-5">
            <div class="d-flex align-items-center">
                <div class="bg-warning bg-opacity-10 p-3 rounded-circle me-3">
                    <i class="bi bi-heart fs-3 text-warning"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1 small uppercase fw-bold">Favoris</h6>
                    <h3 class="mb-0 fw-bold">{{ $stats['favorites_count'] }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Recent Activity -->
    <div class="col-lg-8">
        <div class="card card-custom">
            <div class="card-header bg-white border-0 py-4 px-4 d-flex justify-content-between align-items-center">
                <h5 class="playfair fw-bold mb-0">Activités Récentes</h5>
                <a href="{{ route('owner.properties.index') }}" class="small text-decoration-none">Voir tout <i class="bi bi-arrow-right"></i></a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="px-4 py-3 small fw-bold">Propriété</th>
                                <th class="py-3 small fw-bold">Type</th>
                                <th class="py-3 small fw-bold">Prix</th>
                                <th class="py-3 small fw-bold">Status</th>
                                <th class="px-4 py-3 small fw-bold">Vues</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentProperties as $property)
                            <tr>
                                <td class="px-4 py-3">
                                    <div class="fw-bold text-dark">{{ $property->title }}</div>
                                    <div class="small text-muted"><i class="bi bi-geo-alt"></i> Marrakech</div>
                                </td>
                                <td class="py-3 small">{{ ucfirst($property->type) }}</td>
                                <td class="py-3 fw-bold">{{ number_format($property->price, 0, ',', ' ') }} DH</td>
                                <td class="py-3">
                                    <span class="badge rounded-pill {{ $property->status == 'available' ? 'bg-success' : 'bg-secondary' }} bg-opacity-10 {{ $property->status == 'available' ? 'text-success' : 'text-secondary' }} px-3">
                                        {{ ucfirst($property->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 small text-muted">
                                    <i class="bi bi-eye"></i> {{ $property->views_count }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="mb-3"><i class="bi bi-buildings fs-1 text-muted opacity-25"></i></div>
                                    <p class="text-muted">Aucune propriété ajoutée pour le moment.</p>
                                    <a href="{{ route('owner.properties.create') }}" class="btn btn-sm btn-primary">Ajouter votre premier bien</a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="col-lg-4">
        <div class="card card-custom p-4 h-100">
            <h5 class="playfair fw-bold mb-4">Actions Rapides</h5>
            <div class="d-grid gap-3">
                <a href="{{ route('owner.properties.create') }}" class="btn btn-primary btn-lg border-0 d-flex align-items-center justify-content-center py-3" style="background-color: var(--moroccan-green);">
                    <i class="bi bi-plus-lg me-2"></i> Ajouter une Annonce
                </a>
                <a href="{{ route('owner.properties.index') }}" class="btn btn-outline-dark d-flex align-items-center justify-content-center py-2">
                    <i class="bi bi-list-task me-2"></i> Gérer mes Biens
                </a>
                <a href="{{ route('owner.profile') }}" class="btn btn-outline-dark d-flex align-items-center justify-content-center py-2">
                    <i class="bi bi-person me-2"></i> Mon Profil
                </a>
                <div class="mt-4 p-4 rounded-4 bg-moroccan-gold bg-opacity-10 border border-warning">
                    <h6 class="fw-bold mb-2"><i class="bi bi-lightbulb me-2 text-warning"></i> Astuce</h6>
                    <p class="small text-dark mb-0 opacity-75">Augmentez la visibilité de vos annonces en ajoutant des photos de haute qualité et une description détaillée.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
