@extends('layouts.app')

@section('title', $livre->titre)

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">📖 Détails du livre</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="text-muted">Titre</h6>
                        <p class="h5"><strong>{{ $livre->titre }}</strong></p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Auteur</h6>
                        <p class="h5"><strong>{{ $livre->auteur }}</strong></p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="text-muted">ISBN</h6>
                        <p><strong>{{ $livre->isbn }}</strong></p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Catégorie</h6>
                        <p><span class="badge bg-secondary">{{ $livre->categorie }}</span></p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="text-muted">Exemplaires totaux</h6>
                        <p><strong>{{ $livre->nbExemplaires }}</strong></p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Disponibles</h6>
                        <p>
                            @if($livre->stockDisponible > 0)
                                <span class="badge bg-success fs-6">{{ $livre->stockDisponible }}</span>
                            @else
                                <span class="badge bg-danger fs-6">0</span>
                            @endif
                        </p>
                    </div>
                </div>

                <hr>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('livres.index') }}" class="btn btn-secondary">🔙 Retour</a>
                    @if(auth()->user()->estAdmin())
                        <a href="{{ route('livres.edit', $livre) }}" class="btn btn-warning">✏️ Modifier</a>
                        <form action="{{ route('livres.destroy', $livre) }}" method="POST" style="display:inline;" class="needs-confirm" data-confirm-message="Êtes-vous sûr de supprimer ce livre ?">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">🗑️ Supprimer</button>
                        </form>
                    @endif

                    @if($livre->stockDisponible > 0)
                        @if(auth()->user()->estAdmin())
                            <a href="{{ route('emprunts.create', ['livre_id' => $livre->id]) }}" class="btn btn-primary">➕ Nouvel emprunt</a>
                        @else
                            <a href="{{ route('emprunts.create', ['livre_id' => $livre->id]) }}" class="btn btn-primary">📤 Emprunter</a>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
