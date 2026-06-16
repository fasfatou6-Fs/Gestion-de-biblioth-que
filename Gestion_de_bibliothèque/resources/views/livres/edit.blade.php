@extends('layouts.app')

@section('title', 'Modifier un livre')

@section('content')
<div class="d-flex align-items-center mb-4">
    <a href="{{ route('livres.index') }}" class="btn btn-secondary me-3">
        <i class="bi bi-arrow-left"></i>
    </a>
    <h2 class="page-title mb-0"><i class="bi bi-pencil-square"></i> Modifier le livre</h2>
</div>

<div class="card" style="max-width: 700px;">
    <div class="card-body p-4">
        <form method="POST" action="{{ route('livres.update', $livre->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="titre" class="form-label">Titre <span class="text-danger">*</span></label>
                <input type="text" name="titre" id="titre"
                       value="{{ old('titre', $livre->titre) }}"
                       class="form-control @error('titre') is-invalid @enderror">
                @error('titre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="auteur" class="form-label">Auteur <span class="text-danger">*</span></label>
                <input type="text" name="auteur" id="auteur"
                       value="{{ old('auteur', $livre->auteur) }}"
                       class="form-control @error('auteur') is-invalid @enderror">
                @error('auteur')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="isbn" class="form-label">ISBN <span class="text-danger">*</span> <span class="text-muted fw-normal">(13 caractères)</span></label>
                <input type="text" name="isbn" id="isbn"
                       value="{{ old('isbn', $livre->isbn) }}"
                       maxlength="13"
                       class="form-control @error('isbn') is-invalid @enderror">
                @error('isbn')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="categorie" class="form-label">Catégorie <span class="text-danger">*</span></label>
                <input type="text" name="categorie" id="categorie"
                       value="{{ old('categorie', $livre->categorie) }}"
                       class="form-control @error('categorie') is-invalid @enderror">
                @error('categorie')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="annee_edition" class="form-label">Année d'édition <span class="text-danger">*</span></label>
                    <input type="number" name="annee_edition" id="annee_edition"
                           value="{{ old('annee_edition', $livre->annee_edition) }}"
                           min="1000" max="{{ date('Y') }}"
                           class="form-control @error('annee_edition') is-invalid @enderror">
                    @error('annee_edition')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="nb_exemplaires" class="form-label">Nombre d'exemplaires <span class="text-danger">*</span></label>
                    <input type="number" name="nb_exemplaires" id="nb_exemplaires"
                           value="{{ old('nb_exemplaires', $livre->nb_exemplaires) }}"
                           min="1"
                           class="form-control @error('nb_exemplaires') is-invalid @enderror">
                    <small class="text-muted">Augmente ce chiffre lors d'un réapprovisionnement.</small>
                    @error('nb_exemplaires')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-lg"></i> Mettre à jour
                </button>
                <a href="{{ route('livres.index') }}" class="btn btn-secondary">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
