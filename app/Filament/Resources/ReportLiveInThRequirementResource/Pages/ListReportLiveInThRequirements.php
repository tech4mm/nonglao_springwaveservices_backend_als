<?php

namespace App\Filament\Resources\ReportLiveInThRequirementResource\Pages;

use App\Filament\Resources\ReportLiveInThRequirementResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListReportLiveInThRequirements extends ListRecords
{
    protected static string $resource = ReportLiveInThRequirementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
