<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Events\MessageSent;

class ChatController extends Controller
{
     public function sendMessage(Request $request)
    {
        $message = Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => 1, // Admin ID (change if needed)
            'message' => $request->message,
        ]);

        broadcast(new MessageSent($message))->toOthers();

        return response()->json($message);
    }

    public function getMessages()
    {
        return Message::where('receiver_id', auth()->user()->id)
            ->orWhere('sender_id', auth()->user()->id)
            ->orderBy('created_at', 'asc')
            ->get();
    }
}
