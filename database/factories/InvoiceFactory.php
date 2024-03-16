<?php

namespace Database\Factories;

use App\Models\Repair;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'additionalCharges' => $this->faker->randomFloat(2, 0, 50),
            'totalAmount' => $this->faker->randomFloat(2, 100, 1000),
            'repair_id' => Repair::factory()->create()->id
        ];
    }
}
