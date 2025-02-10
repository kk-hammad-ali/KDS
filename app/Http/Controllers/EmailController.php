<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdmissionConfirmationMail;
use App\Mail\InstructorWelcomeMail;
use App\Mail\NewStudentNotification;

class EmailController extends Controller
{
    public function sendAdmissionConfirmation($student, $schedule, $instructor, $car)
    {
        $details = [
            'student' => $student,
            'schedule' => $schedule,
            'instructor' => $instructor,
            'car' => $car,
            'background_image' => asset('public/images/mail-bg.jpg'),
            'username' => $student->user->name,
            'password' => $student->cnic,
        ];

        if (!empty($student->email)) {
            Mail::to($student->email)->send(new AdmissionConfirmationMail($details));
        }
    }

    public function sendInstructorWelcome($instructor, $username, $password)
    {
        $details = [
            'name' => $instructor->employee->user->name,
            'background_image' => asset('public/images/mail-bg.jpg'),
            'username' => $username,
            'password' => $password,
        ];

        Mail::to($instructor->employee->email)->send(new InstructorWelcomeMail($details));
    }

    public function sendNewStudentNotification($student, $user)
    {
        $details = [
            'student' => $student,
            'user' => $user,
        ];

        $adminEmail = 'kingdrivingschool2@gmail.com';

        // Send the email to the admin
        Mail::to($adminEmail)->send(new \App\Mail\NewStudentNotification($student, $user));
    }

}
