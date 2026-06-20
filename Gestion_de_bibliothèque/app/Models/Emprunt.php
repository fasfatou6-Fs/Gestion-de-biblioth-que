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

    protected $casts = [
        'dateEmprunt' => 'datetime',
        'dateLimiteRetour' => 'datetime',
        'dateRetour' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function livre(): BelongsTo
    {
        return $this->belongsTo(Livre::class);
    }

    public function penalites(): HasMany
    {
        return $this->hasMany(Penalite::class);
    }

    public function enregistrerSortie()
    {
        $this->update(['status' => 'en_cours']);
        $this->livre->decrement('stockDisponible');
        return $this;
    }

    public function marquerRetour()
    {
        $this->update([
            'dateRetour' => now(),
            'status' => 'retourné'
        ]);

        $this->livre->increment('stockDisponible');

        if ($this->dateRetour > $this->dateLimiteRetour) {
            $this->calculerPenalite();
        }

        return $this;
    }

    public function estEnRetard(): bool
    {
        return $this->status === 'en_cours' && now() > $this->dateLimiteRetour;
    }

    public function calculerPenalite()
    {
        if ($this->status !== 'retourné') {
            return;
        }

        $dateRetour = $this->dateRetour instanceof Carbon ? $this->dateRetour : Carbon::parse($this->dateRetour);
        $dateLimite = $this->dateLimiteRetour instanceof Carbon ? $this->dateLimiteRetour : Carbon::parse($this->dateLimiteRetour);

        $nbJoursRetard = max(0, $dateRetour->diffInDays($dateLimite));

        if ($nbJoursRetard > 0) {
            $montant = $nbJoursRetard * 2;

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
}
