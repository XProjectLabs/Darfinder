@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.cities.index') }}">Villes</a></li>
            <li class="breadcrumb-item active" aria-current="page">Nouvelle Ville</li>
        </ol>
    </nav>
    <h2 class="playfair">Ajouter une nouvelle ville</h2>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form action="{{ route('admin.cities.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="form-label fw-bold small text-uppercase text-muted">Nom de la ville</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Ex: Casablanca, Ifrane..." required autofocus>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="region" class="form-label fw-bold small text-uppercase text-muted">Région</label>
                        <select name="region" id="region" class="form-select @error('region') is-invalid @enderror" required>
                            <option value="">Sélectionnez une région</option>
                            @foreach($regions as $region)
                                <option value="{{ $region }}" {{ old('region') == $region ? 'selected' : '' }}>{{ $region }}</option>
                            @endforeach
                        </select>
                        @error('region')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr class="my-4 opacity-25">

                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('admin.cities.index') }}" class="btn btn-link text-muted text-decoration-none">
                            <i class="bi bi-arrow-left"></i> Retour
                        </a>
                        <button type="submit" class="btn btn-primary px-4 py-2">
                            <i class="bi bi-check-lg"></i> Enregistrer la ville
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="alert alert-info border-0 shadow-sm">
            <h5 class="fw-bold"><i class="bi bi-info-circle me-2"></i> Note</h5>
            <p class="mb-0 small">En ajoutant une ville, vous permettez aux propriétaires de lister des biens dans cette localisation. Veillez à bien sélectionner la région administrative correspondante.</p>
        </div>
    </div>
</div>
@endsection
