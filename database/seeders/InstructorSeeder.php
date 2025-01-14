<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Employee;
use App\Models\Instructor;
use Illuminate\Support\Facades\Hash;
use App\Models\Branch;

class InstructorSeeder extends Seeder
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

        for ($i = 1; $i <= 3; $i++) {
            // Create a user for each instructor
            $user = User::create([
                'name' => "Instructor $i",
                'password' => Hash::make('password'),  // Default password
            ]);
            // Assign Instructor role
            $user->assignRole('instructor');

            // Create the employee record and link it to the user
            $employee = Employee::create([
                'user_id' => $user->id,  // Ensure the employee is linked to the user
                'email' => "instructor$i@example.com",
                'phone' => '123456789' . $i,
                'address' => "Instructor Address $i",
                'salary' => 20000 + $i * 1000,
                'id_card_number' => 'ID' . str_pad($i, 6, '0', STR_PAD_LEFT),
                'gender' => $i % 2 == 0 ? 'male' : 'female',
                'designation' => 'Instructor',
                'picture' => null,
                'branch_id' =>  $branch1->id,
            ]);

            // Create the instructor record and link it to the employee
            Instructor::create([
                'employee_id' => $employee->id,
                'license_city' => "City $i",
                'license_start_date' => now()->subYears(5),
                'license_end_date' => now()->addYears(5),
                'experience' => "$i years",
                'license_number' => 'LIC-' . str_pad($i, 6, '0', STR_PAD_LEFT),
            ]);
        }
    }
}
