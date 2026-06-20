<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $allowedRoles = array_map('trim', explode('|', $roles));

        if (!in_array(Auth::user()->role, $allowedRoles, true)) {
            abort(403, 'Accès refusé : rôle insuffisant.');
        }

        return $next($request);
    }
}
