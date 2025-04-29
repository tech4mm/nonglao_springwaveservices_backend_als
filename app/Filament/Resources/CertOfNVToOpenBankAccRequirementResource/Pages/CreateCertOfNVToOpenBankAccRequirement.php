<?php

namespace App\Filament\Resources\CertOfNVToOpenBankAccRequirementResource\Pages;

use App\Filament\Resources\CertOfNVToOpenBankAccRequirementResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCertOfNVToOpenBankAccRequirement extends CreateRecord
{
    protected static string $resource = CertOfNVToOpenBankAccRequirementResource::class;
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
