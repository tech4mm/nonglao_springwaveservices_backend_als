<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\AdminNotification;

class AdminNotificationController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'image' => 'nullable|url',
            'fcm_token' => 'required|string'
        ]);

        $fcmData = [
            'to' => $request->fcm_token,
            'notification' => [
                'title' => $request->title,
                'body' => $request->content,
                'image' => $request->image,
                'sound' => 'default'
            ],
            'data' => [
                'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
                'status' => 'done',
                'title' => $request->title,
                'body' => $request->content,
                'image' => $request->image,
            ]
        ];

        $response = Http::withToken(env('FCM_SERVER_KEY'))
            ->post('https://fcm.googleapis.com/fcm/send', $fcmData);

        AdminNotification::create([
            'user_id' => $request->user_id, // or $request->user()->id if using auth
            'title' => $request->title,
            'content' => $request->content,
            'image' => $request->image,
            'fcm_token' => $request->fcm_token,
            'status' => $response->successful() ? 'sent' : 'failed',
        ]);

        return response()->json([
            'message' => 'Notification sent',
            'fcm_response' => $response->json()
        ]);
    }
}
