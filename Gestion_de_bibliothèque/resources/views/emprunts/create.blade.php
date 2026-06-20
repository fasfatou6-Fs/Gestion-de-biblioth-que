@extends('layouts.app')

@section('title', 'Nouvel emprunt')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">➕ Enregistrer un nouvel emprunt</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('emprunts.store') }}" method="POST">
                    @csrf
                    @if($users)
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Utilisateur <span class="text-danger">*</span></label>
                        <select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
                            <option value="">-- Sélectionner un utilisateur --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" @if(old('user_id') == $user->id) selected @endif>{{ $user->nom }}</option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    @endif

                    <div class="mb-3">
                        <label for="livre_id" class="form-label">Livre <span class="text-danger">*</span></label>
                        @php $selectedLivre = old('livre_id', request()->get('livre_id')) ?? '' ; @endphp
                        <select class="form-select @error('livre_id') is-invalid @enderror" id="livre_id" name="livre_id" required @if($selectedLivre) autofocus @endif>
                            <option value="">-- Sélectionner un livre --</option>
                            @foreach($livres as $livre)
                                <option value="{{ $livre->id }}" @if($selectedLivre == $livre->id) selected @endif>
                                    {{ $livre->titre }} ({{ $livre->stockDisponible }} disponible(s))
                                </option>
                            @endforeach
                        </select>
                        @error('livre_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="dateLimiteRetour" class="form-label">Date limite de retour <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('dateLimiteRetour') is-invalid @enderror" id="dateLimiteRetour" name="dateLimiteRetour" value="{{ old('dateLimiteRetour') }}" required>
                        @error('dateLimiteRetour')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('emprunts.index') }}" class="btn btn-secondary">❌ Annuler</a>
                        <button type="submit" class="btn btn-primary">✅ Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
