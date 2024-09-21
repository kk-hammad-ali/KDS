<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Instructor;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class InstructorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 3 Instructor users
        for ($i = 1; $i <= 3; $i++) {
            $user = User::create([
                'name' => "Instructor $i",
                'password' => Hash::make('password123'),
                'role' => 1, // Assuming role 2 is Instructor
            ]);

            // Create the instructor record
            Instructor::create([
                'user_id' => $user->id,
                'id_card_number' => 'ID' . str_pad($i, 6, '0', STR_PAD_LEFT),
                'license_city' => 'City ' . $i,
                'license_start_date' => now()->subYears($i + 5),  // License starts 5+ years ago
                'license_end_date' => now()->addYears(5),         // License valid for 5 more years
                'experience' => $i . ' years',
                'phone_number' => '123456789' . $i,
                'address' => 'Address ' . $i,
                'gender' => $i % 2 == 0 ? 'male' : 'female',
                'license_number' => 'LIC-' . str_pad($i, 6, '0', STR_PAD_LEFT),
            ]);
        }
    }
}
