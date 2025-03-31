<?php

namespace App\Filament\Resources\BeingSingleResource\Pages;

use App\Filament\Resources\BeingSingleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBeingSingles extends ListRecords
{
    protected static string $resource = BeingSingleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
