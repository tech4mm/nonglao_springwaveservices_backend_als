<?php

namespace App\Filament\Resources\OwicReqResource\Pages;

use App\Filament\Resources\OwicReqResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOwicReq extends CreateRecord
{
    protected static string $resource = OwicReqResource::class;
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
