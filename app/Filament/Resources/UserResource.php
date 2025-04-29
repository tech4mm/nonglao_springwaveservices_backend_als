<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\PasswordInput;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\AdminNotification; // Ensure the AdminNotification model exists in this namespace
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Actions\Action;
use Kreait\Firebase\Contract\Messaging;
use Illuminate\Support\Facades\App;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    public static function getNavigationLabel(): string{
        return 'User Management'; // Custom text
    }

    public static function getNavigationGroup(): ?string{
        return 'Admin Panel'; // Custom group
    }

    public static function getNavigationSort(): ?int{
        return 1; // Sorting order (lower values appear first)
    }

    public static function getNavigationIcon(): ?string{
        return 'heroicon-o-user-group'; // Icon (from Heroicons)
    }

    public static function form(Form $form): Form{
        return $form
            ->schema([
                //
            TextInput::make('name')
                ->required()
                ->label('Name'),

            Forms\Components\FileUpload::make('user_picture')
                ->label('User Picture')->nullable()
                ->disk('public')
                ->directory('profile_pics') // ✅ Optional: stores inside /storage/app/public/user_picture
                ->nullable()
                ->image(),

            TextInput::make('phone')
                ->required()
                ->unique(ignoreRecord: true)
                ->label('Phone'),

            TextInput::make('email')
                ->email()
                ->unique(ignoreRecord: true)
                ->label('Email'),

            TextInput::make('password')
                ->password()
                ->label('Password')
                ->dehydrateStateUsing(fn ($state) => filled($state) ? bcrypt($state) : null)
                ->dehydrated(fn ($state) => filled($state))
                ->nullable(),

            TextInput::make('passport_number')->label('Passport Number')->nullable(),
            Forms\Components\Select::make('gender')
                ->label('Gender')
                ->options([
                    'Male' => 'Male',
                    'Female' => 'Female',
                    'Other' => 'Other',
                ])
                ->nullable(),

            Forms\Components\Select::make('status')
                ->label('Status')
                ->options([
                    'approved' => 'Approved',
                    'pending' => 'Pending',
                ])
                ->default('pending'),

            Forms\Components\DatePicker::make('date_of_birth')->label('Date of Birth')->nullable(),
            TextInput::make('registration_number')->label('NRC Number')->nullable(),
            TextInput::make('uid_number')->label('UID Number')->nullable(),
            TextInput::make('taxpayer_number')->label('Taxpayer Number')->nullable(),
            TextInput::make('owic_number')->label('OWIC Number')->nullable(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('id')->sortable()->searchable(),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('phone')->sortable()->searchable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('passport.passport_expire_date')
                    ->label('Passport Expire')
                    ->date()
                    ->sortable(),

                TextColumn::make('visa.visa_expire_date')
                    ->label('Visa Expire')
                    ->date()
                    ->sortable(),

                TextColumn::make('workPermit.work_permit_expire_date')
                    ->label('Work Permit Expire')
                    ->date()
                    ->sortable(),

                TextColumn::make('ninetyDay.expire_date')
                    ->label('90-Day Report Expire')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                //Tables\Actions\EditAction::make(),
                //Tables\Actions\DeleteAction::make(),
                Action::make('Send Notification')
                    ->icon('heroicon-o-paper-airplane')
                    ->form([
                        TextInput::make('title')->required()->label('Notification Title'),
                        TextInput::make('body')->required()->label('Notification Body'),
                        Forms\Components\FileUpload::make('image')
                            ->label('Upload Image')
                            ->disk('public')
                            ->directory('notifications')
                            ->image()
                            ->nullable(),
                    ])
                    ->action(function (array $data, User $record): void {
                        try {
                            /** @var Messaging $messaging */
                            $messaging = App::make(Messaging::class);

                            $message = CloudMessage::withTarget('token', $record->fcm_token)
                                ->withNotification(Notification::create($data['title'], $data['body']))
                                ->withData([
                                    'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
                                    'image' => $data['image'] ?? '',
                                ]);

                            $messaging->send($message);
                            try {
                                AdminNotification::create([
                                    'user_id' => $record->id,
                                    'title' => $data['title'],
                                    'content' => $data['body'],
                                    'image' => $data['image'] ?? null,
                                    'fcm_token' => $record->fcm_token,
                                    'status' => 'sent',
                                ]);
                            } catch (\Throwable $dbError) {
                                Log::error('DB Error (AdminNotification): ' . $dbError->getMessage());
                            }

                            \Filament\Notifications\Notification::make()
                                ->title("Notification sent to {$record->name}")
                                ->success()
                                ->send();
                        } catch (\Throwable $e) {
                            Log::error('FCM Error: ' . $e->getMessage());

                            \Filament\Notifications\Notification::make()
                                ->title("Failed to send notification.")
                                ->danger()
                                ->send();
                        }
                    })
                    ->modalHeading('Send FCM Notification')
                    ->requiresConfirmation(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

}
