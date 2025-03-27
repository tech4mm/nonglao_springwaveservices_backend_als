<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\AdminNotification;
use Google\Client as GoogleClient;
use Illuminate\Support\Facades\Storage;

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

        $client = new GoogleClient();
        $client->setAuthConfig(storage_path('app/service-account.json'));
        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
        $client->fetchAccessTokenWithAssertion();
        $accessToken = $client->getAccessToken()['access_token'];

        $projectId = json_decode(file_get_contents(storage_path('app/service-account.json')), true)['project_id'];
        $fcmUrl = "https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send";

        $fcmMessage = [
            'message' => [
                'token' => $request->fcm_token,
                'notification' => [
                    'title' => $request->title,
                    'body' => $request->content,
                    'image' => $request->image,
                ],
                'data' => [
                    'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
                    'status' => 'done',
                    'title' => $request->title,
                    'body' => $request->content,
                    'image' => $request->image,
                ]
            ]
        ];

        $response = Http::withToken($accessToken)
            ->post($fcmUrl, $fcmMessage);

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
