<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Notification;
use App\Models\User;

class NotificationController extends Controller
{
    //
    public function send(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'title'   => 'required|string',
            'message' => 'nullable|string',
            'image_url' => 'nullable|url',
        ]);

        $user = User::findOrFail($request->user_id);

        // Save to database
        $notification = Notification::create([
            'user_id' => $user->id,
            'title' => $request->title,
            'message' => $request->message,
            'image_url' => $request->image_url,
        ]);

        // Send FCM
        if ($user->fcm_token) {
            $this->sendFcm($user->fcm_token, $notification);
        }

        return response()->json(['success' => true, 'notification' => $notification]);
    }

    protected function sendFcm($token, $notification)
    {
        $serverKey = env('FCM_SERVER_KEY');

        $payload = [
            'to' => $token,
            'notification' => [
                'title' => $notification->title,
                'body' => $notification->message,
                'image' => $notification->image_url,
            ],
            'data' => [
                'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
                'notification_id' => $notification->id,
            ],
        ];

        Http::withToken($serverKey)
            ->post('https://fcm.googleapis.com/fcm/send', $payload);
    }
}
