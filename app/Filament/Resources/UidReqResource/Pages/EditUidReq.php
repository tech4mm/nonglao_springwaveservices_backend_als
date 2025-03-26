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
}
