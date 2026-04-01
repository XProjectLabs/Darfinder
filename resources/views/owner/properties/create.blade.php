@extends('layouts.owner')

@section('title', 'Ajouter une Propriété')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <form action="{{ route('owner.properties.store') }}" method="POST" class="needs-validation" enctype="multipart/form-data">
            @csrf
            
            @if($errors->any())
                <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <div class="card card-custom p-4 mb-4">
                <h5 class="playfair fw-bold mb-4">Informations Générales</h5>
                <div class="row g-3">
                    <div class="col-md-12 mb-3">
                        <label class="form-label small fw-bold">Titre de l'annonce</label>
                        <input type="text" name="title" class="form-control" placeholder="Ex: Magnifique Riad avec Piscine" required>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label class="form-label small fw-bold">Catégorie de bien</label>
                        <select name="category_id" class="form-select" required>
                            <option value="">Sélectionnez une catégorie</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-bold">Ville</label>
                        <select name="city_id" class="form-select" required>
                            <option value="">Sélectionnez une ville</option>
                            @foreach($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-bold">Prix (DH)</label>
                        <input type="number" name="price" class="form-control" placeholder="1 500 000" required>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label class="form-label small fw-bold">Surface (m²)</label>
                        <input type="number" name="surface" class="form-control" placeholder="120" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-bold">Nombre de chambres</label>
                        <input type="number" name="rooms" class="form-control" placeholder="3" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-bold">Meublé</label>
                        <select name="furnished" class="form-select" required>
                            <option value="0">Non</option>
                            <option value="1">Oui</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="card card-custom p-4 mb-4">
                <h5 class="playfair fw-bold mb-4">Photos du Bien</h5>
                <div class="mb-3">
                    <label class="form-label small fw-bold">Sélectionnez plusieurs images</label>
                    <input type="file" name="images[]" id="imageInput" class="form-control" multiple accept="image/*">
                    <div id="imagePreviewContainer" class="row g-2 mt-3">
                        <!-- Previews will appear here -->
                    </div>
                    <div class="form-text mt-2"><i class="bi bi-info-circle"></i> La première image sera définie comme image principale par défaut.</div>
                </div>
            </div>

            <div class="card card-custom p-4 mb-4">
                <h5 class="playfair fw-bold mb-4">Description</h5>
                <div class="mb-3">
                    <textarea name="description" class="form-control" rows="6" placeholder="Décrivez les atouts de votre bien en quelques lignes..."></textarea>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-3 mb-5">
                <a href="{{ route('owner.properties.index') }}" class="btn btn-outline-secondary px-5">Annuler</a>
                <button type="submit" class="btn btn-primary px-5" style="background-color: var(--moroccan-green); border: none;">Publier l'annonce</button>
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
            const file = files[i];
            const reader = new FileReader();
            
            reader.onload = function(e) {
                const col = document.createElement('div');
                col.className = 'col-md-2 position-relative';
                col.innerHTML = `
                    <img src="${e.target.result}" class="img-fluid rounded-3 shadow-sm border" style="height: 100px; width: 100%; object-fit: cover;">
                    ${i === 0 ? '<span class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-warning text-dark small">Principal</span>' : ''}
                `;
                container.appendChild(col);
            }
            
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
