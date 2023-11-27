<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\evento>
 */
class EventoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
        
            'nombre_evento' => $this->faker->word,
            'fecha_evento' => $this->faker->dateTimeBetween('-1 years', '+1 years'),
            'hora_inicio' => $this->faker->time('H:i:s'),
            'hora_fin' => $this->faker->time('H:i:s'),
            'proyecto_id' => $this->faker->numberBetween(1, 10),
            'notificacion_evento' => $this->faker->word,
            'invitados_evento' => $this->faker->word,
            'lugar_evento' => $this->faker->word,
            'asunto_evento' => $this->faker->word,
            'mensaje_evento' => $this->faker->word,
            'estado_evento' => $this->faker->randomElement(['Activo', 'Cancelado']),
        ];
    }
}
