@extends('layouts.app')

@section('title', 'Modifier le livre')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">✏️ Modifier le livre</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('livres.update', $livre) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="titre" class="form-label">Titre <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('titre') is-invalid @enderror" id="titre" name="titre" value="{{ old('titre', $livre->titre) }}" required>
                        @error('titre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="auteur" class="form-label">Auteur <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('auteur') is-invalid @enderror" id="auteur" name="auteur" value="{{ old('auteur', $livre->auteur) }}" required>
                        @error('auteur')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="categorie" class="form-label">Catégorie <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('categorie') is-invalid @enderror" id="categorie" name="categorie" value="{{ old('categorie', $livre->categorie) }}" required>
                        @error('categorie')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nbExemplaires" class="form-label">Nombre d'exemplaires <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('nbExemplaires') is-invalid @enderror" id="nbExemplaires" name="nbExemplaires" value="{{ old('nbExemplaires', $livre->nbExemplaires) }}" min="1" required>
                        @error('nbExemplaires')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('livres.show', $livre) }}" class="btn btn-secondary">❌ Annuler</a>
                        <button type="submit" class="btn btn-primary">✅ Modifier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
