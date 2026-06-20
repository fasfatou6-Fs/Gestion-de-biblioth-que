@extends('layouts.app')

@section('title', 'Tableau de bord')

@section('content')
<div class="d-flex justify-content-end mb-3">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-outline-secondary">🚪 Déconnexion</button>
    </form>
</div>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="stat-card" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
            <h3>{{ $totalLivres }}</h3>
            <p>Livres</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
            <h3>{{ $totalEmprunts }}</h3>
            <p>Emprunts au total</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
            <h3>{{ $empruntEnCours }}</h3>
            <p>Emprunts en cours</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
            <h3>{{ $empruntEnRetard }}</h3>
            <p>En retard</p>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">📊 Pénalités non payées</h5>
            </div>
            <div class="card-body">
                <h3 class="text-danger">{{ number_format($penalitesNonPayees, 2) }}€</h3>
                <p class="text-muted">Total des pénalités en attente de paiement</p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">👥 Utilisateurs</h5>
            </div>
            <div class="card-body">
                <h3>{{ $totalUtilisateurs }}</h3>
                <p class="text-muted">Utilisateurs enregistrés</p>
            </div>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header bg-dark text-white">
        <h5 class="mb-0">📋 Derniers emprunts</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Utilisateur</th>
                        <th>Livre</th>
                        <th>Date d'emprunt</th>
                        <th>Limite de retour</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dernierEmprunts as $emprunt)
                        <tr>
                            <td>{{ $emprunt->user->nom }}</td>
                            <td>{{ $emprunt->livre->titre }}</td>
                            <td>{{ $emprunt->dateEmprunt->format('d/m/Y') }}</td>
                            <td>{{ $emprunt->dateLimiteRetour->format('d/m/Y') }}</td>
                            <td>
                                @if($emprunt->status === 'en_cours')
                                    <span class="badge bg-info">En cours</span>
                                @elseif($emprunt->status === 'retourné')
                                    <span class="badge bg-success">Retourné</span>
                                @else
                                    <span class="badge bg-secondary">{{ $emprunt->status }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Aucun emprunt</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
