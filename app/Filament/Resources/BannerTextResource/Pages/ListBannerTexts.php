<?php

namespace App\Filament\Resources\BannerTextResource\Pages;

use App\Filament\Resources\BannerTextResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBannerTexts extends ListRecords
{
    protected static string $resource = BannerTextResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
