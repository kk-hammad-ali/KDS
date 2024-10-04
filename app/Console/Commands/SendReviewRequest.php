<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Student;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReviewRequestMail;
use Carbon\Carbon;

class SendReviewRequest extends Command
{
    protected $signature = 'send:review-request';
    protected $description = 'Send review request emails to students on their 7th day from enrollment';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Fetch students whose 7th day from enrollment is today
        $students = Student::whereDate('admission_date', Carbon::now()->subDays(7))->get();

        foreach ($students as $student) {
            // Send the review request email
            Mail::to($student->email)->send(new ReviewRequestMail($student));

            $this->info("Review request sent to: " . $student->email);
        }

        return Command::SUCCESS;
    }
}
