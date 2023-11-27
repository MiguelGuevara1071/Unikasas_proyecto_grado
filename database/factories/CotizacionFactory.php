<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cotizacion>
 */
class CotizacionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'producto_id' => $this->faker->numberBetween(1, 10),

            'nombres_cotizante' => $this->faker->word,
            'apellidos_cotizante' => $this->faker->word,
            'email_cotizante' => $this->faker->email,
            'telefono_cotizante' => $this->faker->tollFreePhoneNumber,
            'ciudad_cotizante' => $this->faker->word,
            'ubicacion_cotizante' => $this->faker->word,
            'fecha_cotizacion' => $this->faker->dateTimeBetween('-1 years', '+1 years'),
            'comentarios_cotizacion' => $this->faker->word,
            'estado_cotizacion' => $this->faker->randomElement(['Por responder', 'Respondida', 'Cancelada']),
        ];
    }
}
