<?php

namespace App\Filament\Resources\TaxAddResource\Pages;

use App\Filament\Resources\TaxAddResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTaxAdds extends ListRecords
{
    protected static string $resource = TaxAddResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
