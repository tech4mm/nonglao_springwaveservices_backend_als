# to make our banner image api work without 'storage/banner_image' like this -> we need to run this command on server
ln -s /var/www/html/nong_springwaveservices_backend_als/storage/app/public/banner_images /var/www/html/nong_springwaveservices_backend_als/public/banner_images

# logo change || update
under -> storage/app/public/images/logo.jpg (if there is no images folder create it)

# if there is no user profile pic in users table -> run this
php artisan migrate:rollback --step=1
php artisan migrate

<x-filament-widgets::widget>
    <x-filament::section>
        {{-- Widget content --}}
    </x-filament::section>
</x-filament-widgets::widget>


<!-- @foreach ($this->users as $user) -->

----
//ChatWidget.php -->app/Filament/Widgets/ChatWidget.php
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

----