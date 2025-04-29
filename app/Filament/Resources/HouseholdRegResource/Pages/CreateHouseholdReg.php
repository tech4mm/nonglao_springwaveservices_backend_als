<?php

namespace App\Filament\Resources\HouseholdRegResource\Pages;

use App\Filament\Resources\HouseholdRegResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateHouseholdReg extends CreateRecord
{
    protected static string $resource = HouseholdRegResource::class;
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
