<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OtherCertificateResource\Pages;
use App\Filament\Resources\OtherCertificateResource\RelationManagers;
use App\Models\OtherCertificate;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OtherCertificateResource extends Resource
{
    protected static ?string $model = OtherCertificate::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('e_title')->required(),
            Forms\Components\Textarea::make('e_body')->required(),
            Forms\Components\TextInput::make('m_title')->required(),
            Forms\Components\Textarea::make('m_body')->required(),
            Forms\Components\TextInput::make('t_title')->required(),
            Forms\Components\Textarea::make('t_body')->required(),
            Forms\Components\TextInput::make('s_title')->required(),
            Forms\Components\Textarea::make('s_body')->required(),
            Forms\Components\Toggle::make('type'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('e_title')->searchable(),
            Tables\Columns\TextColumn::make('m_title'),
            Tables\Columns\IconColumn::make('type')->boolean(),
            Tables\Columns\TextColumn::make('created_at')->dateTime(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListOtherCertificates::route('/'),
            'create' => Pages\CreateOtherCertificate::route('/create'),
            'edit' => Pages\EditOtherCertificate::route('/{record}/edit'),
        ];
    }
}
