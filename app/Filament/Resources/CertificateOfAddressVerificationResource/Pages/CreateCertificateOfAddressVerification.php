<?php

namespace App\Filament\Resources\CertificateOfAddressVerificationResource\Pages;

use App\Filament\Resources\CertificateOfAddressVerificationResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCertificateOfAddressVerification extends CreateRecord
{
    protected static string $resource = CertificateOfAddressVerificationResource::class;
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
