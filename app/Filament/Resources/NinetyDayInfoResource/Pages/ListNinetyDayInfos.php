<?php

namespace App\Filament\Resources\NinetyDayInfoResource\Pages;

use App\Filament\Resources\NinetyDayInfoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNinetyDayInfos extends ListRecords
{
    protected static string $resource = NinetyDayInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
