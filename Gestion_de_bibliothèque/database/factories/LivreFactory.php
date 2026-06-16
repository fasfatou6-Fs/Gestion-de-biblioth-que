<?php

namespace Database\Factories;

use App\Models\Livre;
use Illuminate\Database\Eloquent\Factories\Factory;

class LivreFactory extends Factory
{
    protected $model = Livre::class;

    public function definition()
    {
        return [
            'titre' => $this->faker->sentence(3),
            'auteur' => $this->faker->name,
            'isbn' => $this->faker->numerify('#############'), // 13 chiffres
            'exemplaires' => $this->faker->numberBetween(0, 10),
        ];
    }
}
