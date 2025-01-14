<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Student;
use App\Models\Schedule;
use App\Models\Invoice;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Branch;
use App\Models\Car;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ensure necessary data exists
        $courses = Course::all();
        $instructors = Instructor::all();
        $branches = Branch::all();
        $cars = Car::all();

        // Seed 5 students
        for ($i = 1; $i <= 5; $i++) {
            // Create a user for the student
            $user = User::create([
                'name' => "Student $i",
                'password' => Hash::make('password'),
            ]);
            $user->assignRole('student'); // Assign role

            // Randomize values for student
            $admission_date = now()->subDays(rand(1, 30));
            $course = $courses->random();
            $branch = $branches->random();
            $instructor = $instructors->random();
            $car = $cars->random();

            // Create student record
            $student = Student::create([
                'user_id' => $user->id,
                'branch_id' => 1,
                'father_or_husband_name' => "Parent $i",
                'cnic' => '12345-678901' . $i,
                'address' => "Address $i",
                'phone' => "0312345678$i",
                'optional_phone' => "0321123456$i",
                'admission_date' => $admission_date,
                'email' => "student$i@example.com",
                'course_id' => $course->id,
                'instructor_id' => $instructor->id,
                'form_type' => 'admin',
                'pickup_sector' => "Sector $i",
                'timing_preference' => "Morning",
            ]);

            // Randomize schedule details
            $class_date = Carbon::parse($admission_date)->addDays(rand(1, 3));
            $class_end_date = Carbon::parse($class_date)->addDays($course->duration_days);
            $start_time = Carbon::createFromTime(rand(7, 10), 0, 0);
            $end_time = $start_time->copy()->addMinutes(60);

            // Create schedule record
            $schedule = Schedule::create([
                'student_id' => $student->id,
                'instructor_id' => $instructor->id,
                'vehicle_id' => $car->id,
                'class_date' => $class_date,
                'class_end_date' => $class_end_date,
                'start_time' => $start_time->format('H:i:s'),
                'end_time' => $end_time->format('H:i:s'),
            ]);

            // Create invoice record
            Invoice::create([
                'schedule_id' => $schedule->id,
                'branch_id' => $branch->id,
                'receipt_number' => 'INV-' . strtoupper(uniqid()),
                'invoice_date' => Carbon::now(),
                'paid_by' => "Cash",
                'amount_in_english' => ucfirst(number_format($course->fees, 2)) . ' rupees only',
                'balance' => 0,
                'amount_received' => $course->fees,
            ]);
        }
    }
}
