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
        return [
            'fecha' => $this->faker->randomElement(['01/11/2024','07/11/2024','01/12/2024','15/12/2024']),
            'jugador_id' => $this->faker->numberBetween(1, 100),
            'oponente_id' => $this->faker->numberBetween(1, 10),
            'liga_id' => 1,
            'campeonato_id' => 1,
            'categoria_id' => 1,
            'juegos' => '1',
            'vb' => $this->faker->numberBetween(1, 5),
            'anotadas' => $this->faker->numberBetween(1, 5),
            'hit' => $this->faker->numberBetween(1, 5),
            'dobles' => $this->faker->numberBetween(1, 5),
            'triples' => $this->faker->numberBetween(1, 5),
            'hr' => $this->faker->numberBetween(1, 5),
            'rbi' => $this->faker->numberBetween(1, 5),
            'boletos_recibidos' => $this->faker->numberBetween(1, 5),
            'ponches' => $this->faker->numberBetween(1, 5),
            'robadas' => $this->faker->numberBetween(1, 5),
            'out_robando' => $this->faker->numberBetween(1, 5),
            'alcanzadas' => $this->faker->numberBetween(1, 5),
//            'average' => $this->faker->numberBetween(1, 5),
//            'slugging' => $this->faker->numberBetween(1, 5),
//            'porcentaje' => $this->faker->numberBetween(1, 5),
//            'porcentaje_plus' => $this->faker->numberBetween(1, 5),
            'j' => '1',
            'ganados' => $this->faker->numberBetween(0, 1), 
            'perdidos' => $this->faker->numberBetween(0, 1), 
//            'empatados' => $this->faker->numberBetween(0, 1), 
//            'efectividad' => 
            'blanqueos' => $this->faker->numberBetween(0, 1), 
            'salvados' => $this->faker->numberBetween(0, 1), 
//            'completos' => $this->faker->numberBetween(0, 1), 
            'ip' => $this->faker->numberBetween(1, 7), 
            'carreras_permitidas' => $this->faker->numberBetween(0, 7), 
            'carreras_limpias' => $this->faker->numberBetween(0, 7), 
            'ponches_propinados' => $this->faker->numberBetween(0, 10), 
            'boletos_otorgados' => $this->faker->numberBetween(0, 10), 
            'hp' => $this->faker->numberBetween(0, 15), 
            'h2' => $this->faker->numberBetween(0, 10), 
            'h3' => $this->faker->numberBetween(0, 10), 
            'h4' => $this->faker->numberBetween(0, 10), 
            'recopilador_id' => '1',
        ];
    }
}