<?php

namespace App\Filament\Resources\WorkPermitDetailResource\Pages;

use App\Filament\Resources\WorkPermitDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWorkPermitDetails extends ListRecords
{
    protected static string $resource = WorkPermitDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
