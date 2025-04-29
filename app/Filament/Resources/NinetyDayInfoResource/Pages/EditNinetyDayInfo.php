<?php

namespace App\Filament\Resources\NinetyDayInfoResource\Pages;

use App\Filament\Resources\NinetyDayInfoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNinetyDayInfo extends EditRecord
{
    protected static string $resource = NinetyDayInfoResource::class;

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
