@extends('layouts.owner')

@section('title', 'Mon Profil')

@section('content')
<div class="row g-4">
    <!-- Profile Info Card -->
    <div class="col-lg-7">
        <div class="card card-custom p-4">
            <h5 class="playfair fw-bold mb-4">Informations Personnelles</h5>
            <form action="{{ route('owner.profile.update') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Nom Complet</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Téléphone</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Ville</label>
                        <select name="city_id" class="form-select">
                            <option value="">Sélectionnez une ville</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}" {{ $user->city_id == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary px-4" style="background-color: var(--moroccan-green); border: none;">Enregistrer les modifications</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Password Management Card -->
    <div class="col-lg-5">
        <div class="card card-custom p-4">
            <h5 class="playfair fw-bold mb-4">Sécurité & Mot de Passe</h5>
            <form action="{{ route('owner.profile.password') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label small fw-bold">Mot de passe actuel</label>
                    <input type="password" name="current_password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold">Nouveau mot de passe</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-4">
                    <label class="form-label small fw-bold">Confirmer le nouveau mot de passe</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-outline-dark">Mettre à jour le mot de passe</button>
                </div>
            </form>
        </div>

        <div class="card card-custom mt-4 p-4 text-center" style="border-left: 5px solid var(--moroccan-gold) !important;">
            <p class="mb-0 text-muted small">Statut du Compte: <span class="badge {{ $user->is_active ? 'bg-success' : 'bg-danger' }} rounded-pill ms-2">{{ $user->is_active ? 'Actif' : 'Inactif' }}</span></p>
        </div>
    </div>
</div>
@endsection
