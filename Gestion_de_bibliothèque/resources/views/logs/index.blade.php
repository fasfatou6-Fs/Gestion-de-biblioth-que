@extends('layouts.app')

@section('title', 'Logs d\'activité')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>📋 Logs d'activité</h2>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Utilisateur</th>
                        <th>Action</th>
                        <th>Date et heure</th>
                        <th>Adresse IP</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                        <tr>
                            <td>
                                @if($log->user)
                                    <strong>{{ $log->user->nom }}</strong>
                                @else
                                    <span class="text-muted">Système</span>
                                @endif
                            </td>
                            <td>{{ $log->action }}</td>
                            <td>{{ $log->dateAction->format('d/m/Y H:i:s') }}</td>
                            <td><code>{{ $log->adresseIP }}</code></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Aucun log enregistré</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $logs->links() }}
        </div>
    </div>
</div>
@endsection
