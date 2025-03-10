<?php

namespace App\Filament\Resources\VisaExtensionRequirementResource\Pages;

use App\Filament\Resources\VisaExtensionRequirementResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVisaExtensionRequirement extends EditRecord
{
    protected static string $resource = VisaExtensionRequirementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
