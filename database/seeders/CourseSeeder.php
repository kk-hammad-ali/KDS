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
        $courses = [
            // Suzuki Mehran
            ['car_model_id' => 1, 'duration_days' => 30, 'duration_minutes' => 60, 'fees' => 5000.00, 'course_type' => 'male'],
            ['car_model_id' => 1, 'duration_days' => 30, 'duration_minutes' => 60, 'fees' => 8000.00, 'course_type' => 'female'],

            // Suzuki Alto
            ['car_model_id' => 2, 'duration_days' => 25, 'duration_minutes' => 60, 'fees' => 7000.00, 'course_type' => 'both'],

            // Toyota Vitz
            ['car_model_id' => 3, 'duration_days' => 20, 'duration_minutes' => 90, 'fees' => 7500.00, 'course_type' => 'both'],

            // Daihatsu Mira
            ['car_model_id' => 4, 'duration_days' => 15, 'duration_minutes' => 60, 'fees' => 7500.00, 'course_type' => 'both'],

            // Honda City
            ['car_model_id' => 5, 'duration_days' => 20, 'duration_minutes' => 90, 'fees' => 9000.00, 'course_type' => 'both'],

            // Bike (CD-70)
            ['car_model_id' => 6, 'duration_days' => 10, 'duration_minutes' => 45, 'fees' => 6000.00, 'course_type' => 'both'],
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
