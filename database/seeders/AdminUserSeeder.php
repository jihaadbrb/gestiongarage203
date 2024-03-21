<?php

namespace Database\Seeders;

use App\Models\User;
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
            'name' => 'reda',
            'email' => 'admin@me.com',
            'address'=>'tetouan',
            'phoneNumber'=>"123",
            'password' => bcrypt('admin'),
            'role' => 'admin'
        ]);
    }
}
