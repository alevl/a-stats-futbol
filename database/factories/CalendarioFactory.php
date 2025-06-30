<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Calendario>
 */
class CalendarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fecha_juego' => $this->faker->randomElement(['01/11/2024','07/11/2024','01/12/2024','15/12/2024']),
            'hora_juego' => $this->faker->randomElement(['08:00','10:00','12:00','14:00','16:00']),
            'estadio_id' => $this->faker->numberBetween(1, 4),
            'categoria_id' => 1,
            'campeonato_id' => 1,
            'grupo_id' => '10',
            'visita_id' => $this->faker->numberBetween(1, 10),
            'casa_id' => $this->faker->numberBetween(1, 10),
            'anotacion_visita' => $this->faker->numberBetween(0, 10),
            'anotacion_casa' => $this->faker->numberBetween(0, 10),
            'hits_visita' => $this->faker->numberBetween(0, 10),
            'hits_casa' => $this->faker->numberBetween(0, 10),
            'errores_visita' => $this->faker->numberBetween(0, 5),
            'errores_casa' => $this->faker->numberBetween(0, 5),
            'anotador_id' => $this->faker->numberBetween(1, 3),
            'arbitro1_id' => $this->faker->numberBetween(1, 4),
            'arbitro2_id' => $this->faker->numberBetween(1, 4),
            'arbitro3_id' => $this->faker->numberBetween(1, 4),
            'arbitro4_id' => $this->faker->numberBetween(1, 4),
            'observacion' => '',
            'tiempo' => $this->faker->randomElement(['02:00','01:45','01:30','02:30','01:25']),
            'bat_destacado_id' => $this->faker->numberBetween(1, 100),
            'pit_destacado_id' => $this->faker->numberBetween(1, 100),
            'texto_bateador' => '4-3, 2 2B, 5CI, 2CA',
            'texto_pitcher' => '7IP, 4H, 3C, 1CL, 10K',
        ];
    }
}