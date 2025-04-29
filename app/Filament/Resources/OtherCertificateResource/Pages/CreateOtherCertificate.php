<?php

namespace App\Filament\Resources\OtherCertificateResource\Pages;

use App\Filament\Resources\OtherCertificateResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOtherCertificate extends CreateRecord
{
    protected static string $resource = OtherCertificateResource::class;
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
