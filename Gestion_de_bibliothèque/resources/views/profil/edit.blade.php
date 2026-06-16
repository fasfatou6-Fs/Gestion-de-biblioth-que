@extends('layouts.app')

@section('title', 'Mon profil')

@section('content')
<h2 class="page-title mb-4"><i class="bi bi-gear"></i> Mon profil</h2>

<div class="card" style="max-width: 600px;">
    <div class="card-body p-4">
        <form method="POST" action="{{ route('profil.update') }}">
            @csrf
            @method('PUT')

            <h6 class="mb-3" style="color: var(--plum); text-transform: uppercase; font-size: 0.78rem; letter-spacing: 0.5px;">
                <i class="bi bi-person"></i> Informations personnelles
            </h6>

            <div class="mb-3">
                <label for="name" class="form-label">Nom complet <span class="text-danger">*</span></label>
                <input type="text" name="name" id="name"
                       value="{{ old('name', $user->name) }}"
                       class="form-control @error('name') is-invalid @enderror">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Adresse email <span class="text-danger">*</span></label>
                <input type="email" name="email" id="email"
                       value="{{ old('email', $user->email) }}"
                       class="form-control @error('email') is-invalid @enderror">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <hr style="border-color: var(--line); margin: 24px 0;">

            <h6 class="mb-2" style="color: var(--plum); text-transform: uppercase; font-size: 0.78rem; letter-spacing: 0.5px;">
                <i class="bi bi-lock"></i> Changer le mot de passe
            </h6>
            <p class="text-muted small mb-3">Laissez vide si vous ne souhaitez pas changer votre mot de passe.</p>

            <div class="mb-3">
                <label for="password" class="form-label">Nouveau mot de passe</label>
                <input type="password" name="password" id="password"
                       class="form-control @error('password') is-invalid @enderror"
                       placeholder="Minimum 8 caractères">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                       class="form-control"
                       placeholder="Répétez le nouveau mot de passe">
            </div>

            <button type="submit" class="btn btn-primary mt-2">
                <i class="bi bi-save"></i> Mettre à jour
            </button>
        </form>
    </div>
</div>
@endsection
