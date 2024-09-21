<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Instructor;
use App\Models\Employee;

class InstructorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 3 Instructor employees
        for ($i = 1; $i <= 3; $i++) {
            // Create the employee record for the instructor
            $employee = Employee::create([
                'designation' => 'Instructor',
                'address' => 'Address ' . $i,
                'salary' => rand(30000, 50000),
                'salary_status' => 'paid',
                'employee_status' => 'employed',
                'gender' => $i % 2 == 0 ? 'male' : 'female',
                'picture' => null,
            ]);

            // Create the instructor-specific data
            Instructor::create([
                'employee_id' => $employee->id,
                'id_card_number' => 'ID' . str_pad($i, 6, '0', STR_PAD_LEFT),
                'license_city' => 'City ' . $i,
                'license_start_date' => now()->subYears($i + 5),
                'license_end_date' => now()->addYears(5),
                'experience' => $i . ' years',
                'license_number' => 'LIC-' . str_pad($i, 6, '0', STR_PAD_LEFT),
            ]);
        }
    }
}
