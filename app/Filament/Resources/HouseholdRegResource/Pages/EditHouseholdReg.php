<?php

namespace App\Filament\Resources\HouseholdRegResource\Pages;

use App\Filament\Resources\HouseholdRegResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHouseholdReg extends EditRecord
{
    protected static string $resource = HouseholdRegResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
