<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\User;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Car;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ensure the necessary data exists before creating students
        $courses = Course::all();
        $instructors = Instructor::all();
        $cars = Car::all();

        // Create 3 Student users and corresponding student records
        for ($i = 1; $i <= 3; $i++) {
            // Create a user for the student
            $user = User::create([
                'name' => "Student $i",
                'password' => bcrypt('password123'),
                'role' => 2, // Assuming role 3 is Student
            ]);

            // Create the student record
            Student::create([
                'user_id' => $user->id,
                'father_or_husband_name' => "Father $i",
                'cnic' => '12345-678901' . $i,
                'address' => 'Address ' . $i,
                'phone' => '0312345678' . $i,
                'optional_phone' => '0321123456' . $i,
                'admission_date' => now()->subMonths($i),
                'driving_time_per_week' => rand(1, 10),
                'fees' => rand(1000, 5000),
                'practical_driving_hours' => rand(10, 30),
                'theory_classes' => rand(5, 15),
                'coupon_code' => null,
                'course_id' => $courses->random()->id,  // Assign a random course
                'instructor_id' => $instructors->random()->id,  // Assign a random instructor
                'vehicle_id' => $cars->random()->id,  // Assign a random car
                'course_duration' => rand(5, 30),
                'class_start_time' => now()->format('H:i:s'),
                'class_end_time' => now()->addHours(1)->format('H:i:s'),
                'class_duration' => 60, // Assume class duration is 60 minutes
                'course_end_date' => now()->addDays(rand(10, 30))->format('Y-m-d'),
            ]);
        }
    }
}
