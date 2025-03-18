<?php

namespace App\Filament\Resources\MarriageCertificateResource\Pages;

use App\Filament\Resources\MarriageCertificateResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMarriageCertificates extends ListRecords
{
    protected static string $resource = MarriageCertificateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
