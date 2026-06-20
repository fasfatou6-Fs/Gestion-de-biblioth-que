<?php

namespace App\Http\Controllers;

use App\Models\Emprunt;
use App\Models\Livre;
use App\Models\User;
use App\Models\Log;
use Illuminate\Http\Request;

class EmpruntController extends Controller
{
    public function index()
    {
        if (auth()->user()->estAdmin()) {
            $emprunts = Emprunt::with(['user', 'livre'])->paginate(10);
        } else {
            $emprunts = Emprunt::with('livre')->where('user_id', auth()->id())->paginate(10);
        }

        Log::enregistrerAction('Consultation de la liste des emprunts');
        return view('emprunts.index', compact('emprunts'));
    }

    public function create()
    {
        if (auth()->user()->estAdmin()) {
            $users = User::where('role', 'user')->get();
        } else {
            $users = null;
        }

        $livres = Livre::where('stockDisponible', '>', 0)->get();
        return view('emprunts.create', compact('users', 'livres'));
    }

    public function store(Request $request)
    {
        $rules = [
            'livre_id' => 'required|exists:livres,id',
            'dateLimiteRetour' => 'required|date|after:today',
        ];

        if (auth()->user()->estAdmin()) {
            $rules['user_id'] = 'required|exists:users,id';
        }

        $validated = $request->validate($rules);

        if (! auth()->user()->estAdmin()) {
            $validated['user_id'] = auth()->id();
        }

        $livre = Livre::find($validated['livre_id']);
        if ($livre->stockDisponible <= 0) {
            return back()->with('error', 'Stock insuffisant');
        }

        $emprunt = Emprunt::create([
            'user_id' => $validated['user_id'],
            'livre_id' => $validated['livre_id'],
            'dateEmprunt' => now(),
            'dateLimiteRetour' => $validated['dateLimiteRetour'],
            'status' => 'en_cours',
        ]);

        $emprunt->enregistrerSortie();
        Log::enregistrerAction("Enregistrement d'un nouvel emprunt: {$livre->titre}");
        return redirect()->route('emprunts.index')->with('success', 'Emprunt enregistré avec succès');
    }

    public function show(Emprunt $emprunt)
    {
        return view('emprunts.show', compact('emprunt'));
    }

    public function marquerRetour(Emprunt $emprunt)
    {
        if ($emprunt->status === 'retourné') {
            return back()->with('warning', 'Cet emprunt a déjà été retourné');
        }

        $emprunt->marquerRetour();
        Log::enregistrerAction("Retour de livre: {$emprunt->livre->titre}");
        return redirect()->route('emprunts.show', $emprunt)->with('success', 'Retour enregistré avec succès');
    }

    public function penalites(Emprunt $emprunt)
    {
        $penalites = $emprunt->penalites;
        return view('emprunts.penalites', compact('emprunt', 'penalites'));
    }

    public function destroy(Emprunt $emprunt)
    {
        $titre = $emprunt->livre->titre;
        $emprunt->delete();
        Log::enregistrerAction("Suppression d'un emprunt: {$titre}");
        return redirect()->route('emprunts.index')->with('success', 'Emprunt supprimé');
    }

    public function enRetard()
    {
        $emprunts = Emprunt::where('status', 'en_cours')
            ->where('dateLimiteRetour', '<', now())
            ->with(['user', 'livre'])
            ->paginate(10);
        Log::enregistrerAction('Consultation de la liste des emprunts en retard');
        return view('emprunts.en_retard', compact('emprunts'));
    }
}
