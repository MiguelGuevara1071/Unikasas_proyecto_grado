<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RolPrivilegio>
 */
class RolPrivilegioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'rol_id' => $this->faker->numberBetween(1, 3),
            'privilegio_id' => $this->faker->numberBetween(1, 3),
        ];
    }
}
