<?php

namespace App\Filament\Resources\BeingSingleResource\Pages;

use App\Filament\Resources\BeingSingleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBeingSingle extends EditRecord
{
    protected static string $resource = BeingSingleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
