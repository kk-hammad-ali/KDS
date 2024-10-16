<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Student;
use Illuminate\Support\Facades\Mail;
use App\Mail\CompletionMail;
use App\Notifications\CourseCompletedNotification;
use PDF;

class SendCompletionCertificate extends Command
{
    protected $signature = 'send:completion-certificates';
    protected $description = 'Send certificates to students whose courses have completed today';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Fetch students whose course ends today
        $students = Student::whereDate('course_end_date', today())->get();

        foreach ($students as $student) {
            // Generate PDF from the certificate Blade view
            // $pdf = PDF::loadView('mail.my_certificate', compact('student'))->setPaper('a4', 'portrait');

            // Prepare email details and send the email
            $details = [
                'student' => $student,
            ];

            // Send the email with PDF attached
            Mail::to($student->email)->send(new CompletionMail($details));

            // Notify the student about course completion
            $student->user->notify(new CourseCompletedNotification($student));

            $this->info("Completion certificate and notification sent to: " . $student->email);
        }

        return Command::SUCCESS;
    }

}
