<?php

namespace App\Filament\Resources\MarriageCertificateRequirementResource\Pages;

use App\Filament\Resources\MarriageCertificateRequirementResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMarriageCertificateRequirement extends CreateRecord
{
    protected static string $resource = MarriageCertificateRequirementResource::class;
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
