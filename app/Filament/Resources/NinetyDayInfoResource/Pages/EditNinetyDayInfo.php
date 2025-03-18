<?php

namespace App\Filament\Resources\NinetyDayInfoResource\Pages;

use App\Filament\Resources\NinetyDayInfoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNinetyDayInfo extends EditRecord
{
    protected static string $resource = NinetyDayInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
