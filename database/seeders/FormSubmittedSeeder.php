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
                'father_or_husband_name' => 'Father Doe',
                'cnic' => '12345-1234567-1',
                'phone' => '03111234567',
                'address' => '123 Street, City',
                'optional_phone' => '03221234567',
                'email' => 'john@example.com',
                'course_id' => 1,
                'branch_id' => 1,
                'pickup_sector' => 'I-10',
                'timing_preference' => 'Morning',
            ],
            [
                'name' => 'Jane Smith',
                'father_or_husband_name' => 'Father Smith',
                'cnic' => '98765-9876543-2',
                'phone' => '03119876543',
                'address' => '456 Avenue, City',
                'optional_phone' => '03229876543',
                'email' => 'jane@example.com',
                'course_id' => 2,
                'branch_id' => 1,
                'pickup_sector' => 'G-11',
                'timing_preference' => 'Evening',
            ],
            [
                'name' => 'Alice Brown',
                'father_or_husband_name' => 'Father Brown',
                'cnic' => '13579-1357913-3',
                'phone' => '03111357913',
                'address' => '789 Boulevard, City',
                'optional_phone' => '03221357913',
                'email' => 'alice@example.com',
                'course_id' => 3,
                'branch_id' => 1,
                'pickup_sector' => 'F-8',
                'timing_preference' => 'Afternoon',
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
                'father_or_husband_name' => $record['father_or_husband_name'],
                'cnic' => $record['cnic'],
                'address' => $record['address'],
                'phone' => $record['phone'],
                'optional_phone' => $record['optional_phone'],
                'admission_date' => now(),
                'email' => $record['email'],
                'course_id' => $record['course_id'],
                'branch_id' => $record['branch_id'],
                'pickup_sector' => $record['pickup_sector'],
                'timing_preference' => $record['timing_preference'],
                'form_type' => 'admission',
            ]);

            // Notify the admin about the new admission
            $adminUser = User::whereHas('roles', function ($query) {
                $query->where('name', 'admin');
            })->first();

            if ($adminUser) {
                $adminUser->notify(new NewAdmissionForm($student));
            }
        }
    }
}
