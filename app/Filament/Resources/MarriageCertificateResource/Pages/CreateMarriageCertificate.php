<?php

namespace App\Filament\Resources\MarriageCertificateResource\Pages;

use App\Filament\Resources\MarriageCertificateResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMarriageCertificate extends CreateRecord
{
    protected static string $resource = MarriageCertificateResource::class;
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
