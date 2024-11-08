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


        for ($i = 1; $i <= 3; $i++) {
            // Create a user for each employee
            $user = User::create([
                'name' => "Employee $i",
                'password' => Hash::make('password'),
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
                'branch_id' => $i == 1 ? $branch1->id : $branch2->id,
            ]);
        }
    }
}
