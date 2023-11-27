<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Actividad>
 */
class ActividadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'encargado_actividad' => $this->faker->name,

            'nombre_actividad' => $this->faker->word,
            'objetivo_actividad' => $this->faker->word,
            'fecha_inicio' => $this->faker->dateTimeBetween('-1 years', '+1 years'),
            'fecha_fin' => $this->faker->dateTimeBetween('-1 years', '+1 years'),
            'observaciones_actividad' => $this->faker->word,
            'estado_actividad' => $this->faker->randomElement(['ejecucion', 'finalizada']),
        ];
    }
}
