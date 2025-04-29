<?php

namespace App\Filament\Resources\ReportLiveInThRequirementResource\Pages;

use App\Filament\Resources\ReportLiveInThRequirementResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditReportLiveInThRequirement extends EditRecord
{
    protected static string $resource = ReportLiveInThRequirementResource::class;

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
