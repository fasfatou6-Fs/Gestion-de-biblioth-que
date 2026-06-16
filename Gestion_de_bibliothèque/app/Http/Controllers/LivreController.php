<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Livre;

class LivreController extends Controller
{
    public function create()
    {
        return view('livres.create'); // tu peux créer une vue Blade simple pour tester
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'auteur' => 'required|string|max:255',
            'isbn' => 'required|string|size:13',
            'exemplaires' => 'required|integer|min:1',
        ]);

        Livre::create($validated);

        return redirect()->back()->with('success', 'Livre ajouté avec succès');
    }
}