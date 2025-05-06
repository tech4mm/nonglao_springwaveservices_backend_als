<?php
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chat.{userId}', function ($user, $userId) {
    \Log::info('Broadcast auth', ['user' => $user, 'userId' => $userId]);
    return (int) $user->id === (int) $userId;
});