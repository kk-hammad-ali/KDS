<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdmissionConfirmationMail;

class EmailController extends Controller
{
    public function sendAdmissionConfirmation($student, $schedule, $instructor, $car)
    {
        $details = [
            'student' => $student,
            'schedule' => $schedule,
            'instructor' => $instructor,
            'car' => $car,
            'background_image' => asset('public/images/mail-bg.jpg') // Pass the full URL
        ];

        if (!empty($student->email)) {
            Mail::to($student->email)->send(new AdmissionConfirmationMail($details));
        }
    }
}
