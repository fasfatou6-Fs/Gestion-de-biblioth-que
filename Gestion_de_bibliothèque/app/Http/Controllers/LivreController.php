<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livre;

class LivreController extends Controller
{
    /**
     * Affiche le formulaire de création de livre
     */
    public function create()
    {
        // Retourne la vue Blade "resources/views/livres/create.blade.php"
        return view('livres.create');
    }

    /**
     * Enregistre un nouveau livre avec validation
     */
    public function store(Request $request)
    {
        // Validation des champs
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'auteur' => 'required|string|max:255',
            'isbn' => 'required|string|size:13',
            'exemplaires' => 'required|integer|min:1',
        ]);

        // Création du livre
        Livre::create($validated);

        // Redirection avec message de succès
        return redirect()->back()->with('success', 'Livre ajouté avec succès');
    }
}
