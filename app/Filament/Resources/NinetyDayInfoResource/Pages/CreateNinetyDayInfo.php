<?php

namespace App\Filament\Resources\NinetyDayInfoResource\Pages;

use App\Filament\Resources\NinetyDayInfoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateNinetyDayInfo extends CreateRecord
{
    protected static string $resource = NinetyDayInfoResource::class;
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
