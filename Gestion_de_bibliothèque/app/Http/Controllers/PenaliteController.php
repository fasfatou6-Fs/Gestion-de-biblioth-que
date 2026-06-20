<?php

namespace App\Http\Controllers;

use App\Models\Penalite;
use App\Models\Log;
use Illuminate\Http\Request;

class PenaliteController extends Controller
{
    public function index()
    {
        $penalites = Penalite::with(['emprunt.user', 'emprunt.livre'])->paginate(10);
        Log::enregistrerAction('Consultation de la liste des pénalités');
        return view('penalites.index', compact('penalites'));
    }

    public function nonPayees()
    {
        $penalites = Penalite::where('statusPaiement', 'non_payé')
            ->with(['emprunt.user', 'emprunt.livre'])
            ->paginate(10);
        Log::enregistrerAction('Consultation de la liste des pénalités non payées');
        return view('penalites.non_payees', compact('penalites'));
    }

    public function show(Penalite $penalite)
    {
        return view('penalites.show', compact('penalite'));
    }

    public function payer(Penalite $penalite)
    {
        // Autorisation: l'utilisateur propriétaire de l'emprunt ou un admin peut payer
        $proprietaireId = $penalite->emprunt->user_id;
        if (! auth()->user()->estAdmin() && auth()->id() !== $proprietaireId) {
            abort(403);
        }

        $penalite->payerPenalite();
        Log::enregistrerAction("Paiement de pénalité: {$penalite->montant}€");
        return redirect()->route('penalites.show', $penalite)->with('success', 'Pénalité marquée comme payée');
    }

    public function mesPenalites()
    {
        $penalites = Penalite::whereHas('emprunt', function ($q) {
            $q->where('user_id', auth()->id());
        })->with(['emprunt.livre'])->paginate(10);

        Log::enregistrerAction('Consultation des pénalités personnelles');
        return view('penalites.mes', compact('penalites'));
    }

    public function destroy(Penalite $penalite)
    {
        $montant = $penalite->montant;
        $penalite->delete();
        Log::enregistrerAction("Suppression d'une pénalité: {$montant}€");
        return redirect()->route('penalites.index')->with('success', 'Pénalité supprimée');
    }
}
