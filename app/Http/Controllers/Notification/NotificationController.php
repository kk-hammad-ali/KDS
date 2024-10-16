<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{

    public function allNotifications()
    {
        $notifications = Auth::user()->notifications()->latest()->get();

        return view('notifications.all_notifications', compact('notifications'));
    }
}
