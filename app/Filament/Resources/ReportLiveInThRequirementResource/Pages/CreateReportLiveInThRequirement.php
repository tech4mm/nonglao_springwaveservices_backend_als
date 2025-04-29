<?php

namespace App\Filament\Resources\ReportLiveInThRequirementResource\Pages;

use App\Filament\Resources\ReportLiveInThRequirementResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateReportLiveInThRequirement extends CreateRecord
{
    protected static string $resource = ReportLiveInThRequirementResource::class;
    protected function getCreatedNotification(): ?\Filament\Notifications\Notification
    {
        return \Filament\Notifications\Notification::make()
            ->title('Created successfully')
            ->success();
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
