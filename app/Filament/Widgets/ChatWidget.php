<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\Message;
use App\Models\User;
use Livewire\WithPagination;

class ChatWidget extends Widget
{
    use WithPagination;

    protected static string $view = 'filament.widgets.chat-widget';
    protected int | string | array $columnSpan = 'full';

    public $newMessage = '';
    public $receiverId = null;
    public int $authUserId;

    public function mount()
    {
        $this->receiverId = User::where('id', '!=', auth()->id())->first()?->id;
    }

    public function sendMessage()
    {
        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $this->receiverId,
            'message' => $this->newMessage,
            'is_seen' => false,
        ]);

        $this->newMessage = '';
        $this->dispatch('messageReceived');
    }

    public function getViewData(): array
    {
        $users = User::where('id', '!=', auth()->id())->get();

        $messages = collect();
        if ($this->receiverId) {
            $messages = Message::where(function ($q) {
                $q->where('sender_id', auth()->id())
                    ->where('receiver_id', $this->receiverId);
            })->orWhere(function ($q) {
                $q->where('sender_id', $this->receiverId)
                    ->where('receiver_id', auth()->id());
            })->orderBy('created_at')->get();
        }

        $authUserId = auth()->id();

        return compact('users', 'messages', 'authUserId');
    }

    protected $listeners = ['messageReceived' => '$refresh'];
}
