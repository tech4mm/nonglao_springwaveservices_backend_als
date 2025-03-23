<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class SendFcmNotification implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $fcmToken, $title, $body, $image;

    public function __construct($fcmToken, $title, $body, $image = null)
    {
        $this->fcmToken = $fcmToken;
        $this->title = $title;
        $this->body = $body;
        $this->image = $image;
    }

    public function handle()
    {
        $serverKey = config('services.fcm.server_key'); // set in config/services.php

        $payload = [
            "to" => $this->fcmToken,
            "notification" => [
                "title" => $this->title,
                "body" => $this->body,
                "image" => $this->image,
            ],
            "data" => [
                "click_action" => "FLUTTER_NOTIFICATION_CLICK",
            ],
        ];

        Http::withToken($serverKey)->post('https://fcm.googleapis.com/fcm/send', $payload);
    }
}
