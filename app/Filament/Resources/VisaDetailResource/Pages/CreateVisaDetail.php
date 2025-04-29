<?php

namespace App\Filament\Resources\VisaDetailResource\Pages;

use App\Filament\Resources\VisaDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateVisaDetail extends CreateRecord
{
    protected static string $resource = VisaDetailResource::class;
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
