<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Migration TEMPORAIRE créée par le Dev 3 pour pouvoir tester les vues
     * en attendant la migration officielle du Dev 1.
     * À supprimer/remplacer une fois que le Dev 1 aura poussé la sienne.
     */
    public function up(): void
    {
        Schema::create('livres', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('auteur');
            $table->string('isbn', 13)->unique();
            $table->string('categorie');
            $table->integer('annee_edition');
            $table->integer('nb_exemplaires');
            $table->integer('stock_disponible')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('livres');
    }
};