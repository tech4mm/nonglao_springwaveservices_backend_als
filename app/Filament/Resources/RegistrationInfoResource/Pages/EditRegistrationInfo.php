<?php

namespace App\Filament\Resources\RegistrationInfoResource\Pages;

use App\Filament\Resources\RegistrationInfoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRegistrationInfo extends EditRecord
{
    protected static string $resource = RegistrationInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
