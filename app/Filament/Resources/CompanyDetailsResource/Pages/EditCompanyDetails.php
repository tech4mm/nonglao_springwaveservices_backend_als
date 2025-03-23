<?php

namespace App\Filament\Resources\CompanyDetailsResource\Pages;

use App\Filament\Resources\CompanyDetailsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCompanyDetails extends EditRecord
{
    protected static string $resource = CompanyDetailsResource::class;

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         Actions\DeleteAction::make(),
    //     ];
    // }
}
