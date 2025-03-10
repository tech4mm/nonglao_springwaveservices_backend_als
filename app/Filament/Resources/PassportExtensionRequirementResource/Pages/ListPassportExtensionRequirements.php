<?php

namespace App\Filament\Resources\PassportExtensionRequirementResource\Pages;

use App\Filament\Resources\PassportExtensionRequirementResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPassportExtensionRequirements extends ListRecords
{
    protected static string $resource = PassportExtensionRequirementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
