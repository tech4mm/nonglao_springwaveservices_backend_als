<?php

namespace App\Filament\Resources\RegistrationInfoResource\Pages;

use App\Filament\Resources\RegistrationInfoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRegistrationInfos extends ListRecords
{
    protected static string $resource = RegistrationInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
