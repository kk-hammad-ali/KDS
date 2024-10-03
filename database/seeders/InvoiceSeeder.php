<?php

namespace Database\Seeders;

use App\Models\Invoice;
use App\Models\Student;
use App\Models\Instructor;
use App\Models\Schedule;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Fetch random students, instructors, and schedules for the seeder
        $students = Student::all();
        $instructors = Instructor::all();
        $schedules = Schedule::all();


        foreach (range(1, 3) as $index) {
            Invoice::create([
                'student_id' => $students->random()->id,
                'instructor_id' => $instructors->random()->id,
                'schedule_id' => $schedules->random()->id,
                'invoice_date' => now(),
                'balance' => rand(0, 1000), // Random balance between 0 and 1000
                'receipt_number' => 'RECPT-' . rand(1000, 9999),
                'amount_received' => rand(100, 500), // Random amount received
                'advance_against' => 'Class Fees',
                'class_timing' => '08:00 AM - 09:00 AM',
                'days' => rand(1, 30),
                'branch' => 'Main Branch',
                'receiver_signature' => 'Receiver Name',
            ]);
        }
    }
}
