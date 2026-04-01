@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Catégories</a></li>
            <li class="breadcrumb-item active" aria-current="page">Modifier {{ $category->name }}</li>
        </ol>
    </nav>
    <h2 class="playfair">Modifier la catégorie</h2>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form action="{{ route('admin.categories.update', $category) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="name" class="form-label fw-bold small text-uppercase text-muted">Nom de la catégorie</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $category->name) }}" placeholder="Ex: Maison, Villa, Appartement..." required autofocus>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <p class="form-text small text-muted mt-2">
                            Le slug sera automatiquement mis à jour à partir du nom.
                        </p>
                    </div>

                    <hr class="my-4 opacity-25">

                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-link text-muted text-decoration-none">
                            <i class="bi bi-arrow-left"></i> Retour
                        </a>
                        <button type="submit" class="btn btn-primary px-4 py-2">
                            <i class="bi bi-check-lg"></i> Enregistrer les modifications
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
