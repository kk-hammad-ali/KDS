<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;

class NewStudentAssignedNotification extends Notification
{
    use Queueable;

    protected $student;

    public function __construct($student)
    {
        $this->student = $student;
    }

    public function via($notifiable)
    {
        return ['database']; // Store notification in the database
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'A new student has been assigned to you: ' . $this->student->user->name,
        ];
    }
}
