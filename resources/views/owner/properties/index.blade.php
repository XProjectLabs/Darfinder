@extends('layouts.owner')

@section('title', 'Mes Propriétés')

@section('content')
<div class="card card-custom">
    <div class="card-header bg-white border-0 py-4 px-4 d-flex justify-content-between align-items-center">
        <h5 class="playfair fw-bold mb-0">Liste de vos annonces</h5>
        <a href="{{ route('owner.properties.create') }}" class="btn btn-primary btn-sm px-3" style="background-color: var(--moroccan-green); border: none;">
            <i class="bi bi-plus-lg"></i> Ajouter un Bien
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="px-4 py-3 small fw-bold">Bien</th>
                        <th class="py-3 small fw-bold">Détails</th>
                        <th class="py-3 small fw-bold">Prix</th>
                        <th class="py-3 small fw-bold">Status</th>
                        <th class="py-3 small fw-bold">Vues</th>
                        <th class="px-4 py-3 small fw-bold text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($properties as $property)
                    <tr>
                        <td class="px-4 py-3">
                            <div class="fw-bold text-dark">{{ $property->title }}</div>
                            <div class="small text-muted"><i class="bi bi-geo-alt"></i> {{ $property->city->name }}</div>
                        </td>
                        <td class="py-3">
                            <div class="small">{{ ucfirst($property->type) }}</div>
                            <div class="small text-muted">{{ $property->rooms }} Ch • {{ $property->surface }} m²</div>
                        </td>
                        <td class="py-3 fw-bold">{{ number_format($property->price, 0, ',', ' ') }} DH</td>
                        <td class="py-3">
                            <span class="badge rounded-pill {{ $property->status == 'available' ? 'bg-success' : 'bg-secondary' }} bg-opacity-10 {{ $property->status == 'available' ? 'text-success' : 'text-secondary' }} px-3 border {{ $property->status == 'available' ? 'border-success' : 'border-secondary' }} border-opacity-25">
                                {{ ucfirst($property->status) }}
                            </span>
                        </td>
                        <td class="py-3 small text-muted">
                            <i class="bi bi-eye"></i> {{ $property->views_count }}
                        </td>
                        <td class="px-4 py-3 text-end">
                            <div class="btn-group">
                                <a href="{{ route('owner.properties.edit', $property) }}" class="btn btn-outline-secondary btn-sm rounded-3 me-2" title="Modifier">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('owner.properties.destroy', $property) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette annonce ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm rounded-3" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <p class="text-muted">Vous n'avez pas encore publié d'annonces.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white border-0 py-4 px-4">
        {{ $properties->links() }}
    </div>
</div>
@endsection
