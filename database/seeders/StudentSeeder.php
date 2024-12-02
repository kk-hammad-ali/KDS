<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\User;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Car;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Notifications\WelcomeNotification; // Import WelcomeNotification
use App\Notifications\NewStudentAssignedNotification; // Import NewStudentAssignedNotification

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

        // Create 3 Student users and corresponding student and schedule records
        for ($i = 1; $i <= 3; $i++) {
            // Create a user for the student
            $user = User::create([
                'name' => "Student $i",
                'password' => Hash::make('password'),
            ]);
            // Assign Student role
            $user->assignRole('student');

            // Set up random values for course and schedule
            $admission_date = now()->subMonths($i);
            $course_duration = rand(10, 30);  // Duration of the course in days
            $class_duration = 60;  // Duration of class in minutes

            // Define start and end time
            $start_time = Carbon::createFromTime(8, 0, 0); // 08:00 AM
            $end_time = Carbon::createFromTime(20, 0, 0); // 08:00 PM

            // Generate all 30-minute slots
            $slots = [];
            while ($start_time->lessThanOrEqualTo($end_time)) {
                $slots[] = $start_time->format('H:i:s');
                $start_time->addMinutes(30);
            }

            // Randomly pick a start time from the available slots
            $class_start_time = $slots[array_rand($slots)];
            $class_end_time = Carbon::parse($class_start_time)->addMinutes($class_duration)->format('H:i:s');
            $course_end_date = Carbon::parse($admission_date)->addDays($course_duration)->format('Y-m-d');

            // Create the student record
            $student = Student::create([
                'user_id' => $user->id,
                'father_or_husband_name' => "Father $i",
                'cnic' => '12345-678901' . $i,
                'address' => 'Address ' . $i,
                'phone' => '0312345678' . $i,
                'optional_phone' => '0321123456' . $i,
                'admission_date' => $admission_date,
                'email' => "mail$i@gmail.com",
                'fees' => rand(1000, 5000),
                'practical_driving_hours' => rand(10, 30),
                'theory_classes' => rand(5, 15),
                'coupon_code' => null,
                'course_id' => $courses->random()->id,  // Assign a random course
                'instructor_id' => $instructors->random()->id,  // Assign a random instructor
                'course_duration' => $course_duration,
                'class_start_time' => $class_start_time,
                'class_end_time' => $class_end_time,
                'course_end_date' => $course_end_date,
                'class_duration' => $class_duration,
                'form_type' => 'admin',
                'branch_id' => 1,
            ]);

            // Create schedule for the student
            Schedule::create([
                'student_id' => $student->id,
                'instructor_id' => $student->instructor_id,
                'vehicle_id' => $cars->random()->id,
                'class_date' => $admission_date,  // Start date
                'class_end_date' => $course_end_date,      // End date
                'start_time' => $class_start_time,
                'end_time' => $class_end_time,
            ]);

            // Notify the student with a welcome notification
            $user->notify(new WelcomeNotification($student));

            // Notify the assigned instructor about the new student
            $instructor = $student->instructor; // Get the assigned instructor
            if ($instructor) {
                $instructor->employee->user->notify(new NewStudentAssignedNotification($student));
            }
        }
    }
}
