@extends('layouts.app')

@section('title', 'Mes livres')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <span class="section-tag">Mon espace</span>
        <h2 class="section-title mb-0">Mes livres</h2>
    </div>
    @if(Route::has('catalogue.index'))
    <a href="{{ route('catalogue.index') }}" class="btn btn-primary">
        <i class="bi bi-search"></i> Explorer le catalogue
    </a>
    @endif
</div>

<ul class="nav nav-pills mb-4 dash-tabs">
    <li class="nav-item">
        <a class="nav-link active" href="#en-cours">Emprunts en cours</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#historique">Historique</a>
    </li>
</ul>

{{-- Emprunts en cours --}}
<div id="en-cours" class="mb-5">
    <div class="book-grid">
        @forelse($empruntsEnCours as $i => $emprunt)
        <div class="book-card">
            <div class="book-cover cover-{{ $i % 6 }}">
                <i class="bi bi-book"></i>
                @if(\Carbon\Carbon::now()->greaterThan($emprunt->date_limite))
                    <span class="cover-flag flag-retard">En retard</span>
                @else
                    <span class="cover-flag flag-ok">En cours</span>
                @endif
            </div>
            <div class="book-card-body">
                <h6 class="book-card-title">{{ $emprunt->livre->titre }}</h6>
                <p class="book-card-author">{{ $emprunt->livre->auteur }}</p>
                <p class="book-card-date">
                    <i class="bi bi-calendar3"></i>
                    Emprunté le {{ \Carbon\Carbon::parse($emprunt->date_emprunt)->format('d/m/Y') }}
                </p>
                <p class="book-card-date {{ \Carbon\Carbon::now()->greaterThan($emprunt->date_limite) ? 'text-retard' : '' }}">
                    <i class="bi bi-clock"></i>
                    À rendre avant le {{ \Carbon\Carbon::parse($emprunt->date_limite)->format('d/m/Y') }}
                </p>
            </div>
        </div>
        @empty
        <div class="empty-state full-row">
            <i class="bi bi-inbox"></i>
            Aucun emprunt en cours pour le moment.
            @if(Route::has('catalogue.index'))
            <div class="mt-2"><a href="{{ route('catalogue.index') }}" class="btn btn-secondary btn-sm">Parcourir le catalogue</a></div>
            @endif
        </div>
        @endforelse
    </div>
</div>

{{-- Historique --}}
<div id="historique">
    <h5 class="mb-3" style="font-weight:600;"><i class="bi bi-clock-history text-muted me-2"></i>Historique de mes lectures</h5>
    <div class="book-grid">
        @forelse($historique as $i => $h)
        <div class="book-card">
            <div class="book-cover cover-{{ ($i + 3) % 6 }}">
                <i class="bi bi-bookmark-check"></i>
            </div>
            <div class="book-card-body">
                <h6 class="book-card-title">{{ $h->livre->titre }}</h6>
                <p class="book-card-author">{{ $h->livre->auteur }}</p>
                <p class="book-card-date">
                    <i class="bi bi-check-circle"></i>
                    @if($h->date_restitution_effective)
                        Rendu le {{ \Carbon\Carbon::parse($h->date_restitution_effective)->format('d/m/Y') }}
                    @else
                        Restitution non enregistrée
                    @endif
                </p>
            </div>
        </div>
        @empty
        <div class="empty-state full-row">
            <i class="bi bi-inbox"></i>
            Aucun historique disponible.
        </div>
        @endforelse
    </div>
</div>

@push('styles')
<style>
    .section-tag { color: var(--mauve); font-weight: 600; font-size: 0.78rem; text-transform: uppercase; letter-spacing: 0.8px; }
    .section-title { font-weight: 600; color: var(--midnight); margin-top: 4px; }

    .dash-tabs .nav-link {
        color: var(--muted);
        font-weight: 500;
        border-radius: 30px;
        padding: 8px 20px;
        margin-right: 8px;
        font-size: 0.9rem;
    }
    .dash-tabs .nav-link.active { background: var(--plum-deep); color: #fff; }

    .book-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }
    .book-card {
        background: var(--paper);
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 4px 18px rgba(93, 60, 100, 0.09);
        transition: transform 0.15s, box-shadow 0.15s;
    }
    .book-card:hover { transform: translateY(-3px); box-shadow: 0 10px 26px rgba(93, 60, 100, 0.16); }

    .book-cover {
        height: 130px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.4rem;
        color: rgba(255,255,255,0.9);
        position: relative;
    }
    .cover-0 { background: linear-gradient(160deg, #E08E45, #C9692E); }
    .cover-1 { background: linear-gradient(160deg, #5C7FB5, #3C5C8F); }
    .cover-2 { background: linear-gradient(160deg, #E0B23D, #C98A1F); }
    .cover-3 { background: linear-gradient(160deg, var(--plum), var(--plum-deep)); }
    .cover-4 { background: linear-gradient(160deg, #5BAF8C, #3C8A68); }
    .cover-5 { background: linear-gradient(160deg, var(--rose-dust), var(--mauve)); }

    .cover-flag {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 0.7rem;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 20px;
        text-transform: uppercase;
        letter-spacing: 0.4px;
    }
    .flag-ok { background: rgba(255,255,255,0.25); color: #fff; }
    .flag-retard { background: #fff; color: #b3273f; }

    .book-card-body { padding: 16px 18px; }
    .book-card-title { font-weight: 600; margin-bottom: 2px; color: var(--midnight); }
    .book-card-author { color: var(--muted); font-size: 0.85rem; margin-bottom: 10px; }
    .book-card-date { font-size: 0.8rem; color: var(--muted); margin-bottom: 4px; }
    .book-card-date.text-retard { color: #b3273f; font-weight: 600; }

    .full-row { grid-column: 1 / -1; }

    @media (max-width: 1100px) { .book-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 700px) { .book-grid { grid-template-columns: 1fr; } }
</style>
@endpush
@endsection
