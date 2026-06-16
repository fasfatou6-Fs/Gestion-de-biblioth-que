<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGBLE - @yield('title', 'Bibliothèque')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --midnight: #0C0420;
            --plum-deep: #5D3C64;
            --plum: #7B466A;
            --mauve: #9F6496;
            --rose: #D391B0;
            --rose-dust: #BA6E8F;
            --cream: #FBF5F8;
            --paper: #FFFFFF;
            --muted: #8c7d96;
            --line: #ece1ea;
        }

        * { font-family: 'Inter', sans-serif; }
        h1, h2, h3, .brand-font { font-family: 'Fraunces', serif; }

        body { background-color: var(--cream); color: var(--midnight); }

        .navbar-sgble {
            background: var(--midnight);
            padding: 0.9rem 1.75rem;
            box-shadow: 0 2px 16px rgba(12, 4, 32, 0.25);
        }
        .navbar-brand-sgble {
            font-family: 'Fraunces', serif;
            font-weight: 600;
            font-size: 1.5rem;
            color: var(--cream) !important;
            letter-spacing: 0.5px;
            text-decoration: none;
        }
        .navbar-brand-sgble i { color: var(--rose); }
        .user-chip {
            background: rgba(255,255,255,0.07);
            border-radius: 30px;
            padding: 6px 14px;
            color: var(--cream);
            font-size: 0.9rem;
        }
        .role-badge {
            background: var(--rose-dust);
            color: #fff;
            border-radius: 20px;
            padding: 2px 10px;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-left: 6px;
        }
        .btn-logout {
            background: transparent;
            border: 1.5px solid rgba(255,255,255,0.22);
            color: var(--cream);
            border-radius: 30px;
            padding: 6px 16px;
            font-size: 0.85rem;
            transition: all 0.2s;
        }
        .btn-logout:hover { background: var(--rose-dust); border-color: var(--rose-dust); color: #fff; }
        .btn-nav-link {
            color: var(--cream);
            text-decoration: none;
            font-size: 0.92rem;
            font-weight: 500;
            padding: 7px 16px;
            border-radius: 30px;
            transition: background 0.2s;
        }
        .btn-nav-link:hover { background: rgba(255,255,255,0.08); color: var(--cream); }
        .btn-nav-cta {
            background: var(--rose-dust);
            color: #fff !important;
            border-radius: 30px;
            padding: 7px 20px;
            font-size: 0.9rem;
            font-weight: 600;
            text-decoration: none;
        }
        .btn-nav-cta:hover { background: var(--plum); }

        .sidebar {
            min-height: calc(100vh - 70px);
            background: var(--paper);
            border-right: 1px solid var(--line);
            padding-top: 40px;
        }
        .sidebar-label {
            color: var(--muted);
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
            padding: 0 24px;
            margin-bottom: 16px;
        }
        .sidebar a {
            color: var(--midnight);
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 20px;
            text-decoration: none;
            border-radius: 10px;
            margin: 2px 12px;
            font-size: 0.93rem;
            font-weight: 500;
            transition: all 0.18s;
        }
        .sidebar a i { font-size: 1.05rem; color: var(--mauve); }
        .sidebar a:hover { background: var(--cream); }
        .sidebar a.active { background: var(--plum-deep); color: #fff; }
        .sidebar a.active i { color: var(--rose); }
        .sidebar hr { border-color: var(--line); margin: 16px 16px; }

        .main-content { padding: 40px 44px; }
        .main-content.full-width { padding: 0; }

        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 18px rgba(93, 60, 100, 0.1);
        }
        .card-header { border-radius: 16px 16px 0 0 !important; border: none; font-weight: 600; padding: 16px 20px; }

        .btn-primary { background: var(--plum-deep); border: none; border-radius: 10px; font-weight: 500; padding: 9px 20px; }
        .btn-primary:hover { background: var(--midnight); }
        .btn-secondary { background: var(--cream); border: 1.5px solid var(--line); color: var(--midnight); border-radius: 10px; font-weight: 500; }
        .btn-secondary:hover { background: var(--line); color: var(--midnight); }
        .btn-success { background: #6f9b7a; border: none; border-radius: 10px; }
        .btn-success:hover { background: #5c8467; }
        .btn-warning { background: var(--rose); border: none; border-radius: 8px; color: #fff; }
        .btn-warning:hover { background: var(--rose-dust); color: #fff; }
        .btn-danger { background: var(--plum); border: none; border-radius: 8px; }
        .btn-danger:hover { background: var(--plum-deep); }

        .form-control, .form-select { border-radius: 10px; border: 1.5px solid var(--line); padding: 10px 14px; }
        .form-control:focus, .form-select:focus { border-color: var(--mauve); box-shadow: 0 0 0 3px rgba(159, 100, 150, 0.15); }
        .form-label { font-weight: 600; font-size: 0.9rem; color: var(--midnight); }

        .badge-retard { background: linear-gradient(135deg, var(--plum), var(--midnight)); color: white; padding: 5px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 600; }
        .badge-ok { background: #6f9b7a; color: white; padding: 5px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 600; }
        .row-retard { background-color: #f6e9ef !important; }

        .page-title { font-weight: 600; color: var(--midnight); display: flex; align-items: center; gap: 12px; }
        .page-title i { color: var(--rose-dust); background: var(--cream); padding: 10px; border-radius: 12px; font-size: 1.3rem; }

        .empty-state { text-align: center; padding: 50px 20px; color: var(--muted); }
        .empty-state i { font-size: 2.2rem; color: var(--line); display: block; margin-bottom: 10px; }

        .alert { border: none; border-radius: 12px; }
    </style>
    @stack('styles')
</head>
<body>

    <nav class="navbar navbar-sgble d-flex justify-content-between align-items-center">
        <a class="navbar-brand-sgble" href="{{ Auth::check() ? (Route::has('home') ? route('home') : '#') : '/' }}">
            <i class="bi bi-book-half"></i> SGBLE
        </a>
        <div class="d-flex align-items-center gap-2">
            @auth
                <span class="user-chip">
                    <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                    <span class="role-badge">{{ Auth::user()->role }}</span>
                </span>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="bi bi-box-arrow-right"></i> Déconnexion
                    </button>
                </form>
            @else
                @if(Route::has('login'))
                <a href="{{ route('login') }}" class="btn-nav-link">Connexion</a>
                @endif
                @if(Route::has('register'))
                <a href="{{ route('register') }}" class="btn-nav-cta">S'inscrire</a>
                @endif
            @endauth
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">

            @auth
            <div class="col-md-2 sidebar p-0">
                @if(Auth::user()->role === 'admin')
                    <p class="sidebar-label">Administration</p>
                    @if(Route::has('livres.index'))
                    <a href="{{ route('livres.index') }}" class="{{ request()->routeIs('livres.*') ? 'active' : '' }}">
                        <i class="bi bi-journals"></i> Gestion des livres
                    </a>
                    @endif
                    @if(Route::has('emprunts.index'))
                    <a href="{{ route('emprunts.index') }}" class="{{ request()->routeIs('emprunts.*') ? 'active' : '' }}">
                        <i class="bi bi-arrow-left-right"></i> Emprunts
                    </a>
                    @endif
                    @if(Route::has('logs.index'))
                    <a href="{{ route('logs.index') }}" class="{{ request()->routeIs('logs.*') ? 'active' : '' }}">
                        <i class="bi bi-clock-history"></i> Logs
                    </a>
                    @endif
                @else
                    <p class="sidebar-label">Mon espace</p>
                    @if(Route::has('home'))
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
                        <i class="bi bi-house"></i> Accueil
                    </a>
                    @endif
                    @if(Route::has('catalogue.index'))
                    <a href="{{ route('catalogue.index') }}" class="{{ request()->routeIs('catalogue.*') ? 'active' : '' }}">
                        <i class="bi bi-search"></i> Catalogue
                    </a>
                    @endif
                    @if(Route::has('etudiant.dashboard'))
                    <a href="{{ route('etudiant.dashboard') }}" class="{{ request()->routeIs('etudiant.*') ? 'active' : '' }}">
                        <i class="bi bi-grid"></i> Tableau de bord
                    </a>
                    @endif
                @endif
                <hr>
                @if(Route::has('profil.edit'))
                <a href="{{ route('profil.edit') }}" class="{{ request()->routeIs('profil.*') ? 'active' : '' }}">
                    <i class="bi bi-gear"></i> Mon profil
                </a>
                @endif
            </div>
            @endauth

            <div class="col-md-{{ Auth::check() ? '10' : '12' }} main-content @yield('content-class')">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>