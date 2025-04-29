<?php

namespace App\Filament\Resources\RegistrationInfoResource\Pages;

use App\Filament\Resources\RegistrationInfoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRegistrationInfo extends CreateRecord
{
    protected static string $resource = RegistrationInfoResource::class;
    protected function getCreatedNotification(): ?\Filament\Notifications\Notification
    {
        return \Filament\Notifications\Notification::make()
            ->title('Created successfully')
            ->success();
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
