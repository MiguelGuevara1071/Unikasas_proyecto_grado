<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nombre_producto' => $this->faker->word,
            'descripcion_producto' => $this->faker->word,
            'precio_producto' => $this->faker->randomNumber($nbDigits = NULL, $strict = false),
        ];
    }
}
