<?php

namespace App\Filament\Resources\VisaDetailResource\Pages;

use App\Filament\Resources\VisaDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVisaDetails extends ListRecords
{
    protected static string $resource = VisaDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
