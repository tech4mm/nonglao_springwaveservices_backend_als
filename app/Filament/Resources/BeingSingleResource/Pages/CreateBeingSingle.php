<?php

namespace App\Filament\Resources\BeingSingleResource\Pages;

use App\Filament\Resources\BeingSingleResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBeingSingle extends CreateRecord
{
    protected static string $resource = BeingSingleResource::class;
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
