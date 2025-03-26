<?php

namespace App\Filament\Resources\OwicReqResource\Pages;

use App\Filament\Resources\OwicReqResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOwicReq extends EditRecord
{
    protected static string $resource = OwicReqResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
