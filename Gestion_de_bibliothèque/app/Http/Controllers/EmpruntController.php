<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Livre;

class EmpruntController extends Controller
{
    /**
     * Enregistre un nouvel emprunt
     */
    public function store(Request $request)
    {
        $user = $request->user();
        $livre = Livre::findOrFail($request->livre_id);

        // Vérification du statut utilisateur
        if ($user->status === 'suspendu') {
            return response()->json(['error' => 'Compte suspendu'], 403);
        }

        // Vérification du stock
        if ($livre->exemplaires <= 0) {
            return response()->json(['error' => 'Stock épuisé'], 403);
        }

        // Décrémenter le stock
        $livre->decrement('exemplaires');

        // Ici tu pourrais créer un modèle Emprunt si besoin
        // Emprunt::create([...]);

        return response()->json(['success' => 'Emprunt enregistré'], 200);
    }
}
