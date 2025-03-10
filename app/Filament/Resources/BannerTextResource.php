<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BannerTextResource\Pages;
use App\Filament\Resources\BannerTextResource\RelationManagers;
use App\Models\BannerText;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BannerTextResource extends Resource
{
    protected static ?string $model = BannerText::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('banner_text')
                ->label('Banner Text')
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('id')->sortable(),
            Tables\Columns\TextColumn::make('banner_text'),
            Tables\Columns\TextColumn::make('created_at')->date(),
            Tables\Columns\TextColumn::make('updated_at')->date(),
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
            'index' => Pages\ListBannerTexts::route('/'),
            'create' => Pages\CreateBannerText::route('/create'),
            'edit' => Pages\EditBannerText::route('/{record}/edit'),
        ];
    }
}
