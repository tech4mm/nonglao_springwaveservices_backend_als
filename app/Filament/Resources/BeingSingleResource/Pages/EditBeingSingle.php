<?php

namespace App\Filament\Resources\BeingSingleResource\Pages;

use App\Filament\Resources\BeingSingleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBeingSingle extends EditRecord
{
    protected static string $resource = BeingSingleResource::class;

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
