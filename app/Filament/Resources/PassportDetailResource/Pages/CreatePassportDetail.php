<?php

namespace App\Filament\Resources\PassportDetailResource\Pages;

use App\Filament\Resources\PassportDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePassportDetail extends CreateRecord
{
    protected static string $resource = PassportDetailResource::class;
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
