<?php
namespace Database\Factories;

use App\Models\SparePart;
use App\Models\Repair;
use App\Models\SparePartRepair;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SparePartRepair>
 */
class SparePartRepairFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Retrieve random repair and spare part IDs
        $repairId = Repair::inRandomOrder()->first()->id;
        $sparePartId = SparePart::inRandomOrder()->first()->id;

        return [
            'repair_id' => $repairId,
            'spare_part_id' => $sparePartId,
        ];
    }
}
