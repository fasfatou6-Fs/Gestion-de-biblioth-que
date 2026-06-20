<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Livre extends Model
{
    use HasFactory;

    protected $table = 'livres';

    protected $fillable = [
        'titre',
        'auteur',
        'isbn',
        'categorie',
        'nbExemplaires',
        'stockDisponible',
    ];

    protected $dates = ['deleted_at'];

    /**
     * Get the emprunts for this book.
     */
    public function emprunts(): HasMany
    {
        return $this->hasMany(Emprunt::class, 'livre_id');
    }

    /**
     * Ajouter un livre
     */
    public function ajouterLivre()
    {
        return $this;
    }

    /**
     * Modifier les infos du livre
     */
    public function modifierInfos($data)
    {
        return $this->update($data);
    }

    /**
     * Supprimer le livre (soft delete)
     */
    public function supprimerLogique()
    {
        return $this->delete();
    }
}
