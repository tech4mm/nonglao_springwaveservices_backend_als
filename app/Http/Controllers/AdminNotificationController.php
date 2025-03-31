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
        print($accessToken);

        $projectId = json_decode(file_get_contents(storage_path('app/service-account.json')), true)['project_id'];
        // $fcmUrl = "https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send";

        $fcmUrl = "https://fcm.googleapis.com/v1/projects/spring-wave-a2661/messages:send";

        $fcmMessage = [
            'message' => [
                // 'token' => $request->fcm_token,
                'token' => 'cXj4IZg6T6-BLZK0DVZkT2:APA91bEh2s26rsbVMh7jcBLil2YqWeWWq3qChy_LEeIq059K6U_GRRcm03FonXiRxNZCgdmVNSzSzAAeh3HEGAnzXKWGMKi8uMNvereonO4rlH0nFCm-VIY',
                'notification' => [
                    // 'title' => $request->title,
                    // 'body' => $request->content,
                    'title' => 'Test Title',
                    'body' => 'Test Body',
                    // 'image' => $request->image,
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

    public function index(Request $request){
        return AdminNotification::where('user_id', $request->user()->id)
            ->latest()
            ->paginate(10);
    }

    public function show(Request $request, $id){
        return AdminNotification::where('user_id', $request->user()->id)
            ->findOrFail($id);
    }
}
