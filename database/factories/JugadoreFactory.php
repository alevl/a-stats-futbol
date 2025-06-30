<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jugadore>
 */
class JugadoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->faker->locale('es_ES'); 

        return [
            'nombre' => $this->faker->name(),
            'dni' => $this->faker->numberBetween(10000000, 40000000),
            'numero' => $this->faker->numberBetween(1, 99),
            'equipo_id' => $this->faker->numberBetween(1, 5),
            'foto' => '',
            'Nacimiento' => 'Caracas, 01 de Enero de 2015',
            'batea' => 'Derecha',
            'lanza' => 'Derecha',
        ];
    }
}