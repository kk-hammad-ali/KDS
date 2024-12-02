<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use App\Notifications\NewAdmissionForm;

class FormSubmittedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [
            [
                'name' => 'John Doe',
                'father_husband_name' => 'Father Doe',
                'cnic' => '12345-1234567-1',
                'phone' => '03111234567',
                'address' => '123 Street, City',
                'secondary_phone' => '03221234567',
                'email' => 'john@example.com',
                'course_id' => 1,
                'fees' => 5000,
                'course_duration' => 30
            ],
            [
                'name' => 'Jane Smith',
                'father_husband_name' => 'Father Smith',
                'cnic' => '98765-9876543-2',
                'phone' => '03119876543',
                'address' => '456 Avenue, City',
                'secondary_phone' => '03229876543',
                'email' => 'jane@example.com',
                'course_id' => 2,
                'fees' => 6000,
                'course_duration' => 45
            ],
            [
                'name' => 'Alice Brown',
                'father_husband_name' => 'Father Brown',
                'cnic' => '13579-1357913-3',
                'phone' => '03111357913',
                'address' => '789 Boulevard, City',
                'secondary_phone' => '03221357913',
                'email' => 'alice@example.com',
                'course_id' => 3,
                'fees' => 7000,
                'course_duration' => 60
            ],
        ];

        foreach ($records as $record) {
            // Create user
            $user = User::create([
                'name' => $record['name'],
                'password' => Hash::make("password"), // Default password
            ]);

            // Assign role to user as student
            $user->assignRole('student');

            // Create student entry
            $student = Student::create([
                'user_id' => $user->id,
                'father_or_husband_name' => $record['father_husband_name'],
                'cnic' => $record['cnic'],
                'address' => $record['address'],
                'phone' => $record['phone'],
                'optional_phone' => $record['secondary_phone'],
                'admission_date' => now(),
                'email' => $record['email'],
                'fees' => $record['fees'],
                'practical_driving_hours' => 0,
                'theory_classes' => 0,
                'coupon_code' => null,
                'course_id' => $record['course_id'],
                'instructor_id' => null,
                'course_duration' => $record['course_duration'],
                'class_start_time' => null,
                'class_end_time' => null,
                'class_duration' => 0,
                'course_end_date' => now()->addDays($record['course_duration']),
                'form_type' => 'admission',
                'branch_id' => 1,
            ]);

            // Notify the admin about the new admission
            $adminUser = User::whereHas('roles', function($query) {
                $query->where('name', 'admin');
            })->first();

            if ($adminUser) {
                $adminUser->notify(new NewAdmissionForm($student));
            }
        }
    }
}
