<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LivresDemoSeeder extends Seeder
{
    /**
     * Ajoute des livres de démonstration pour que le catalogue ne soit pas vide.
     * Adapte les noms de colonnes si ta table `livres` est différente.
     */
    public function run(): void
    {
        $livres = [
            ['titre' => 'Le Petit Prince', 'auteur' => 'Antoine de Saint-Exupéry', 'isbn' => '9782070612758', 'categorie' => 'Roman', 'annee_edition' => 1943, 'nb_exemplaires' => 5, 'stock_disponible' => 5],
            ['titre' => '1984', 'auteur' => 'George Orwell', 'isbn' => '9782070368228', 'categorie' => 'Science-fiction', 'annee_edition' => 1949, 'nb_exemplaires' => 4, 'stock_disponible' => 3],
            ['titre' => 'Une si longue lettre', 'auteur' => 'Mariama Bâ', 'isbn' => '9782070383627', 'categorie' => 'Roman', 'annee_edition' => 1979, 'nb_exemplaires' => 3, 'stock_disponible' => 3],
            ['titre' => 'L\'Étranger', 'auteur' => 'Albert Camus', 'isbn' => '9782070360024', 'categorie' => 'Philosophie', 'annee_edition' => 1942, 'nb_exemplaires' => 6, 'stock_disponible' => 4],
            ['titre' => 'Sapiens', 'auteur' => 'Yuval Noah Harari', 'isbn' => '9782226257017', 'categorie' => 'Histoire', 'annee_edition' => 2015, 'nb_exemplaires' => 3, 'stock_disponible' => 2],
            ['titre' => 'Le Vieux Nègre et la médaille', 'auteur' => 'Ferdinand Oyono', 'isbn' => '9782266118123', 'categorie' => 'Roman', 'annee_edition' => 1956, 'nb_exemplaires' => 2, 'stock_disponible' => 2],
            ['titre' => 'Clean Code', 'auteur' => 'Robert C. Martin', 'isbn' => '9780132350884', 'categorie' => 'Informatique', 'annee_edition' => 2008, 'nb_exemplaires' => 4, 'stock_disponible' => 1],
            ['titre' => 'Les Soleils des indépendances', 'auteur' => 'Ahmadou Kourouma', 'isbn' => '9782020005804', 'categorie' => 'Roman', 'annee_edition' => 1968, 'nb_exemplaires' => 3, 'stock_disponible' => 3],
            ['titre' => 'Une brève histoire du temps', 'auteur' => 'Stephen Hawking', 'isbn' => '9782081336816', 'categorie' => 'Science', 'annee_edition' => 1988, 'nb_exemplaires' => 2, 'stock_disponible' => 0],
            ['titre' => 'Harry Potter à l\'école des sorciers', 'auteur' => 'J.K. Rowling', 'isbn' => '9782070518379', 'categorie' => 'Jeunesse', 'annee_edition' => 1997, 'nb_exemplaires' => 5, 'stock_disponible' => 5],
        ];

        foreach ($livres as $livre) {
            DB::table('livres')->insertOrIgnore(array_merge($livre, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
