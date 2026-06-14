<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livre extends Model
{
    use HasFactory;

    protected $fillable = ['titre', 'auteur', 'annee', 'description'];

    public function emprunts()
    {
        return $this->hasMany(Emprunt::class);
    }
}
