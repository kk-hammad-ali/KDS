<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;

class WelcomeNotification extends Notification
{
    use Queueable;

    public function via($notifiable)
    {
        return ['database']; // Store notification in the database
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Welcome to King Driving School, ' . $notifiable->name . '!',
        ];
    }
}
