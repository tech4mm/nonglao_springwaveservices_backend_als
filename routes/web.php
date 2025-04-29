<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\AdminNotificationController;
use App\Http\Controllers\FCMController;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

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
