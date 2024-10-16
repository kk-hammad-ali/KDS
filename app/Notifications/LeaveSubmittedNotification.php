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
        return [
            'leave_id' => $this->leave->id,
            'message' => 'A new leave application has been submitted by ' . $this->leave->user->name,
            'created_at' => now(),
        ];
    }
}
