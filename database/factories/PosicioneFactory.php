<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Posicione>
 */
class PosicioneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'categoria_id' => 1,
            'campeonato_id' => 1,
            'grupo_id' => '10',
            'equipo_id' => $this->faker->numberBetween(1, 5),
            'jugados' => $this->faker->numberBetween(1, 10),
            'ganados' => $this->faker->numberBetween(1, 10),
            'perdidos' => $this->faker->numberBetween(1, 10),
            'empatados' => $this->faker->numberBetween(1, 10),
            'porcentaje' => '0',
        ];
    }
}
