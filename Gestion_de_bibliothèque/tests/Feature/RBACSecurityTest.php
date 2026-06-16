<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RBACSecurityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function un_lecteur_ne_peut_pas_acceder_a_la_page_creation_livre()
    {
        $lecteur = User::factory()->create(['role' => 'lecteur']);
        $response = $this->actingAs($lecteur)->get('/livres/create');
        $response->assertStatus(403);
    }

    /** @test */
    public function un_admin_peut_acceder_a_la_page_creation_livre()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $response = $this->actingAs($admin)->get('/livres/create');
        $response->assertStatus(200);
    }

    /** @test */
    public function isbn_invalide_est_rejete()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $response = $this->actingAs($admin)->post('/livres', [
            'titre' => 'Test Livre',
            'auteur' => 'Auteur',
            'isbn' => '123', // trop court
            'exemplaires' => 5,
        ]);
        $response->assertSessionHasErrors(['isbn']);
    }

    /** @test */
    public function exemplaires_negatifs_sont_rejetes()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $response = $this->actingAs($admin)->post('/livres', [
            'titre' => 'Test Livre',
            'auteur' => 'Auteur',
            'isbn' => '1234567890123',
            'exemplaires' => -2,
        ]);
        $response->assertSessionHasErrors(['exemplaires']);
    }
}
