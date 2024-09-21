<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed 3 example courses
        Course::create([
            'duration_days' => '15 Days',
            'duration_minutes' => '30',
            'fees' => 15000.00,
        ]);

        Course::create([
            'duration_days' => '10 Days',
            'duration_minutes' => '60',
            'fees' => 20000.00,
        ]);

        Course::create([
            'duration_days' => '5 Days',
            'duration_minutes' => '90',
            'fees' => 30000.00,
        ]);
    }
}
