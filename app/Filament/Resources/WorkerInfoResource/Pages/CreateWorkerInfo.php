<?php

namespace App\Filament\Resources\WorkerInfoResource\Pages;

use App\Filament\Resources\WorkerInfoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateWorkerInfo extends CreateRecord
{
    protected static string $resource = WorkerInfoResource::class;
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
