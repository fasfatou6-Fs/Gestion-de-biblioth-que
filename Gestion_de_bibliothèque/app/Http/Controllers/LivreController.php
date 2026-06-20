<?php

namespace App\Http\Controllers;

use App\Models\Livre;
use App\Models\Log;
use Illuminate\Http\Request;

class LivreController extends Controller
{
    public function index()
    {
        $livres = Livre::paginate(10);
        Log::enregistrerAction('Consultation de la liste des livres');
        return view('livres.index', compact('livres'));
    }

    public function create()
    {
        return view('livres.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'auteur' => 'required|string|max:255',
            'isbn' => 'required|string|unique:livres,isbn',
            'categorie' => 'required|string|max:255',
            'nbExemplaires' => 'required|integer|min:1',
        ]);

        $livre = Livre::create([
            ...$validated,
            'stockDisponible' => $validated['nbExemplaires'],
        ]);

        Log::enregistrerAction("Création du livre: {$livre->titre}");
        return redirect()->route('livres.index')->with('success', 'Livre créé avec succès');
    }

    public function show(Livre $livre)
    {
        return view('livres.show', compact('livre'));
    }

    public function edit(Livre $livre)
    {
        return view('livres.edit', compact('livre'));
    }

    public function update(Request $request, Livre $livre)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'auteur' => 'required|string|max:255',
            'categorie' => 'required|string|max:255',
            'nbExemplaires' => 'required|integer|min:1',
        ]);

        $livre->update($validated);
        Log::enregistrerAction("Modification du livre: {$livre->titre}");
        return redirect()->route('livres.show', $livre)->with('success', 'Livre modifié avec succès');
    }

    public function destroy(Livre $livre)
    {
        $titre = $livre->titre;
        $livre->delete();
        Log::enregistrerAction("Suppression du livre: {$titre}");
        return redirect()->route('livres.index')->with('success', 'Livre supprimé avec succès');
    }
}
