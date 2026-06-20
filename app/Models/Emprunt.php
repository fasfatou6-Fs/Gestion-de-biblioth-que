<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Emprunt extends Model
{
    use HasFactory;

    protected $table = 'emprunts';

    protected $fillable = [
        'user_id',
        'livre_id',
        'dateEmprunt',
        'dateLimiteRetour',
        'dateRetour',
        'status',
    ];

    protected $dates = ['dateEmprunt', 'dateLimiteRetour', 'dateRetour'];

    /**
     * Get the user who borrowed the book.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the book that was borrowed.
     */
    public function livre(): BelongsTo
    {
        return $this->belongsTo(Livre::class);
    }

    /**
     * Get the penalties for this loan.
     */
    public function penalites(): HasMany
    {
        return $this->hasMany(Penalite::class, 'emprunt_id');
    }

    /**
     * Enregistrer un nouvel emprunt
     */
    public function enregistrerSortie()
    {
        $this->update(['status' => 'en_cours']);
        
        // Mettre à jour le stock disponible
        $this->livre->decrement('stockDisponible');
        
        return $this;
    }

    /**
     * Marquer le retour de l'emprunt
     */
    public function marquerRetour()
    {
        $this->update([
            'dateRetour' => now(),
            'status' => 'retourné'
        ]);

        // Mettre à jour le stock disponible
        $this->livre->increment('stockDisponible');

        // Vérifier si retard et calculer pénalité
        if ($this->dateRetour > $this->dateLimiteRetour) {
            $this->calculerPenalite();
        }

        return $this;
    }

    /**
     * Vérifier si l'emprunt est en retard
     */
    public function estEnRetard(): bool
    {
        return $this->status === 'en_cours' && now() > $this->dateLimiteRetour;
    }

    /**
     * Calculer la pénalité
     */
    public function calculerPenalite()
    {
        if ($this->status !== 'retourné') {
            return;
        }

        $dateRetour = $this->dateRetour instanceof Carbon ? $this->dateRetour : Carbon::parse($this->dateRetour);
        $dateLimite = $this->dateLimiteRetour instanceof Carbon ? $this->dateLimiteRetour : Carbon::parse($this->dateLimiteRetour);
        
        $nbJoursRetard = max(0, $dateRetour->diffInDays($dateLimite));

        if ($nbJoursRetard > 0) {
            $montant = $nbJoursRetard * 2; // 2€ par jour de retard

            Penalite::updateOrCreate(
                ['emprunt_id' => $this->id],
                [
                    'montant' => $montant,
                    'nbJoursRetard' => $nbJoursRetard,
                    'dateCreation' => now(),
                    'statusPaiement' => 'non_payé'
                ]
            );
        }
    }

    /**
     * Vérifier si on peut en retarder
     */
    public function estEnRetard_(): bool
    {
        return $this->status === 'en_cours' && Carbon::now()->gt(Carbon::parse($this->dateLimiteRetour));
    }
}
