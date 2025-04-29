<?php

namespace App\Filament\Resources\DependencyRelativeResource\Pages;

use App\Filament\Resources\DependencyRelativeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDependencyRelative extends EditRecord
{
    protected static string $resource = DependencyRelativeResource::class;

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
