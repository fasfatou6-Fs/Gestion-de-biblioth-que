@extends('layouts.app')

@section('title', 'Emprunts en retard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>⏰ Emprunts en retard</h2>
</div>

<div class="card">
    <div class="card-body">
        @if($emprunts->count() > 0)
            <div class="alert alert-danger">
                ⚠️ {{ $emprunts->total() }} emprunt(s) en retard
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Utilisateur</th>
                        <th>Livre</th>
                        <th>Limite de retour</th>
                        <th>Jours de retard</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($emprunts as $emprunt)
                        <tr>
                            <td><strong>{{ $emprunt->user->nom }}</strong></td>
                            <td>{{ $emprunt->livre->titre }}</td>
                            <td><span class="text-danger"><strong>{{ $emprunt->dateLimiteRetour->format('d/m/Y') }}</strong></span></td>
                            <td>
                                <span class="badge bg-danger">
                                    {{ now()->diffInDays($emprunt->dateLimiteRetour) }} jour(s)
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('emprunts.show', $emprunt) }}" class="btn btn-sm btn-info">👁️</a>
                                <form action="{{ route('emprunts.marquer-retour', $emprunt) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">✅ Marquer retour</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Aucun emprunt en retard</td>
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

<div class="mt-4">
    <a href="{{ route('emprunts.index') }}" class="btn btn-secondary">🔙 Retour à la liste</a>
</div>
@endsection
