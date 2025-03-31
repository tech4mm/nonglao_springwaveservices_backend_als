<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\AdminNotificationController;
use App\Http\Controllers\FCMController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/download-apk', function () {
    $filePath = public_path('apk/app-release.apk'); // make sure the path is correct
    return response()->download($filePath, 'app-release.apk');
})->name('download.apk');

// Route::middleware(['web', 'auth']) // Admin login required
//     ->get('/send-notification/{user}', [NotificationController::class, 'send'])
//     ->name('fcm.send');

// Route::post('/send-notification', [AdminNotificationController::class, 'send'])
//     ->name('fcm.send.from.admin'); // ✅ No {user} required


// Route::post('/fcm/send-from-admin/{user}', [AdminNotificationController::class, 'send'])
//     ->name('fcm.send.from.admin')
//     ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);
