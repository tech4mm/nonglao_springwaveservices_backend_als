<?php

namespace App\Filament\Resources\WorkPermitRequirementResource\Pages;

use App\Filament\Resources\WorkPermitRequirementResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateWorkPermitRequirement extends CreateRecord
{
    protected static string $resource = WorkPermitRequirementResource::class;
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
