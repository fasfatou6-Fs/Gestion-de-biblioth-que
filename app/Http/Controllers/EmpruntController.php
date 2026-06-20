<?php

namespace App\Http\Controllers;

use App\Models\Emprunt;
use App\Models\Livre;
use App\Models\User;
use App\Models\Log;
use Illuminate\Http\Request;

class EmpruntController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $emprunts = Emprunt::with(['user', 'livre'])->paginate(10);
        Log::enregistrerAction('Consultation de la liste des emprunts');
        
        return view('emprunts.index', compact('emprunts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('role', 'user')->get();
        $livres = Livre::where('stockDisponible', '>', 0)->get();
        
        return view('emprunts.create', compact('users', 'livres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'livre_id' => 'required|exists:livres,id',
            'dateLimiteRetour' => 'required|date|after:today',
        ]);

        $livre = Livre::find($validated['livre_id']);
        
        if ($livre->stockDisponible <= 0) {
            return back()->with('error', 'Stock insuffisant');
        }

        $emprunt = Emprunt::create([
            ...$validated,
            'dateEmprunt' => now(),
            'status' => 'en_cours',
        ]);

        $emprunt->enregistrerSortie();

        Log::enregistrerAction("Enregistrement d'un nouvel emprunt: {$livre->titre}");

        return redirect()->route('emprunts.index')->with('success', 'Emprunt enregistré avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Emprunt $emprunt)
    {
        return view('emprunts.show', compact('emprunt'));
    }

    /**
     * Mark the loan as returned
     */
    public function marquerRetour(Emprunt $emprunt)
    {
        if ($emprunt->status === 'retourné') {
            return back()->with('warning', 'Cet emprunt a déjà été retourné');
        }

        $emprunt->marquerRetour();
        
        Log::enregistrerAction("Retour de livre: {$emprunt->livre->titre}");

        return redirect()->route('emprunts.show', $emprunt)->with('success', 'Retour enregistré avec succès');
    }

    /**
     * Show penalties for this loan
     */
    public function penalites(Emprunt $emprunt)
    {
        $penalites = $emprunt->penalites;
        
        return view('emprunts.penalites', compact('emprunt', 'penalites'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Emprunt $emprunt)
    {
        $titre = $emprunt->livre->titre;
        $emprunt->delete();
        
        Log::enregistrerAction("Suppression d'un emprunt: {$titre}");

        return redirect()->route('emprunts.index')->with('success', 'Emprunt supprimé');
    }

    /**
     * Show loans in late status
     */
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
