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
use Illuminate\Support\Facades\Storage; // Import Storage facade
use Kreait\Firebase\Factory;
use Livewire\WithFileUploads;
use Livewire\WithValidation;

class Chat extends Page
{
     use WithFileUploads;
     public $file;
        public function uploadFile(){
            if ($this->file) {

                $path = $this->file->store('chat_uploads', 'public');
                $url = Storage::disk('public')->url($path);

                Message::create([
                    'sender_id' => $this->authUserId,
                    'receiver_id' => $this->receiverId,
                    'message' => '📎 File: <a href="' . $url . '" target="_blank">View File</a>',
                ]);

                $this->loadMessages();
                $this->file = null;
            }
        }
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
    public string $search = '';


    public function mount(): void
    {
        $this->authUserId = auth()->id();
        $this->loadUsers();
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
            // Mark messages as seen
            Message::where('receiver_id', $this->authUserId)
                ->where('sender_id', $this->receiverId)
                ->where('is_seen', false)
                ->update(['is_seen' => true]);

            $this->loadUsers(); // ✅ Reload users to refresh counts

            // Dispatch an event to scroll and reset UI unread count
            $this->dispatch('chat-messages-loaded');
            $this->dispatch('scroll-to-bottom');
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

public function loadUsers(): void
{

    $this->users = User::query()
        ->where('id', '!=', $this->authUserId) // ✅ Make sure Admin itself is excluded
        ->when($this->search, fn ($query) =>
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%');
            })
        )
        ->withCount([
            'sentMessages as unread_count' => function ($query) {
                $query->where('receiver_id', $this->authUserId)
                      ->where('is_seen', false);
            }
        ])
        ->get();
}

    public function updatedSearch()
        {
            $this->loadUsers();
        }

public function getFilteredUsersProperty()
{
   
    return User::query()
    ->where('id', '!=', $this->authUserId)
    ->when($this->search, fn ($query) =>
        $query->where(function($q) {
            $q->where('name', 'like', '%' . $this->search . '%')
              ->orWhere('email', 'like', '%' . $this->search . '%')
              ->orWhere('phone', 'like', '%' . $this->search . '%');
        })
    )
    ->withCount([
        'sentMessages as unread_count' => function ($query) {
            $query->where('receiver_id', $this->authUserId)
                  ->where('is_seen', 0);
        }
    ])
    ->with(['sentMessages' => function($query) {
        $query->where('receiver_id', $this->authUserId)
              ->latest()
              ->limit(1);
    }])
    ->orderByDesc('unread_count')
    ->orderByDesc(function($query) {
        $query->select('created_at')
              ->from('messages')
              ->whereColumn('sender_id', 'users.id')
              ->where('receiver_id', $this->authUserId)
              ->latest()
              ->limit(1);
    })
    ->get();
}


    // Chat.php (Livewire Component)

public function getUsersProperty()
{
    return User::select('users.*')
        ->where('id', '!=', $this->authUserId) // ✅ Always exclude current user
        ->selectRaw('(SELECT COUNT(*) FROM messages WHERE messages.receiver_id = users.id AND messages.is_read = 0) as unread_count')
        ->get();
}
}
