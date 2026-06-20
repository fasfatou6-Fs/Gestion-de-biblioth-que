<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Livre extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'livres';

    protected $fillable = [
        'titre',
        'auteur',
        'isbn',
        'categorie',
        'nbExemplaires',
        'stockDisponible',
    ];

    public function emprunts(): HasMany
    {
        return $this->hasMany(Emprunt::class);
    }
}
