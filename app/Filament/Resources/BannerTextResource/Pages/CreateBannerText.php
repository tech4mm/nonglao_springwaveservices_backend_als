<?php

namespace App\Filament\Resources\BannerTextResource\Pages;

use App\Filament\Resources\BannerTextResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBannerText extends CreateRecord
{
    protected static string $resource = BannerTextResource::class;
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
