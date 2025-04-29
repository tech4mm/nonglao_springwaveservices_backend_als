<?php

namespace App\Filament\Resources\VisaExtensionRequirementResource\Pages;

use App\Filament\Resources\VisaExtensionRequirementResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateVisaExtensionRequirement extends CreateRecord
{
    protected static string $resource = VisaExtensionRequirementResource::class;
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
