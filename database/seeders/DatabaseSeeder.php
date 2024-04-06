<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        \App\Models\User::factory(100)->create();
        \App\Models\Vehicle::factory(100)->create();
        \App\Models\Repair::factory(100)->create();
        \App\Models\SparePart::factory(100)->create();
        \App\Models\Invoice::factory(100)->create();
    }
}
