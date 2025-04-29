<?php

namespace App\Filament\Resources\CertOfNVToOpenBankAccRequirementResource\Pages;

use App\Filament\Resources\CertOfNVToOpenBankAccRequirementResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCertOfNVToOpenBankAccRequirement extends EditRecord
{
    protected static string $resource = CertOfNVToOpenBankAccRequirementResource::class;

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
