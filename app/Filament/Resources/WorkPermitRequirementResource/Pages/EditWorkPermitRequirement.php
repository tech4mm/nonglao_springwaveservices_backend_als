<?php

namespace App\Filament\Resources\WorkPermitRequirementResource\Pages;

use App\Filament\Resources\WorkPermitRequirementResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWorkPermitRequirement extends EditRecord
{
    protected static string $resource = WorkPermitRequirementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
