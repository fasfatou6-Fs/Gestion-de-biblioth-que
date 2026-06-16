<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Livre;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmpruntTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function un_utilisateur_ne_peut_pas_emprunter_si_stock_epuise()
    {
        $user = User::factory()->create(['role' => 'lecteur']);
        $livre = Livre::factory()->create(['exemplaires' => 0]);

        $response = $this->actingAs($user)->post('/emprunts', [
            'livre_id' => $livre->id,
        ]);

        $response->assertStatus(403);
    }

    /** @test */
    public function un_utilisateur_suspendu_ne_peut_pas_emprunter()
    {
        $user = User::factory()->create([
            'role' => 'lecteur',
            'status' => 'suspendu'
        ]);
        $livre = Livre::factory()->create(['exemplaires' => 5]);

        $response = $this->actingAs($user)->post('/emprunts', [
            'livre_id' => $livre->id,
        ]);

        $response->assertStatus(403);
    }

    /** @test */
    public function un_utilisateur_actif_peut_emprunter_si_stock_disponible()
    {
        $user = User::factory()->create(['role' => 'lecteur', 'status' => 'actif']);
        $livre = Livre::factory()->create(['exemplaires' => 3]);

        $response = $this->actingAs($user)->post('/emprunts', [
            'livre_id' => $livre->id,
        ]);

        $response->assertStatus(200);
    }
}
