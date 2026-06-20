<?php

namespace App\Http\Controllers;

use App\Models\Livre;
use App\Models\Emprunt;
use App\Models\Penalite;
use App\Models\User;
use App\Models\Log;

class DashboardController extends Controller
{
    public function index()
    {
        $totalLivres = Livre::count();

        if (auth()->user()->estAdmin()) {
            $totalEmprunts = Emprunt::count();
            $empruntEnCours = Emprunt::where('status', 'en_cours')->count();
            $empruntEnRetard = Emprunt::where('status', 'en_cours')
                ->where('dateLimiteRetour', '<', now())
                ->count();
            $penalitesNonPayees = Penalite::where('statusPaiement', 'non_payé')->sum('montant');
            $totalUtilisateurs = User::count();
            $dernierEmprunts = Emprunt::with(['user', 'livre'])->latest()->take(5)->get();
        } else {
            $totalEmprunts = Emprunt::where('user_id', auth()->id())->count();
            $empruntEnCours = Emprunt::where('user_id', auth()->id())->where('status', 'en_cours')->count();
            $empruntEnRetard = Emprunt::where('user_id', auth()->id())->where('status', 'en_cours')
                ->where('dateLimiteRetour', '<', now())
                ->count();
            $penalitesNonPayees = Penalite::whereHas('emprunt', function ($q) {
                $q->where('user_id', auth()->id());
            })->where('statusPaiement', 'non_payé')->sum('montant');
            $totalUtilisateurs = 1;
            $dernierEmprunts = Emprunt::with('livre')->where('user_id', auth()->id())->latest()->take(5)->get();
        }

        return view('dashboard', compact([
            'totalLivres',
            'totalEmprunts',
            'empruntEnCours',
            'empruntEnRetard',
            'penalitesNonPayees',
            'totalUtilisateurs',
            'dernierEmprunts'
        ]));
    }

    public function logs()
    {
        $logs = Log::with('user')->latest()->paginate(20);
        return view('logs.index', compact('logs'));
    }
}
