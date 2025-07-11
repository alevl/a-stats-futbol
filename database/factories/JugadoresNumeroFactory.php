<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JugadoresNumero>
 */
class JugadoresNumeroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fecha = $this->faker->randomElement(['01/11/2024','07/11/2024','01/12/2024','15/12/2024']);  
        $fecha_invertida = \Carbon\Carbon::createFromFormat('d/m/Y', $fecha)->format('Ymd');

        return [
            'fecha' => $fecha,
            'jugador_id' => $this->faker->numberBetween(1, 100),
            'oponente_id' => $this->faker->numberBetween(1, 10),
            'liga_id' => 1,
            'campeonato_id' => 1,
            'categoria_id' => 1,
            'juegos' => '1',
            'goles' => $this->faker->numberBetween(0, 5),
            'asistencias' => $this->faker->numberBetween(0, 5),
            'tiros_arco' => $this->faker->numberBetween(0, 5),
            'faltas_cometidas' => $this->faker->numberBetween(0, 5),
            'faltas_recibidas' => $this->faker->numberBetween(0, 5),
            'tarjetas_amarilla' => $this->faker->numberBetween(0, 5),
            'tarjetas_roja' => $this->faker->numberBetween(0, 1),           
            'atajadas' => $this->faker->numberBetween(0, 5),
            'penales_cobrados' => $this->faker->numberBetween(0, 5),
            'penales_fallados' => $this->faker->numberBetween(0, 5),
            'fuera_juego' => $this->faker->numberBetween(0, 5),
            'fecha_invertida' => $fecha_invertida,
            'recopilador_id' => '1',
        ];
    }
}