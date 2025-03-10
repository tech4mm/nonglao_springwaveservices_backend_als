<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyDetailsResource\Pages;
use App\Filament\Resources\CompanyDetailsResource\RelationManagers;
use App\Models\CompanyDetails;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class CompanyDetailsResource extends Resource
{
    protected static ?string $model = CompanyDetails::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Textarea::make('application_details')->columnSpan(2),
                Textarea::make('company_address')->columnSpan(2),
                Textarea::make('company_bank_details')->columnSpan(2),
                FileUpload::make('bank_payment_qr')
                    ->image()
                    ->directory('qr_codes')
                    ->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('application_details')->limit(50),
                TextColumn::make('company_address')->limit(50),
                TextColumn::make('company_bank_details')->limit(50),
                ImageColumn::make('bank_payment_qr')->disk('public')->square(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCompanyDetails::route('/'),
            'create' => Pages\CreateCompanyDetails::route('/create'),
            'edit' => Pages\EditCompanyDetails::route('/{record}/edit'),
        ];
    }
}
