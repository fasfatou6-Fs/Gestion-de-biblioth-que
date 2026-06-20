@extends('layouts.app')

@section('title', 'Mes pénalités')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>⚠️ Mes pénalités</h2>
    <a href="{{ route('dashboard') }}" class="btn btn-secondary">🔙 Retour</a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Livre</th>
                        <th>Jours de retard</th>
                        <th>Montant (€)</th>
                        <th>Date création</th>
                        <th>Statut paiement</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($penalites as $penalite)
                        <tr>
                            <td>{{ $penalite->emprunt->livre->titre }}</td>
                            <td>{{ $penalite->nbJoursRetard }}</td>
                            <td><strong>{{ number_format($penalite->montant, 2) }}€</strong></td>
                            <td>{{ $penalite->dateCreation->format('d/m/Y') }}</td>
                            <td>
                                @if($penalite->statusPaiement === 'payé')
                                    <span class="badge bg-success">Payé</span>
                                @else
                                    <span class="badge bg-danger">Non payé</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('penalites.show', $penalite) }}" class="btn btn-sm btn-info">👁️</a>
                                @if($penalite->statusPaiement === 'non_payé')
                                    <form action="{{ route('penalites.payer', $penalite) }}" method="POST" style="display:inline;" class="simulate-payment-form" data-amount="{{ number_format($penalite->montant, 2) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">✅ Payer</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Aucune pénalité enregistrée</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $penalites->links() }}
        </div>
    </div>
</div>
@endsection
