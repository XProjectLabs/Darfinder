@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="playfair text-dark fw-bold">Gestion des Utilisateurs</h2>
</div>

<!-- Filters & Search -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-4">
        <form action="{{ route('admin.users.index') }}" method="GET" class="row g-3">
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="Rechercher par nom ou email..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-3">
                <select name="role" class="form-select" onchange="this.form.submit()">
                    <option value="">Tous les rôles</option>
                    <option value="propriétaire" {{ request('role') == 'propriétaire' ? 'selected' : '' }}>Propriétaires</option>
                    <option value="locataire" {{ request('role') == 'locataire' ? 'selected' : '' }}>Locataires</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select" onchange="this.form.submit()">
                    <option value="">Tous les statuts</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Actifs</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Désactivés</option>
                </select>
            </div>
            <div class="col-md-2">
                <a href="{{ route('admin.users.index') }}" class="btn btn-light w-100 text-decoration-none">Réinitialiser</a>
            </div>
        </form>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">Utilisateur</th>
                        <th>Rôle</th>
                        <th>Localisation</th>
                        <th>Activité</th>
                        <th>Statut</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold me-3" style="width: 40px; height: 40px; min-width: 40px;">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div class="text-truncate" style="max-width: 200px;">
                                        <div class="fw-bold text-dark">{{ $user->name }}</div>
                                        <div class="small text-muted">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($user->role == 'propriétaire')
                                    <span class="badge bg-success-subtle text-success border border-success border-opacity-10 px-3 py-2 rounded-pill fw-normal">
                                        <i class="bi bi-house-door me-1"></i> Propriétaire
                                    </span>
                                @else
                                    <span class="badge bg-primary-subtle text-primary border border-primary border-opacity-10 px-3 py-2 rounded-pill fw-normal">
                                        <i class="bi bi-person me-1"></i> Locataire
                                    </span>
                                @endif
                            </td>
                            <td>
                                <i class="bi bi-geo-alt text-muted me-1"></i> {{ $user->city?->name ?? 'N/A' }}
                            </td>
                            <td>
                                <div class="small text-muted">
                                    @if($user->role == 'propriétaire')
                                        {{ $user->properties_count }} annonces
                                    @else
                                        {{ $user->favorites_count }} favoris
                                    @endif
                                </div>
                            </td>
                            <td>
                                @if($user->is_active)
                                    <span class="badge bg-success border-0 px-3 py-1 rounded-pill" style="font-size: 0.75rem;">Actif</span>
                                @else
                                    <span class="badge bg-danger border-0 px-3 py-1 rounded-pill" style="font-size: 0.75rem;">Désactivé</span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <div class="btn-group shadow-sm rounded">
                                    <a href="{{ route('admin.users.show', $user) }}" class="btn btn-sm btn-white border" title="Voir détails">
                                        <i class="bi bi-eye text-primary"></i>
                                    </a>
                                    <form action="{{ route('admin.users.toggle-status', $user) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-white border border-start-0" title="{{ $user->is_active ? 'Désactiver' : 'Activer' }}">
                                            <i class="bi {{ $user->is_active ? 'bi-lock text-warning' : 'bi-unlock text-success' }}"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer définitivement cet utilisateur ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-white border border-start-0" title="Supprimer">
                                            <i class="bi bi-trash text-danger"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="bi bi-people d-block mb-3 fs-1 opacity-25"></i>
                                Aucun utilisateur trouvé.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-4 px-2">
    {{ $users->appends(request()->query())->links() }}
</div>
@endsection
