<?php

namespace App\Filament\Resources\PassportDeclarationResource\Pages;

use App\Filament\Resources\PassportDeclarationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPassportDeclarations extends ListRecords
{
    protected static string $resource = PassportDeclarationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
