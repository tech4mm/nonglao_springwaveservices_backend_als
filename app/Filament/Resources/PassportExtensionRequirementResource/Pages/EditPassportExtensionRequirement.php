<?php

namespace App\Filament\Resources\PassportExtensionRequirementResource\Pages;

use App\Filament\Resources\PassportExtensionRequirementResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPassportExtensionRequirement extends EditRecord
{
    protected static string $resource = PassportExtensionRequirementResource::class;

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
