<?php

namespace App\Filament\Resources\PassportExtensionRequirementResource\Pages;

use App\Filament\Resources\PassportExtensionRequirementResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePassportExtensionRequirement extends CreateRecord
{
    protected static string $resource = PassportExtensionRequirementResource::class;
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
