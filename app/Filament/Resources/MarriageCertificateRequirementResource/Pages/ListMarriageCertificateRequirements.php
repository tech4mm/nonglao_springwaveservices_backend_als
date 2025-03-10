<?php

namespace App\Filament\Resources\MarriageCertificateRequirementResource\Pages;

use App\Filament\Resources\MarriageCertificateRequirementResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMarriageCertificateRequirements extends ListRecords
{
    protected static string $resource = MarriageCertificateRequirementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
