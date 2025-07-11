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
        $faker = \Faker\Factory::create('es_VE');
    
        return [
            'nombre' => $faker->firstNameMale . ' ' . $faker->lastName,
            'dni' => $faker->numberBetween(10000000, 40000000),
            'numero' => $faker->numberBetween(1, 99),
            'equipo_id' => $faker->numberBetween(1, 10),
            'foto' => '',
            'Nacimiento' => 'Caracas, 01 de Enero de 2015',
            'batea' => 'Derecha',
            'lanza' => 'Derecha',
        ];
    }
}