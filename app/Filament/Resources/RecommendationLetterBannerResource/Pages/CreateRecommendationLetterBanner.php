<?php

namespace App\Filament\Resources\RecommendationLetterBannerResource\Pages;

use App\Filament\Resources\RecommendationLetterBannerResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRecommendationLetterBanner extends CreateRecord
{
    protected static string $resource = RecommendationLetterBannerResource::class;
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
