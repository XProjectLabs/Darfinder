@extends('layouts.client')

@section('client_content')
<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
        <h4 class="playfair fw-bold mb-0">Informations Personnelles</h4>
        <p class="text-muted small">Mettez à jour vos informations de contact et votre ville.</p>
    </div>
    <div class="card-body p-4">
        <form action="{{ route('client.profile.update') }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-uppercase">Nom Complet</label>
                    <input type="text" name="name" class="form-control bg-light border-0 py-2 @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-uppercase">Adresse Email</label>
                    <input type="email" name="email" class="form-control bg-light border-0 py-2 @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-uppercase">Numéro de Téléphone</label>
                    <input type="text" name="phone" class="form-control bg-light border-0 py-2 @error('phone') is-invalid @enderror" value="{{ old('phone', $user->phone) }}" placeholder="+212 600 000 000">
                    @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-uppercase">Ville par défaut</label>
                    <select name="city_id" class="form-select bg-light border-0 py-2 @error('city_id') is-invalid @enderror">
                        <option value="">Sélectionnez une ville</option>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}" {{ old('city_id', $user->city_id) == $city->id ? 'selected' : '' }}>
                                {{ $city->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('city_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            
            <div class="mt-4 text-end">
                <button type="submit" class="btn btn-primary px-4 py-2 rounded-3">Enregistrer les modifications</button>
            </div>
        </form>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
        <h4 class="playfair fw-bold mb-0">Sécurité</h4>
        <p class="text-muted small">Modifiez votre mot de passe pour sécuriser votre compte.</p>
    </div>
    <div class="card-body p-4">
        <form action="{{ route('client.profile.password') }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label small fw-bold text-uppercase">Mot de passe actuel</label>
                    <input type="password" name="current_password" class="form-control bg-light border-0 py-2 @error('current_password') is-invalid @enderror" required>
                    @error('current_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-uppercase">Nouveau mot de passe</label>
                    <input type="password" name="password" class="form-control bg-light border-0 py-2 @error('password') is-invalid @enderror" required>
                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-uppercase">Confirmer le mot de passe</label>
                    <input type="password" name="password_confirmation" class="form-control bg-light border-0 py-2" required>
                </div>
            </div>
            
            <div class="mt-4 text-end">
                <button type="submit" class="btn btn-outline-primary px-4 py-2 rounded-3">Mettre à jour le mot de passe</button>
            </div>
        </form>
    </div>
</div>
@endsection
