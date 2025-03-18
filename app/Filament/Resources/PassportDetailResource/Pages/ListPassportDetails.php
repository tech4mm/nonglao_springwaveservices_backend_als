<?php

namespace App\Filament\Resources\PassportDetailResource\Pages;

use App\Filament\Resources\PassportDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPassportDetails extends ListRecords
{
    protected static string $resource = PassportDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
