<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\AdminNotificationController;
use App\Http\Controllers\FCMController;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Support\Facades\Broadcast;

Broadcast::routes(['middleware' => ['web', 'auth']]);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/download-apk', function () {
    $filePath = public_path('apk/app-release.apk');

    return Response::download($filePath, 'app-release.apk', [
        'Content-Type' => 'application/vnd.android.package-archive',
        'Content-Disposition' => 'attachment; filename="app-release.apk"',
    ]);
})->name('download.apk');


Route::get('/download-file', function (Request $request) { // ← This is the Illuminate\Http\Request instance
    $url = $request->query('url'); // Now works correctly
    $filename = basename($url);
    
    return response()->streamDownload(function () use ($url) {
        echo file_get_contents($url);
    }, $filename);
})->name('download.file');

Route::get('/send-notification', function () {
    $message = Message::create([
        'sender_id' => 18,
        'receiver_id' => 1,
        'message' => 'from pusher user dd',
    ]);
    //event(new MessageSent($message, auth()->id()));
    $event = event(new MessageSent($message));
    return $event;
});
