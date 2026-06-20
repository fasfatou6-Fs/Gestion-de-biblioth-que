@extends('layouts.app')

@section('title', 'Livres')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>📖 Liste des livres</h2>
    @if(auth()->user()->estAdmin())
        <a href="{{ route('livres.create') }}" class="btn btn-primary">➕ Ajouter un livre</a>
    @endif
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Auteur</th>
                        <th>ISBN</th>
                        <th>Catégorie</th>
                        <th>Stock</th>
                        <th>Disponible</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($livres as $livre)
                        <tr>
                            <td><strong>{{ $livre->titre }}</strong></td>
                            <td>{{ $livre->auteur }}</td>
                            <td>{{ $livre->isbn }}</td>
                            <td><span class="badge bg-secondary">{{ $livre->categorie }}</span></td>
                            <td>{{ $livre->nbExemplaires }}</td>
                            <td>
                                @if($livre->stockDisponible > 0)
                                    <span class="badge bg-success">{{ $livre->stockDisponible }}</span>
                                @else
                                    <span class="badge bg-danger">0</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('livres.show', $livre) }}" class="btn btn-sm btn-info">👁️</a>
                                @if(auth()->user()->estAdmin())
                                    <a href="{{ route('livres.edit', $livre) }}" class="btn btn-sm btn-warning">✏️</a>
                                    <form action="{{ route('livres.destroy', $livre) }}" method="POST" style="display:inline;" class="needs-confirm" data-confirm-message="Êtes-vous sûr de supprimer ce livre ?">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">🗑️</button>
                                    </form>
                                @else
                                    @if($livre->stockDisponible > 0)
                                        <a href="{{ route('emprunts.create', ['livre_id' => $livre->id]) }}" class="btn btn-sm btn-primary">📤 Emprunter</a>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Aucun livre enregistré</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $livres->links() }}
        </div>
    </div>
</div>
@endsection
