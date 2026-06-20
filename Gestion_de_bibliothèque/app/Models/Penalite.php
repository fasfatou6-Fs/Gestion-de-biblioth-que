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

    protected $casts = [
        'dateCreation' => 'datetime',
    ];

    public function emprunt(): BelongsTo
    {
        return $this->belongsTo(Emprunt::class);
    }

    public function calculerPenalite()
    {
        $nbJoursRetard = $this->nbJoursRetard;
        $this->montant = $nbJoursRetard * 2;
        $this->save();
        return $this;
    }

    public function payerPenalite()
    {
        $this->update(['statusPaiement' => 'payé']);
        return $this;
    }
}
