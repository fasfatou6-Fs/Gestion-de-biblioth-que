<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('emprunts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('livre_id')->constrained('livres')->onDelete('cascade');
            $table->date('dateEmprunt');
            $table->date('dateLimiteRetour');
            $table->date('dateRetour')->nullable();
            $table->string('status')->default('en_cours');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('emprunts');
    }
};
