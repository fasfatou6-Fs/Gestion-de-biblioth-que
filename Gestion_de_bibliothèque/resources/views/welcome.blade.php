<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Gestion de biblioth�que</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            color-scheme: dark;
            color: #1f0433;
            background: #14021d;
            font-family: 'Inter', sans-serif;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            background: radial-gradient(circle at top left, rgba(236, 72, 153, .28), transparent 25%),
                        radial-gradient(circle at bottom right, rgba(168, 85, 247, .20), transparent 22%),
                        linear-gradient(180deg, #1b052f 0%, #290a4c 100%);
            color: #f8f4ff;
        }
        a { text-decoration: none; }
        .page {
            max-width: 1180px;
            margin: 0 auto;
            padding: 40px 24px 80px;
        }
        .hero {
            display: grid;
            gap: 32px;
            align-items: center;
            grid-template-columns: 1.1fr 0.9fr;
        }
        .hero-header {
            padding: 42px 42px 42px 36px;
            background: rgba(255,255,255,.06);
            border: 1px solid rgba(255,255,255,.12);
            border-radius: 32px;
            box-shadow: 0 32px 70px rgba(37, 11, 55, .24);
            backdrop-filter: blur(18px);
        }
        .hero-header span {
            display: inline-block;
            font-size: 0.85rem;
            letter-spacing: .35em;
            text-transform: uppercase;
            color: #f9d5ff;
            margin-bottom: 18px;
        }
        .hero-header h1 {
            margin: 0;
            font-size: clamp(3rem, 4vw, 4.5rem);
            line-height: 1.02;
            letter-spacing: -0.05em;
        }
        .hero-header p {
            margin: 24px 0 0;
            max-width: 680px;
            font-size: 1.05rem;
            line-height: 1.75;
            color: rgba(248, 244, 255, .85);
        }
        .hero-buttons {
            margin-top: 32px;
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
        }
        .btn-primary, .btn-secondary {
            border: none;
            border-radius: 999px;
            padding: 16px 32px;
            font-weight: 600;
            cursor: pointer;
            transition: transform .25s ease, opacity .25s ease, box-shadow .25s ease;
        }
        .btn-primary {
            background: #f472b6;
            color: #210031;
            box-shadow: 0 18px 40px rgba(244, 114, 182, .28);
        }
        .btn-primary:hover { transform: translateY(-2px); }
        .btn-secondary {
            background: rgba(255,255,255,.08);
            color: #f8f4ff;
            border: 1px solid rgba(255,255,255,.14);
        }
        .btn-secondary:hover { opacity: .92; }
        .hero-features {
            padding: 28px;
            border-radius: 32px;
            background: rgba(255,255,255,.04);
            border: 1px solid rgba(255,255,255,.1);
            display: grid;
            gap: 18px;
        }
        .feature-card {
            padding: 20px 24px;
            border-radius: 26px;
            background: rgba(255,255,255,.06);
            border: 1px solid rgba(255,255,255,.08);
        }
        .feature-card h3 {
            margin: 0 0 10px;
            font-size: 1.1rem;
            color: #ffe5fb;
        }
        .feature-card p {
            margin: 0;
            line-height: 1.7;
            color: rgba(248, 244, 255, .78);
        }
        .section {
            margin-top: 60px;
            display: grid;
            gap: 24px;
        }
        .section-grid {
            display: grid;
            gap: 24px;
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
        .card {
            background: rgba(255,255,255,.06);
            border: 1px solid rgba(255,255,255,.12);
            border-radius: 28px;
            padding: 28px;
            box-shadow: 0 20px 60px rgba(23, 6, 51, .12);
        }
        .card h4 {
            margin: 0 0 12px;
            color: #ffe4fe;
        }
        .card p {
            margin: 0;
            color: rgba(248, 244, 255, .82);
            line-height: 1.75;
        }
        .small-text {
            font-size: .95rem;
            color: rgba(255,255,255,.7);
        }
        @media (max-width: 980px) {
            .hero { grid-template-columns: 1fr; }
            .section-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="page">
        <main class="hero">
            <section class="hero-header">
                <span>Présentation</span>

                <p>Cette page pr"sente la solution de gestion de bibliothèque. Cree des comptes, administre les livres, suis les emprunts, et gère les pénalités avec une interface douce et professionnelle.</p>
                <div class="hero-buttons">
                    <a href="{{ route('login') }}" class="btn-primary">Se connecter</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-secondary">Créer un compte</a>
                    @endif
                </div>
            </section>
            <aside class="hero-features">
                <div class="feature-card">
                    <h3>Bibliothèque présente</h3>
                    <p>Une présentation claire de lqapplication, idéqle pour démontrer le projet TP DevOps.</p>
                </div>
                <div class="feature-card">
                    <h3>Roles distincts</h3>
                    <p>Deux profils sont supportes: admin pour la gestion complte, utilisateur pour lqaccès restreint.</p>
                </div>
                <div class="feature-card">
                    <h3>Design feminin</h3>
                    <p>Une ambiance rose violet, lumineuse et moderne, inspirée dùun style féminin.</p>
                </div>
            </aside>
        </main>

        <section class="section">
            <div class="card">
                <h4>Pourquoi cette page ?</h4>
                <p>La page d'accueil est une vitrine de l'application. Elle doit montrer les fonctions principales sans afficher de menu ou de navigation interne. C'est un point d'entr2e clair pour les visiteurs et les juges du projet.</p>
            </div>
        </section>

        <section class="section section-grid">
            <div class="card">
                <h4>?? Role Admin</h4>
                <p>Le compte admin peut gerer les livres, les emprunts, les penalites et consulter les logs d'activit�. C�est le role le plus complet du systeme.</p>
            </div>
            <div class="card">
                <h4>? Role Utilisateur</h4>
                <p>Le compte utilisateur peut se connecter, acceder a son tableau de bord et consulter son espace sans acceder aux pages de gestion protegees.</p>
            </div>
            <div class="card">
                <h4>?? Points forts</h4>
                <p>Une interface soignee, une logique claire et un parcours utilisateur simple pour un usage pedagogique et professionnel.</p>
            </div>
        </section>
    </div>
</body>
</html>
