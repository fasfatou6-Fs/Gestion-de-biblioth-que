<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the emprunts for this user.
     */
    public function emprunts(): HasMany
    {
        return $this->hasMany(Emprunt::class, 'user_id');
    }

    /**
     * Get the logs for this user.
     */
    public function logs(): HasMany
    {
        return $this->hasMany(Log::class, 'user_id');
    }

    /**
     * Vérifier si l'utilisateur est un admin
     */
    public function estAdmin(): bool
    {
        return $this->role === 'admin' || $this->role === 'bibliothecaire';
    }

    /**
     * Vérifier si l'utilisateur est un utilisateur normal
     */
    public function estUtilisateur(): bool
    {
        return $this->role === 'user';
    }

    /**
     * Connecter et déconnecter un utilisateur
     */
    public function seConnecter()
    {
        Log::enregistrerAction("Connexion de l'utilisateur {$this->nom}");
        return $this;
    }

    /**
     * Déconnecter l'utilisateur
     */
    public function seDeconnecter()
    {
        Log::enregistrerAction("Déconnexion de l'utilisateur {$this->nom}");
        return $this;
    }
}
