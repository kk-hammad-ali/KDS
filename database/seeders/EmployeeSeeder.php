<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Employee;
use App\Models\Branch;  // Add this import to access branches
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
        // Fetch branches created by BranchSeeder
        $branch1 = Branch::where('name', 'Main Branch')->first();
        $branch2 = Branch::where('name', 'North Branch')->first();

        for ($i = 1; $i <= 2; $i++) {
            // Create a user for each manager
            $user = User::create([
                'name' => "Manager $i",
                'password' => Hash::make('password'),  // Default password
                'current_branch_id' => $i == 1 ? $branch1->id : $branch2->id,  // Assign manager to respective branch
            ]);

            // Assign the manager role
            $user->assignRole('manager');

            // Create the employee record
            Employee::create([
                'user_id' => $user->id,
                'email' => "manager$i@example.com",
                'phone' => '987654321' . $i,
                'address' => "Manager Address $i",
                'salary' => 25000 + $i * 1000,
                'gender' => $i % 2 == 0 ? 'female' : 'male',
                'id_card_number' => 'ID' . str_pad($i, 6, '0', STR_PAD_LEFT),
                'designation' => 'Manager',
                'picture' => null,  // Add default if needed
            ]);
        }

        for ($i = 3; $i <= 5; $i++) {
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
