<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gestion de Bibliothèque')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fff5fb;
            color: #2d0735;
        }
        .navbar {
            background-color: #d946ef !important;
        }
        .navbar-brand {
            font-weight: bold;
            color: #fff !important;
            font-size: 1.3rem;
        }
        .nav-link {
            color: #fef2ff !important;
            margin: 0 5px;
        }
        .nav-link:hover {
            color: #f9a8d4 !important;
        }
        .sidebar {
            background-color: #fdf2f8;
            color: #6b0d4b;
            min-height: 100vh;
            padding: 20px 0;
        }
        .sidebar a {
            color: #6b0d4b;
            text-decoration: none;
            display: block;
            padding: 10px 20px;
            border-left: 3px solid transparent;
        }
        .sidebar a:hover {
            background-color: #fce7f3;
            border-left-color: #d946ef;
        }
        .sidebar a.active {
            background-color: #f9a8d4;
            border-left-color: #a21caf;
            color: #4c1d95;
        }
        .main-content {
            padding: 30px 20px;
        }
        .card {
            box-shadow: 0 8px 30px rgba(139, 92, 246, 0.12);
            border: none;
            border-radius: 1.5rem;
        }
        .card-header {
            background: linear-gradient(135deg, #f9a8d4 0%, #d946ef 100%);
            color: white;
            border-radius: 1.5rem 1.5rem 0 0;
        }
        .stat-card {
            background: linear-gradient(135deg, #fbcfe8 0%, #f472b6 100%);
            color: white;
            padding: 20px;
            border-radius: 1rem;
            text-align: center;
            margin-bottom: 20px;
        }
        .stat-card h3 {
            font-size: 2rem;
            margin-bottom: 5px;
        }
        .stat-card p {
            margin: 0;
            font-size: 0.9rem;
            opacity: 0.95;
        }
        .btn-primary {
            background-color: #db2777;
            border-color: #db2777;
        }
        .btn-primary:hover {
            background-color: #be185d;
            border-color: #be185d;
        }
        .btn-outline-secondary {
            color: #6b0d4b;
            border-color: #f9a8d4;
            background-color: transparent;
        }
        .btn-outline-secondary:hover {
            background-color: #fad0ec;
            color: #4c1d95;
            border-color: #d946ef;
        }
        .alert {
            margin-top: 20px;
        }
        table {
            background-color: white;
        }
        table thead {
            background-color: #f9a8d4;
            color: #4c1d95;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('dashboard') }}">📚 Bibliothèque</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('livres.index') }}">📖 Livres</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('emprunts.index') }}">📤 Emprunts</a>
                        </li>
                        <li class="nav-item">
                            @if(auth()->user()->estAdmin())
                                <a class="nav-link" href="{{ route('penalites.index') }}">⚠️ Pénalités</a>
                            @else
                                <a class="nav-link" href="{{ route('penalites.mes') }}">⚠️ Mes pénalités</a>
                            @endif
                        </li>
                        @if(auth()->user()->estAdmin())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logs.index') }}">📋 Logs</a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button class="btn btn-link nav-link" type="submit">🚪 Déconnexion</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Connexion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Inscription</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar">
                <h5 style="padding: 0 20px; margin-bottom: 20px;">Menu</h5>
                @auth
                    <a href="{{ route('dashboard') }}" class="@if(request()->route()->getName() == 'dashboard') active @endif">
                        🏠 Tableau de bord
                    </a>
                    @if(auth()->user()->estAdmin())
                        <a href="{{ route('livres.index') }}" class="@if(strpos(request()->route()->getName(), 'livres') === 0) active @endif">
                            📖 Livres
                        </a>
                        <a href="{{ route('livres.create') }}">
                            ➕ Ajouter un livre
                        </a>
                        <a href="{{ route('emprunts.index') }}" class="@if(strpos(request()->route()->getName(), 'emprunts') === 0) active @endif">
                            📤 Emprunts
                        </a>
                        <a href="{{ route('emprunts.create') }}">
                            ➕ Nouvel emprunt
                        </a>
                        <a href="{{ route('emprunts.en_retard') }}">
                            ⏰ En retard
                        </a>
                        <a href="{{ route('penalites.index') }}" class="@if(strpos(request()->route()->getName(), 'penalites') === 0) active @endif">
                            ⚠️ Pénalités
                        </a>
                        <a href="{{ route('penalites.non_payees') }}">
                            💰 Non payées
                        </a>
                        <a href="{{ route('logs.index') }}">
                            📋 Logs d'activité
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="active">🔐 Se connecter</a>
                    <a href="{{ route('register') }}">📝 S'inscrire</a>
                @endauth
            </div>
            <div class="col-md-10">
                <div class="main-content">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Erreurs:</strong>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if (session('warning'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{ session('warning') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Modal global pour paiement simulé -->
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="paymentModalLabel">Paiement de pénalité</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
          </div>
          <div class="modal-body">
            <p id="paymentModalAmount" class="h5 text-danger"></p>
            <p class="text-muted">Ceci est un paiement simulé. Aucune transaction réelle ne sera effectuée.</p>
            <div id="paymentFields" style="display:none;">
                <div class="mb-3">
                    <label class="form-label">Numéro de carte</label>
                    <input type="text" class="form-control" id="fakeCardNumber" placeholder="4242 4242 4242 4242">
                </div>
                <div class="row">
                    <div class="col-6 mb-3">
                        <label class="form-label">MM/AA</label>
                        <input type="text" class="form-control" id="fakeExpiry" placeholder="12/34">
                    </div>
                    <div class="col-6 mb-3">
                        <label class="form-label">CVC</label>
                        <input type="text" class="form-control" id="fakeCvc" placeholder="123">
                    </div>
                </div>
            </div>
            <div id="paymentModalAlert" class="alert d-none" role="alert"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            <button type="button" id="confirmPaymentBtn" class="btn btn-primary">Payer</button>
          </div>
        </div>
      </div>
    </div>

    <script>
        (function(){
            let currentForm = null;
            const paymentModalEl = document.getElementById('paymentModal');
            const paymentModal = new bootstrap.Modal(paymentModalEl);
            const amountEl = document.getElementById('paymentModalAmount');
            const paymentFields = document.getElementById('paymentFields');
            const alertEl = document.getElementById('paymentModalAlert');
            document.addEventListener('submit', function(e){
                const form = e.target;
                if (form.classList && form.classList.contains('simulate-payment-form')) {
                    e.preventDefault();
                    currentForm = form;
                    const amount = form.dataset.amount || '';
                    amountEl.textContent = amount ? 'Montant à payer: ' + amount + ' €' : '';
                    paymentFields.style.display = '';
                    alertEl.classList.add('d-none');
                    paymentModal.show();
                }
            });

            document.getElementById('confirmPaymentBtn').addEventListener('click', function(){
                if (!currentForm) return;
                // simulation: simple client-side validation
                const card = document.getElementById('fakeCardNumber').value.trim();
                const cvc = document.getElementById('fakeCvc').value.trim();
                if (card.length < 12 || cvc.length < 3) {
                    alertEl.classList.remove('d-none');
                    alertEl.classList.remove('alert-success');
                    alertEl.classList.add('alert-danger');
                    alertEl.textContent = 'Informations de carte invalides (simulation)';
                    return;
                }

                // disable button to prevent double submit
                this.disabled = true;
                this.textContent = 'Paiement en cours...';
                // slight delay to simulate processing
                setTimeout(() => {
                    // submit the original form
                    currentForm.submit();
                }, 900);
            });
        })();
    </script>
        <!-- Modal global de confirmation pour actions critiques -->
        <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmModalLabel">Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        <p id="confirmModalMessage" class="mb-0"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="button" id="confirmModalBtn" class="btn btn-danger">Confirmer</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
                (function(){
                        const confirmModalEl = document.getElementById('confirmModal');
                        const confirmModal = new bootstrap.Modal(confirmModalEl);
                        const confirmMsg = document.getElementById('confirmModalMessage');
                        const confirmBtn = document.getElementById('confirmModalBtn');
                        let formToSubmit = null;

                        document.addEventListener('click', function(e){
                                const target = e.target.closest && e.target.closest('.needs-confirm');
                                if (target) {
                                        e.preventDefault();
                                        // find the form element
                                        let form = target.tagName === 'FORM' ? target : target.closest('form');
                                        if (!form) return;
                                        formToSubmit = form;
                                        const message = form.dataset.confirmMessage || 'Êtes-vous sûr?';
                                        confirmMsg.textContent = message;
                                        confirmModal.show();
                                }
                        });

                        confirmBtn.addEventListener('click', function(){
                                if (!formToSubmit) return;
                                confirmBtn.disabled = true;
                                formToSubmit.submit();
                        });
                })();
        </script>
</body>
</html>
