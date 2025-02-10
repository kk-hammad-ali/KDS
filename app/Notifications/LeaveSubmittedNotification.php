<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LeaveSubmittedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $leave;

    public function __construct($leave)
    {
        $this->leave = $leave;
    }

    public function via($notifiable)
    {
        return ['database']; // You can also add 'mail' if you want email notifications
    }

    public function toDatabase($notifiable)
    {
        // Check if the leave is for a student or employee and get the name accordingly
        $name = '';

        if ($this->leave->student_id) {
            $name = $this->leave->student->user->name; // For student
        } elseif ($this->leave->employee_id) {
            $name = $this->leave->employee->user->name; // For employee
        }

        return [
            'leave_id' => $this->leave->id,
            'message' => 'A new leave application has been submitted by ' . $name,
            'created_at' => now(),
        ];
    }
}
