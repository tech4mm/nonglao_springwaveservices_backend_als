<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminNotificationController extends Controller
{
    public function send(Request $request)
    {
        // Add logic to handle the notification sending
        return response()->json(['message' => 'Notification sent successfully']);
    }
}
