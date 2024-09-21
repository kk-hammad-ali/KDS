<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Schedule;
use App\Models\Student;
use App\Models\Instructor;
use App\Models\Car;
use Carbon\Carbon;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get students, instructors, and vehicles
        $students = Student::all();
        $instructors = Instructor::all();
        $vehicles = Car::all();

        // Create schedules for each student
        foreach ($students as $student) {
            $instructor = $instructors->random(); // Assign random instructor
            $vehicle = $vehicles->random();       // Assign random vehicle

            for ($i = 1; $i <= 5; $i++) {  // Create 5 schedules for each student
                $startTime = Carbon::now()->addDays($i)->setTime(rand(8, 16), 0);  // Random start time between 8 AM and 4 PM
                $endTime = $startTime->copy()->addHour();  // 1-hour class

                Schedule::create([
                    'student_id' => $student->id,
                    'instructor_id' => $instructor->id,
                    'vehicle_id' => $vehicle->id,
                    'class_date' => $startTime->format('Y-m-d'),
                    'start_time' => $startTime->format('H:i:s'),
                    'end_time' => $endTime->format('H:i:s'),
                ]);
            }
        }
    }
}
