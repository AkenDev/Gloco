<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Cliente::class;

    public function definition(): array
    {
        return [
            'codigoCliente' => $this->faker->unique()->word,
            'depaCliente' => $this->faker->city,
            'nombreCliente' => $this->faker->name,
            'contactoCliente' => $this->faker->name,
            'telCliente' => $this->faker->phoneNumber,
            'rucCliente' => $this->faker->unique()->numerify('#########'),
            'dirCliente' => $this->faker->address,
        ];
    }
}
