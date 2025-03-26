<?php

namespace App\Filament\Resources\OtherCertificateResource\Pages;

use App\Filament\Resources\OtherCertificateResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOtherCertificate extends EditRecord
{
    protected static string $resource = OtherCertificateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
