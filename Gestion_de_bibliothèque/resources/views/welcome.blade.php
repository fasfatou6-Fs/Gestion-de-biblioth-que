<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion de Bibliothèque</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-slate-50 font-sans">
    <div class="min-h-screen flex flex-col justify-center items-center relative overflow-hidden">
        
        <!-- Background decoration -->
        <div class="absolute inset-0 z-0">
            <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-br from-pink-50 via-white to-purple-50 opacity-90"></div>
            <div class="absolute -top-32 -right-32 w-96 h-96 bg-purple-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse"></div>
            <div class="absolute top-32 -left-32 w-96 h-96 bg-pink-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse" style="animation-delay: 2s;"></div>
        </div>

        <!-- Content -->
        <div class="z-10 text-center px-4 sm:px-6 max-w-4xl w-full">
            <div class="mb-8 inline-flex items-center justify-center p-4 bg-pink-100 rounded-full shadow-inner">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>
            
            <h1 class="text-5xl sm:text-6xl md:text-7xl font-extrabold tracking-tight text-slate-800 mb-6 drop-shadow-sm">
                Gestion de <span class="text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-purple-400">Bibliothèque</span>
            </h1>
            
            <p class="text-lg sm:text-xl text-slate-600 mb-10 max-w-2xl mx-auto font-medium leading-relaxed">
                Votre plateforme moderne et intuitive pour la gestion complète de votre catalogue de livres, emprunts et traçabilité.
            </p>
            
            <div class="flex flex-col sm:flex-row justify-center items-center gap-4 sm:gap-6 mt-8">
                @auth
                    <a href="{{ route('livres.index') }}" class="px-8 py-4 bg-gradient-to-r from-pink-500 to-purple-400 hover:from-pink-600 hover:to-purple-500 text-white text-lg font-bold rounded-full shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1 w-full sm:w-auto flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        Accéder au Catalogue
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-8 py-4 bg-gradient-to-r from-pink-500 to-purple-400 hover:from-pink-600 hover:to-purple-500 text-white text-lg font-bold rounded-full shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1 w-full sm:w-auto text-center">
                        Se connecter
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-8 py-4 bg-white text-purple-600 border border-purple-200 hover:border-purple-300 hover:bg-purple-50 text-lg font-bold rounded-full shadow-sm hover:shadow transition-all w-full sm:w-auto text-center">
                            Créer un compte
                        </a>
                    @endif
                @endauth
            </div>
        </div>

        <!-- Footer -->
        <div class="absolute bottom-6 w-full text-center z-10 px-4">
            <p class="text-sm text-slate-500 font-medium">
                &copy; {{ date('Y') }} Gestion de Bibliothèque. Tous droits réservés.
            </p>
        </div>
    </div>
</body>
</html>
