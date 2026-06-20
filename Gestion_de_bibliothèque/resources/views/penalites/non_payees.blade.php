@extends('layouts.app')

@section('title', 'Pénalités non payées')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>💰 Pénalités non payées</h2>
</div>

<div class="card">
    <div class="card-body">
        @if($penalites->count() > 0)
            <div class="alert alert-warning">
                ⚠️ {{ $penalites->total() }} pénalité(s) non payée(s) - Total: {{ number_format($penalites->sum('montant'), 2) }}€
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Utilisateur</th>
                        <th>Livre</th>
                        <th>Jours de retard</th>
                        <th>Montant (€)</th>
                        <th>Date création</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($penalites as $penalite)
                        <tr>
                            <td><strong>{{ $penalite->emprunt->user->nom }}</strong></td>
                            <td>{{ $penalite->emprunt->livre->titre }}</td>
                            <td>{{ $penalite->nbJoursRetard }}</td>
                            <td><strong class="text-danger">{{ number_format($penalite->montant, 2) }}€</strong></td>
                            <td>{{ $penalite->dateCreation->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('penalites.show', $penalite) }}" class="btn btn-sm btn-info">👁️</a>
                                <form action="{{ route('penalites.payer', $penalite) }}" method="POST" style="display:inline;" class="simulate-payment-form" data-amount="{{ number_format($penalite->montant, 2) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">✅ Payer</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Aucune pénalité non payée</td>
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

<div class="mt-4">
    <a href="{{ route('penalites.index') }}" class="btn btn-secondary">🔙 Retour à la liste</a>
</div>
@endsection
