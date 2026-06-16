@extends('layouts.app')

@section('title', 'Catalogue des livres')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="page-title"><i class="bi bi-journals"></i> Catalogue des livres</h2>
    @if(Auth::user()->role === 'admin')
        <a href="{{ route('livres.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Ajouter un livre
        </a>
    @endif
</div>

{{-- Barre de recherche multicritère --}}
<form method="GET" action="{{ route('livres.index') }}" class="mb-4">
    <div class="row g-2">
        <div class="col-md-4">
            <input type="text" name="titre" placeholder="Rechercher par titre..." value="{{ request('titre') }}" class="form-control">
        </div>
        <div class="col-md-3">
            <input type="text" name="auteur" placeholder="Rechercher par auteur..." value="{{ request('auteur') }}" class="form-control">
        </div>
        <div class="col-md-3">
            <input type="text" name="categorie" placeholder="Rechercher par catégorie..." value="{{ request('categorie') }}" class="form-control">
        </div>
        <div class="col-md-2 d-flex gap-2">
            <button type="submit" class="btn btn-primary w-100">
                <i class="bi bi-search"></i>
            </button>
            <a href="{{ route('livres.index') }}" class="btn btn-secondary w-100">
                <i class="bi bi-x-lg"></i>
            </a>
        </div>
    </div>
</form>

{{-- Cartes horizontales --}}
<div class="d-flex flex-column gap-3">
    @forelse($livres as $livre)
    <div class="book-card">
        <div class="book-cover">
            <i class="bi bi-book"></i>
        </div>
        <div class="book-info">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h5 class="book-title">{{ $livre->titre }}</h5>
                    <p class="book-author">{{ $livre->auteur }}</p>
                </div>
                @if($livre->stock_disponible > 0)
                    <span class="stock-badge stock-ok">{{ $livre->stock_disponible }} disponible(s)</span>
                @else
                    <span class="stock-badge stock-out">Indisponible</span>
                @endif
            </div>

            <div class="book-meta">
                <span class="meta-pill"><i class="bi bi-tag"></i> {{ $livre->categorie }}</span>
                <span class="meta-pill"><i class="bi bi-calendar3"></i> {{ $livre->annee_edition }}</span>
                <span class="meta-pill meta-isbn"><i class="bi bi-upc"></i> {{ $livre->isbn }}</span>
            </div>

            @if(Auth::user()->role === 'admin')
            <div class="book-actions">
                <a href="{{ route('livres.edit', $livre->id) }}" class="btn btn-warning btn-sm">
                    <i class="bi bi-pencil"></i> Modifier
                </a>
                <form action="{{ route('livres.destroy', $livre->id) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Confirmer la suppression logique de ce livre ?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="bi bi-trash"></i> Supprimer
                    </button>
                </form>
            </div>
            @endif
        </div>
    </div>
    @empty
    <div class="empty-state">
        <i class="bi bi-inbox"></i>
        Aucun livre trouvé.
    </div>
    @endforelse
</div>

<div class="mt-4 d-flex justify-content-center">
    {{ $livres->appends(request()->query())->links() }}
</div>

@push('styles')
<style>
    .book-card {
        background: var(--paper);
        border-radius: 16px;
        box-shadow: 0 4px 18px rgba(74, 59, 107, 0.08);
        display: flex;
        overflow: hidden;
        transition: transform 0.15s, box-shadow 0.15s;
    }
    .book-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(74, 59, 107, 0.14);
    }
    .book-cover {
        width: 90px;
        min-width: 90px;
        background: linear-gradient(160deg, var(--plum), var(--mauve));
        display: flex;
        align-items: center;
        justify-content: center;
        color: rgba(255,255,255,0.85);
        font-size: 2rem;
    }
    .book-info {
        padding: 18px 22px;
        flex: 1;
    }
    .book-title {
        font-family: 'Fraunces', serif;
        font-weight: 600;
        margin-bottom: 2px;
        color: var(--midnight);
    }
    .book-author {
        color: var(--muted);
        font-size: 0.9rem;
        margin-bottom: 10px;
    }
    .book-meta {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        margin-bottom: 12px;
    }
    .meta-pill {
        background: var(--cream);
        color: var(--plum);
        font-size: 0.78rem;
        padding: 4px 11px;
        border-radius: 20px;
        font-weight: 500;
    }
    .meta-isbn {
        font-family: monospace;
    }
    .stock-badge {
        font-size: 0.78rem;
        padding: 5px 13px;
        border-radius: 20px;
        font-weight: 600;
        white-space: nowrap;
    }
    .stock-ok { background: rgba(127, 166, 138, 0.18); color: #6f9b7a; }
    .stock-out { background: rgba(255, 107, 91, 0.15); color: var(--plum-deep); }
    .book-actions {
        display: flex;
        gap: 8px;
        margin-top: 4px;
    }
</style>
@endpush
@endsection
