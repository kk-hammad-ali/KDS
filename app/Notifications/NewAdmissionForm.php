<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class NewAdmissionForm extends Notification implements ShouldQueue
{
    use Queueable;

    protected $student;

    public function __construct($student)
    {
        $this->student = $student;
    }

    public function via($notifiable)
    {
        return ['database']; // Only use the database channel
    }

    public function toDatabase($notifiable)
    {
        return [
            'student_id' => $this->student->id,
            'message' => 'A new admission form has been submitted by ' . $this->student->user->name,
            'created_at' => now(),
        ];
    }
}
