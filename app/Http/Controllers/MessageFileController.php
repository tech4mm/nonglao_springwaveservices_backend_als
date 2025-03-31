<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MessageFileController extends Controller
{
    //
    public function upload(Request $request)
{
    $request->validate([
        'file' => 'required|file|max:10240',
    ]);

    // Store under public disk so it goes to storage/app/public/messages
    $path = $request->file('file')->store('messages', 'public');

    return response()->json([
        'success' => true,
        'path' => $path,
        'url' => asset('storage/' . $path),
    ]);
}
}
