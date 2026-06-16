@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
<div class="welcome-banner mb-4">
    <div>
        <p class="welcome-tag">Bonjour</p>
        <h2 class="welcome-title">{{ Auth::user()->name }} 👋</h2>
        <p class="welcome-sub">Voici ce qui se passe dans votre bibliothèque aujourd'hui.</p>
    </div>
    @if(Route::has('catalogue.index'))
    <a href="{{ route('catalogue.index') }}" class="btn btn-primary">
        <i class="bi bi-search"></i> Explorer le catalogue
    </a>
    @endif
</div>

<div class="d-flex justify-content-between align-items-end mb-3">
    <div>
        <span class="section-tag">Cette semaine</span>
        <h3 class="section-title">Livres populaires</h3>
    </div>
</div>
<div class="book-grid mb-5">
    @forelse($livresPopulaires ?? [] as $livre)
    <div class="book-tile">
        <div class="tile-cover"><i class="bi bi-book"></i></div>
        <p class="tile-title">{{ $livre->titre }}</p>
        <p class="tile-author">{{ $livre->auteur }}</p>
    </div>
    @empty
    @for($i = 0; $i < 5; $i++)
    <div class="book-tile">
        <div class="tile-cover"><i class="bi bi-book"></i></div>
        <p class="tile-title">Titre à venir</p>
        <p class="tile-author">Auteur</p>
    </div>
    @endfor
    @endforelse
</div>

<div class="d-flex justify-content-between align-items-end mb-3">
    <div>
        <span class="section-tag">Fraîchement ajoutés</span>
        <h3 class="section-title">Nouveautés du catalogue</h3>
    </div>
</div>
<div class="book-grid">
    @forelse($livresRecents ?? [] as $livre)
    <div class="book-tile">
        <div class="tile-cover tile-cover-alt"><i class="bi bi-stars"></i></div>
        <p class="tile-title">{{ $livre->titre }}</p>
        <p class="tile-author">{{ $livre->auteur }}</p>
    </div>
    @empty
    @for($i = 0; $i < 5; $i++)
    <div class="book-tile">
        <div class="tile-cover tile-cover-alt"><i class="bi bi-stars"></i></div>
        <p class="tile-title">Titre à venir</p>
        <p class="tile-author">Auteur</p>
    </div>
    @endfor
    @endforelse
</div>

@push('styles')
<style>
    .welcome-banner {
        background: linear-gradient(120deg, var(--plum-deep), var(--midnight));
        color: var(--cream);
        border-radius: 20px;
        padding: 34px 36px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
    }
    .welcome-tag { color: var(--rose); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.8px; font-weight: 600; margin-bottom: 4px; }
    .welcome-title { font-weight: 600; margin-bottom: 6px; }
    .welcome-sub { color: rgba(251,245,248,0.7); margin-bottom: 0; }
    .welcome-banner .btn-primary { background: var(--rose-dust); }
    .welcome-banner .btn-primary:hover { background: var(--rose); }

    .section-tag { color: var(--mauve); font-weight: 600; font-size: 0.78rem; text-transform: uppercase; letter-spacing: 0.8px; }
    .section-title { font-weight: 600; color: var(--midnight); margin-top: 4px; }

    .book-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 18px;
    }
    .book-tile { text-align: center; }
    .tile-cover {
        background: linear-gradient(160deg, var(--plum), var(--mauve));
        border-radius: 14px;
        height: 170px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: rgba(255,255,255,0.8);
        font-size: 2.2rem;
        margin-bottom: 10px;
        box-shadow: 0 6px 16px rgba(93, 60, 100, 0.16);
    }
    .tile-cover-alt { background: linear-gradient(160deg, var(--rose-dust), var(--rose)); }
    .tile-title { font-weight: 600; margin-bottom: 2px; font-size: 0.9rem; }
    .tile-author { color: var(--muted); font-size: 0.8rem; }

    @media (max-width: 1200px) {
        .book-grid { grid-template-columns: repeat(3, 1fr); }
    }
    @media (max-width: 768px) {
        .book-grid { grid-template-columns: repeat(2, 1fr); }
    }
</style>
@endpush
@endsection
