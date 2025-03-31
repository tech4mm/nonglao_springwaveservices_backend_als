<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Livewire\Component;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Kreait\Firebase\Messaging; // Ensure this is the correct namespace for Messaging
use Kreait\Firebase\Messaging\CloudMessage; // Import CloudMessage from Firebase SDK
use Kreait\Firebase\Messaging\Notification; // Import Notification from Firebase SDK
use App\Models\AdminNotification; // Import AdminNotification model
use Illuminate\Support\Facades\Log; // Import Log facade
use Kreait\Firebase\Factory;

class Chat extends Page
{
    //protected static ?string $navigationIcon = 'heroicon-o-chat-alt-2';
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static string $view = 'filament.pages.chat';
     public static function getNavigationSort(): ?int
    {
        return 3; // Sorting order (lower values appear first)
    }

    public string $newMessage = '';
    public ?int $receiverId = null;
    public int $authUserId;
    public Collection $users;
    public Collection $messages;

    public function mount(): void
    {
        $this->authUserId = auth()->id();
        $this->users = User::where('id', '!=', $this->authUserId)->get();
        $this->receiverId = $this->users->first()?->id;
        $this->loadMessages();
    }

    public function updatedReceiverId(): void
    {
        $this->loadMessages();
    }

    public function loadMessages(): void
    {
        $this->messages = collect();
        if ($this->receiverId) {
            $this->messages = Message::where(function ($q) {
                $q->where('sender_id', $this->authUserId)
                    ->where('receiver_id', $this->receiverId);
            })->orWhere(function ($q) {
                $q->where('sender_id', $this->receiverId)
                    ->where('receiver_id', $this->authUserId);
            })->orderBy('created_at')->get();
        }
    }

    public function sendMessage(): void
    {
        if (!$this->receiverId || !$this->newMessage) return;

        $messageText = $this->newMessage;

        Message::create([
            'sender_id' => $this->authUserId,
            'receiver_id' => $this->receiverId,
            'message' => $messageText,
        ]);

        $this->loadMessages();

        // Optionally, you can also send a notification to the receiver
        try {
            $messaging = (new Factory)
                ->withServiceAccount(storage_path('app/firebase/firebase_credentials.json'))
                ->createMessaging();

            $receiver = User::find($this->receiverId);
            if (!$receiver || !$receiver->fcm_token) {
                throw new \Exception('Receiver or FCM token not found.');
            }

            $notification = Notification::create('New Message', $messageText);

            $message = CloudMessage::withTarget('token', $receiver->fcm_token)
                ->withNotification($notification)
                ->withData([
                    'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
                    'image' => '',
                ]);

            $messaging->send($message);

            // try {
            //     AdminNotification::create([
            //         'user_id' => $receiver->id,
            //         'title' => $messageText,
            //         'content' => $messageText,
            //         'image' => null,
            //         'fcm_token' => $receiver->fcm_token,
            //         'status' => 'sent',
            //     ]);
            // } catch (\Throwable $dbError) {
            //     Log::error('DB Error (AdminNotification): ' . $dbError->getMessage());
            // }

            \Filament\Notifications\Notification::make()
                ->title("Notification sent to {$receiver->name}")
                ->success()
                ->send();
        } catch (\Throwable $e) {
            Log::error('FCM Error: ' . $e->getMessage());

            \Filament\Notifications\Notification::make()
                ->title("Failed to send notification: " . $e->getMessage())
                ->danger()
                ->send();
        }

        $this->newMessage = '';
    }
}
