@extends('layouts.app')

@section('content')
<div class="container my-5 py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 shadow-lg p-4 rounded-4" style="border-top: 5px solid var(--moroccan-gold) !important;">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <i class="bi bi-house-heart-fill fs-1 text-moroccan-green" style="color: var(--moroccan-green);"></i>
                        <h2 class="playfair fw-bold mt-2">Heureux de vous revoir</h2>
                        <p class="text-muted">Connectez-vous pour accéder à vos favoris et vos annonces.</p>
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

                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label small fw-bold">Email</label>
                            <input type="email" name="email" id="email" class="form-control form-control-lg bg-light border-0 shadow-sm" placeholder="votre@email.com" value="{{ old('email') }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label small fw-bold">Mot de passe</label>
                            <input type="password" name="password" id="password" class="form-control form-control-lg bg-light border-0 shadow-sm" placeholder="••••••••" required>
                        </div>
                        <div class="mb-4 d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                <label class="form-check-label text-muted small" for="remember">Se souvenir de moi</label>
                            </div>
                            <a href="#" class="text-decoration-none small" style="color: var(--moroccan-green);">Oublié ?</a>
                        </div>
                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-primary btn-lg fw-bold">Se Connecter</button>
                        </div>
                        <p class="text-center text-muted small mb-0">Pas encore de compte ? <a href="{{ route('register') }}" class="text-decoration-none fw-bold" style="color: var(--moroccan-gold);">S'inscrire gratuitement</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
