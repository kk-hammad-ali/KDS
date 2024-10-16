<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CourseCompletedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $student;

    public function __construct($student)
    {
        $this->student = $student;
    }

    public function via($notifiable)
    {
        return ['database']; // You can add 'mail' or other channels if needed
    }

    public function toDatabase($notifiable)
    {
        return [
            'student_id' => $this->student->id,
            'message' => 'Congratulations! You have completed your course: ' . $this->student->course->name,
            'created_at' => now(),
        ];
    }
}
