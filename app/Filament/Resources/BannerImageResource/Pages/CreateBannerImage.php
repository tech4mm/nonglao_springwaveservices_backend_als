<?php

namespace App\Filament\Resources\BannerImageResource\Pages;

use App\Filament\Resources\BannerImageResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBannerImage extends CreateRecord
{
    protected static string $resource = BannerImageResource::class;

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
