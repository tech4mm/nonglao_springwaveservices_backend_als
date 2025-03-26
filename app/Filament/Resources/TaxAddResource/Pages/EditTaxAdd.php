<?php

namespace App\Filament\Resources\TaxAddResource\Pages;

use App\Filament\Resources\TaxAddResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTaxAdd extends EditRecord
{
    protected static string $resource = TaxAddResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
