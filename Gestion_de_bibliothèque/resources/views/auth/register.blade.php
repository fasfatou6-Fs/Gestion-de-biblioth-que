@extends('layouts.app')

@section('title', 'Inscription')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card border-0 overflow-hidden">
            <div class="card-header text-white text-center py-5" style="background: linear-gradient(135deg, #f472b6 0%, #ec4899 100%);">
                <h5 class="mb-1">Création de compte</h5>
                <p class="mb-0 text-white-75">Rejoins la bibliothèque et gère les emprunts facilement.</p>
            </div>
            <div class="card-body p-5" style="background: #fff5fb;">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="nom" class="form-label text-dark">Nom complet</label>
                        <input id="nom" type="text" class="form-control form-control-lg @error('nom') is-invalid @enderror" name="nom" value="{{ old('nom') }}" required autofocus>
                        @error('nom')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="form-label text-dark">Adresse email</label>
                        <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
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

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label text-dark">Confirmer le mot de passe</label>
                        <input id="password_confirmation" type="password" class="form-control form-control-lg" name="password_confirmation" required>
                    </div>

                    <div class="d-grid gap-3">
                        <button type="submit" class="btn btn-primary btn-lg">Créer mon compte</button>
                        <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-lg">J'ai déjà un compte</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
