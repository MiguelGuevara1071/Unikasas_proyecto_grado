<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Proyecto>
 */
class ProyectoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [

            'encargado_id' => $this->faker->numberBetween(1, 4),
            'cliente_id' => $this->faker->numberBetween(1, 10),
            'producto_id' => $this->faker->numberBetween(1, 10),

            'nombre_proyecto' => $this->faker->word,
            'costo_estimado' => $this->faker->randomNumber($nbDigits = NULL, $strict = false),
            'costo_final' => $this->faker->randomNumber($nbDigits = NULL, $strict = false),
            'ciudad_proyecto' => $this->faker->word,
            'direccion_proyecto' => $this->faker->word,
            'fecha_inicio' => $this->faker->dateTimeBetween('-1 years', '+1 years'),
            'fecha_fin' => $this->faker->dateTimeBetween('-1 years', '+1 years'),
            'estado_proyecto' => $this->faker->randomElement(['En ejecución', 'Suspendido', 'Finalizado'])

        ];
    }
}
