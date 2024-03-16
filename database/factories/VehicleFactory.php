<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'make' => $this->faker->name(),
            'model' => $this->faker->name(),
            'fuelType' => $this->faker->randomElement(['Petrol', 'Diesel', 'Electric']),
            'registration' => $this->faker->name(),
            'photos' => $this->faker->imageUrl(),
            'client_id' => function () {
                return Client::factory()->create()->id;
            },
        ];
    }
}
