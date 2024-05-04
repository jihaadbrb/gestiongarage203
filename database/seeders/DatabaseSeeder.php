<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Create users
        User::factory(4)->create()->each(function ($user) {
            // For each user, create related data
            $vehicle = $user->vehicles()->save(\App\Models\Vehicle::factory()->make());
            $repair = $user->repairs()->save(\App\Models\Repair::factory()->make());

            // Create spare part associated with the repair
            $sparePart = \App\Models\SparePart::factory()->make();
            $repair->spareParts()->save($sparePart);

            // Create invoice associated with the repair
            $invoice = \App\Models\Invoice::factory()->make();
            $repair->invoices()->save($invoice);
        });
    }
}
