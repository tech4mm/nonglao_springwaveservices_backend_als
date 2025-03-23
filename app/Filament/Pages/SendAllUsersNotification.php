<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Facades\Http;
use Filament\Notifications\Notification;
use App\Models\User;

class SendAllUsersNotification extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-oval-left-ellipsis';
    protected static ?string $navigationGroup = 'Admin Panel';
    protected static ?int $navigationSort = 99;
    protected static string $view = 'filament.pages.send-all-users-notification';

    public ?string $notificationTitle = null;
    public ?string $notificationBody = null;
    public string|array|null $notificationImage = null;

    public function mount(): void
    {
        $this->form->fill();
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('notificationTitle')->label('Title')->required(),
            TextInput::make('notificationBody')->label('Body')->required(),
            // TextInput::make('notificationImage')->label('Image URL')->nullable(),
            FileUpload::make('notificationImage')
                ->label('Upload Image')
                ->image()
                ->directory('notifications')
                ->nullable(),
        ];
    }

    protected function getFormModel(): \Illuminate\Database\Eloquent\Model|string|null{
        return User::class;
    }

    public function send(): void{
        $tokens = User::whereNotNull('fcm_token')->pluck('fcm_token')->toArray();

        // Handle string|array|null from FileUpload
        $imagePath = is_array($this->notificationImage)
            ? $this->notificationImage[0] ?? null
            : $this->notificationImage;

        $imageUrl = $imagePath ? asset('storage/' . $imagePath) : null;

        foreach ($tokens as $token) {
            Http::withToken(env('FCM_SERVER_KEY'))->post('https://fcm.googleapis.com/fcm/send', [
                'to' => $token,
                'notification' => [
                    'title' => $this->notificationTitle,
                    'body' => $this->notificationBody,
                    'image' => $imageUrl,
                ],
                'data' => [
                    'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
                ],
            ]);
        }

        Notification::make()
            ->title('Notification sent to all users')
            ->success()
            ->send();

        $this->notificationTitle = null;
        $this->notificationBody = null;
        $this->notificationImage = null;

        $this->form->fill(); // Optional: refresh form UI
    }
}
