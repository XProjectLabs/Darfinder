@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Utilisateurs</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profil de {{ $user->name }}</li>
        </ol>
    </nav>
</div>

<div class="row g-4">
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4 text-center">
                <div class="avatar-lg bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px; font-size: 2rem; font-weight: 700;">
                    {{ substr($user->name, 0, 1) }}
                </div>
                <h4 class="mb-1 fw-bold">{{ $user->name }}</h4>
                <p class="text-muted mb-3">{{ ucfirst($user->role) }}</p>
                
                @if($user->is_active)
                    <span class="badge bg-success-subtle text-success border border-success border-opacity-25 rounded-pill px-3 py-2 mb-4">Compte Actif</span>
                @else
                    <span class="badge bg-danger-subtle text-danger border border-danger border-opacity-25 rounded-pill px-3 py-2 mb-4">Compte Désactivé</span>
                @endif

                <div class="d-grid gap-2">
                    <form action="{{ route('admin.users.toggle-status', $user) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn {{ $user->is_active ? 'btn-outline-warning' : 'btn-outline-success' }} w-100">
                             <i class="bi {{ $user->is_active ? 'bi-lock' : 'bi-unlock' }} me-1"></i>
                             {{ $user->is_active ? 'Désactiver le compte' : 'Activer le compte' }}
                        </button>
                    </form>
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Supprimer définitivement cet utilisateur ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100">
                            <i class="bi bi-trash me-1"></i> Supprimer l'utilisateur
                        </button>
                    </form>
                </div>
            </div>
            <div class="card-footer bg-white border-top-0 p-4">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted">Coordonnées</h6>
                <div class="mb-2">
                    <i class="bi bi-envelope text-muted me-2"></i> {{ $user->email }}
                </div>
                <div class="mb-2">
                    <i class="bi bi-telephone text-muted me-2"></i> {{ $user->phone ?? 'Non renseigné' }}
                </div>
                <div class="mb-0">
                    <i class="bi bi-geo-alt text-muted me-2"></i> {{ $user->city?->name ?? 'Ville non définie' }}
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        @if($user->role == 'propriétaire')
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold"><i class="bi bi-building me-2"></i> Annonces publiées ({{ $user->properties->count() }})</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>Propriété</th>
                                    <th>Statut</th>
                                    <th>Prix</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user->properties as $property)
                                    <tr>
                                        <td>
                                            <div class="fw-bold small">{{ $property->title }}</div>
                                            <div class="text-muted extra-small">{{ $property->city->name }}</div>
                                        </td>
                                        <td>
                                            @php $color = ['pending' => 'warning', 'active' => 'success', 'rejected' => 'danger'][$property->status] ?? 'secondary'; @endphp
                                            <span class="badge bg-{{ $color }} bg-opacity-10 text-{{ $color }} px-2 py-1 rounded small">
                                                {{ ucfirst($property->status) }}
                                            </span>
                                        </td>
                                        <td>{{ number_format($property->price, 0, ',', ' ') }} DH</td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-sm btn-light border" title="Voir l'annonce (Soon)">
                                                <i class="bi bi-link-45deg"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold"><i class="bi bi-heart me-2"></i> Propriétés favorites ({{ $user->favorites->count() }})</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>Propriété</th>
                                    <th>Prix</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user->favorites as $favorite)
                                    <tr>
                                        <td>
                                            @if($favorite->property)
                                                <div class="fw-bold small">{{ $favorite->property->title }}</div>
                                                <div class="text-muted extra-small">{{ $favorite->property->city->name }}</div>
                                            @else
                                                <span class="text-danger small">Propriété supprimée</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($favorite->property)
                                                {{ number_format($favorite->property->price, 0, ',', ' ') }} DH
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            @if($favorite->property)
                                                <a href="#" class="btn btn-sm btn-light border" title="Voir l'annonce (Soon)">
                                                    <i class="bi bi-link-45deg"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
        
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold"><i class="bi bi-clock-history me-2"></i> Informations système</h5>
            </div>
            <div class="card-body">
                <div class="row text-center mb-3">
                    <div class="col-md-6 border-end">
                        <div class="small text-muted mb-1 text-uppercase">Membre depuis</div>
                        <div class="fw-bold">{{ $user->created_at->format('d/m/Y') }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="small text-muted mb-1 text-uppercase">Dernière mise à jour</div>
                        <div class="fw-bold">{{ $user->updated_at->format('d/m/Y') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .extra-small { font-size: 0.75rem; }
</style>
@endsection
