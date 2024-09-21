<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 3 generic Employee records
        for ($i = 1; $i <= 3; $i++) {
            Employee::create([
                'designation' => "Employee $i",
                'address' => 'Employee Address ' . $i,
                'salary' => rand(25000, 40000),
                'salary_status' => 'unpaid',
                'employee_status' => 'employed',
                'gender' => $i % 2 == 0 ? 'male' : 'female',
                'picture' => null, // Optional
            ]);
        }
    }
}
