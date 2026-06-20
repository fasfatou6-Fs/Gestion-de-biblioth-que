<?php

namespace App\Http\Controllers;

use App\Models\Penalite;
use App\Models\Log;
use Illuminate\Http\Request;

class PenaliteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penalites = Penalite::with(['emprunt.user', 'emprunt.livre'])->paginate(10);
        Log::enregistrerAction('Consultation de la liste des pénalités');
        
        return view('penalites.index', compact('penalites'));
    }

    /**
     * Display penalties not paid
     */
    public function nonPayees()
    {
        $penalites = Penalite::where('statusPaiement', 'non_payé')
            ->with(['emprunt.user', 'emprunt.livre'])
            ->paginate(10);
            
        Log::enregistrerAction('Consultation de la liste des pénalités non payées');

        return view('penalites.non_payees', compact('penalites'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Penalite $penalite)
    {
        return view('penalites.show', compact('penalite'));
    }

    /**
     * Mark penalty as paid
     */
    public function payer(Penalite $penalite)
    {
        $penalite->payerPenalite();
        
        Log::enregistrerAction("Paiement de pénalité: {$penalite->montant}€");

        return redirect()->route('penalites.show', $penalite)->with('success', 'Pénalité marquée comme payée');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penalite $penalite)
    {
        $montant = $penalite->montant;
        $penalite->delete();
        
        Log::enregistrerAction("Suppression d'une pénalité: {$montant}€");

        return redirect()->route('penalites.index')->with('success', 'Pénalité supprimée');
    }
}
