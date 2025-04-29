<?php

namespace App\Filament\Resources\PassportDeclarationResource\Pages;

use App\Filament\Resources\PassportDeclarationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPassportDeclaration extends EditRecord
{
    protected static string $resource = PassportDeclarationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getSavedNotification(): ?\Filament\Notifications\Notification
    {
        return \Filament\Notifications\Notification::make()
            ->title('Saved successfully')
            ->success();
    }

    protected function afterSave(): void
    {
        $this->redirect($this->getResource()::getUrl('index'));
    }
}
