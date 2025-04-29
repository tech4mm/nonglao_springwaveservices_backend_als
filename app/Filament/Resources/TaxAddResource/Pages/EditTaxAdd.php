<?php

namespace App\Filament\Resources\TaxAddResource\Pages;

use App\Filament\Resources\TaxAddResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTaxAdd extends EditRecord
{
    protected static string $resource = TaxAddResource::class;

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
