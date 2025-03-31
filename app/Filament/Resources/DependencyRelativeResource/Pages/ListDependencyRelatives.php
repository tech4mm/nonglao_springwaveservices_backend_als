<?php

namespace App\Filament\Resources\DependencyRelativeResource\Pages;

use App\Filament\Resources\DependencyRelativeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDependencyRelatives extends ListRecords
{
    protected static string $resource = DependencyRelativeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
