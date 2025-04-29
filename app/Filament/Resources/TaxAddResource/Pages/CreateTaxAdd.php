<?php

namespace App\Filament\Resources\TaxAddResource\Pages;

use App\Filament\Resources\TaxAddResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTaxAdd extends CreateRecord
{
    protected static string $resource = TaxAddResource::class;
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
