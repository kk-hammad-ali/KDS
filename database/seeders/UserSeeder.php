<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 3 Admin users
        for ($i = 1; $i <= 3; $i++) {
            User::create([
                'name' => "Admin User $i",
                'password' => Hash::make('password123'),
                'role' => 0, // Role 1 for Admin
            ]);
        }
    }
}
