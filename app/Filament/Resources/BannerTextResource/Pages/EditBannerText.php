<?php

namespace App\Filament\Resources\BannerTextResource\Pages;

use App\Filament\Resources\BannerTextResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBannerText extends EditRecord
{
    protected static string $resource = BannerTextResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
