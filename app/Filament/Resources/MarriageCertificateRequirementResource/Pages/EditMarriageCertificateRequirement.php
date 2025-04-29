<?php

namespace App\Filament\Resources\MarriageCertificateRequirementResource\Pages;

use App\Filament\Resources\MarriageCertificateRequirementResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMarriageCertificateRequirement extends EditRecord
{
    protected static string $resource = MarriageCertificateRequirementResource::class;

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
