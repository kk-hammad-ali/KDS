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
            ['car_model_id' => 1, 'duration_days' => 10, 'duration_minutes' => 30, 'fees' => 10000.00, 'course_type' => 'male'],
            ['car_model_id' => 1, 'duration_days' => 10, 'duration_minutes' => 60, 'fees' => 17000.00, 'course_type' => 'male'],
            ['car_model_id' => 1, 'duration_days' => 15, 'duration_minutes' => 60, 'fees' => 28000.00, 'course_type' => 'male'],
            ['car_model_id' => 1, 'duration_days' => 11, 'duration_minutes' => 60, 'fees' => 17000.00, 'course_type' => 'female'],
            ['car_model_id' => 1, 'duration_days' => 16, 'duration_minutes' => 60, 'fees' => 28000.00, 'course_type' => 'female'],

            // Suzuki Alto
            ['car_model_id' => 2, 'duration_days' => 11, 'duration_minutes' => 60, 'fees' => 20000.00, 'course_type' => 'both'],
            ['car_model_id' => 2, 'duration_days' => 16, 'duration_minutes' => 60, 'fees' => 30000.00, 'course_type' => 'both'],

            // Toyota Vitz
            ['car_model_id' => 3, 'duration_days' => 11, 'duration_minutes' => 60, 'fees' => 20000.00, 'course_type' => 'both'],
            ['car_model_id' => 3, 'duration_days' => 16, 'duration_minutes' => 60, 'fees' => 30000.00, 'course_type' => 'both'],

            // Daihatsu Mira
            ['car_model_id' => 4, 'duration_days' => 11, 'duration_minutes' => 60, 'fees' => 20000.00, 'course_type' => 'both'],
            ['car_model_id' => 4, 'duration_days' => 16, 'duration_minutes' => 60, 'fees' => 30000.00, 'course_type' => 'both'],

            // Honda City
            ['car_model_id' => 5, 'duration_days' => 11, 'duration_minutes' => 60, 'fees' => 25000.00, 'course_type' => 'both'],
            ['car_model_id' => 5, 'duration_days' => 16, 'duration_minutes' => 60, 'fees' => 35000.00, 'course_type' => 'both'],

            // Bike (CD-70)
            ['car_model_id' => 6, 'duration_days' => 10, 'duration_minutes' => 30, 'fees' => 10000.00, 'course_type' => 'both'],
            ['car_model_id' => 6, 'duration_days' => 10, 'duration_minutes' => 60, 'fees' => 17000.00, 'course_type' => 'both'],
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
