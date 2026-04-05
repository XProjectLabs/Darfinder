@extends('layouts.owner')

@section('title', 'Statistiques et Performance')

@section('content')
<div class="mb-4">
    <h2 class="playfair">Statistiques</h2>
    <p class="text-muted">Aperçu global de la performance de vos biens</p>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4 text-center">
                <i class="bi bi-building fs-1 text-primary mb-3"></i>
                <h3 class="fw-bold mb-1">{{ $properties->count() }}</h3>
                <p class="text-muted small text-uppercase mb-0">Total Propriétés</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4 text-center">
                <i class="bi bi-eye fs-1 text-info mb-3"></i>
                <h3 class="fw-bold mb-1">{{ $properties->sum('views_count') }}</h3>
                <p class="text-muted small text-uppercase mb-0">Total Vues</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4 text-center">
                <i class="bi bi-heart fs-1 text-danger mb-3"></i>
                <h3 class="fw-bold mb-1">{{ $properties->sum('favorites_count') }}</h3>
                <p class="text-muted small text-uppercase mb-0">Total Favoris</p>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0 fw-bold">Détails des annonces</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="px-4 py-3 small fw-bold border-bottom-0">Propriété</th>
                        <th class="py-3 small fw-bold text-center border-bottom-0">Status</th>
                        <th class="py-3 small fw-bold text-center border-bottom-0">Vues</th>
                        <th class="px-4 py-3 small fw-bold text-center border-bottom-0">Favoris</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($properties as $property)
                    <tr>
                        <td class="px-4 py-3">
                            <div class="fw-bold text-dark">{{ $property->title }}</div>
                            <div class="small text-muted">{{ ucfirst($property->type) }} - {{ number_format($property->price, 0, ',', ' ') }} DH</div>
                        </td>
                        <td class="py-3 text-center">
                            <span class="badge rounded-pill {{ $property->status == 'available' ? 'bg-success' : 'bg-secondary' }} bg-opacity-10 {{ $property->status == 'available' ? 'text-success' : 'text-secondary' }} px-3">
                                {{ ucfirst($property->status) }}
                            </span>
                        </td>
                        <td class="py-3 text-center">
                            <span class="text-dark fw-bold">
                                {{ $property->views_count }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <span class="text-dark fw-bold">
                                {{ $property->favorites_count }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-1 d-block mb-2 opacity-50"></i>
                            Aucun bien n'a été trouvé.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
