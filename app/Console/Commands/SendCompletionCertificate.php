<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Student;
use Illuminate\Support\Facades\Mail;
use App\Mail\CompletionMail; // New Mailable for completion
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
            $pdf = PDF::loadView('student.my_certificate_pdf', compact('student'))->setPaper('a4', 'portrait');

            // Prepare email details and send the email
            $details = [
                'student' => $student,
            ];

            // Send the email with PDF attached
            Mail::to($student->email)->send(new CompletionMail($details));

            $this->info("Completion certificate sent to: " . $student->email);
        }

        return Command::SUCCESS;
    }
}