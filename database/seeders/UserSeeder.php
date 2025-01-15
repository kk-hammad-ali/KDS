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
            'name' => "fahad",
            'password' => Hash::make('fahad1122'),
        ]);
        // Assign Admin role
        $admin->assignRole('admin');
    }
}
