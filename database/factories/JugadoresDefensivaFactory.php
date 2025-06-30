<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JugadoresDefensiva>
 */
class JugadoresDefensivaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fecha' => $this->faker->randomElement(['01/11/2024','07/11/2024','01/12/2024','15/12/2024']),
            'jugador_id' => $this->faker->numberBetween(1, 100),
            'oponente_id' => $this->faker->numberBetween(1, 10),
            'liga_id' => 1,
            'campeonato_id' => 1,
            'categoria_id' => 1,
            'juegos' => '1',
            'posicion' => $this->faker->numberBetween(1, 9),
            'innings' => $this->faker->numberBetween(1, 7),
            'outs' => $this->faker->numberBetween(0, 15),
            'asistencias' => $this->faker->numberBetween(0, 15),
            'errores' => $this->faker->numberBetween(0, 5),
//            'porcentaje_fildeo' => $this->faker->numberBetween(100, 1000),
            'recopilador_id' => '1',
        ];
    }
}