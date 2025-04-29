<?php

namespace App\Filament\Resources\UidReqResource\Pages;

use App\Filament\Resources\UidReqResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUidReq extends CreateRecord
{
    protected static string $resource = UidReqResource::class;
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
