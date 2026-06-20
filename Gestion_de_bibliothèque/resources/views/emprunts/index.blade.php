@extends('layouts.app')

@section('title', 'Emprunts')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>📤 Liste des emprunts</h2>
    <a href="{{ route('emprunts.create') }}" class="btn btn-primary">➕ Nouvel emprunt</a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Utilisateur</th>
                        <th>Livre</th>
                        <th>Date d'emprunt</th>
                        <th>Limite de retour</th>
                        <th>Date de retour</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($emprunts as $emprunt)
                        <tr>
                            <td><strong>{{ $emprunt->user->nom }}</strong></td>
                            <td>{{ $emprunt->livre->titre }}</td>
                            <td>{{ $emprunt->dateEmprunt->format('d/m/Y') }}</td>
                            <td>
                                @if($emprunt->estEnRetard())
                                    <span class="text-danger"><strong>{{ $emprunt->dateLimiteRetour->format('d/m/Y') }}</strong> ⏰</span>
                                @else
                                    {{ $emprunt->dateLimiteRetour->format('d/m/Y') }}
                                @endif
                            </td>
                            <td>{{ $emprunt->dateRetour ? $emprunt->dateRetour->format('d/m/Y') : '-' }}</td>
                            <td>
                                @if($emprunt->status === 'en_cours')
                                    <span class="badge bg-info">En cours</span>
                                @elseif($emprunt->status === 'retourné')
                                    <span class="badge bg-success">Retourné</span>
                                @else
                                    <span class="badge bg-secondary">{{ $emprunt->status }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('emprunts.show', $emprunt) }}" class="btn btn-sm btn-info">👁️</a>
                                @if($emprunt->status === 'en_cours')
                                    <form action="{{ route('emprunts.marquer-retour', $emprunt) }}" method="POST" style="display:inline;" class="needs-confirm" data-confirm-message="Confirmer le marquage comme retourné pour cet emprunt ?">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">✅ Retour</button>
                                    </form>
                                @endif
                                <form action="{{ route('emprunts.destroy', $emprunt) }}" method="POST" style="display:inline;" class="needs-confirm" data-confirm-message="Êtes-vous sûr de supprimer cet emprunt ?">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">🗑️</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Aucun emprunt enregistré</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $emprunts->links() }}
        </div>
    </div>
</div>
@endsection
