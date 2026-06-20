<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penalite extends Model
{
    use HasFactory;

    protected $table = 'penalites';

    protected $fillable = [
        'emprunt_id',
        'montant',
        'nbJoursRetard',
        'dateCreation',
        'statusPaiement',
    ];

    protected $dates = ['dateCreation'];

    /**
     * Get the loan associated with this penalty.
     */
    public function emprunt(): BelongsTo
    {
        return $this->belongsTo(Emprunt::class);
    }

    /**
     * Calculer la pénalité
     */
    public function calculerPenalite()
    {
        $nbJoursRetard = $this->nbJoursRetard;
        $this->montant = $nbJoursRetard * 2; // 2€ par jour de retard
        $this->save();
        
        return $this;
    }

    /**
     * Marquer comme payée
     */
    public function payerPenalite()
    {
        $this->update(['statusPaiement' => 'payé']);
        return $this;
    }
}
