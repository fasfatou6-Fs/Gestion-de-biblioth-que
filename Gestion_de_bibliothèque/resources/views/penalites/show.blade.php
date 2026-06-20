@extends('layouts.app')

@section('title', 'Détails pénalité')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">⚠️ Détails de la pénalité</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="text-muted">Utilisateur</h6>
                        <p class="h5"><strong>{{ $penalite->emprunt->user->nom }}</strong></p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Livre</h6>
                        <p class="h5"><strong>{{ $penalite->emprunt->livre->titre }}</strong></p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="text-muted">Jours de retard</h6>
                        <p><strong>{{ $penalite->nbJoursRetard }} jour(s)</strong></p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Montant</h6>
                        <p><strong class="text-danger fs-5">{{ number_format($penalite->montant, 2) }}€</strong></p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="text-muted">Date de création</h6>
                        <p><strong>{{ $penalite->dateCreation->format('d/m/Y') }}</strong></p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Statut du paiement</h6>
                        <p>
                            @if($penalite->statusPaiement === 'payé')
                                <span class="badge bg-success fs-6">Payé</span>
                            @else
                                <span class="badge bg-danger fs-6">Non payé</span>
                            @endif
                        </p>
                    </div>
                </div>

                <hr>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ auth()->user()->estAdmin() ? route('penalites.index') : route('penalites.mes') }}" class="btn btn-secondary">🔙 Retour</a>
                    @if($penalite->statusPaiement === 'non_payé')
                        @php $isOwner = auth()->id() === $penalite->emprunt->user_id; @endphp
                        @if($isOwner || auth()->user()->estAdmin())
                            <form action="{{ route('penalites.payer', $penalite) }}" method="POST" style="display:inline;" class="simulate-payment-form" data-amount="{{ number_format($penalite->montant, 2) }}">
                                @csrf
                                <button type="submit" class="btn btn-success">✅ Payer</button>
                            </form>
                        @endif
                    @endif
                    @if(auth()->user()->estAdmin())
                        <form action="{{ route('penalites.destroy', $penalite) }}" method="POST" style="display:inline;" class="needs-confirm" data-confirm-message="Êtes-vous sûr de supprimer cette pénalité ?">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">🗑️ Supprimer</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
