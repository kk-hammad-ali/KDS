<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewStudentNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $student;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($student, $user)
    {
        $this->student = $student;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Student Admission Form Submission')
                    ->view('emails.new-student-notification');
    }
}
