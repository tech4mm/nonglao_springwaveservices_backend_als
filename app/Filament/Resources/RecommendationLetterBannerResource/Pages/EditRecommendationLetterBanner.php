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
    protected function getSavedNotification(): ?\Filament\Notifications\Notification
    {
        return \Filament\Notifications\Notification::make()
            ->title('Saved successfully')
            ->success();
    }

    protected function afterSave(): void
    {
        $this->redirect($this->getResource()::getUrl('index'));
    }
}
