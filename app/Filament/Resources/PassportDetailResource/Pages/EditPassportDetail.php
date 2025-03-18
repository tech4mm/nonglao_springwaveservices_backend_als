<?php

namespace App\Filament\Resources\PassportDetailResource\Pages;

use App\Filament\Resources\PassportDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPassportDetail extends EditRecord
{
    protected static string $resource = PassportDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
