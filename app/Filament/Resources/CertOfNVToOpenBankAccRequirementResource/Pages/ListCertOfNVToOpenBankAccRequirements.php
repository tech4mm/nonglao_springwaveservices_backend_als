<?php

namespace App\Filament\Resources\CertOfNVToOpenBankAccRequirementResource\Pages;

use App\Filament\Resources\CertOfNVToOpenBankAccRequirementResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCertOfNVToOpenBankAccRequirements extends ListRecords
{
    protected static string $resource = CertOfNVToOpenBankAccRequirementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
