<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Livewire\Component;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Collection;

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

        Message::create([
            'sender_id' => $this->authUserId,
            'receiver_id' => $this->receiverId,
            'message' =>  $this->newMessage,
        ]);

        $this->newMessage = '';
        $this->loadMessages();
    }
}
