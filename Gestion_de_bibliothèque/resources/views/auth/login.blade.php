@extends('layouts.app')

@section('title', 'Connexion')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card border-0 overflow-hidden">
            <div class="card-header text-white text-center py-5" style="background: linear-gradient(135deg, #fb7185 0%, #c026d3 100%);">
                <h5 class="mb-1">Connexion</h5>
                <p class="mb-0 text-white-75">Accède à ton espace bibliothèque en quelques secondes.</p>
            </div>
            <div class="card-body p-5" style="background: #fff5fb;">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="form-label text-dark">Adresse email</label>
                        <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label text-dark">Mot de passe</label>
                        <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Se souvenir de moi</label>
                    </div>

                    <div class="d-grid gap-3">
                        <button type="submit" class="btn btn-primary btn-lg">Se connecter</button>
                        <a href="{{ route('register') }}" class="btn btn-outline-secondary btn-lg">Créer un compte</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
