<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Livre;
use App\Models\Emprunt;
use App\Models\Penalite;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate([
            'email' => 'admin@example.com',
        ], [
            'nom' => 'Admin Test',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);

        $livre1 = Livre::firstOrCreate([
            'isbn' => '9782070612758',
        ], [
            'titre' => 'Le Petit Prince',
            'auteur' => 'Antoine de Saint-Exupéry',
            'categorie' => 'Classique',
            'nbExemplaires' => 5,
            'stockDisponible' => 5,
        ]);

        $livre2 = Livre::firstOrCreate([
            'isbn' => '9780451524935',
        ], [
            'titre' => '1984',
            'auteur' => 'George Orwell',
            'categorie' => 'Dystopie',
            'nbExemplaires' => 3,
            'stockDisponible' => 3,
        ]);

        $user = User::updateOrCreate([
            'email' => 'user@example.com',
        ], [
            'nom' => 'Utilisateur Demo',
            'password' => bcrypt('password123'),
            'role' => 'user',
        ]);

        $emprunt = Emprunt::create([
            'user_id' => $user->id,
            'livre_id' => $livre1->id,
            'dateEmprunt' => now()->subDays(10),
            'dateLimiteRetour' => now()->subDays(3),
            'status' => 'en_cours',
        ]);

        $livre1->decrement('stockDisponible');

        Penalite::create([
            'emprunt_id' => $emprunt->id,
            'montant' => 14.00,
            'nbJoursRetard' => 7,
            'dateCreation' => now(),
            'statusPaiement' => 'non_payé',
        ]);
    }
}
