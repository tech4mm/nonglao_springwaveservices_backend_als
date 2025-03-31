<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Facades\Http;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\AdminNotification;
use Google\Client as GoogleClient;

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
        $users = User::whereNotNull('fcm_token')->get();

        $imagePath = is_array($this->notificationImage)
            ? $this->notificationImage[0] ?? null
            : $this->notificationImage;

        $imageUrl = $imagePath ? asset('storage/' . $imagePath) : null;

        $client = new GoogleClient();
        $client->setAuthConfig(storage_path('app/firebase/firebase_credentials.json'));
        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
        $accessToken = $client->fetchAccessTokenWithAssertion()['access_token'];

        foreach ($users as $user) {
            Http::withToken($accessToken)->post('https://fcm.googleapis.com/v1/projects/spring-wave-a2661/messages:send', [
                'message' => [
                    'token' => $user->fcm_token,
                    'notification' => [
                        'title' => $this->notificationTitle,
                        'body' => $this->notificationBody,
                        'image' => $imageUrl,
                    ],
                    'data' => [
                        'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
                    ],
                ]
            ]);

            try {
                AdminNotification::create([
                    'user_id' => $user->id,
                    'title' => $this->notificationTitle,
                    'content' => $this->notificationBody,
                    'image' => $imageUrl,
                    'fcm_token' => $user->fcm_token,
                    'status' => 'sent',
                ]);
            } catch (\Throwable $e) {
                Log::error("Failed to save notification for user {$user->id}: " . $e->getMessage());
            }
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
