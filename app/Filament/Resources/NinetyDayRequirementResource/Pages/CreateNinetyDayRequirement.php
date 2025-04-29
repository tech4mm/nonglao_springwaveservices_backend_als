<?php

namespace App\Filament\Resources\NinetyDayRequirementResource\Pages;

use App\Filament\Resources\NinetyDayRequirementResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateNinetyDayRequirement extends CreateRecord
{
    protected static string $resource = NinetyDayRequirementResource::class;
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
