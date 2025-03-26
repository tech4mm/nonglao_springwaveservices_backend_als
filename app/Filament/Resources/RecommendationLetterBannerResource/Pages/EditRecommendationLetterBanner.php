<?php

namespace App\Filament\Resources\RecommendationLetterBannerResource\Pages;

use App\Filament\Resources\RecommendationLetterBannerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRecommendationLetterBanner extends EditRecord
{
    protected static string $resource = RecommendationLetterBannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
