<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'jihad',
            'email' => 'jihad@bourbab.com',
            'address'=>'tetouan',
            'phoneNumber'=>"123",
            'password' => bcrypt('admin'),
            'role' => 'admin'
        ]);
        // Vehicle::create([
        //     'make'=>'G Class',
        // 'model'=>2024,
        // 'fuelType'=>'disiel',
        // 'registration'=>'A1',
        // 'photos'=>'null',
        // 'user_id'=>'1'   
        // ]);
    }
}
