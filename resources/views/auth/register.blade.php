@extends('layouts.app')

@section('content')
<div class="container my-5 py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card border-0 shadow-lg p-4 rounded-4" style="border-top: 5px solid var(--moroccan-gold) !important;">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <i class="bi bi-house-heart-fill fs-1" style="color: var(--moroccan-green);"></i>
                        <h2 class="playfair fw-bold mt-2">Rejoignez Darfinder</h2>
                        <p class="text-muted">Créez votre compte en quelques minutes pour commencer votre projet immobilier au Maroc.</p>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger border-0 rounded-4">
                            <ul class="mb-0 small">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label small fw-bold">Nom Complet</label>
                                <input type="text" name="name" id="name" class="form-control bg-light border-0 shadow-sm" placeholder="John Doe" value="{{ old('name') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label small fw-bold">Email</label>
                                <input type="email" name="email" id="email" class="form-control bg-light border-0 shadow-sm" placeholder="votre@email.com" value="{{ old('email') }}" required>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label small fw-bold">Téléphone (Optionnel)</label>
                                <input type="text" name="phone" id="phone" class="form-control bg-light border-0 shadow-sm" placeholder="+212 6..." value="{{ old('phone') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="role" class="form-label small fw-bold">Je suis un...</label>
                                <select name="role" id="role" class="form-select bg-light border-0 shadow-sm" required>
                                    <option value="locataire">Locataire (Chercheur)</option>
                                    <option value="propriétaire">Propriétaire (Annonceur)</option>
                                </select>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-12 mb-3">
                                <label for="city_id" class="form-label small fw-bold">Ma Ville de Résidence</label>
                                <select name="city_id" id="city_id" class="form-select bg-light border-0 shadow-sm">
                                    <option value="">Sélectionnez votre ville...</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label small fw-bold">Mot de passe</label>
                                <input type="password" name="password" id="password" class="form-control bg-light border-0 shadow-sm" placeholder="••••••••" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label small fw-bold">Confirmer</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control bg-light border-0 shadow-sm" placeholder="••••••••" required>
                            </div>
                        </div>

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary btn-lg fw-bold">Créer mon compte</button>
                        </div>
                        <p class="text-center text-muted small mb-0">Déjà inscrit ? <a href="{{ route('login') }}" class="text-decoration-none fw-bold" style="color: var(--moroccan-gold);">Se connecter</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
