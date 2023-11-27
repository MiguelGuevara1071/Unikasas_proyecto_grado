<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProyectoEtapa>
 */
class ProyectoEtapaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'proyecto_id' => $this->faker->numberBetween(1, 10),
            'etapa_id' => $this->faker->numberBetween(1, 6),
        ];
    }
}
