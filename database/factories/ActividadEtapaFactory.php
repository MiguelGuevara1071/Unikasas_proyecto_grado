<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\actividadEtapa>
 */
class ActividadEtapaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'etapa_id' => $this->faker->numberBetween(1, 6),
            'actividad_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
