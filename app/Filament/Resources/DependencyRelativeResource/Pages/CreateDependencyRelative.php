<?php

namespace App\Filament\Resources\DependencyRelativeResource\Pages;

use App\Filament\Resources\DependencyRelativeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDependencyRelative extends CreateRecord
{
    protected static string $resource = DependencyRelativeResource::class;
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
