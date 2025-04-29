<?php

namespace App\Filament\Resources\NinetyDayRequirementResource\Pages;

use App\Filament\Resources\NinetyDayRequirementResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNinetyDayRequirement extends EditRecord
{
    protected static string $resource = NinetyDayRequirementResource::class;

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
