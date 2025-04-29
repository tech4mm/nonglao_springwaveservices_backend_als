<?php

namespace App\Filament\Resources\UidReqResource\Pages;

use App\Filament\Resources\UidReqResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUidReq extends EditRecord
{
    protected static string $resource = UidReqResource::class;

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
