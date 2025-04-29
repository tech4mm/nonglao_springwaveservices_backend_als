<?php

namespace App\Filament\Resources\VisaExtensionRequirementResource\Pages;

use App\Filament\Resources\VisaExtensionRequirementResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVisaExtensionRequirement extends EditRecord
{
    protected static string $resource = VisaExtensionRequirementResource::class;

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
