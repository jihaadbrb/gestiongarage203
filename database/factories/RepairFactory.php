<?php

namespace Database\Factories;

use App\Models\Invoice;
use App\Models\SparePart;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Repair>
 */
class RepairFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
   // RepairFactory
// RepairFactory
public function definition(): array
{
    $user = User::factory()->create(['role' => 'client']); 
    $vehicle = Vehicle::factory()->create(['user_id' => $user->id]);
    
    return [
        'description' => $this->faker->sentence,
        'status' => $this->faker->randomElement(['pending', 'in_progress', 'completed']),
        'startDate' => $this->faker->dateTimeBetween('-1 year', 'now'),
        'endDate' => $this->faker->dateTimeBetween('now', '+1 year'),
        'mechanicNotes' => $this->faker->paragraph,
        'clientNotes' => $this->faker->paragraph,
        'user_id' => $user->id, 
        'vehicle_id' => $vehicle->id, 
        'mechanic_id' => User::factory()->create(['role' => 'mechanic'])->id, 
    ];
}


}
