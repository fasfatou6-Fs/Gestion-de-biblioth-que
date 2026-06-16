@extends('layouts.app')

@section('title', 'Ajouter un livre')

@section('content')
<div class="d-flex align-items-center mb-4">
    <a href="{{ route('livres.index') }}" class="btn btn-secondary me-3">
        <i class="bi bi-arrow-left"></i>
    </a>
    <h2 class="page-title mb-0"><i class="bi bi-plus-circle"></i> Ajouter un livre</h2>
</div>

<div class="card" style="max-width: 700px;">
    <div class="card-body p-4">
        <form method="POST" action="{{ route('livres.store') }}">
            @csrf

            <div class="mb-3">
                <label for="titre" class="form-label">Titre <span class="text-danger">*</span></label>
                <input type="text" name="titre" id="titre"
                       value="{{ old('titre') }}"
                       class="form-control @error('titre') is-invalid @enderror"
                       placeholder="Ex: Le Petit Prince">
                @error('titre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="auteur" class="form-label">Auteur <span class="text-danger">*</span></label>
                <input type="text" name="auteur" id="auteur"
                       value="{{ old('auteur') }}"
                       class="form-control @error('auteur') is-invalid @enderror"
                       placeholder="Ex: Antoine de Saint-Exupéry">
                @error('auteur')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="isbn" class="form-label">ISBN <span class="text-danger">*</span> <span class="text-muted fw-normal">(13 caractères)</span></label>
                <input type="text" name="isbn" id="isbn"
                       value="{{ old('isbn') }}"
                       maxlength="13"
                       class="form-control @error('isbn') is-invalid @enderror"
                       placeholder="Ex: 9782070612758">
                @error('isbn')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="categorie" class="form-label">Catégorie <span class="text-danger">*</span></label>
                <input type="text" name="categorie" id="categorie"
                       value="{{ old('categorie') }}"
                       class="form-control @error('categorie') is-invalid @enderror"
                       placeholder="Ex: Roman, Science-fiction, Histoire...">
                @error('categorie')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="annee_edition" class="form-label">Année d'édition <span class="text-danger">*</span></label>
                    <input type="number" name="annee_edition" id="annee_edition"
                           value="{{ old('annee_edition') }}"
                           min="1000" max="{{ date('Y') }}"
                           class="form-control @error('annee_edition') is-invalid @enderror"
                           placeholder="Ex: 2023">
                    @error('annee_edition')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="nb_exemplaires" class="form-label">Nombre d'exemplaires <span class="text-danger">*</span></label>
                    <input type="number" name="nb_exemplaires" id="nb_exemplaires"
                           value="{{ old('nb_exemplaires') }}"
                           min="1"
                           class="form-control @error('nb_exemplaires') is-invalid @enderror"
                           placeholder="Ex: 5">
                    @error('nb_exemplaires')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Enregistrer
                </button>
                <a href="{{ route('livres.index') }}" class="btn btn-secondary">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
