@extends('layouts.owner')

@section('title', 'Modifier la Propriété')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <form action="{{ route('owner.properties.update', $property) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="card card-custom p-4 mb-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="playfair fw-bold mb-0">Informations Générales</h5>
                    <span class="badge bg-primary bg-opacity-10 text-primary">ID: #{{ $property->id }}</span>
                </div>
                
                <div class="row g-3 mb-3">
                    <div class="col-md-12">
                        <label class="form-label small fw-bold">Titre de l'annonce</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $property->title) }}" required>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label class="form-label small fw-bold">Type de bien</label>
                        <select name="type" class="form-select" required>
                            @foreach($types as $type)
                            <option value="{{ $type }}" {{ $property->type == $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-bold">Ville</label>
                        <select name="city_id" class="form-select" required>
                            @foreach($cities as $city)
                            <option value="{{ $city->id }}" {{ $property->city_id == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-bold">Statut</label>
                        <select name="status" class="form-select" required>
                            <option value="available" {{ $property->status == 'available' ? 'selected' : '' }}>Disponible</option>
                            <option value="sold" {{ $property->status == 'sold' ? 'selected' : '' }}>Vendu</option>
                            <option value="rented" {{ $property->status == 'rented' ? 'selected' : '' }}>Loué</option>
                        </select>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label class="form-label small fw-bold">Prix (DH)</label>
                        <input type="number" name="price" class="form-control" value="{{ old('price', $property->price) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-bold">Surface (m²)</label>
                        <input type="number" name="surface" class="form-control" value="{{ old('surface', $property->surface) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-bold">Nombre de chambres</label>
                        <input type="number" name="rooms" class="form-control" value="{{ old('rooms', $property->rooms) }}" required>
                    </div>
                </div>
            </div>

            <div class="card card-custom p-4 mb-4">
                <h5 class="playfair fw-bold mb-4">Gestion des Photos</h5>
                
                <!-- Existing Images -->
                <div class="row g-3 mb-4">
                    @foreach($property->images as $image)
                    <div class="col-md-3">
                        <div class="position-relative group shadow-sm rounded-3 overflow-hidden border">
                            <img src="{{ asset('storage/' . $image->path) }}" class="img-fluid" style="height: 150px; width: 100%; object-fit: cover;">
                            @if($image->is_primary)
                                <span class="position-absolute top-0 start-0 m-2 badge rounded-pill bg-warning text-dark">Principal</span>
                            @endif
                            <div class="position-absolute bottom-0 start-0 w-100 p-2 bg-dark bg-opacity-75 d-flex justify-content-between">
                                @if(!$image->is_primary)
                                <button type="button" onclick="event.preventDefault(); document.getElementById('primary-form-{{ $image->id }}').submit();" class="btn btn-link p-0 text-white small text-decoration-none">
                                    <i class="bi bi-star"></i> Principal
                                </button>
                                @endif
                                <button type="button" onclick="event.preventDefault(); if(confirm('Supprimer cette image ?')) document.getElementById('delete-image-form-{{ $image->id }}').submit();" class="btn btn-link p-0 text-danger small text-decoration-none ms-auto">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Hidden Forms for Image Actions -->
                @foreach($property->images as $image)
                    <form id="primary-form-{{ $image->id }}" action="{{ route('owner.properties.images.primary', $image) }}" method="POST" style="display: none;">@csrf</form>
                    <form id="delete-image-form-{{ $image->id }}" action="{{ route('owner.properties.images.destroy', $image) }}" method="POST" style="display: none;">@csrf @method('DELETE')</form>
                @endforeach

                <!-- New Images Upload -->
                <div class="mb-3">
                    <label class="form-label small fw-bold">Ajouter de nouvelles photos</label>
                    <input type="file" name="images[]" id="imageInput" class="form-control" multiple accept="image/*">
                    <div id="imagePreviewContainer" class="row g-2 mt-3"></div>
                </div>
            </div>

            <div class="card card-custom p-4 mb-4">
                <h5 class="playfair fw-bold mb-4">Description</h5>
                <textarea name="description" class="form-control" rows="6">{{ old('description', $property->description) }}</textarea>
            </div>

            <div class="d-flex justify-content-end gap-3 mb-5">
                <a href="{{ route('owner.properties.index') }}" class="btn btn-outline-secondary px-5">Annuler</a>
                <button type="submit" class="btn btn-primary px-5" style="background-color: var(--moroccan-green); border: none;">Mettre à jour</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('imageInput').addEventListener('change', function(event) {
        const container = document.getElementById('imagePreviewContainer');
        container.innerHTML = '';
        const files = event.target.files;
        for (let i = 0; i < files.length; i++) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const col = document.createElement('div');
                col.className = 'col-md-2';
                col.innerHTML = `<img src="${e.target.result}" class="img-fluid rounded-3 shadow-sm border" style="height: 100px; width: 100%; object-fit: cover;">`;
                container.appendChild(col);
            }
            reader.readAsDataURL(files[i]);
        }
    });
</script>
@endsection
