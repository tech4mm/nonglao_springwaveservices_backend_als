<?php

namespace App\Filament\Resources\VisaDetailResource\Pages;

use App\Filament\Resources\VisaDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVisaDetail extends EditRecord
{
    protected static string $resource = VisaDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
