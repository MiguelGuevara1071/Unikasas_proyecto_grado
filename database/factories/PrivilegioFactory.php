<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Privilegio>
 */
class PrivilegioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nombre_privilegio' => $this->faker->randomElement(['administrar usuarios', 'administrar proyectos', 'administrar cotizaciones']),
            'descripcion_privilegio' => $this->faker->word,
        ];
    }
}
