@extends('layouts.app')

@section('title', 'Détails emprunt')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">📋 Détails de l'emprunt</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="text-muted">Utilisateur</h6>
                        <p class="h5"><strong>{{ $emprunt->user->nom }}</strong></p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Livre</h6>
                        <p class="h5"><strong>{{ $emprunt->livre->titre }}</strong></p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="text-muted">Date d'emprunt</h6>
                        <p><strong>{{ $emprunt->dateEmprunt->format('d/m/Y') }}</strong></p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Limite de retour</h6>
                        <p>
                            @if($emprunt->estEnRetard())
                                <span class="text-danger"><strong>{{ $emprunt->dateLimiteRetour->format('d/m/Y') }}</strong> ⏰ EN RETARD</span>
                            @else
                                <strong>{{ $emprunt->dateLimiteRetour->format('d/m/Y') }}</strong>
                            @endif
                        </p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="text-muted">Date de retour</h6>
                        <p><strong>{{ $emprunt->dateRetour ? $emprunt->dateRetour->format('d/m/Y') : 'Pas encore retourné' }}</strong></p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Statut</h6>
                        <p>
                            @if($emprunt->status === 'en_cours')
                                <span class="badge bg-info fs-6">En cours</span>
                            @elseif($emprunt->status === 'retourné')
                                <span class="badge bg-success fs-6">Retourné</span>
                            @else
                                <span class="badge bg-secondary fs-6">{{ $emprunt->status }}</span>
                            @endif
                        </p>
                    </div>
                </div>

                @if($emprunt->status === 'en_cours')
                    <div class="alert alert-info">
                        ℹ️ Cet emprunt est toujours en cours
                    </div>
                @endif

                <hr>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('emprunts.index') }}" class="btn btn-secondary">🔙 Retour</a>
                    @if($emprunt->status === 'en_cours')
                        <form action="{{ route('emprunts.marquer-retour', $emprunt) }}" method="POST" style="display:inline;" class="needs-confirm" data-confirm-message="Confirmer le marquage comme retourné ?">
                            @csrf
                            <button type="submit" class="btn btn-success">✅ Marquer comme retourné</button>
                        </form>
                    @endif
                    <form action="{{ route('emprunts.destroy', $emprunt) }}" method="POST" style="display:inline;" class="needs-confirm" data-confirm-message="Êtes-vous sûr de supprimer cet emprunt ?">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">🗑️ Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
