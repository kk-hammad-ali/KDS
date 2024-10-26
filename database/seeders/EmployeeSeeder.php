<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 3; $i++) {
            // Create a user for each employee
            $user = User::create([
                'name' => "Employee $i",
                'password' => Hash::make('password'),  // Default password
            ]);

            // Create employees with user ID
            Employee::create([
                'user_id' => $user->id,  // Link the employee to the created user
                'email' => "employee$i@example.com",
                'phone' => '987654321' . $i,
                'address' => "Employee Address $i",
                'salary' => 15000 + $i * 1000,
                'gender' => $i % 2 == 0 ? 'female' : 'male',
                'id_card_number' => 'ID' . str_pad($i, 6, '0', STR_PAD_LEFT),
                'designation' => 'Employee',
                'picture' => null,  // Add default if needed
            ]);
        }
    }
}
