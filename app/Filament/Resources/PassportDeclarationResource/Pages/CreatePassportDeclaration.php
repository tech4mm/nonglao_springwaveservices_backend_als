<?php

namespace App\Filament\Resources\PassportDeclarationResource\Pages;

use App\Filament\Resources\PassportDeclarationResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePassportDeclaration extends CreateRecord
{
    protected static string $resource = PassportDeclarationResource::class;
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
