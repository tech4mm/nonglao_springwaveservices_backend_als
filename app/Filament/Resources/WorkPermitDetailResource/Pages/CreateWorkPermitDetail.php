<?php

namespace App\Filament\Resources\WorkPermitDetailResource\Pages;

use App\Filament\Resources\WorkPermitDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateWorkPermitDetail extends CreateRecord
{
    protected static string $resource = WorkPermitDetailResource::class;
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
