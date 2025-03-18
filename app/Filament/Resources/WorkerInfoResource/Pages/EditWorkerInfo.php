<?php

namespace App\Filament\Resources\WorkerInfoResource\Pages;

use App\Filament\Resources\WorkerInfoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWorkerInfo extends EditRecord
{
    protected static string $resource = WorkerInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
