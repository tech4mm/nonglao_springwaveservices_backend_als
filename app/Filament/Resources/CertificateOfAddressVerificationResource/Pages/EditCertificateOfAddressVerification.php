<?php

namespace App\Filament\Resources\CertificateOfAddressVerificationResource\Pages;

use App\Filament\Resources\CertificateOfAddressVerificationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCertificateOfAddressVerification extends EditRecord
{
    protected static string $resource = CertificateOfAddressVerificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
