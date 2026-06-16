@extends('layouts.app')

@section('title', 'Bienvenue')
@section('content-class', 'full-width')

@section('content')
<div class="hero">
    <div class="hero-text">
        <span class="hero-tag">Système de Gestion de Bibliothèque</span>
        <h1 class="hero-title">Lisez plus.<br>Cherchez moins.</h1>
        <p class="hero-sub">Empruntez, suivez vos lectures et découvrez de nouveaux livres en quelques clics. Votre bibliothèque, simplifiée.</p>
        <div class="d-flex gap-3 mt-4">
            @if(Route::has('register'))
            <a href="{{ route('register') }}" class="btn btn-hero-primary">Créer un compte</a>
            @endif
            @if(Route::has('login'))
            <a href="{{ route('login') }}" class="btn btn-hero-secondary">Se connecter</a>
            @endif
        </div>
    </div>
    <div class="hero-visual">
        <i class="bi bi-book-half"></i>
    </div>
</div>

<div class="section-wrap">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <span class="section-tag">À la une</span>
            <h2 class="section-title">Livres populaires</h2>
        </div>
    </div>

    <div class="book-grid">
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
</div>

<div class="section-wrap pb-5">
    <span class="section-tag">Pourquoi SGBLE</span>
    <h2 class="section-title mb-4">Tout ce qu'il faut, rien de plus</h2>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="feature-card">
                <i class="bi bi-search"></i>
                <h5>Recherche rapide</h5>
                <p>Trouvez un livre par titre, auteur ou catégorie en quelques secondes.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-card">
                <i class="bi bi-clock-history"></i>
                <h5>Suivi des emprunts</h5>
                <p>Visualisez vos prêts en cours et vos dates de retour sans surprise.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-card">
                <i class="bi bi-graph-up"></i>
                <h5>Historique de lecture</h5>
                <p>Gardez une trace de tout ce que vous avez lu depuis votre inscription.</p>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .hero {
        background: radial-gradient(circle at top right, var(--plum-deep), var(--midnight) 70%);
        color: var(--cream);
        padding: 90px 60px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 40px;
        flex-wrap: wrap;
    }
    .hero-tag {
        background: rgba(255,255,255,0.1);
        color: var(--rose);
        padding: 6px 16px;
        border-radius: 30px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.8px;
    }
    .hero-title {
        font-size: 3.2rem;
        font-weight: 600;
        margin: 18px 0 14px;
        line-height: 1.1;
    }
    .hero-sub { color: rgba(251,245,248,0.75); font-size: 1.05rem; max-width: 480px; }
    .hero-text { max-width: 600px; }
    .btn-hero-primary {
        background: var(--rose-dust);
        color: #fff;
        border-radius: 30px;
        padding: 13px 30px;
        font-weight: 600;
        text-decoration: none;
    }
    .btn-hero-primary:hover { background: var(--rose); color: #fff; }
    .btn-hero-secondary {
        background: transparent;
        border: 1.5px solid rgba(255,255,255,0.3);
        color: var(--cream);
        border-radius: 30px;
        padding: 13px 30px;
        font-weight: 600;
        text-decoration: none;
    }
    .btn-hero-secondary:hover { background: rgba(255,255,255,0.08); color: var(--cream); }
    .hero-visual {
        font-size: 11rem;
        color: rgba(255,255,255,0.08);
        line-height: 1;
    }

    .section-wrap { padding: 60px 60px 20px; }
    .section-tag { color: var(--mauve); font-weight: 600; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.8px; }
    .section-title { font-weight: 600; color: var(--midnight); margin-top: 6px; }

    .book-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 20px;
    }
    .book-tile { text-align: center; }
    .tile-cover {
        background: linear-gradient(160deg, var(--plum), var(--mauve));
        border-radius: 14px;
        height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: rgba(255,255,255,0.8);
        font-size: 2.5rem;
        margin-bottom: 12px;
        box-shadow: 0 8px 20px rgba(93, 60, 100, 0.18);
    }
    .tile-title { font-weight: 600; margin-bottom: 2px; font-size: 0.95rem; }
    .tile-author { color: var(--muted); font-size: 0.82rem; }

    .feature-card {
        background: var(--paper);
        border-radius: 16px;
        padding: 28px;
        height: 100%;
        box-shadow: 0 4px 18px rgba(93, 60, 100, 0.08);
    }
    .feature-card i { font-size: 1.8rem; color: var(--rose-dust); margin-bottom: 12px; display: block; }
    .feature-card h5 { font-weight: 600; margin-bottom: 8px; }
    .feature-card p { color: var(--muted); font-size: 0.92rem; margin-bottom: 0; }

    @media (max-width: 992px) {
        .book-grid { grid-template-columns: repeat(2, 1fr); }
        .hero { padding: 60px 30px; }
        .hero-title { font-size: 2.3rem; }
        .section-wrap { padding: 40px 24px; }
    }
</style>
@endpush
@endsection
