<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Livre;

class LivrePolicy
{
    /**
     * Déterminer si l'utilisateur peut créer un livre
     */
    public function create(User $user): bool
    {
        // Seuls les admins peuvent créer
        return $user->role === 'admin';
    }

    /**
     * Déterminer si l'utilisateur peut voir un livre
     */
    public function view(User $user, Livre $livre): bool
    {
        // Admins et lecteurs peuvent voir
        return in_array($user->role, ['admin', 'lecteur']);
    }
}
