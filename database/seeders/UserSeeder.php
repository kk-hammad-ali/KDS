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
        // Create Admin User
        $admin = User::create([
            'name' => "Admin User",
            'password' => Hash::make('password'),
        ]);
        // Assign Admin role
        $admin->assignRole('admin');

        // You can add more users here as needed
    }
}
